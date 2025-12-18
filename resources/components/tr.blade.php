<tr
    data-slot="table-row"
    {{ $attributes->cn('hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors') }}>
    {{ $slot }}
</tr>
