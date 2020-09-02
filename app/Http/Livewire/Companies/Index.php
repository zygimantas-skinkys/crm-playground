<?php

namespace App\Http\Livewire\Companies;

use App\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.companies.index', [
            'companies' => Company::paginate(10),
        ]);
    }

    public function paginationView()
    {
        return 'pagination-links';
    }
}
