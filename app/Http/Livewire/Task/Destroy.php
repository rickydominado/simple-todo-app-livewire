<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Illuminate\View\View;
use Livewire\Component;

class Destroy extends Component
{
    public $task;
    public bool $toggleDestroyTaskModal = false;

    protected $listeners = ['deleteTask'];

    public function deleteTask(Task $task): void
    {
        $this->task = $task;
        $this->toggleDestroyTaskModal = true;
    }

    public function destroy(): void
    {
        $this->task->delete();

        $this->emitTo('task.index', 'refreshDeletedTasks-' . $this->task->todo->id);

        $this->reset();
    }

    public function render(): View
    {
        return view('livewire.task.destroy');
    }
}
