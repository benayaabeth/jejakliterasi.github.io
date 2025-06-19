@extends('layouts.user')

@section('title', 'My Books - Jejak Literasi')

@push('styles')
<link href="{{ asset('css/user.css') }}" rel="stylesheet">
<style>
    /* Limit the size of book covers */
    .search-header {
        text-align: center;
        margin-top: 3rem;
        margin-bottom: 2rem;
    }

    .search-header h1 {
        font-size: 2rem;
        font-weight: 700;
    }
    .book-cover {
        max-width: 150px;
        max-height: 200px;
        margin: 0 auto;
        display: block;
        object-fit: cover; /* Ensure the image is cropped proportionally */
    }
    .book-item {
        text-align: center; /* Center-align content */
    }
</style>
@endpush

@section('content')
<main>
    <section class="my-books">
        <section class="search-header">
            <h1>My Books</h1>
        </section>
        <div class="container">

            {{-- Display error message --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Display books if available --}}
            @if($books->count() > 0)
                <div class="row g-4 book-list">
                    @foreach($books as $book)
                        <div class="col-md-4">
                            <article class="book-item card h-100">
                                {{-- Book cover --}}
                                <img 
                                    src="{{ asset('storage/books/'.$book->image) }}" 
                                    alt="Cover image of {{ $book->title }}" 
                                    class="card-img-top book-cover">

                                {{-- Book details --}}
                                <div class="card-body">
                                    <h3 class="book-title card-title">{{ $book->title }}</h3>
                                    <p class="book-author text-muted mb-3">Author: {{ $book->author }}</p>
                                    
                                    {{-- Download button or fallback message --}}
                                    @if($book->pdf_file)
                                        <a 
                                            href="{{ route('books.download', $book) }}" 
                                            class="btn btn-primary w-100"
                                            aria-label="Download PDF for {{ $book->title }}">
                                            <i class="bi bi-download me-2"></i> Download PDF
                                        </a>
                                    @else
                                        <p class="text-muted text-center mt-2">No PDF available</p>
                                    @endif
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Fallback message when no books are available --}}
                <div class="alert alert-info text-center mt-4">
                    <i class="bi bi-info-circle me-2"></i>
                    You don't have any books yet.
                </div>
            @endif
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Bootstrap alert dismiss functionality
    const alertCloseButtons = document.querySelectorAll('.btn-close');
    alertCloseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const alert = this.closest('.alert');
            if (alert) alert.classList.add('d-none');
        });
    });
});
</script>
@endpush
