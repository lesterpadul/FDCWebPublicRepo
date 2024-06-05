const img = $("img");

//target the hero-text
const pTag = $("#hero-text");
const text = pTag.text();
const maxLength = 50;

//cut the original text to 50 chars
const ellipsesText =
	text.length > maxLength ? text.slice(0, maxLength) + "..." : text;
pTag.text(ellipsesText);

// create a button with the text "See More"
const button = $("<button>").text("See More");

// insert the button after the element with the id "hero-text"
$("#hero-text").after(button);

button.css("color", "#6366F1");

button.click(() => {
	if (button.text() === "See More") {
		pTag.text(text);
		button.text("See Less");
	} else {
		pTag.text(ellipsesText);
		button.text("See More");
	}
});

button.hover(
	() => {
		$(this).css("filter", "drop-shadow(0 0 10px #6366F1)");
	},
	() => {
		$(this).css("filter", "none");
	}
);

let currentSlide = 0;
const slides = $(".slide");
const totalSlides = slides.length;

function showSlide(index) {
	slides.hide();
	slides.eq(index).show();
}

function nextSlide() {
	currentSlide = (currentSlide + 1) % totalSlides;
	showSlide(currentSlide);
}

function prevSlide() {
	currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
	showSlide(currentSlide);
}

$("#nextBtn").click(nextSlide);
$("#prevBtn").click(prevSlide);

showSlide(currentSlide);
