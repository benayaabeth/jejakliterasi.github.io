@props(['book'])

<div class="book-card">
    <a href="{{ route('books.show', $book) }}" aria-label="View details of {{ $book->title }}">
        <img class="book-card" src="{{ asset('storage/books/'.$book->image) }}" alt="{{ $book->title }}" class="img-fluid" />
        <div class="book-info">
            <p class="book-title">{{ $book->title }}</p>
            <p class="book-author">{{ $book->author }}</p>
            <p class="book-price">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
        </div>
    </a>
    @auth
        <button onclick="addToCart({{ $book->id }})" class="add-to-cart-btn" aria-label="Add {{ $book->title }} to cart">
            Add to Cart
        </button>
    @else
        <a href="{{ route('login') }}" class="add-to-cart-btn" aria-label="Login to purchase {{ $book->title }}">
            Login to Purchase
        </a>
    @endauth
</div>
