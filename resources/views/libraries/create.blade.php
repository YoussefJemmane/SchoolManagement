<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Create Un Bibliothèque") }}
        </h2>
    </x-slot>

    <div class="flex justify-center py-12 ">
        <div class="border rounded-md bg-white p-[20px]">
            <form method="POST" action="{{ route('library.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Type -->
                <div>
                    <x-input-label for="type" :value="__('Type')" />
                    <x-text-input id="type" class="block w-full mt-1" type="text" name="type" :value="old('type')" required autofocus autocomplete="type" />
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <!-- Iamge -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block w-full p-4 mt-1 bg-white border " type="file" name="image" :value="old('image')" required autocomplete="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <div class="flex items-center justify-end mt-4">


                    <x-primary-button class="ms-4">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
            </form>

        </div>


    </div>
</x-app-layout>
