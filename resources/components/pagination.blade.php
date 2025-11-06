@props([
    'paginator',
])

<nav
    role="navigation"
    aria-label="pagination"
    data-slot="pagination"
    class="mx-auto flex w-full justify-center">
    <ul
        data-slot="pagination-content"
        class="flex flex-row items-center gap-1">
        <li data-active="false">
            @php
                $previousPage = match (get_class($paginator)) {
                    Illuminate\Pagination\LengthAwarePaginator::class => "previousPage('{$paginator->getPageName()}')",
                    Illuminate\Pagination\CursorPaginator::class => "setPage('{$paginator->previousCursor()->encode()}','{$paginator->getCursorName()}')",
                    Illuminate\Pagination\Paginator::class => "previousPage('{$paginator->getPageName()}')",
                };

                $nextPage = match (get_class($paginator)) {
                    Illuminate\Pagination\LengthAwarePaginator::class => "nextPage('{$paginator->getPageName()}')",
                    Illuminate\Pagination\CursorPaginator::class => "setPage('{$paginator->nextCursor()->encode()}','{$paginator->getCursorName()}')",
                    Illuminate\Pagination\Paginator::class => "nextPage('{$paginator->getPageName()}')",
                };
            @endphp

            @if ($paginator->onFirstPage())
                <x-mog::button
                    class="gap-1 px-2.5 sm:pr-2.5"
                    aria-label="Go to previous page"
                    variant="ghost">
                    @svg('mog-chevron-left')
                    <span class="hidden sm:block">Prvious</span>
                </x-mog::button>
            @else
                <x-mog::button
                    class="gap-1 px-2.5 sm:pr-2.5"
                    wire:click="{{ $previousPage }}"
                    aria-label="Go to previous page"
                    variant="ghost">
                    @svg('mog-chevron-left')
                    <span class="hidden sm:block">Prvious</span>
                </x-mog::button>
            @endif
        </li>

        @if ($paginator instanceof Illuminate\Pagination\LengthAwarePaginator)
            @php
                $links = $paginator->linkCollection();

                $links->pop();
                $links->shift();
            @endphp

            @foreach ($links as $link)
                <li data-active="@js($link['active'])">
                    @if ($link['label'] === '...')
                        <x-mog::button
                            class="flex size-9 items-center justify-center"
                            variant="ghost"
                            disabled>
                            @svg('mog-more-horizontal')
                        </x-mog::button>
                    @else
                        <x-mog::button
                            wire:click="gotoPage({{ $link['label'] }}, '{{ $paginator->getPageName() }}')"
                            href="{{ $link['url'] }}"
                            class="flex size-9 items-center justify-center"
                            variant="{{$link['active'] ? 'outline' : 'ghost'}}">
                            {{ $link['label'] }}
                        </x-mog::button>
                    @endif
                </li>
            @endforeach
        @elseif ($paginator instanceof Illuminate\Pagination\Paginator)
            <li data-active="true">
                {{-- <span>{{ $paginator->currentPage() }}</span> --}}
                <x-mog::button
                    class="flex size-9 items-center justify-center"
                    variant="ghost">
                    {{ $paginator->currentPage() }}
                </x-mog::button>
            </li>
        @endif

        <li data-active="false">
            @if (! $paginator->hasMorePages())
                <x-mog::button
                    class="gap-1 px-2.5 sm:pr-2.5"
                    aria-label="Go to next page"
                    variant="ghost">
                    <span class="hidden sm:block">Next</span>
                    @svg('mog-chevron-right')
                </x-mog::button>
            @else
                <x-mog::button
                    class="gap-1 px-2.5 sm:pr-2.5"
                    wire:click="{{ $nextPage }}"
                    aria-label="Go to next page"
                    variant="ghost">
                    <span class="hidden sm:block">Next</span>
                    @svg('mog-chevron-right')
                </x-mog::button>
            @endif
        </li>
    </ul>
</nav>
