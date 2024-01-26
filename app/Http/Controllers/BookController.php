<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Library;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $library = Library::find(request()->library);
        return view('books.create', compact('library'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Library $library)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'pdf' => ['required', 'file'],
            'image' => ['required', 'image'],
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'isbn' => $request->isbn,
            'description' => $request->description,
            'pdf' => $request->file('pdf')->store('', 'public'),
            'image' => $request->file('image')->store('', 'public'),
            'library_id' => $library->id,
        ]);

        return redirect()->route('library.show', $library);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book, Library $library)
    {
        $book = Book::find($book->id);
        return view('books.show', compact('book', 'library'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, Library $library)
    {
        $book = Book::find($book->id);
        $book->publisher = html_entity_decode($book->publisher);
        return view('books.edit', compact('book', 'library'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book, Library $library)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'pdf' => ['required', 'file'],
            'image' => ['required', 'image'],
        ]);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'isbn' => $request->isbn,
            'description' => $request->description,
            'pdf' => $request->file('pdf')->store('', 'public'),
            'image' => $request->file('image')->store('', 'public'),
        ]);

        return redirect()->route('library.show', $library);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Library $library)
    {
        $book->delete();
        return redirect()->route('library.show', $library->id);
    }
}
