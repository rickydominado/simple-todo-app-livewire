<x-jet-dialog-modal wire:model="toggleEditTaskModal">
    <x-slot name="title">
        {{ __('Edit Task') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="update" id="formEditTask">
        @csrf
            <div class="space-y-4 p-4">
                <x-jet-label for="title" class="font-semibold text-base" value="Title" />
                <x-jet-input type="text" id="title" name="title" wire:model.defer="task.title" class="w-full" autocomplete="off" />
                <x-jet-input-error for="task.title" />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('toggleEditTaskModal')" wire:loading.attr='disabled'>
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

        <x-todo.button-primary type="submit" class="ml-2" wire:target='update' wire:loading.attr='disabled' form="formEditTask">
            {{ __('Update') }}
        </x-todo.button-primary>
    </x-slot>
</x-jet-dialog-modal>

@push('scripts')
<script>
    window.addEventListener('task-updated', e => {
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
