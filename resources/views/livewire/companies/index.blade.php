@section('title', 'Companies')

<div>
    <table class="table-auto">
        <thead class="border">
        <tr>
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Image</th>
            <th class="px-4 py-2">Website</th>
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
                    <img src="{{ $company->img_path }}" alt="{{ $company->name }} logo">
                </td>
                <td class="border px-4 py-2">
                    <a class="text-blue-400 hover:text-blue-600" href="{{ $company->website }}">
                        {{ $company->website }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $companies->links() }}
</div>
