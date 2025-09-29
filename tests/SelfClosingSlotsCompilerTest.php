<?php

it('compiles name attribute self-closing slots', function ($slot) {
    expect(trim($this->compiler()->compileSlots($slot)))
        ->toBe("@slot('foo', null, []) @endslot");
})->with([
    '<x-slot name="foo"/>',
    '<x-slot name="foo" />',
    '<x-slot name="foo"/ >',
    '<x-slot name="foo" / >',
]);

it('compiles inline name self-closing slots', function ($slot) {
    expect(trim($this->compiler()->compileSlots($slot)))
        ->toBe("@slot('foo', null, []) @endslot");
})->with([
    '<x-slot:foo/>',
    '<x-slot:foo />',
    '<x-slot:foo/ >',
    '<x-slot:foo / >',
]);

it('compiles bound name self-closing slots', function ($slot) {
    expect(trim($this->compiler()->compileSlots($slot)))
        ->toBe("@slot('foo', null, []) @endslot");
})->with([
    '<x-slot :name="foo"/>',
    '<x-slot :name="foo" />',
    '<x-slot :name="foo"/ >',
    '<x-slot :name="foo" / >',
]);

it('compiles vanilla named slots', function ($slot) {
    expect(trim($this->compiler()->compileSlots($slot)))
        ->toBe("@slot('foo', null, []) </x-slot>");
})->with([
    '<x-slot name="foo"></x-slot>',
    '<x-slot name="foo" ></x-slot>',

    '<x-slot:foo></x-slot>',
    '<x-slot:foo ></x-slot>',

    '<x-slot :name="foo"></x-slot>',
    '<x-slot :name="foo" ></x-slot>',
]);

it('compiles vanilla named slots with weird spacing', function () {
    expect(trim($this->compiler()->compileSlots('<x-slot name="foo"></x-slot>')))
        ->toBe("@slot('foo', null, []) </x-slot>");

    expect(trim($this->compiler()->compileSlots('<x-slot name="foo"> </x-slot>')))
        ->toBe("@slot('foo', null, [])  </x-slot>");

    expect(trim($this->compiler()->compileSlots('<x-slot name="foo" ></x-slot>')))
        ->toBe("@slot('foo', null, []) </x-slot>");

    expect(trim($this->compiler()->compileSlots('<x-slot name="foo" > </x-slot>')))
        ->toBe("@slot('foo', null, [])  </x-slot>");

    expect(trim($this->compiler()->compileSlots('<x-slot name="foo"  ></x-slot>')))
        ->toBe("@slot('foo', null, []) </x-slot>");

    expect(trim($this->compiler()->compileSlots('<x-slot name="foo"  > </x-slot>')))
        ->toBe("@slot('foo', null, [])  </x-slot>");

    expect(trim($this->compiler()->compileSlots('<x-slot:foo></x-slot:foo>')))
        ->toBe("@slot('foo', null, []) </x-slot:foo>");

    expect(trim($this->compiler()->compileSlots('<x-slot:foo ></x-slot:foo>')))
        ->toBe("@slot('foo', null, []) </x-slot:foo>");
});
