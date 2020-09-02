<?php

namespace App\Http\Livewire\Employees;

use App\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $company;

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.employees.index', [
            'company' => $this->company,
            'employees' => $this->company->employees()->paginate(10),
        ]);
    }

    public function paginationView()
    {
        return 'layouts.pagination-links';
    }

}
