<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the project can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Allow user to View project  detail with tasks if he/she owns.
     */
    public function view(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    /**
     * Allow everyone to create project
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Allow user to update project if he/she owns.
     */
    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    /**
     * Allow user to delete project if he/she owns.
     */
    public function delete(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }
}
