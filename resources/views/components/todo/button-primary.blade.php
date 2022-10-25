<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:outline-none focus:border-blue-800 focus:ring focus:ring-blue-200 active:bg-blue-700 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
