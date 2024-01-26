<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Liste des Bibliothèques") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex justify-end pb-[20px]">
                <a href="{{ route('library.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                    Ajouter un Bibliothèque
                </a>

            </div>

            <div class="grid w-full grid-cols-3 gap-4 overflow-x-auto">
                @foreach ($libraries as $library)
                <a href="{{ route('library.show', $library->id) }}">

                    <div class="overflow-hidden bg-white rounded shadow-md text-slate-500 shadow-slate-200">
                        <!--  Image -->
                        <figure>
                            <img src="{{ asset('storage/'.$library->image) }}" alt="card image" class="w-full aspect-video" />
                        </figure>
                        <!-- Body-->
                        <div class="p-6">
                            <header>
                                <h3 class="text-xl font-medium text-slate-700">Library of {{ $library->type }}</h3>
                                <p class="text-sm text-slate-400">created at {{ $library->created_at }}</p>
                            </header>
                        </div>
                    </div>

                </a>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
