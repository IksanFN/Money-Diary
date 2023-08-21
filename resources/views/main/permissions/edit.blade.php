<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <x-splade-form method="PUT" :default="$permission" action="{{ route('permissions.update', $permission->id) }}" class="space-y-3">
                    <x-splade-input name="name" :label="__('Name Permission')"/>
                    <x-splade-submit :label="__('Update')"/>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
