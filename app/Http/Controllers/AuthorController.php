<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Resources\AuthorResource;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Cache::remember('authors', 60, function () {
            return Author::with('books')->paginate(10);
        });

        return AuthorResource::collection($authors);
    }

    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);

        return new AuthorResource($author);
    }

    public function store(StoreAuthorRequest $request)
    {
        $author = Author::create($request->validated());

        Cache::forget('authors');

        return new AuthorResource($author);
    }

    public function update(StoreAuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->validated());

        Cache::forget('authors');

        return new AuthorResource($author);
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        Cache::forget('authors');

        return response()->json(['status' => 'success', 'message' => 'Author deleted successfully']);
    }
}

