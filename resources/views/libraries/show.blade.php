<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Liste des Books de la Bibliotheque " . $library->type) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(Auth::user()->role == 'Admin')
            <div class="flex justify-end pb-[20px]">
                <a href="{{ route('book.create',$library->id) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                    Ajouter un Book
                </a>

            </div>
            @endif
            <div class="grid w-full grid-cols-3 gap-4 overflow-x-auto">
                @foreach ($books as $book)
                <div class="col">
                    <a href="{{ route('book.show', [$book->id,$library->id]) }}">

                        <div class="overflow-hidden bg-white rounded shadow-md text-slate-500 shadow-slate-200">
                            <!--  Image -->
                            <figure>
                                <img src="{{ asset('storage/'.$book->image) }}" alt="card image" class="w-full aspect-video" />
                            </figure>
                            <!-- Body-->
                            <div class="p-6">
                                <header>
                                    <h3 class="text-xl font-medium text-slate-700">{{ $book->title }} by {{ $book->author }}</h3>
                                    <p class="text-sm text-slate-400">ISBN: {{ $book->isbn }}</p>
                                    <p class="text-sm text-slate-400">Publisher: {{ $book->publisher }}</p>
                                    <p class="text-sm text-slate-400">Description: {{ $book->description }}</p>
                                    <p class="text-sm text-slate-400">created at {{ $book->created_at }}</p>
                                    @if(Auth::user()->role == 'Admin')
                                    <div class="flex justify-end gap-4 pt-4">
                                        <a href="{{ route('book.edit', [$book->id,$library->id]) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                                            Edit
                                        </a>
                                        <form action="{{ route('book.destroy', [$book->id,$library->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </header>

                            </div>
                        </div>

                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
