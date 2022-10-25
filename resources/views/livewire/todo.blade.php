<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Todo list') }}
    </h2>
</x-slot>


<div class="container py-12 mx-auto">
    <!-- Todo Create -->
    <livewire:todo.create />

    <div class="flex flex-wrap items-start">
        <!-- Todo Cards -->
        @foreach ($todos as $todo)
            <livewire:todo.index :todo="$todo" :wire:key="'todo-' . $todo->id" />
        @endforeach
    </div>
</div>

@push('modals')
    <!-- Todo Edit Modal -->
    <livewire:todo.edit />

    <!-- Todo Delete Modal -->
    <livewire:todo.destroy />

    <!-- Task Create Modal -->
    <livewire:task.create />

    <!-- Task Edit Modal -->
    <livewire:task.edit />

    <!-- Task Destroy Modal -->
    <livewire:task.destroy />
@endpush
