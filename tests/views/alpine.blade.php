@extends('mog-test::layout')

@section('title', 'Alpine.js Test')

@section('content')
    <div x-data="{ count: 0, message: 'Hello Alpine!' }" class="space-y-4">
        <h1 class="text-2xl font-bold">Alpine.js Integration Test</h1>

        <div class="space-y-2">
            <p dusk="alpine-message" x-text="message"></p>
            <p dusk="alpine-count">Count: <span x-text="count"></span></p>
            <button
                @click="count++"
                dusk="alpine-increment"
                class="px-4 py-2 bg-blue-500 text-white rounded"
            >
                Increment
            </button>
        </div>
    </div>
@endsection
