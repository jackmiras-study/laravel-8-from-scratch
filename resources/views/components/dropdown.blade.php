@props(['trigger'])

<div x-data="{ show: false }" @click.away="show = false">
    {{-- Trigger | The x-data being set is from Alpine.js --}}
    <div @click="show = !show">
        {{ $trigger }}
    </div>

    {{-- Links | The x-show being set is from Alpine.js --}}
    <div x-show="show" class="py-2 absolute bg-gray-100 mt-2 rounded-xl w-full z-50 overflow-auto max-h-52" style="display: none">
        {{ $slot }}
    </div>
</div>
