<?php

namespace Tests\Feature\Employees;

use App\Company;
use App\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListEmployeesTest extends TestCase
{
    use RefreshDatabase;

    public function test_employees_index_page_returns_successful_response(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('employees.index', $company));

        $response->assertStatus(200);
    }

    public function test_employees_index_page_displays_livewire_component(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('employees.index', $company));

        $response->assertSeeLivewire(\App\Livewire\Employees\Index::class);
    }

    public function test_employees_index_page_shows_company_name_in_title(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('employees.index', $company));

        $response->assertSee("{$company->name} employees");
    }

    public function test_employees_index_page_displays_company_employees(): void
    {
        $company = Company::factory()->create();
        $employees = Employee::factory()->count(3)->create(['company_id' => $company->id]);

        $response = $this->get(route('employees.index', $company));

        foreach ($employees as $employee) {
            $response->assertSee($employee->full_name);
            $response->assertSee($employee->email);
        }
    }

    public function test_employees_index_page_does_not_show_other_company_employees(): void
    {
        $company = Company::factory()->create();
        $otherCompany = Company::factory()->create();
        Employee::factory()->create(['company_id' => $company->id]);
        $otherEmployee = Employee::factory()->create(['company_id' => $otherCompany->id]);

        $response = $this->get(route('employees.index', $company));

        $response->assertDontSee($otherEmployee->full_name);
    }

    public function test_employees_index_page_shows_correct_pagination(): void
    {
        $company = Company::factory()->create();
        Employee::factory()->count(15)->create(['company_id' => $company->id]);

        $response = $this->get(route('employees.index', $company));

        $response->assertSee('Next');
    }

    public function test_employees_table_has_correct_structure(): void
    {
        $company = Company::factory()->create();
        Employee::factory()->count(2)->create(['company_id' => $company->id]);

        $response = $this->get(route('employees.index', $company));

        $response->assertSee('Full name');
        $response->assertSee('Email');
        $response->assertSee('Phone');
    }

    public function test_employees_list_shows_empty_state_when_no_employees(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('employees.index', $company));

        $response->assertStatus(200);
        $response->assertSee("{$company->name} employees");
    }

    public function test_employees_pagination_navigates_to_next_page(): void
    {
        $company = Company::factory()->create();
        Employee::factory()->count(12)->create(['company_id' => $company->id]);

        $response = $this->get(route('employees.index', $company).'?page=2');

        $response->assertStatus(200);
        $response->assertSee('Previous');
    }

    public function test_livewire_component_renders_with_company_and_employees(): void
    {
        $company = Company::factory()->create();
        $employees = Employee::factory()->count(5)->create(['company_id' => $company->id]);

        Livewire::test(\App\Livewire\Employees\Index::class, ['company' => $company])
            ->assertSee($company->name)
            ->assertSee($employees->first()->full_name)
            ->assertSee($employees->first()->email)
            ->assertStatus(200);
    }

    public function test_employees_links_are_clickable(): void
    {
        $company = Company::factory()->create();
        $employee = Employee::factory()->create(['company_id' => $company->id]);

        $response = $this->get(route('employees.index', $company));

        $response->assertSee("mailto:{$employee->email}");
        $response->assertSee("tel:{$employee->phone}");
    }
}
