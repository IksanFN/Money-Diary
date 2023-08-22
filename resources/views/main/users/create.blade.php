<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <x-splade-form action="{{ route('users.store') }}" class="space-y-3" enctype="multipart/form-data">
                    <x-splade-file name="avatar" :label="__('Avatar')"/>
                    <img v-if="form.avatar" :src="form.$fileAsUrl('avatar')" />
                    <x-splade-input name="nisn" :label="__('NISN')" placeholder="Enter NISN..." />
                    <x-splade-input name="name" :label="__('Name')" placeholder="Enter Name..."/>
                    <x-splade-input name="email" :label="__('Email')" class="pb-3"/>
                    <x-splade-input type="password" name="password" :label="__('password')" class="pb-3"/>
                    <label>Role</label>
                    <x-splade-select name="roles[]" :options="$roles" multiple class="pb-3">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" >{{ $role->name }}</option>    
                    @endforeach
                    </x-splade-select>
                    <x-splade-submit :label="__('Create')"/>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
