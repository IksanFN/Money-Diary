<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mapping Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-splade-form action="{{ route('students.store') }}" class="">
                    <div class="grid grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-6 mb-5">
                        <div class="space-y-5">
                            <x-splade-select name="user_id" :options="$users" label="Users" class="" placeholder="Pilih User"/>
                            <x-splade-select name="kelas_id" :options="$kelases" label="Kelases" class="" placeholder="Pilih Kelas"/>
                            <x-splade-select name="major_id" :options="$majors" label="Majors" class="" placeholder="Pilih Major"/>
                        </div>
                        <div class="">
                            <x-splade-group name="gender" label="Pilih jenis kelamin" inline class=" items-center">
                                <x-splade-radio name="gender" value="Female" label="Perempuan" class="pb-5"/>
                                <x-splade-radio name="gender" value="Male" label="Laki-laki" />
                            </x-splade-group>
                            <x-splade-input name="student_phone" label="Nomor Handphone" class="pb-5" placeholder="0811xxxxxx.."/>
                            <x-splade-textarea name="alamat" label="Alamat" autosize />
                        </div>
                    </div>
                    <x-splade-submit :label="__('Mapping Student')"/>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
