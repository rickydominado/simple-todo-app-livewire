<x-jet-dialog-modal wire:model="toggleCreateTaskModal">
    <x-slot name="title">
        {{ __('Create Task') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="store" id="createTaskForm">
            @csrf
            <div class="space-y-4 p-4">
                <x-jet-label for="title" class="font-semibold text-base" value="Title" />
                <x-jet-input type="text" id="title" name="title" wire:model.defer="title" class="w-full"
                    autocomplete="off" placeholder="Task title..." />
                <x-jet-input-error for="title" />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('toggleCreateTaskModal')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

        <x-todo.button-primary type="submit" class="ml-2" wire:target="store" wire:loading.attr="disabled"
            form="createTaskForm">
            {{ __('Create') }}
        </x-todo.button-primary>
    </x-slot>
</x-jet-dialog-modal>

@push('scripts')
<script>
    window.addEventListener('task-created', e => {
        Swal.fire({
            title: e.detail.title,
            icon: e.detail.icon,
            iconColor: e.detail.iconColor,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
        });
    });
</script>
@endpush
