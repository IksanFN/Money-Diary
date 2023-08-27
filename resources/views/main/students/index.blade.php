<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md shadow-gray-100 sm:rounded-lg p-6 shadow-xl shadow-slate-100">
                <div class="flex justify-end pb-5">
                    <Link href="{{ route('students.create') }}" class="btn-primary">Mapping Student<span class="ms-2"><i class="fa-solid fa-plus"></i></span></Link>
                </div>
                <x-splade-table :for="$students">
                    <x-splade-cell actions as="$student">
                        <Link href="{{ route('students.show', $student->id) }}" class="btn-secondary mr-3"><i class="fa-regular fa-eye"></i></Link>
                        <Link href="{{ route('students.edit', $student->id) }}" class="btn-secondary mr-3"><i class="fa-regular fa-pen-to-square"></i></Link>
                        <Link method="DELETE" href="{{ route('students.destroy', $student->id) }}" 
                            confirm="Apakah kamu yakin akan menghapusnya?"
                            confirm-button="Yes, Hapus"
                            cancel-button="Batalkan" 
                            class="btn-secondary"><i class="fa-regular fa-trash-can"></i></Link>
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
