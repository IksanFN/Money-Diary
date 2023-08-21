<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="pb-3 w-full">
                    <x-splade-form action="{{ route('years.store') }}" class="w-full flex items-center space-x-3">
                        <x-splade-input name="name" placeholder="Year" class="w-full"/>
                        <x-splade-input name="description" placeholder="Description" class="w-full"/>
                        <x-splade-submit label="Create"/>
                    </x-splade-form>
                </div>
                <x-splade-table :for="$years">
                    <x-splade-cell actions as="$year">
                        <Link href="{{ route('years.show', $year->id) }}" class="px-4 py-2 bg-slate-400 text-white rounded mr-3">Detail</Link>
                        <Link href="{{ route('years.edit', $year->id) }}" class="px-4 py-2 bg-blue-400 text-white rounded mr-3">Edit</Link>
                        <Link method="DELETE" href="{{ route('years.destroy', $year->id) }}" confirm class="px-4 py-2 bg-red-400 text-white rounded">Delete</Link>
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
