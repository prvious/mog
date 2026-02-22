<div {{ $attributes->cn('flex items-center') }}>
    <x-mog::scrollable class="max-w-[96%] md:max-w-[600px] lg:max-w-none">
        <div class="flex items-center">
            <a
                href="/"
                class="text-muted-foreground hover:text-primary data-[active=true]:text-primary flex h-7 items-center justify-center px-4 text-center text-base font-medium transition-colors">
                Examples
            </a>
            @php
                $examples = [
                    [
                        'name' => 'Dashboard',
                        'href' => '/examples/dashboard',
                    ],
                    [
                        'name' => 'Tasks',
                        'href' => '/examples/tasks',
                    ],
                    [
                        'name' => 'Playground',
                        'href' => '/examples/playground',
                    ],
                    [
                        'name' => 'Authentication',
                        'href' => '/examples/authentication',
                    ],
                ];
            @endphp

            @foreach ($examples as $example)
                <a
                    href="{{ $example['href'] }}"
                    class="text-muted-foreground hover:text-primary data-[active=true]:text-primary flex h-7 items-center justify-center px-4 text-center text-base font-medium transition-colors">
                    {{ $example['name'] }}
                </a>
            @endforeach
        </div>
    </x-mog::scrollable>
</div>
