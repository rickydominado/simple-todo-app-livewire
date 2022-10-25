<?php

namespace App\Http\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Todo extends Component
{
    protected $listeners = [
        'todoCreated',
        'todoDeleted',
    ];

    public function todoCreated(): void
    {
        $this->dispatchBrowserEvent('todo-created', [
            'title' => 'Todo Created!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);

        '$refresh';
    }

    public function todoDeleted(): void
    {
        $this->dispatchBrowserEvent('todo-deleted', [
            'title' => 'Todo Deleted!',
            'icon' => 'error',
            'iconColor' => 'red',
        ]);

        '$refresh';
    }

    public function render(): View
    {
        $todos = \App\Models\Todo::with('tasks')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('livewire.todo', compact('todos'))->layout('layouts.app', ['title' => 'List']);
    }
}
