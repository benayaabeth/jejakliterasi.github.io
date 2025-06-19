@extends('layouts.user')
@section('title', 'Books by Category - Jejak Literasi')

@section('content')
<style>
    /* Container utama */
    .categories-container {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    /* Kategori section */
    .category-section {
        width: 100%;
    }

    .search-header {
        text-align: center;
        margin-top: 3rem;
        margin-bottom: 2rem;
    }

    .search-header h1 {
        font-size: 2rem;
        font-weight: 700;
    }

    /* Kontainer untuk buku dengan scroll horizontal */
    .category-book-grid {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding: 20px 0;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scroll-behavior: smooth;
        width: 100%;
    }

    /* Scrollbar styling */
    .category-book-grid::-webkit-scrollbar {
        height: 8px;
    }

    .category-book-grid::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .category-book-grid::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    /* Kartu buku */
    .book-card {
        flex: 0 0 auto;
        width: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        text-align: center;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Gambar buku */
    .book-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 4px;
    }

    /* Judul buku */
    .book-title {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        margin: 10px 0 4px;
        max-width: 100%;
    }

    /* Penulis buku */
    .book-author {
        font-size: 0.875rem;
        color: #777;
        margin-bottom: 8px;
    }

    /* Harga buku */
    .book-price {
        font-size: 0.9rem;
        font-weight: bold;
        color: #0d6efd;
    }

    /* Header kategori */
    .kategori-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 8px;
    }

    .kategori-header h2 {
        font-size: 1.5rem;
        color: #333;
        margin: 0;
    }

    .lihat-semua {
        font-size: 0.875rem;
        color: #0d6efd;
        text-decoration: none;
        font-weight: bold;
    }

    .lihat-semua:hover {
        text-decoration: underline;
    }

    /* All books grid untuk halaman category/all */
    .all-books-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px 0;
    }

    /* Pagination wrapper */
    .pagination-wrapper {
        margin-top: 20px;
        text-align: center;
    }
    /* Shared styles for book containers */
    .book-container {
        display: flex;
        overflow-x: auto;
        gap: 20px;
        padding: 20px 0;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scroll-behavior: smooth;
        width: 100%;
    }

    /* Scrollbar styling */
    .book-container::-webkit-scrollbar {
        height: 8px;
    }

    .book-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .book-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    /* Kartu buku */
    .book-card {
        flex: 0 0 auto;
        width: 200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
        text-align: center;
    }

    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Gambar buku */
    .book-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 4px;
    }

    /* Judul buku */
    .book-title {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        margin: 10px 0 4px;
        max-width: 100%;
    }

    /* Penulis buku */
    .book-author {
        font-size: 0.875rem;
        color: #777;
        margin-bottom: 8px;
    }

    /* Harga buku */
    .book-price {
        font-size: 0.9rem;
        font-weight: bold;
        color: #0d6efd;
    }

    /* Header kategori */
    .category-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 8px;
    }

    .category-header h1 {
        font-size: 1.5rem;
        color: #333;
        margin: 0;
    }

    .back-link {
        font-size: 0.875rem;
        color: #0d6efd;
        text-decoration: none;
        font-weight: bold;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>

<main>
    <section class="search-header">
        <h1>Book Categories</h1>
    </section>
    <div class="container">
        @if(isset($categories))
            
            @if($categories->isNotEmpty())
                <div class="categories-container">
                    @foreach($categories as $categoryName => $categoryBooks)
                        <section class="category-section">
                            <div class="kategori-header">
                                <h2>{{ $categoryName }}</h2>
                                <a href="{{ route('books.category', $categoryName) }}" class="lihat-semua">
                                    View All
                                </a>
                            </div>
                            <div class="category-book-grid">
                                @foreach($categoryBooks->take(5) as $book)
                                    <article class="book-card">
                                        <a href="{{ route('books.show', $book) }}">
                                            @if($book->image)
                                                <img src="{{ asset('storage/books/'.$book->image) }}" 
                                                     alt="Cover of {{ $book->title }}">
                                            @endif
                                            <h3 class="book-title">{{ $book->title }}</h3>
                                            <p class="book-author">{{ $book->author }}</p>
                                            <p class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    No books available at the moment.
                </div>
            @endif
        @else
            <div class="category-header">
                <h1>{{ $currentCategory }} Books</h1>
                <a href="{{ route('books.category', 'all') }}" class="back-link">
                    View All Categories
                </a>
            </div>
            
            @if($books->isNotEmpty())
            <div class="book-container">
                @foreach($books as $book)
                    <article class="book-card">
                        <a href="{{ route('books.show', $book) }}">
                            @if($book->image)
                                <img src="{{ asset('storage/books/'.$book->image) }}" 
                                     alt="Cover of {{ $book->title }}">
                            @endif
                            <h3 class="book-title">{{ $book->title }}</h3>
                            <p class="book-author">{{ $book->author }}</p>
                            <p class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                No books found in this category.
            </div>
        @endif
        @endif
    </div>
</main>
@endsection