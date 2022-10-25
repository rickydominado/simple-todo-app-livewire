<button x-data="{ show: @entangle($attributes->wire('model')).defer }" x-cloak x-show="!show"
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-200 active:bg-green-800 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
