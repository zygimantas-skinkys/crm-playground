<?php

namespace Tests\Feature\Companies;

use App\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ListCompaniesTest extends TestCase
{
    use RefreshDatabase;

    public function test_companies_index_page_returns_successful_response(): void
    {
        $response = $this->get(route('companies.index'));

        $response->assertStatus(200);
    }

    public function test_companies_index_page_displays_livewire_component(): void
    {
        $response = $this->get(route('companies.index'));

        $response->assertSeeLivewire(\App\Livewire\Companies\Index::class);
    }

    public function test_companies_index_page_displays_companies(): void
    {
        $companies = Company::factory()->count(3)->create();

        $response = $this->get(route('companies.index'));

        foreach ($companies as $company) {
            $response->assertSee($company->name);
            $response->assertSee($company->email);
        }
    }

    public function test_companies_index_page_shows_correct_pagination(): void
    {
        Company::factory()->count(15)->create();

        $response = $this->get(route('companies.index'));

        $response->assertSee('Next');
    }

    public function test_companies_index_page_shows_empty_state_when_no_companies(): void
    {
        $response = $this->get(route('companies.index'));

        $response->assertStatus(200);
        $response->assertSee('Companies');
    }

    public function test_companies_table_has_correct_structure(): void
    {
        Company::factory()->count(2)->create();

        $response = $this->get(route('companies.index'));

        $response->assertSee('Name');
        $response->assertSee('Email');
        $response->assertSee('Image');
        $response->assertSee('Website');
        $response->assertSee('Employees');
    }

    public function test_companies_list_includes_employee_count_link(): void
    {
        $company = Company::factory()->create();

        $response = $this->get(route('companies.index'));

        $response->assertSee(route('employees.index', $company));
    }

    public function test_companies_pagination_navigates_to_next_page(): void
    {
        Company::factory()->count(12)->create();

        $response = $this->get(route('companies.index').'?page=2');

        $response->assertStatus(200);
        $response->assertSee('Previous');
    }

    public function test_livewire_component_renders_with_companies(): void
    {
        $companies = Company::factory()->count(5)->create();

        Livewire::test(\App\Livewire\Companies\Index::class)
            ->assertSee($companies->first()->name)
            ->assertSee($companies->first()->email)
            ->assertStatus(200);
    }
}
