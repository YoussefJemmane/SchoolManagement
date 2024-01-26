<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Book : " . $book->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- i want inside here the PDF viewer to this book the pdf is stored in $book->pdf --}}
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <iframe src="{{ asset('/laraview/#../storage/' . $book->pdf) }}" width="100%" height="800px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

