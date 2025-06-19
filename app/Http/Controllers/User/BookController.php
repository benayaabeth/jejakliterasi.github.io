<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Paginate books ordered by title, 12 books per page
        $books = Book::orderBy('title')->paginate(12);
        return view('user.books.index', compact('books'));
    }

    /**
     * Display the specified book.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\View\View
     */
    public function show(Book $book)
    {
        return view('user.books.show', compact('book'));
    }

    /**
     * Display the latest books.
     *
     * @return \Illuminate\View\View
     */
    public function latest()
{
    $books = Book::orderBy('created_at', 'asc')  // This is correct - newest first
                ->paginate(12);
    return view('user.books.latest', compact('books'));
}
    /**
     * Display all book categories
     * 
     * @return \Illuminate\View\View
     */
    public function allCategories()
    {
        $books = Book::all();
        $categories = $books->groupBy('kategori');
        
        return view('user.books.category', compact('categories'));
    }

    /**
     * Display books by category
     * 
     * @param string $category
     * @return \Illuminate\View\View
     */
    public function category($category)
    {
        if ($category === 'all') {
            return $this->allCategories();
        }

        $books = Book::where('kategori', $category)->paginate(12);
        $currentCategory = $category;
        
        return view('user.books.category', compact('books', 'currentCategory'));
    }

    

    /**
     * Search for books based on title or author.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        // Perform search on title and author
        $books = Book::where('title', 'like', "%{$query}%")
                    ->orWhere('author', 'like', "%{$query}%")
                    ->paginate(12);
        return view('user.books.search', compact('books', 'query'));
    }

    /**
     * Suggest books based on search query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function suggestions(Request $request)
    {
        $query = $request->get('q');
        $books = Book::where('title', 'like', "%{$query}%")
                    ->orWhere('author', 'like', "%{$query}%")
                    ->limit(5)
                    ->get(['id', 'title', 'author']);

        return response()->json($books);
    }

    /**
     * Download the PDF of the book if purchased.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function download(Book $book)
    {
        // Ensure the user has purchased the book before downloading
        if (!auth()->user()->hasPurchased($book)) {
            return redirect()->back()->with('error', 'You have not purchased this book');
        }

        // Check if the PDF exists before attempting download
        $pdfPath = storage_path("app/public/pdfs/{$book->pdf_file}");
        if (!Storage::exists("public/pdfs/{$book->pdf_file}")) {
            return redirect()->back()->with('error', 'The requested file is not available');
        }

        return response()->download($pdfPath);
    }
    public function purchased()
{
    $user = auth()->user();
    $books = $user->orders()
        ->whereNotIn('status', ['rejected']) // Tambahkan filter ini
        ->with('orderDetails.book')
        ->get()
        ->flatMap(function ($order) {
            return $order->orderDetails;
        })
        ->pluck('book')
        ->unique('id'); // Tambahkan unique() untuk menghindari duplikasi buku

    return view('user.books.purchased', compact('books'));
}   


}
