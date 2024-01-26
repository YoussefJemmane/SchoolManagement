<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libraries = Library::all();
        return view('libraries.index', compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libraries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
        ]);

        $imagePath = $request->file('image')->store('', 'public');


        $library = Library::create([
            'type' => $request->type,
            'image' => $imagePath,
        ]);

        return redirect()->route('library.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        $books = Book::where('library_id', $library->id)->get();

        return view('libraries.show', compact('books', 'library'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        return view('libraries.edit', compact('library'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Library $library)
    {
        $request->validate([
            'type' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
        ]);

        $library->update([
            'type' => $request->type,
            'image' => $request->image,
        ]);

        return redirect()->route('libraries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        $library->delete();
        return redirect()->route('libraries.index');
    }
}
