<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Role Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="flex justify-end pb-3">
                    <Link href="{{ route('roles.create') }}" class="px-4 py-2 bg-slate-400 text-white rounded">New User</Link>
                </div>
                <x-splade-table :for="$roles">
                    <x-splade-cell actions as="$role">
                        <Link href="{{ route('roles.show', $role->id) }}" class="px-4 py-2 bg-slate-400 text-white rounded mr-3">Detail</Link>
                        <Link href="{{ route('roles.edit', $role->id) }}" class="px-4 py-2 bg-blue-400 text-white rounded mr-3">Edit</Link>
                        <Link method="DELETE" href="{{ route('roles.destroy', $role->id) }}" 
                            confirm="Apakah kamu yakin akan menghapusnya?"
                            confirm-button="Yes, Hapus"
                            cancel-button="Batalkan" 
                            class="px-4 py-2 bg-red-400 text-white rounded">Hapus</Link>
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
