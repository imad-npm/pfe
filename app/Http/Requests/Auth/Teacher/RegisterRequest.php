<?php

namespace App\Http\Requests\Auth\Teacher;

use App\Http\Requests\Admin\Teacher\RegisterRequest as TeacherRegisterRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Rules\Name;

class RegisterRequest extends TeacherRegisterRequest
{
   
}
