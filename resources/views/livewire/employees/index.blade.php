@section('title', "{$company->name} employees")

<div>
    <h1 class="prose mt-8">{{ $company->name }} employees</h1>

    <table class="table-auto mb-2">
        <thead class="border">
        <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Full name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Phone</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                <td class="border px-4 py-2">
                    {{ ($employees->currentPage() -1) * $employees->perPage() + $loop->iteration }}
                </td>
                <td class="border px-4 py-2">
                    {{ $employee->full_name }}
                </td>
                <td class="border px-4 py-2">
                    <a class="text-blue-400 hover:text-blue-600" href="mailto:{{ $employee->email }}">
                        {{ $employee->email }}
                    </a>
                </td>
                <td class="border px-4 py-2">
                    <a class="text-blue-400 hover:text-blue-600" href="tel:{{ $employee->phone }}">
                        {{ $employee->phone }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $employees->links() }}
</div>
