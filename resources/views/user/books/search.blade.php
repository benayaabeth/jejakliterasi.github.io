@extends('layouts.user')

@section('title', 'Search Results - Jejak Literasi')

@section('content')
<style>
    .search-header {
        text-align: center;
        margin-top: 3rem;
        margin-bottom: 2rem;
    }

    .search-header h2 {
        font-size: 2rem;
        font-weight: 700;
    }

    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1.5rem;
        padding: 2rem 0;
        justify-items: center;
        max-width: 1200px;
        margin: 0 auto;
    }

    .book-card {
        width: 180px;
        text-align: center;
    }

    .book-cover {
        width: 100%;
        height: auto;
    }

    .book-title {
        font-size: 1rem;
        font-weight: bold;
        margin-top: 0.5rem;
    }

    .book-author {
        font-size: 0.9rem;
        color: #555;
    }
</style>
<main>
    <section class="search-header">
        <h2>Search Results for "{{ $query }}"</h2>
    </section>
    
    <section class="book-list">
        <div class="container">
            @if($books->count() > 0)
                <div class="book-grid">
                    @foreach($books as $book)
                        <div class="book-card">
                            <a href="{{ route('books.show', $book) }}" aria-label="View details of {{ $book->title }}">
                                <img src="{{ asset('storage/books/'.$book->image) }}" 
                                     alt="Cover image of {{ $book->title }}" 
                                     class="book-cover">
                            </a>
                            <p class="book-title">{{ $book->title }}</p>
                            <p class="book-author">{{ $book->author }}</p>
                        </div>
                    @endforeach
                </div>
                
            @else
                <p class="text-center">No books found matching your search criteria.</p>
            @endif
        </div>
    </section>
</main>
<div class="d-flex justify-content-center">
    {{ $books->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
</div>
@endsection
