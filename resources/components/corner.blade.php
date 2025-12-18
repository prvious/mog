<div {{ $attributes->cn('relative') }}>
    {{ $slot }}

    <span
        class="group-hover:border-current/50 absolute left-0 top-0 size-1.5 border-l border-t border-current transition-[height,width] group-hover:size-3"></span>
    <span
        class="group-hover:border-current/50 absolute right-0 top-0 size-1.5 border-r border-t border-current transition-[height,width] group-hover:size-3"></span>
    <span
        class="group-hover:border-current/50 absolute bottom-0 left-0 size-1.5 border-b border-l border-current transition-[height,width] group-hover:size-3"></span>
    <span
        class="group-hover:border-current/50 absolute bottom-0 right-0 size-1.5 border-b border-r border-current transition-[height,width] group-hover:size-3"></span>
</div>
