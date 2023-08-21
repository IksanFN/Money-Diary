<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <x-splade-form method="PUT" :default="$role" action="{{ route('roles.update', $role->id) }}" class="space-y-3">
                    <x-splade-input name="name" :label="__('Name Role')"/>
                    <label>Permission</label>
                    <x-splade-select name="permission[]" multiple class="pb-3">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}" >{{ $permission->name }}</option>    
                    @endforeach
                    </x-splade-select>
                    <label>User Role</label>
                    <div class="flex space-x-3">
                        @if ($rolePermissions->count() > 0)
                            @foreach ($rolePermissions as $role_permission)
                                    <span id="badge-dismiss-red" class="inline-flex items-center px-2 py-1 mr-2 text-sm font-medium text-red-800 bg-red-100 rounded dark:bg-red-900 dark:text-red-300">
                                        {{ $role_permission->name }}
                                        <Link href="{{ route('roles.remove_permission', [$role->id, $role_permission->id]) }}" confirm method="DELETE" class="inline-flex items-center p-1 ml-2 text-sm text-red-400 bg-transparent rounded-sm hover:bg-red-200 hover:text-red-900 dark:hover:bg-red-800 dark:hover:text-red-300" data-dismiss-target="#badge-dismiss-red" aria-label="Remove">
                                        <svg class="w-2 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Remove badge</span>
                                        </Link>
                                    </span>
                            @endforeach
                        @endif
                    </div>
                    <x-splade-submit :label="__('Update')"/>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
