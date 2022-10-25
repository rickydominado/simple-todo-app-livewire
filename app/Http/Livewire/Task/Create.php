<?php

namespace App\Http\Livewire\Task;

use App\Models\Todo;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public $todo;
    public bool $toggleCreateTaskModal = false;
    public $title;

    protected $listeners = ['createTask'];

    public function createTask(Todo $todo): void
    {
        $this->todo = $todo;
        $this->toggleCreateTaskModal = true;
    }

    protected $rules = [
        'title' => 'required|min:8',
    ];

    public function store(): void
    {
        $data = $this->validate();

        $this->todo->tasks()->create($data);

        $this->emitTo('task.index', 'refreshCreatedTasks-' . $this->todo->id);

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.task.create');
    }
}
