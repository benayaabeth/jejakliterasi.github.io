<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
            'kategori' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'pdf_file' => 'nullable|mimes:pdf'
        ]);

        // Menyimpan data yang divalidasi
        $data = $request->all();

        // Jika ada file image yang di-upload, simpan file tersebut
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/books');
            $data['image'] = basename($imagePath);
        }

        // Jika ada file pdf yang di-upload, simpan file tersebut
        if ($request->hasFile('pdf_file')) {
            $pdfPath = $request->file('pdf_file')->store('public/pdfs');
            $data['pdf_file'] = basename($pdfPath);
        }

        // Membuat record baru di database
        Book::create($data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.books.index')->with('success', 'Book created successfully');
    }

    public function edit(Book $book)
    {
        // Mengambil kategori unik dari database
        $categories = Book::select('kategori')
                         ->distinct()
                         ->pluck('kategori');
        
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'synopsis' => 'required',
            'kategori' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'pdf_file' => 'nullable|mimes:pdf'
        ]);

        // Menyimpan data yang divalidasi
        $data = $request->all();

        // Jika ada file image yang di-upload, hapus file lama dan simpan file baru
        if ($request->hasFile('image')) {
            Storage::delete('public/books/' . $book->image);
            $imagePath = $request->file('image')->store('public/books');
            $data['image'] = basename($imagePath);
        }

        // Jika ada file pdf yang di-upload, hapus file lama dan simpan file baru
        if ($request->hasFile('pdf_file')) {
            Storage::delete('public/pdfs/' . $book->pdf_file);
            $pdfPath = $request->file('pdf_file')->store('public/pdfs');
            $data['pdf_file'] = basename($pdfPath);
        }

        // Update data book di database
        $book->update($data);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        // Hapus file image dan pdf jika ada
        Storage::delete('public/books/' . $book->image);
        if ($book->pdf_file) {
            Storage::delete('public/pdfs/' . $book->pdf_file);
        }

        // Hapus data book dari database
        $book->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }
}
