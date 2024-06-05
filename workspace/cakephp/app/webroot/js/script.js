function getImages(){
    var img = document.querySelectorAll("img");
    var imgCount = img.length;
    console.log("Number of Images: " + imgCount);
}

$(document).ready(function(){
    var max = 100;
    $('.service_boxes p').each(function() {
        var text = $(this).text();
        if (text.length > max) {
            $(this).data('full-text', text); // Store full text in data attribute
            $(this).text(text.substring(0, max) + '...');
            $(this).siblings('.read-less').hide();
        } else {
            $(this).siblings('.read-more').hide();
        }
    });

    $('.read-more').click(function(e) {
        e.preventDefault();
        var $paragraph = $(this).prev('p');
        $paragraph.text($paragraph.data('full-text')); // Retrieve full text from data attribute
        $(this).hide();
        $(this).next('.read-less').show();
    });

    $('.read-less').click(function(e) {
        e.preventDefault();
        var $paragraph = $(this).prev().prev('p');
        var text = $paragraph.text();
        $paragraph.text(text.substring(0, max) + '...');
        $(this).hide();
        $(this).prev('.read-more').show();
    });
});


const carousel = document.querySelector('.carousel-inner');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let currentIndex = 0;
    let autoPlayInterval;

    function showSlide(index) {
        const slides = document.querySelectorAll('.carousel-item');
        if (index >= slides.length) currentIndex = 0;
        if (index < 0) currentIndex = slides.length - 1;
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function nextSlide() {
        currentIndex++;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex--;
        showSlide(currentIndex);
    }

    function startAutoPlay() {
        autoPlayInterval = setInterval(nextSlide, 3000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlayInterval);
    }

    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    carousel.addEventListener('mouseover', stopAutoPlay);
    carousel.addEventListener('mouseout', startAutoPlay);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowRight') {
            nextSlide();
        } else if (event.key === 'ArrowLeft') {
            prevSlide();
        }
    });

    showSlide(currentIndex);
    startAutoPlay();