let slideIndex = 0;
let slideIndex2 = 0;
let slideIndex3 = 0;

// Fungsi untuk menduplikasi slides agar bisa infinite scroll
function duplicateSlides(slidesClass) {
    const slides = document.querySelector(slidesClass);
    const originalSlides = slides.innerHTML;
    // Duplikasi slides di awal dan akhir
    slides.innerHTML = originalSlides + originalSlides + originalSlides;
    
    // Set posisi awal ke set tengah
    const slideItems = slides.querySelectorAll('.book-slide');
    const middleOffset = Math.floor(slideItems.length / 3);
    slides.style.transform = `translateX(-${middleOffset * 200}px)`;
    return middleOffset;
}

// Inisialisasi slide duplikat saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    slideIndex = duplicateSlides('.slides');
    slideIndex2 = duplicateSlides('.slides2');
    slideIndex3 = duplicateSlides('.slides3');
});

function moveSlide(direction, slidesClass = '.slides', index = 1) {
    const slides = document.querySelector(slidesClass);
    const slideItems = slides.querySelectorAll('.book-slide');
    const totalSlides = slideItems.length;
    
    // Update index berdasarkan direction
    if (index === 1) {
        slideIndex += direction;
    } else if (index === 2) {
        slideIndex2 += direction;
    } else {
        slideIndex3 += direction;
    }
    
    let currentIndex = (index === 1) ? slideIndex : (index === 2) ? slideIndex2 : slideIndex3;
    
    // Animasi transisi
    slides.style.transition = 'transform 0.5s ease-in-out';
    slides.style.transform = `translateX(-${currentIndex * 200}px)`;
    
    // Reset posisi setelah transisi selesai
    slides.addEventListener('transitionend', function resetPosition() {
        slides.style.transition = 'none';
        const oneThird = Math.floor(totalSlides / 3);
        
        if (currentIndex >= oneThird * 2) {
            currentIndex = oneThird;
            slides.style.transform = `translateX(-${currentIndex * 200}px)`;
        } else if (currentIndex <= 0) {
            currentIndex = oneThird;
            slides.style.transform = `translateX(-${currentIndex * 200}px)`;
        }
        
        if (index === 1) slideIndex = currentIndex;
        else if (index === 2) slideIndex2 = currentIndex;
        else slideIndex3 = currentIndex;
        
        slides.removeEventListener('transitionend', resetPosition);
    });
}

// Fungsi untuk setiap slider
function moveSlide2(direction) {
    moveSlide(direction, '.slides2', 2);
}

function moveSlide3(direction) {
    moveSlide(direction, '.slides3', 3);
}
