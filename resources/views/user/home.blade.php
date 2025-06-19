    @extends('layouts.user')

    @section('title', 'Home - Jejak Literasi')

    @section('content')
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="{{ asset('css/user.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/slider-styles.css') }}" rel="stylesheet">
        @stack('styles')
        <style>
            @stack('scripts');
            /* Dark mode styles for home page */
body.dark-mode .hero {
    background-color: #1a1a1a;
}

body.dark-mode .hero-content {
    color: #ffffff;
}

body.dark-mode .hero-content h1,
body.dark-mode .hero-content h2 {
    color: #ffffff;
}

body.dark-mode .books {
    background-color: #1a1a1a;
}

body.dark-mode .popular-books-section h2,
body.dark-mode .latest-books-section h2,
body.dark-mode .random-books-section h2 {
    color: #ffffff;
}

body.dark-mode .book-title {
    color: #ffffff;
}

body.dark-mode .prev,
body.dark-mode .next {
    background-color: #2d2d2d;
    color: #ffffff;
}

body.dark-mode .prev:hover,
body.dark-mode .next:hover {
    background-color: #404040;
}

/* Add smooth transitions */
.hero,
.books,
.hero-content,
.book-title,
.prev,
.next {
    transition: background-color var(--transition-speed, 0.3s),
                color var(--transition-speed, 0.3s);
}
/* Dark mode styles for hero section */
body.dark-mode main .hero {
    background-color: #1a1a1a;
}

/* Untuk memastikan transisi yang halus */
main .hero {
    transition: background-color var(--transition-speed, 0.3s);
}
    </style>
    </head>
    <body>
    <main>
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h2>WELCOME TO</h2>
                    <h1>JEJAK LITERASI</h1>
                    <p>Books are humanity's unique way of looking at the world. Books explore all parts of life, transform lives, and allow us to see things differently. Books can change your life.</p>
                </div>
                <div class="hero-image">
                    <img src="images/bookshelf.png" alt="Deskripsi gambar hero" />
                </div>

            </div>
        </section>

        <section class="books">
            <div class="container">
                <!-- Popular Books -->
                <div class="popular-books-section">
                    <h2>Popular Books</h2>
                    <div class="slideshow-container">
                        <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                        <div class="slides">
                            @foreach($popularBooks as $book)
                                <div class="book-slide">
                                    <a href="{{ route('books.show', $book) }}">
                                        <img class="book-card" src="{{ asset('storage/books/'.$book->image) }}" alt="{{ $book->title }}">
                                        <p class="book-title">{{ $book->title }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="next" onclick="moveSlide(1)">&#10095;</button>
                    </div>
                </div>

                <!-- Latest Books -->
                <div class="latest-books-section">
                    <h2>New Additions</h2>
                    <div class="slideshow-container">
                        <button class="prev" onclick="moveSlide2(-1)">&#10094;</button>
                        <div class="slides2">
                            @foreach($latestBooks as $book)
                                <div class="book-slide">
                                    <a href="{{ route('books.show', $book) }}">
                                        <img class="book-card" src="{{ asset('storage/books/'.$book->image) }}" alt="{{ $book->title }}">
                                        <p class="book-title">{{ $book->title }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="next" onclick="moveSlide2(1)">&#10095;</button>
                    </div>
                </div>

                <!-- Random Books -->
                <div class="random-books-section">
                    <h2>Random Books</h2>
                    <div class="slideshow-container">
                        <button class="prev" onclick="moveSlide3(-1)">&#10094;</button>
                        <div class="slides3">
                            @foreach($randomBooks as $book)
                                <div class="book-slide">
                                    <a href="{{ route('books.show', $book) }}">
                                        <img class="book-card" src="{{ asset('storage/books/'.$book->image) }}" alt="{{ $book->title }}">
                                        <p class="book-title">{{ $book->title }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="next" onclick="moveSlide3(1)">&#10095;</button>
                    </div>
                </div>
            </div>
            @stack('scripts')
        <script src="{{ asset('js/user.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/infinite-book-slider.js') }}"></script>
        </section>
    </main>
    </body>
    </html>
    @endsection
    @push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const darkModeToggle = document.getElementById('darkModeToggle');
    const darkModePreference = localStorage.getItem('darkMode');

    // Only apply user's explicit preference, ignore system preference
    if (darkModePreference === 'true') {
        body.classList.add('dark-mode');
    } else {
        body.classList.remove('dark-mode');
    }
    
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            body.classList.toggle('dark-mode');
            localStorage.setItem('darkMode', body.classList.contains('dark-mode'));
        });
    }
});
    
    // Check for saved dark mode preference
    const savedDarkMode = localStorage.getItem('darkMode');
    if (savedDarkMode === 'true') {
        applyDarkMode();
    }
    
    // Check system preference
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && !localStorage.getItem('darkMode')) {
        applyDarkMode();
    }
    
    // Watch for system dark mode changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('darkMode')) {
            if (e.matches) {
                applyDarkMode();
            } else {
                removeDarkMode();
            }
        }
    });
});
</script>
@endpush