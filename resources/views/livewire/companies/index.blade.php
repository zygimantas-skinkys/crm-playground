@section('title', 'Companies')

<div>
    <h1 class="prose mt-8">Companies</h1>

    <table class="table-auto mb-2">
        <thead class="border">
        <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Image</th>
            <th class="px-4 py-2">Website</th>
            <th class="px-4 py-2">Employees</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                <td class="border px-4 py-2">
                    {{ ($companies->currentPage() -1) * $companies->perPage() + $loop->iteration }}
                </td>
                <td class="border px-4 py-2">
                    {{ $company->name }}
                </td>
                <td class="border px-4 py-2">
                    <a class="text-blue-400 hover:text-blue-600" href="mailto:{{ $company->email }}">
                        {{ $company->email }}
                    </a>
                </td>
                <td class="border px-4 py-2">
                    <img class="object-contain h-20 w-full" src="{{ $company->img_path }}" alt="{{ $company->name }} logo">
                </td>
                <td class="border px-4 py-2">
                    <a class="text-blue-400 hover:text-blue-600" href="{{ $company->website }}">
                        {{ $company->website }}
                    </a>
                </td>
                <td class="border px-4 py-2">
                    <a href="{{ route('employees.index', $company) }}">
                        <x-icon-zondicons.user-group class="fill-current text-blue-400 hover:text-blue-600 h-8 w-8 mr-2"/>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $companies->links() }}
</div>
