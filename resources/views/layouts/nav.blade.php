<nav class="flex items-center justify-between flex-wrap bg-indigo-500 p-6">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <x-icon-zondicons.location-marina class="fill-current h-8 w-8 mr-2"/>
        <a href="{{ route('home') }}" class="font-semibold text-xl tracking-tight">Companies and Employees</a>
    </div>
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="{{ route('companies.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-indigo-200 hover:text-white mr-4">
                Companies
            </a>
        </div>
    </div>
</nav>
