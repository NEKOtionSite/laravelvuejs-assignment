<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve paginated data of books from the database.
        $data = Book::query()->paginate(20);

        // Render the 'books' Inertia view and pass the retrieved data.
        return Inertia::render('books', [
            'data' => $data
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        // Validate the incoming request data.
        Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required'
        ])->validate();

        // Create a new book record in the database.
        Book::create($request->all());

        // Process and store the uploaded image.
        $this->processImage($request);

        // Redirect back with a success message.
        return redirect()->back()
            ->with('message', 'Book created');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request The request object containing validated data.
     * @param  \App\Models\Book  $book The book model to be updated.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // Validate the incoming request data.
        Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required'
        ])->validate();

        // Update the book record in the database.
        $book->update($request->all());

         // Process and store the uploaded image.
        $this->processImage($request);

        // Redirect back with a success message.
        return redirect()->back()
            ->with('message', 'Book updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book The book model to be deleted.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Book $book)
    {
        // Delete the book record from the database.
        $book->delete();

        // Redirect back with a success message.
        return redirect()->back()
            ->with('message', 'Book deleted');
    }

    /**
     * Upload an image using Filepond.
     *
     * @param  \Illuminate\Http\Request  $request The request object containing the uploaded image.
     * @return string The path of the uploaded image.
     */
    public function upload(Request $request)
    {
        if($request->hasFile('imageFilepond'))
        {
            // Store the uploaded image in the 'public' disk under 'uploads/books' directory.
            return $request->file('imageFilepond')->store('uploads/books', 'public');
        }
        return '';
    }

    /**
     * Revert the image upload using Filepond.
     *
     * @param  \Illuminate\Http\Request  $request The request object containing the image filename to revert.
     * @return void
     */
    public function uploadRevert(Request $request)
    {
        if($image = $request->get('image')){
            $path = storage_path('app/public/' . $image);
            if(file_exists($path)){
                // Delete the image file from storage.
                unlink($path);
            }
        }

    }

    /**
     * Process and store the uploaded image.
     *
     * @param  \Illuminate\Http\Request  $request The request object containing the uploaded image.
     * @return void
     */
    protected function processImage(Request $request)
    {
        if($image = $request->get('image'))
        {
            $path = storage_path('app/public/' . $image);
            if(file_exists($path)){
                // Copy the image file from storage to the public directory.
                copy($path, public_path($image));
                // Delete the image file from storage.
                unlink($path);
            }
        }
    }
}