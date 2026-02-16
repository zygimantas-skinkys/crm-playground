<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns a successful response', function () {
    $this->get(route('home'))->assertSuccessful();
});

it('displays the application name', function () {
    $this->get(route('home'))->assertSee(config('app.name'));
});

it('includes a link to companies', function () {
    $this->get(route('home'))->assertSee(route('companies.index'));
});

it('shows the welcome message', function () {
    $this->get(route('home'))->assertSuccessful();
});
