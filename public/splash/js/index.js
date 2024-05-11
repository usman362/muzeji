// document.addEventListener('click', function (event) {
//     var sideLangCont = document.querySelector('.side-lang-cont');
//     var conticDiv = document.querySelector('.contic');
//     if (!sideLangCont.contains(event.target) && !conticDiv.contains(event.target)) {
//         sideLangCont.classList.remove('s-side');
//     }
// });

function openPopup(id) {
    var overlay = document.getElementById("overlay");
    var popup = document.getElementById("popup"+id);
    overlay.style.display = "block";
    popup.style.display = "block";
    document.body.style.overflow = "hidden";
}

function closePopup() {
    var overlay = document.getElementById("overlay");
    var popup = document.querySelector(".popup");
    overlay.style.display = "none";
    popup.style.display = "none";
    document.body.style.overflow = "auto";
}

document.addEventListener('DOMContentLoaded', function () {
    var conticDiv = document.querySelector('.contic');
    var eachLangDivs = document.querySelectorAll('.each-lang');

    conticDiv.addEventListener('click', addClassToSideLangCont);

    eachLangDivs.forEach(function (eachLangDiv) {
        eachLangDiv.addEventListener('click', removeClassFromSideLangCont);
    });
});


function addClassToSideLangCont() {
    var sideLangCont = document.querySelector('.side-lang-cont');
    sideLangCont.classList.add('s-side');
}

function removeClassFromSideLangCont() {
    var sideLangCont = document.querySelector('.side-lang-cont');
    sideLangCont.classList.remove('s-side');
}
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n, i) {
    showSlides(slideIndex += n, i);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n, id = 1) {
    let i;
    let className = 'mySlides' + id;
    let slides = document.getElementsByClassName(className);
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
}


function showLanguage(n) {
    let slides = document.getElementsByClassName('language-content');
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    let pastSlides = document.getElementsByClassName('mySlides');
    for (i = 0; i < pastSlides.length; i++) {
        pastSlides[i].style.display = "none";
    }
    let className = 'mySlides'+n;
    let currentSlide = document.getElementsByClassName(className);
    currentSlide[0].style.display = "block";
    let id = 'content-'+n;
    let activeContent = document.getElementById(id);
    activeContent.style.display = "block";
}

