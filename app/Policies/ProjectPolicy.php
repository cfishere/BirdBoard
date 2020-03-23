<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

   
/**
 * [update description]
 * @param  User   $user authenticated user.
 * @param Project $project the current project Model.
 * @return bool   true when project owner is current auth user.
 */
    public function update(User $user, Project $project)
    {
       return $user->is( $project->owner $project->members ) || $project->members->contains($user);
    }

     public function edit(User $user, Project $project)
    {
       return $user->is( $project->owner );
    }
}
