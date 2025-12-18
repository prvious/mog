@props([
    'key',
    'multiple' => true,
    'bag' => 'default',
])

@error($key)
    @php
        $errorBag = $errors->getBag($bag);
    @endphp

    <div
        role="alert"
        data-slot="field-error"
        {{ $attributes->cn('text-destructive text-sm font-normal') }}>
        <ul className="ml-4 flex list-disc flex-col gap-1">
            @foreach ($multiple ? $errorBag->get($key) : [$errorBag->first($key)] as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@enderror
