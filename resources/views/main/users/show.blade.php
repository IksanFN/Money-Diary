<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <p>
                    Nama: {{ $user->name }}
                </p>
                <p class="pb-3">
                    Email: {{ $user->email }}
                </p>
                <Link href="{{ route('users.index') }}" class="px-4 py-2 bg-slate-500 rounded-md text-white">Kembali</Link>
            </div>
        </div>
    </div>
</x-app-layout>
