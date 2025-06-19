@extends('layouts.user')

@section('title', $book->title.' - Jejak Literasi')

@section('content')
<main>
    <section class="book-detail">
        <div class="container">
            <div class="book-detail-content">
                <!-- Book Image Section -->
                <div class="book-image">
                    <img class="book-card" src="{{ asset('storage/books/'.$book->image) }}" 
                         alt="Cover image of {{ $book->title }}" 
                         class="img-fluid" 
                         aria-label="Cover image of {{ $book->title }}">
                </div>

                <!-- Book Info Section -->
                <div class="book-info">
                    <h2>{{ $book->title }}</h2>
                    <p><strong>Author:</strong> {{ $book->author }}</p>
                    <p><strong>Price:</strong> Rp {{ number_format($book->price, 0, ',', '.') }}</p>
                    
                    <div class="book-synopsis">
                        <p><strong>Synopsis:</strong></p>
                        <p>{{ $book->synopsis }}</p>
                    </div>

                    <!-- Add to Cart Button -->
                    @auth
                        {{-- Dalam view yang menampilkan detail buku --}}
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary">Login to Purchase</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
