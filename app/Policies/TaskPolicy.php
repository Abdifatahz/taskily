<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     *  This allow user to create tasks if this he/she owns projects of this tasks
     */
    public function create(User $user, $project): bool
    {
        return $user->id === $project->user_id;
    }

    /**
     *  This allow user to Edit or update tasks if this he/she owns projects of this tasks
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id;
    }

    /**
     * This allow user to delete tasks if this he/she owns projects of this tasks
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->project->user_id;
    }
}
