<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\bookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // CREATE METHOD - POST
    public function createBook(bookRequest $request)
    {
        Book::create([
            ...$request->all(),
           'author_id' => auth()->user()->id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'book created successfully'
        ],201);
    }
    // LIST METHOD - GET
    public function listBook()
    {
        $books = Book::get();

        return response()->json([
            'status' => true,
            'message' => 'All Books',
            'data' => $books
        ]);
    }

    // AUTHOR BOOK METHOD - GET
    public function authorBook()
    {
        $books = auth()->user()->books;

        return response()->json([
            'status' => true,
            'message' => 'All Books',
            'data' => $books
        ]);
    }
    // SINGLE METHOD - POST
    public function singleBook($book_id)
    {
        $Author_id = auth()->user()->id;
        try{
            $book = Book::where([
                'author_id' => $Author_id,
                'id' => $book_id
            ])->get();
            return response()->json([
                'status' => true,
                'message' => 'Book data found',
                'data' => $book
            ]);
        } catch(Exception $e){
            return response()->json([
                'status' => 1,
                'message' => 'Book not found'
            ], 404);
        }
    }
    // UPDATE METHOD - PUT
    public function updateBook(Request $request, $book_id)
    {
        try{
            $book = Book::where([['author_id', Auth::id()], ['id',$book_id]])->update([
                ...$request->all()]);

            return response()->json([
                'status' => true,
                'message' =>'Book is updated successfully!'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 1,
                'message' => 'Book not found',
                'error' => $e->getMessage()
            ], 404);
        }
    }
    // DELETE METHOD - DELETE
    public function deleteBook($book_id)
    {
        try{
            Book::where([['author_id', Auth::id()], ['id',$book_id]])->delete();

            return response()->json([
                'status' => true,
                'message' => 'Book deleted successfully'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => true,
                'message' => 'Book not found'
            ],404);
        }
    }
}
