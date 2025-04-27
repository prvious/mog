@props(['collapsible' => true])

@php
    // I dont really like this. it doesn't feel right(I'm no js expert). This could create potential performance issues if the group is large.
    $onclick = 'x-on:click="Array.from($event.target.closest(\'[data-mog-group]\').children).filter((x) => x !== $event.target.closest(\'[data-mog-groupable]\')).forEach((x) => Alpine.$data(x).close())"';
@endphp

<div
    x-data
    data-mog-group
    {!! when($collapsible, $onclick) !!}>
    {{ $slot }}
</div>
