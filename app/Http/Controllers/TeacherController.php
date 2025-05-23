<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Teacher\ExternalTeacherRequest;
use App\Http\Requests\Admin\Teacher\RegisterRequest;
use App\Http\Requests\Admin\Teacher\UpdateExternalTeacherRequest;
use App\Http\Requests\Admin\Teacher\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    private $teacherService ;

    public function __construct(TeacherService $service) {
        $this->teacherService = $service;


    }


    public function show( Teacher $teacher)
    {
       
        return view('public.teachers.show', compact('teacher'));
    }

 
   
}
