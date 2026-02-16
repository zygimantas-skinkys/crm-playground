<?php

namespace App\Livewire\Companies;

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
        ])->extends('layouts.app');
    }

    public function paginationView()
    {
        return 'layouts.pagination-links';
    }
}
