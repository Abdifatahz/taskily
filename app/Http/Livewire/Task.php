<?php

namespace App\Http\Livewire;

use App\Models\Task as TaskModel;
use Livewire\Component;

class Task extends Component
{
    public $project;


    // Re-renders task livewire view when ever updateTaskOrder trigerred.
    public function render()
    {
        $tasks  =   $this->project->tasks()
            ->orderBy('priority')
            ->get();

        return view('livewire.task', compact('tasks'));
    }

    public function updateTaskOrder($tasks)
    {
        foreach($tasks as $task) {
            $id         =    $task['value'];
            $priority   =    $task['order'];
            $task = TaskModel::find($id)->update(['priority' => $priority]);
        }
    }

}
