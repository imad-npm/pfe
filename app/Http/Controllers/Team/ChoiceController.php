<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;

use App\Http\Requests\Team\Choice\ChoiceRequest;
use App\Models\Subject;
use App\Models\Choice;
use App\Services\ChoiceService;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    //

    private $team;
    private $choiceService;

    public function __construct(ChoiceService $service)
    {
        $this->choiceService = $service;
        $this->team = auth('team')->user();
    }

    public function index()
    {

        $choices = Choice::with('team')->get();
    }

    public function create(Request $request)
    {

        if ($this->team->choice) {
            return redirect()->back()->with("info", "You have already made a choice.");
        }


        $options = $this->choiceService->getSubjectOptions($this->team->id);

        return view('team.choices.form', compact('options'));
    }



    public function store(ChoiceRequest $request)
    {

        $validated = $request->validated();

        $selectedSubjects = [];
        foreach ($validated as $key => $value) {
            # code...
            if ($key != "team_id")
                $selectedSubjects[] = $value;
        }

        $hasDuplicates = count($selectedSubjects) > count(array_unique($selectedSubjects));
        if ($hasDuplicates) {
            return redirect()->back()->withInput()->
            withErrors("All choices must be different");
        }
        $validated["team_id"] = $this->team->id;
        Choice::create($validated);


        return redirect()->route('team.dashboard')->with("success", "Choice submitted successfully.");
    }


    public function show()
    {
        $choice = Choice::where('team_id', $this->team->id)->first();
        // dd($choice) ;
        if (!$choice)
            return view('team.choices.show');

        $subjects=$this->choiceService->getSubjects($choice) ;

        return view('team.choices.show', compact('subjects'));
    }
}
