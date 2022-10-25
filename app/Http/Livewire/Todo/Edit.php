<?php

namespace App\Http\Livewire\Todo;

use App\Models\Todo;
use Illuminate\View\View;
use Livewire\Component;

class Edit extends Component
{
    public $todo;
    public bool $toggleEditModal = false;

    protected $listeners = ['updateTodo'];

    public function updateTodo(Todo $todo): void
    {
        $this->todo = $todo;
        $this->toggleEditModal = true;
    }

    protected $rules = [
        'todo.title' => 'required|min:8',
    ];

    public function update(): void
    {
        $this->validate();

        $this->todo->save();

        $this->emitTo('todo.index', 'updateTodo-' . $this->todo->id);

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.todo.edit');
    }
}
