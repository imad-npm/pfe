<?php

namespace App\Http\Controllers\Admin;

use App\Models\Speciality;

use App\Http\Requests\Admin\Student\UploadRequest;
use App\Models\Student;
use App\Services\StudentService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    private $studentService;
    public function __construct(StudentService $service)
    {
        $this->studentService = $service;
    }

    public function index(Request $request)
    {

        $search = $request->input('search');
        $status = $request->input('status');
        $speciality = $request->input('speciality');
        $sort=$request->input('sort') ;

        if ($speciality && !Speciality::where("abbreviation", $speciality)->first())
            return abort(404);

        $students = $this->studentService->getStudents($search,
         $speciality, $status,$sort);
        $specialities = Speciality::all();

        return view('admin.students.index', compact('students', 'speciality', "specialities"));
    }

    public function edit() {}
    public function destroy() {}

    public function show(Student $student)
    {
        return view("admin.students.show", compact('student'));
    }


    public function uploadForm()
    {
        $specialities = Speciality::all();
        return view("admin.students.upload", compact('specialities'));
    }
    public function upload(UploadRequest $request)
    {

        $validated = $request->validated();
        $requiredColumns = ['N°', "N° d'inscription", 'Nom', 'Prénom', 'MG', 'Crédit aquis', 'Décision'];

        foreach ($validated as $speciality => $file) {
            # code... 
            if ($file) {

                if (!validateColumns($file->getRealPath(), $requiredColumns))
                    return redirect()->back()->withErrors(
                        [$speciality => "The CSV file for $speciality does not 
                                                contain the required columns."]
                    );

                if (!containsRows($file->getRealPath()))
                    return redirect()->back()->withErrors(
                        [$speciality => "The CSV file for $speciality does not 
                                                                            contain any rows."]
                    );


                $file->storeAs("uploads", "students_$speciality.csv");
                $this->studentService->storeUploadedStudents($speciality);
            }
        }

        return back()->withSuccess("Students Uploaded Successfully .");
    }
}
