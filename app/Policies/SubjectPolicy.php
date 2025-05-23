<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    /**
     * Determine whether the teacher can view any models.
     */
    public function viewAny(Teacher $teacher): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can view the model.
     */
    public function view(Teacher $teacher, Subject $subject): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can create models.
     */
    public function create(Teacher $teacher): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can update the model.
     */
    public function update(Teacher $teacher, Subject $subject): bool
    {
        return $teacher->id==$subject->supervisor_id || $teacher->id==$subject->supervisor_id 
         ;
    }

    /**
     * Determine whether the teacher can delete the model.
     */
    public function delete(Teacher $teacher, Subject $subject): bool
    {
        return $teacher->id==$subject->supervisor_id || $teacher->id==$subject->supervisor_id ;
    }

    /**
     * Determine whether the teacher can restore the model.
     */
    public function restore(Teacher $teacher, Subject $subject): bool
    {
        return false;
    }

    /**
     * Determine whether the teacher can permanently delete the model.
     */
    public function forceDelete(Teacher $teacher, Subject $subject): bool
    {
        return false;
    }
}
