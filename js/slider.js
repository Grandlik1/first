let slideIndex = 0;
const slides = document.querySelectorAll('.slide');

function showSlide(index) {
    if (index >= slides.length) {
        slideIndex = 0;
    } else if (index < 0) {
        slideIndex = slides.length - 1;
    } else {
        slideIndex = index;
    }

    // Hide all slides
    slides.forEach(slide => {
        slide.style.display = 'none';
    });

    // Show the selected slide
    slides[slideIndex].style.display = 'block';
}

function prevSlide() {
    showSlide(slideIndex - 1);
    document.getElementById('prevButton').classList.add('active-button');
}

function nextSlide() {
    showSlide(slideIndex + 1);
    document.getElementById('nextButton').classList.add('active-button');
}

document.getElementById('prevButton').addEventListener('mouseup', function() {
    this.classList.remove('active-button');
});

document.getElementById('nextButton').addEventListener('mouseup', function() {
    this.classList.remove('active-button');
});