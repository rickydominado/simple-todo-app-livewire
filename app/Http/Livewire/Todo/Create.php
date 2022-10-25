<?php

namespace App\Http\Livewire\Todo;

use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public $title;
    public bool $toggleCreateModal = false;

    public function render(): View
    {
        return view('livewire.todo.create');
    }

    protected $rules = [
        'title' => 'required|min:8',
    ];

    public function store(): void
    {
        $data = $this->validate();

        auth()->user()->todos()->create($data);

        $this->emitUp('todoCreated');

        $this->reset();
    }
}
