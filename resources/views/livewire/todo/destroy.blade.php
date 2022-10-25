<div>
    <x-jet-dialog-modal wire:model="toggleDeleteModal">
        <x-slot name="title">
            {{ __('Delete Todo') }}
        </x-slot>

        <x-slot name="content">
            Are you sure you want to Delete?
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('toggleDeleteModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="destroy" wire:loading.attr="disabled" class="ml-2">
                {{ __('Delete') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push('scripts')
<script>
    window.addEventListener('todo-deleted', e => {
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
