<div class="my-4">
    @foreach ($tasks as $task)
        <livewire:task.show :task="$task" :wire:key="'task-' . $task->id">
    @endforeach
</div>
