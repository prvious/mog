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
            @if ($paginator->onFirstPage())
                <x-mog::button
                    class="gap-1 px-2.5 sm:pr-2.5"
                    aria-label="Go to previous page"
                    variant="ghost">
                    @svg('mog-chevron-left')
                    <span class="hidden sm:block">Prvious</span>
                </x-mog::button>
            @else
                <x-mog::link
                    class="gap-1 px-2.5 sm:pr-2.5"
                    href="{{ $paginator->previousPageUrl() }}"
                    aria-label="Go to previous page"
                    variant="ghost">
                    @svg('mog-chevron-left')
                    <span class="hidden sm:block">Prvious</span>
                </x-mog::link>
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
                        <x-mog::link
                            href="{{ $link['url'] }}"
                            class="flex size-9 items-center justify-center"
                            variant="{{$link['active'] ? 'outline' : 'ghost'}}">
                            {{ $link['label'] }}
                        </x-mog::link>
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
                <x-mog::link
                    class="gap-1 px-2.5 sm:pr-2.5"
                    href="{{ $paginator->nextPageUrl() }}"
                    aria-label="Go to next page"
                    variant="ghost">
                    <span class="hidden sm:block">Next</span>
                    @svg('mog-chevron-right')
                </x-mog::link>
            @endif
        </li>
    </ul>
</nav>
