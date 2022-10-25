<?php

namespace App\Http\Livewire\Todo;

use App\Models\Todo;
use Illuminate\View\View;
use Livewire\Component;

class Destroy extends Component
{
    public $todo;
    public bool $toggleDeleteModal = false;

    protected $listeners = ['deleteTodo'];

    public function deleteTodo(Todo $todo): void
    {
        $this->todo = $todo;
        $this->toggleDeleteModal = true;
    }

    public function destroy(): void
    {
        $this->todo->delete();

        $this->emitTo('todo', 'todoDeleted');

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.todo.destroy');
    }
}
