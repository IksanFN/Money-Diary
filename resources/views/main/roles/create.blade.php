<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <x-splade-form action="{{ route('roles.store') }}" class="space-y-3">
                    <x-splade-input name="name" :label="__('Name Role')"/>
                    <label>Permission</label>
                    <x-splade-select name="permission[]" multiple class="pb-3">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}" >{{ $permission->name }}</option>    
                    @endforeach
                    </x-splade-select>
                    <x-splade-submit :label="__('Create')"/>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
