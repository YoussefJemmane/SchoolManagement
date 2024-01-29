<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Liste des Bibliothèques") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(Auth::user()->role == 'Admin')
            <div class="flex justify-end pb-[20px]">
                <a href="{{ route('library.create') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                    Ajouter un Bibliothèque
                </a>

            </div>

            @endif
            <div class="grid w-full grid-cols-3 gap-4 overflow-x-auto">
                @foreach ($libraries as $library)
                <div class="col">
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
                                @if(Auth::user()->role == 'Admin')
                                <div class="flex justify-end gap-4 pt-4">
                                    <a href="{{ route('library.edit', $library->id) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                                        Edit
                                    </a>
                                    <form action="{{ route('library.destroy', $library->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>


                    </a>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
