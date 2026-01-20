@extends('mog-test::layout')

@section('title', 'Theme System Test')

@section('content')
    <div x-data="{ currentTheme: window.Mog?.theme || 'light' }" class="space-y-4">
        <h1 class="text-2xl font-bold">Theme System Test</h1>

        <div class="space-y-2">
            <p dusk="current-theme">Current theme: <span x-text="currentTheme"></span></p>

            <div class="flex gap-2">
                <button
                    @click="window.Mog?.paint('light'); currentTheme = 'light'"
                    dusk="theme-light"
                    class="px-4 py-2 bg-white text-black rounded border"
                >
                    Light Mode
                </button>
                <button
                    @click="window.Mog?.paint('dark'); currentTheme = 'dark'"
                    dusk="theme-dark"
                    class="px-4 py-2 bg-gray-800 text-white rounded"
                >
                    Dark Mode
                </button>
            </div>
        </div>
    </div>
@endsection
