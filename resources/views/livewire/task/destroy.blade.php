<x-jet-dialog-modal wire:model="toggleDestroyTaskModal">
    <x-slot name="title">
        {{ __('Delete Task') }}
    </x-slot>

    <x-slot name="content">
        Are you sure you want to Delete?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('toggleDestroyTaskModal')" wire:loading.attr='disabled'>
            {{ __('Newvermind') }}
        </x-jet-secondary-button>

        <x-jet-danger-button wire:click="destroy" wire:loading.attr='disabled' class="ml-2">
            {{ __('Delete') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-dialog-modal>

@push('scripts')
<script>
    window.addEventListener('task-deleted', e => {
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
