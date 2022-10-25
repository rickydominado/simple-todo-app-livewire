<x-jet-dialog-modal wire:model="toggleEditModal">
    <x-slot name="title">
        {{ __('Edit Todo') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="update" id="editForm">
        @csrf
            <div class="space-y-4 p-4">
                <x-jet-label for="title" class="font-semibold text-base" value="Title" />
                <x-jet-input type="text" id="title" name="title" wire:model.defer="todo.title" class="w-full" autocomplete="off" />
                <x-jet-input-error for="todo.title" />
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('toggleEditModal')" wire:loading.attr="disabled">
            {{ __('Nevermind') }}
        </x-jet-secondary-button>

        <x-todo.button-primary type="submit" class="ml-2" wire:target="update" wire:loading.attr="disabled" form="editForm">
            {{ __('Update') }}
        </x-todo.button-primary>
    </x-slot>
</x-jet-dialog-modal>

@push('scripts')
<script>
    window.addEventListener('todo-updated', e => {
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
