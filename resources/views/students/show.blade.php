<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __("Show Un Etudiant") }}
        </h2>
    </x-slot>

    <div class="flex justify-center py-12 ">
        <div class="border rounded-md bg-white p-[20px]">
            {{-- show a admin --}}
            <div class="flex justify-center pb-3">
                <img src="{{ asset('storage/'.$student->image) }}" alt="" class="w-[150px] h-[150px] object-cover rounded-full">
                {{-- the name in the middle --}}
            </div>
            <div class="flex items-center ml-4">
                <h1 class="text-2xl font-bold text-gray-700">{{ $student->name }}</h1>
            </div>
            <div>
                <p class="mt-2 text-sm text-gray-500">Email: {{ $student->email }}</p>
                <p class="mt-2 text-sm text-gray-500">Phone: {{ $student->phone }}</p>
                <p class="mt-2 text-sm text-gray-500">Section: {{ $student->students[0]->section }}</p>
            </div>
            {{-- return to admin index--}}
            <div class="flex justify-center mt-4 space-x-4">
                <a href="{{ route('student.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                    Retour
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
