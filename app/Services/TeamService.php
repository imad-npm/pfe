<?php

namespace App\Services;

use App\Models\Speciality;
use App\Models\Student;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf;
use Ramsey\Uuid\Type\Decimal;

class TeamService
{

    public function getTeams(
        $search = null,
        $status = null,
        $speciality = null,
        $type = null,
        $choice_status = null,
        $sort = null,
        $paginated = true
    ) {
        $query = Team::with(["choice", 'student1', "student2", 'assignedSubject']);

        if ($status == "assigned") {
            $query->whereHas("assignedSubject");
        }
        if ($status == "not assigned") {
            $query->whereDoesntHave("assignedSubject");
        }

        if ($type == "one member") {
            $query->whereDoesntHave("student2");
        }
        if ($type == "two members") {
            $query->whereHas("student2");
        }

        if ($choice_status == "with_choice") {
            $query->whereHas("choice");
        }
        if ($choice_status == "without_choice") {
            $query->whereDoesntHave("choice");
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere("student1_email", "like", "%$search%")
                    ->orWhere("student2_email", "like", "%$search%")

                    ->orWhere(function ($q1) use ($search) {
                        $q1->whereHas('student1', function ($q) use ($search) {
                            $q->where("firstname", "like", "%$search%")

                                ->orWhere("lastname", "like", "%$search%")
                                ->orWhereRaw("concat(firstname,' ',lastname) like ?", ["%$search%"]);
                        })
                            ->orWhereHas('student2', function ($q) use ($search) {
                                $q->where("firstname", "like", "%$search%")
                                    ->orWhere("lastname", "like", "%$search%")
                                    ->orWhereRaw("concat(firstname,' ',lastname) like ?", ["%$search%"]);
                            })
                            ->orWhereHas('assignedSubject', function ($q) use ($search) {
                                $q->where("title", "like", "%$search%")
                                    ->orWhere("tags", "like", "%$search%");
                            })

                        ;
                    });
            });
        }

        if ($speciality) {
            $speciality_id = Speciality::where("abbreviation", $speciality)->value("id");

            $query->where('speciality_id', "$speciality_id");
        }
        if ($sort) {
            $query->orderByDesc("max_average");
        }
        //   $teams = $query->orderByDesc("max_average");

        return $paginated ? $query->paginate(10)->withQueryString() : $query->get();
    }


    public function getStudentByEmail($email)
    {
        return Student::with("email")
            ->whereHas('email', function ($q) use ($email) {
                $q->where("email", $email);
            })
            ->first();
    }

    public function calculateMaxAverage($student1, $student2)
    {
        if ($student2)
            return $student1->average >= $student2->average ? $student1->average : $student2->average;

        return  (float) $student1->average;
    }
    public function prepareTeamData($validated, $team = null)
    {
        $student1 = $this->getStudentByEmail($validated["student1_email"]);
        $student2 = $this->getStudentByEmail($validated["student2_email"]);

        $validated['student1_id'] = $student1->id;
         $validated['student2_id'] = $student2?->id;
        
        $validated["max_average"] = $this->calculateMaxAverage($student1, $student2);
        if (!empty($validated["password"]))

            $validated["password"] = Hash::make($validated["password"]);

        else
            unset($validated["password"] );

        if($team && $team?->max_average == $validated['max_average'])
            unset($validated['max_average']) ;    
        return $validated;
    }



    /* public function createTeamsZip($status)
    {
        $specialities = Speciality::all();
        $zip = new ZipArchive;
        $zipFileName = storage_path("app/public/teams_exports.zip");

        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($specialities as $speciality) {
                # code
                $teams = $this->getTeams(speciality: $speciality->abbreviation, status: $status, paginated: false);

                $pdf = Pdf::loadView('admin.pdf.teams', compact('teams'));
                $fileName = "teams_$speciality->abbreviation" . (($status == "assigned" || $status == "not assigned") ?
                    "_$status" : "");

                $zip->addFromString("$fileName.pdf", $pdf->output());

                $csvContent = $this->generateCsv($teams);

                $zip->addFromString("$fileName.xlsx", $csvContent);
            }
            $zip->close();
        }

        return $zipFileName;
    }
*/

    public function createTeamsZip($teams)
    {
        $zip = new ZipArchive;
        $zipFileName = storage_path("app/public/teams_exports.zip");

        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            # code

            $pdf = Pdf::loadView('admin.pdf.teams', compact('teams'));
            $fileName = "teams";

            $zip->addFromString("$fileName.pdf", $pdf->output());

            $csvContent = $this->generateCsv($teams);

            $zip->addFromString("$fileName.xlsx", $csvContent);

            $zip->close();
        }

        return $zipFileName;
    }

    public function generateCsv($teams)
    {
        $file = fopen('php://temp', 'r+');
        $cols = [
            'id',
            'student 1',
            'student 2',
            'assigned subject',
            'speciality'
        ];
        fputcsv($file, $cols);

        foreach ($teams as $team) {
            # code...
            fputcsv($file, [
                $team->id,
                $team->student1->firstname . ' ' . $team->student1->lastname,
                $team->student2?->firstname . ' ' . $team->student2?->lastname,
                $team->assignedSubject?->title,
                $team->speciality?->abbreviation
            ]);
        }
        rewind($file);
        return stream_get_contents($file);
        fclose($file);
    }
}
