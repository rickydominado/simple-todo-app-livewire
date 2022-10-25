<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Illuminate\View\View;
use Livewire\Component;

class Show extends Component
{
    public Task $task;
    public $isDone;

    public function dehydrate(): void
    {
        $this->isDone = $this->task->is_done;
    }

    protected function getListeners()
    {
        return ['updateTask-' . $this->task->id => 'taskUpdated'];
    }

    public function taskUpdated(): void
    {
        $this->dispatchBrowserEvent('task-updated', [
            'title' => 'Task Updated!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);

        '$refresh';
    }

    public function isDone(): void
    {
        $this->task->update([
            'is_done' => true,
        ]);

        $this->dispatchBrowserEvent('mark-as-done', [
            'title' => 'Mark as Done!',
            'icon' => 'success',
            'iconColor' => 'green',
        ]);
    }

    public function undoIsDone(): void
    {
        $this->task->update([
            'is_done' => false,
        ]);

        $this->dispatchBrowserEvent('undo-done', [
            'title' => 'Mark as not Done!',
            'icon' => 'info',
            'iconColor' => 'gray',
        ]);
    }

    public function render(): View
    {
        return view('livewire.task.show');
    }
}
