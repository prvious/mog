<div
    data-slot="scrollable"
    {{ $attributes->twMerge('relative overflow-auto h-72 w-48') }}>
    <div
        class="focus-visible:ring-ring/50 size-full rounded-[inherit] outline-none transition-[color,box-shadow] focus-visible:outline-1 focus-visible:ring-[3px]"
        data-slot="scrollable-viewport">
        {{ $slot }}
    </div>
</div>
