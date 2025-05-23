<?php

namespace App\Policies;

use App\Models\Teacher;
use Illuminate\Auth\Access\Response;

class TeacherPolicy
{
    /**
     * Determine whether the teacher can view any models.
     */
    public function viewAny(Teacher $externalTeacher): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can view the model.
     */
    public function view(Teacher $teacher, Teacher $externalTeacher): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can create models.
     */
    public function create(Teacher $externalTeacher): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can update the model.
     */
    public function update(Teacher $teacher, Teacher $externalTeacher): bool
    {
        
        return $teacher->id==$externalTeacher->added_by_id;
    }

    /**
     * Determine whether the teacher can delete the model.
     */
    public function delete(Teacher $teacher, Teacher $externalTeacher): bool
    {
        return $teacher->id==$externalTeacher->added_by_id;
     }

    /**
     * Determine whether the teacher can restore the model.
     */
    public function restore(Teacher $teacher, Teacher $externalTeacher): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can permanently delete the model.
     */
    public function forceDelete(Teacher $teacher, Teacher $externalTeacher): bool
    {
        return false;
    }
}
