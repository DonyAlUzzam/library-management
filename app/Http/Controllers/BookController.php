<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Cache;

class BookController extends Controller
{
    public function index()
    {
        $books = Cache::remember('books', 60, function () {
            return Book::with('author')->paginate(10);
        });

        return BookResource::collection($books);
    }

    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);

        return new BookResource($book);
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());

        $book->load('author');

        Cache::forget('books');

        return new BookResource($book);
    }

    public function update(StoreBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());

        Cache::forget('books');

        return new BookResource($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        Cache::forget('books');

        return response()->json(['status' => 'success', 'message' => 'Book deleted successfully']);
    }
}
