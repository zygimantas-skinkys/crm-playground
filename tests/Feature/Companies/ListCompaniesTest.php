<?php

use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('returns a successful response', function () {
    $this->get(route('companies.index'))->assertSuccessful();
});

it('displays the livewire component', function () {
    $this->get(route('companies.index'))->assertSeeLivewire(\App\Livewire\Companies\Index::class);
});

it('displays companies', function () {
    $companies = Company::factory()->count(3)->create();

    $response = $this->get(route('companies.index'));

    foreach ($companies as $company) {
        $response->assertSee($company->name);
        $response->assertSee($company->email);
    }
});

it('shows correct pagination', function () {
    Company::factory()->count(15)->create();

    $this->get(route('companies.index'))->assertSee('Next');
});

it('shows empty state when no companies', function () {
    $response = $this->get(route('companies.index'));

    $response->assertSuccessful();
    $response->assertSee('Companies');
});

it('has correct table structure', function () {
    Company::factory()->count(2)->create();

    $response = $this->get(route('companies.index'));

    $response->assertSee('Name');
    $response->assertSee('Email');
    $response->assertSee('Image');
    $response->assertSee('Website');
    $response->assertSee('Employees');
});

it('includes employee count link', function () {
    $company = Company::factory()->create();

    $this->get(route('companies.index'))->assertSee(route('employees.index', $company));
});

it('navigates to next page', function () {
    Company::factory()->count(12)->create();

    $response = $this->get(route('companies.index').'?page=2');

    $response->assertSuccessful();
    $response->assertSee('Previous');
});

it('renders livewire component with companies', function () {
    $companies = Company::factory()->count(5)->create();

    Livewire::test(\App\Livewire\Companies\Index::class)
        ->assertSee($companies->first()->name)
        ->assertSee($companies->first()->email)
        ->assertStatus(200);
});
