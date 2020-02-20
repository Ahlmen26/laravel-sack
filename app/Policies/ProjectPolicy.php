<?php

namespace App\Policies;

use App\Projects;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function show(User $user, Projects $project)
    {
        //
        return $project->owner == $user->id || $project->proofer == $user->id || $project->proofer2 == $user->id;
    }
}
