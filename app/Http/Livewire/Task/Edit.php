<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Illuminate\View\View;
use Livewire\Component;

class Edit extends Component
{
    public $task;
    public bool $toggleEditTaskModal = false;

    protected $listeners = ['updateTask'];

    public function updateTask(Task $task): void
    {
        $this->task = $task;
        $this->toggleEditTaskModal = true;
    }

    protected $rules = [
        'task.title' => 'required|min:8',
    ];

    public function update(): void
    {
        $this->validate();

        $this->task->save();

        $this->emitTo('task.show', 'updateTask-' . $this->task->id);

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.task.edit');
    }
}
