$(document).ready(function () {
    let currentSlide = 0;
    const slides = $('.carousel-item');
    const dots = $('.carousel-dot');
    const totalSlides = slides.length;

    // Initialize dots
    dots.eq(0).addClass('bg-opacity-100');

    // Function to update carousel position
    function updateCarousel() {
        $('.carousel-slides').css('transform', `translateX(-${currentSlide * 100}%)`);
        dots.removeClass('bg-opacity-100').addClass('bg-opacity-50');
        dots.eq(currentSlide).removeClass('bg-opacity-50').addClass('bg-opacity-100');
    }

    // Next button click
    $('.carousel-next').click(function () {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    });

    // Previous button click
    $('.carousel-prev').click(function () {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateCarousel();
    });

    // Dot navigation
    dots.each(function (index) {
        $(this).click(function () {
            currentSlide = index;
            updateCarousel();
        });
    });

    // Auto-advance slides every 5 seconds
    setInterval(function () {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }, 5000);

    // Touch support for mobile devices
    let touchStartX = 0;
    let touchEndX = 0;

    $('.carousel-container').on('touchstart', function (e) {
        touchStartX = e.originalEvent.touches[0].clientX;
    });

    $('.carousel-container').on('touchend', function (e) {
        touchEndX = e.originalEvent.changedTouches[0].clientX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const difference = touchStartX - touchEndX;

        if (Math.abs(difference) > swipeThreshold) {
            if (difference > 0) {
                // Swipe left - next slide
                currentSlide = (currentSlide + 1) % totalSlides;
            } else {
                // Swipe right - previous slide
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            }
            updateCarousel();
        }
    }
});