<div x-data="{ show: false }" x-cloak
    {{ $attributes->class(['inline-block mt-5 ml-5 bg-white rounded-lg shadow-lg p-4']) }}>
    <div @mouseenter="show = !show" @mouseleave="show = false" {{ $attributes->class(['relative min-w-64 my-4']) }}>
        <div {{ $attributes->class(['p-4 bg-gray-700 shadow-lg rounded-lg text-center text-white']) }}>
            {{ $title }}
        </div>

        <div x-show="show" :class="show && 'bg-gray-500 bg-opacity-25'" x-transition
            {{ $attributes->class(['absolute inset-0 flex items-center justify-center rounded-lg min-w-max p-4 space-x-2']) }}>
            {{ $hover_buttons }}
        </div>
    </div>

    {{ $slot }}
</div>
