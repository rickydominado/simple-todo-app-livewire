<div class="flex justify-end my-5">
    <x-todo.button-primary wire:click="$toggle('toggleCreateModal')" wire:loading.attr="disabled" class="!p-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-5 h-5 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        {{ __('Add Todo') }}
    </x-todo.button-primary>

    <x-jet-dialog-modal wire:model="toggleCreateModal">
        <x-slot name="title">
            {{ __('Create Todo') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit.prevent="store" id="createform">
                @csrf
                <div class="space-y-4 p-4">
                    <x-jet-label for="title" class="font-semibold text-base" value="Title" />
                    <x-jet-input type="text" id="title" name="title" wire:model.defer="title" class="w-full"
                        autocomplete="off" placeholder="Todo title..." />
                    <x-jet-input-error for="title" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('toggleCreateModal')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-todo.button-primary type="submit" class="ml-2" wire:target="store" wire:loading.attr="disabled"
                form="createform">
                {{ __('Create') }}
            </x-todo.button-primary>
        </x-slot>
    </x-jet-dialog-modal>
</div>

@push('scripts')
<script>
    window.addEventListener('todo-created', e => {
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
