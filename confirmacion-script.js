const track = document.getElementById('track');
const slides = document.querySelectorAll('.slide');
const lightbox = document.getElementById('lightbox');
const imgFull = document.getElementById('imgFull');
const captionText = document.getElementById('caption');
const closeBtn = document.querySelector('.close-lightbox');

let index = 1;

function updateCarousel() {
    track.style.transition = "transform 0.5s ease-in-out";
    track.style.transform = `translateX(${-index * 100}%)`;
}

document.getElementById('nextBtn').addEventListener('click', () => {
    index++;
    updateCarousel();
});

document.getElementById('prevBtn').addEventListener('click', () => {
    index--;
    updateCarousel();
});

track.addEventListener('transitionend', () => {
    if (index >= slides.length - 1) {
        track.style.transition = "none";
        index = 1;
        track.style.transform = `translateX(${-index * 100}%)`;
    }
    if (index <= 0) {
        track.style.transition = "none";
        index = slides.length - 2;
        track.style.transform = `translateX(${-index * 100}%)`;
    }
});

slides.forEach(slide => {
    slide.addEventListener('click', () => {
        const img = slide.querySelector('img');
        lightbox.style.display = "flex";
        imgFull.src = img.src;
        captionText.innerHTML = img.getAttribute('data-caption');
    });
});

closeBtn.onclick = () => lightbox.style.display = "none";
window.onclick = (e) => { if (e.target == lightbox) lightbox.style.display = "none"; };

setInterval(() => {
    index++;
    updateCarousel();
}, 6000);