<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permission Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl shadow-gray-100 sm:rounded-lg p-4">
                <div class="w-full pb-3">
                    <x-splade-form action="{{ route('permissions.store') }}" class="w-full flex items-center space-x-3">
                        <x-splade-input name="name" placeholder="Create permission" class="w-full"/>
                        <x-splade-submit label="Create"/>
                    </x-splade-form>
                </div>
                <x-splade-table :for="$permissions">
                    <x-splade-cell actions as="$permission">
                        <Link href="{{ route('permissions.edit', $permission->id) }}" class="px-4 py-2 bg-blue-400 text-white rounded mr-3">Edit</Link>
                        <Link method="DELETE" href="{{ route('permissions.destroy', $permission->id) }}" confirm="Apakah kamu yakin akan menghapusnya?"
                            confirm-button="Yes, Hapus"
                            cancel-button="Batalkan" 
                            class="px-4 py-2 bg-red-400 text-white rounded">Delete</Link>
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
