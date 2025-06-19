@extends('layouts.user')

@section('title', 'Latest Books - Jejak Literasi')

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
</style>

<main>
    <section class="search-header">
        <h2>Latest Books</h2>
    </section>
    <section class="book-list">
        <div class="container">

            @if($books->sortByDesc('created_at')->isNotEmpty())
                <div class="book-grid">
                    @foreach($books->sortByDesc('created_at') as $book)
                        <article class="book-card">
                            <a href="{{ route('books.show', $book) }}" aria-label="View details of {{ $book->title }}">
                                @if($book->image)
                                    <img class="book-cover" 
                                         src="{{ asset('storage/books/'.$book->image) }}" 
                                         alt="Cover of {{ $book->title }}">
                                @endif
                                <p class="book-title">{{ $book->title }}</p>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    No books available at the moment.
                </div>
            @endif

        </div>
    </section>
</main>

<div class="d-flex justify-content-center">
    {{ $books->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
</div>
@endsection
