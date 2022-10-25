<?php

namespace App\Http\Livewire\Task;

use App\Models\Todo;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public Todo $todo;

    protected function getListeners()
    {
        return [
            'refreshCreatedTasks-' . $this->todo->id => 'taskCreated',
            'refreshDeletedTasks-' . $this->todo->id => 'taskDeleted',
        ];
    }

    public function taskCreated(): void
    {
        $this->dispatchBrowserEvent('task-created', [
            'title' => 'Task Created!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);

        '$refresh';
    }

    public function taskDeleted(): void
    {
        $this->dispatchBrowserEvent('task-deleted', [
            'title' => 'Task Deleted!',
            'icon' => 'error',
            'iconColor' => 'red',
        ]);

        '$refresh';
    }

    public function render(): View
    {
        return view('livewire.task.index', [
            'tasks' => $this->todo->tasks
        ]);
    }
}
