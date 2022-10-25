<?php

namespace App\Http\Livewire\Todo;

use App\Models\Todo;
use Illuminate\View\View;
use Livewire\Component;

class Index extends Component
{
    public Todo $todo;

    protected function getListeners()
    {
        return ['updateTodo-' . $this->todo->id  => 'todoUpdated'];
    }

    public function todoUpdated(): void
    {
        $this->dispatchBrowserEvent('todo-updated', [
            'title' => 'Todo Updated!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);

        '$refresh';
    }

    public function render(): View
    {
        return view('livewire.todo.index');
    }
}
