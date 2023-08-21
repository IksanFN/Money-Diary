<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <div class="flex justify-end pb-3">
                    <Link href="{{ route('users.create') }}" class="px-4 py-2 bg-slate-400 text-white rounded">New User</Link>
                </div>
                <x-splade-table :for="$users">
                    <x-splade-cell actions as="$user">
                        <Link href="{{ route('users.show', $user->id) }}" class="px-4 py-2 bg-slate-400 text-white rounded mr-3">Detail</Link>
                        <Link href="{{ route('users.edit', $user->id) }}" class="px-4 py-2 bg-blue-400 text-white rounded mr-3">Edit</Link>
                        <Link method="DELETE" href="{{ route('users.destroy', $user->id) }}"
                            confirm="Apakah kamu yakin akan menghapusnya?"
                            confirm-button="Yes, Hapus"
                            cancel-button="Batalkan" 
                            class="px-4 py-2 bg-red-400 text-white rounded">Delete</Link>
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
