<?php

use Illuminate\Support\Facades\Route;
use Livewire\Features\SupportRouting\LivewirePageController;

Route::get('/', LivewirePageController::class)
    ->defaults('_livewire_component', 'pages::index');
