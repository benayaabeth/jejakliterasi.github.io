document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.querySelector('.dark-mode-toggle');
    const icon = toggleButton?.querySelector('.icon'); // Ikon dalam tombol
    const logo = document.getElementById('logo'); // Elemen logo

    if (!toggleButton || !icon || !logo) return;

    // Fungsi untuk mengaktifkan atau menonaktifkan dark mode
    function setDarkMode(enabled) {
        if (enabled) {
            document.body.classList.add('dark-mode');
            document.querySelectorAll('.dark-mode-toggle-target').forEach(el => {
                el.classList.add('dark-mode');
            });
            localStorage.setItem('theme', 'dark');
            icon.textContent = '☀️'; // Ikon matahari untuk light mode
            toggleButton.setAttribute('aria-label', 'Switch to light mode');
            logo.src = logoDark; // Ganti logo ke versi dark
        } else {
            document.body.classList.remove('dark-mode');
            document.querySelectorAll('.dark-mode-toggle-target').forEach(el => {
                el.classList.remove('dark-mode');
            });
            localStorage.setItem('theme', 'light');
            icon.textContent = '🌙'; // Ikon bulan untuk dark mode
            toggleButton.setAttribute('aria-label', 'Switch to dark mode');
            logo.src = logoLight; // Ganti logo ke versi light
        }
    }

    // Set initial mode berdasarkan localStorage
    const savedMode = localStorage.getItem('theme');
    setDarkMode(savedMode === 'dark');

    // Tambahkan event listener untuk toggle dark mode
    toggleButton.addEventListener('click', () => {
        const isDarkMode = document.body.classList.contains('dark-mode');
        setDarkMode(!isDarkMode);
    });
});





let currentIndex = 0;

function moveSlide(step) {
    const slides = document.querySelector('.slides');
    const slideCount = slides.children.length;
    const visibleSlides = 5; // Jumlah buku yang tampil sekaligus
    const maxIndex = slideCount - visibleSlides;

    currentIndex += step;

    if (currentIndex < 0) {
        currentIndex = 0; // Cegah ke kiri lebih jauh
    } else if (currentIndex > maxIndex) {
        currentIndex = maxIndex; // Cegah ke kanan lebih jauh
    }

    const slideWidth = slides.children[0].offsetWidth;
    slides.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

function moveSlide2(step) {
    const slides = document.querySelector('.slides2');
    const slideCount = slides.children.length;
    const visibleSlides = 5; // Jumlah buku yang tampil sekaligus
    const maxIndex = slideCount - visibleSlides;

    currentIndex += step;

    if (currentIndex < 0) {
        currentIndex = 0; // Cegah ke kiri lebih jauh
    } else if (currentIndex > maxIndex) {
        currentIndex = maxIndex; // Cegah ke kanan lebih jauh
    }

    const slideWidth = slides.children[0].offsetWidth;
    slides.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

function moveSlide3(step) {
    const slides = document.querySelector('.slides3');
    const slideCount = slides.children.length;
    const visibleSlides = 5; // Jumlah buku yang tampil sekaligus
    const maxIndex = slideCount - visibleSlides;

    currentIndex += step;

    if (currentIndex < 0) {
        currentIndex = 0; // Cegah ke kiri lebih jauh
    } else if (currentIndex > maxIndex) {
        currentIndex = maxIndex; // Cegah ke kanan lebih jauh
    }

    const slideWidth = slides.children[0].offsetWidth;
    slides.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
}

document.getElementById("searchInput").addEventListener("keyup", function() {
    let query = this.value;
    const suggestionsBox = document.getElementById("suggestions");

    if (query.length > 0) {
        fetch(`search_suggestions.php?q=${query}`)
            .then(response => response.json())
            .then(data => {
                suggestionsBox.innerHTML = ""; // Kosongkan box
                suggestionsBox.style.display = "block";

                if (data.length > 0) {
                    data.forEach(item => {
                        let link = document.createElement("a");
                        link.href = `detail_buku.php?id=${item.id}`;
                        link.textContent = item.title + " - " + item.author;
                        suggestionsBox.appendChild(link);
                    });
                } else {
                    suggestionsBox.innerHTML = "<p style='padding: 10px;'>Tidak ada hasil</p>";
                }
            });
    } else {
        suggestionsBox.style.display = "none";
    }
});

document.addEventListener("click", function(e) {
    if (!document.querySelector(".search-wrapper").contains(e.target)) {
        document.getElementById("suggestions").style.display = "none";
    }
});

// Add loading spinner
function showLoading() {
    const spinner = document.createElement('div');
    spinner.className = 'loading-spinner';
    document.body.appendChild(spinner);
    spinner.style.display = 'block';
}

function hideLoading() {
    const spinner = document.querySelector('.loading-spinner');
    if (spinner) {
        spinner.remove();
    }
}

// Add to cart with animation
function addToCart(bookId) {
    showLoading();
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ book_id: bookId })
    })
    .then(response => response.json())
    .then(data => {
        hideLoading();
        if (data.success) {
            // Update cart count
            const cartCount = document.getElementById('cartCount');
            if (cartCount) {
                cartCount.textContent = data.cartCount;
            }
            // Show success message
            alert('Book added to cart successfully');
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        hideLoading();
        alert('Error adding book to cart');
    });
}

// Enhanced search suggestions
let searchTimeout;
const searchInput = document.getElementById('searchInput');
const suggestionsBox = document.getElementById('suggestions');

if (searchInput && suggestionsBox) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value;

        if (query.length < 2) {
            suggestionsBox.style.display = 'none';
            return;
        }

        searchTimeout = setTimeout(() => {
            fetch(`/books/suggestions?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    suggestionsBox.innerHTML = '';
                    suggestionsBox.style.display = data.length ? 'block' : 'none';

                    data.forEach(book => {
                        const div = document.createElement('div');
                        div.className = 'suggestion-item';
                        div.innerHTML = `
                            <a href="/books/${book.id}">
                                <strong>${book.title}</strong>
                                <span>${book.author}</span>
                            </a>
                        `;
                        suggestionsBox.appendChild(div);
                    });
                });
        }, 300);
    });
}