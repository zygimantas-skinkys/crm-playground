<?php

use App\Company;
use App\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('returns a successful response', function () {
    $company = Company::factory()->create();

    $this->get(route('employees.index', $company))->assertSuccessful();
});

it('displays the livewire component', function () {
    $company = Company::factory()->create();

    $this->get(route('employees.index', $company))->assertSeeLivewire(\App\Livewire\Employees\Index::class);
});

it('shows company name in title', function () {
    $company = Company::factory()->create();

    $this->get(route('employees.index', $company))->assertSee("{$company->name} employees");
});

it('displays company employees', function () {
    $company = Company::factory()->create();
    $employees = Employee::factory()->count(3)->create(['company_id' => $company->id]);

    $response = $this->get(route('employees.index', $company));

    foreach ($employees as $employee) {
        $response->assertSee($employee->full_name);
        $response->assertSee($employee->email);
    }
});

it('does not show other company employees', function () {
    $company = Company::factory()->create();
    $otherCompany = Company::factory()->create();
    Employee::factory()->create(['company_id' => $company->id]);
    $otherEmployee = Employee::factory()->create(['company_id' => $otherCompany->id]);

    $this->get(route('employees.index', $company))->assertDontSee($otherEmployee->full_name);
});

it('shows correct pagination', function () {
    $company = Company::factory()->create();
    Employee::factory()->count(15)->create(['company_id' => $company->id]);

    $this->get(route('employees.index', $company))->assertSee('Next');
});

it('has correct table structure', function () {
    $company = Company::factory()->create();
    Employee::factory()->count(2)->create(['company_id' => $company->id]);

    $response = $this->get(route('employees.index', $company));

    $response->assertSee('Full name');
    $response->assertSee('Email');
    $response->assertSee('Phone');
});

it('shows empty state when no employees', function () {
    $company = Company::factory()->create();

    $response = $this->get(route('employees.index', $company));

    $response->assertSuccessful();
    $response->assertSee("{$company->name} employees");
});

it('navigates to next page', function () {
    $company = Company::factory()->create();
    Employee::factory()->count(12)->create(['company_id' => $company->id]);

    $response = $this->get(route('employees.index', $company).'?page=2');

    $response->assertSuccessful();
    $response->assertSee('Previous');
});

it('renders livewire component with company and employees', function () {
    $company = Company::factory()->create();
    $employees = Employee::factory()->count(5)->create(['company_id' => $company->id]);

    Livewire::test(\App\Livewire\Employees\Index::class, ['company' => $company])
        ->assertSee($company->name)
        ->assertSee($employees->first()->full_name)
        ->assertSee($employees->first()->email)
        ->assertStatus(200);
});

it('has clickable employee links', function () {
    $company = Company::factory()->create();
    $employee = Employee::factory()->create(['company_id' => $company->id]);

    $response = $this->get(route('employees.index', $company));

    $response->assertSee("mailto:{$employee->email}");
    $response->assertSee("tel:{$employee->phone}");
});
