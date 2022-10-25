<div x-data="{ show: false, task: @entangle($attributes->wire('model')).defer }" x-cloak @mouseenter="show = !show" @mouseleave="show = false"
    {{ $attributes->class(['relative mt-2 min-w-64 max-w-max']) }}>
    <div {{ $attributes->class(['p-4 bg-white border shadow-lg rounded-lg text-center relative']) }} :class="task && 'text-green-700 font-bold'">
        <span x-show="task" {{ $attributes->class(['absolute inset-0 flex items-center ml-5']) }}>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
        </span>
        {{ $title }}
    </div>

    <div x-show="show" :class="show && 'bg-gray-500 bg-opacity-25'" x-transition
        {{ $attributes->class(['absolute inset-0 flex items-center justify-center rounded-lg min-w-max p-4 space-x-2']) }}>
        {{ $hover_buttons }}
    </div>
</div>
