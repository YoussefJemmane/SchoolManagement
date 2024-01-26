<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Editer Un Book dans la Bibliotheque " . $library->type) }}
        </h2>
    </x-slot>

    <div class="flex justify-center py-12 ">
        <div class="border rounded-md bg-white p-[20px]">
            <form method="POST" action="{{ route('book.update',[$book->id,$library->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" value="{{ $book->title }}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Author -->
                <div class="mt-4">
                    <x-input-label for="author" :value="__('Author')" />
                    <x-text-input id="author" class="block w-full mt-1" type="text" name="author" :value="old('author')" required autofocus autocomplete="author" value="{{ $book->author }}" />
                    <x-input-error :messages="$errors->get('author')" class="mt-2" />
                </div>

                <!-- Publisher -->
                <div class="mt-4">
                    <x-input-label for="publisher" :value="__('Publisher')" />
                    <x-text-input id="publisher" class="block w-full mt-1" type="text" name="publisher" :value="old('publisher')" required autofocus autocomplete="publisher" value="{{$book->publisher}}" />
                    <x-input-error :messages="$errors->get('publisher')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block w-full mt-1" type="text" name="description" :value="old('description')" required autofocus autocomplete="description" value="{{ $book->description }}" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- ISBN -->
                <div class="mt-4">
                    <x-input-label for="isbn" :value="__('ISBN')" />
                    <x-text-input id="isbn" class="block w-full mt-1" type="text" name="isbn" :value="old('isbn')" required autofocus autocomplete="isbn" value="{{ $book->isbn }}" />
                    <x-input-error :messages="$errors->get('isbn')" class="mt-2" />
                </div>

                <!-- Iamge -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block w-full p-4 mt-1 bg-white border " type="file" name="image" :value="old('image')" required autocomplete="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <!-- PDF -->
                <div class="mt-4">
                    <x-input-label for="pdf" :value="__('PDF')" />
                    <x-text-input id="pdf" class="block w-full p-4 mt-1 bg-white border " type="file" name="pdf" :value="old('pdf')" required autocomplete="pdf" />
                    <x-input-error :messages="$errors->get('pdf')" class="mt-2" />
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
