<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Majors Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md shadow-gray-100 sm:rounded-lg p-4">
                <div class="flex justify-end pb-3">
                    <Link href="{{ route('majors.create') }}" class="px-5 py-2 bg-indigo-400 text-white rounded-xl font-semibold shadow-md shadow-indigo-100 hover:bg-indigo-500">New Major <span class="ms-2"><i class="fa-solid fa-plus"></i></span></Link>
                </div>
                <x-splade-table :for="$majors">
                    <x-splade-cell actions as="$major">
                        <Link href="{{ route('majors.edit', $major->id) }}" class="px-4 py-2 bg-indigo-400 text-white rounded-xl mr-3 shadow-sm shadow-indigo-200 hover:bg-indigo-500"><i class="fa-regular fa-pen-to-square"></i></Link>
                        <Link method="DELETE" href="{{ route('majors.destroy', $major->id) }}"
                            confirm="Apakah kamu yakin akan menghapusnya?"
                            confirm-button="Yes, Hapus"
                            cancel-button="Batalkan" 
                            class="px-4 py-2 bg-red-400 text-white rounded-xl shadow-sm shadow-red-200 hover:bg-red-500"><i class="fa-regular fa-trash-can"></i></Link>
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
