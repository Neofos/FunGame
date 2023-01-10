let changeMainHitListBg = function () {
    let imgUrl = document.querySelector('.slide-active img').src;
    let mainHitList = $('.main-hit-list');
    mainHitList.css('background', 'url(' + imgUrl + ') no-repeat');
}

let gameInfos = $('li.slide');
gameInfos[Math.floor(Math.random() * gameInfos.length)].classList.add('slide-active');
changeMainHitListBg();

let hitProductLink = document.querySelector('.hit-product-link');
let hitProductId = document.querySelector('.slide-active').querySelector('.hit-product-id');
hitProductLink.setAttribute('href', "/product.php?id=" + hitProductId.textContent)

let changeSlideRight = function () {
    let currentActiveSlide, activeSlideIndex;

    for (let i = 0; i < gameInfos.length; i++) {
        if (gameInfos[i].classList.contains('slide-active')) {
            currentActiveSlide = gameInfos[i];
            activeSlideIndex = i;
            break;
        }
    }

    if (currentActiveSlide) {
        currentActiveSlide.classList.remove('slide-active');

        if (activeSlideIndex + 1 < gameInfos.length) {
            gameInfos[activeSlideIndex + 1].classList.add('slide-active');
        }
        else {
            gameInfos[0].classList.add('slide-active');
        }
    }

    changeMainHitListBg();
    hitProductId = document.querySelector('.slide-active').querySelector('.hit-product-id');
    hitProductLink.setAttribute('href', "/product.php?id=" + hitProductId.textContent)
};

let changeSlideLeft = function () {
    let currentActiveSlide, activeSlideIndex;

    for (let i = 0; i < gameInfos.length; i++) {
        if (gameInfos[i].classList.contains('slide-active')) {
            currentActiveSlide = gameInfos[i];
            activeSlideIndex = i;
            break;
        }
    }

    if (currentActiveSlide) {
        currentActiveSlide.classList.remove('slide-active');

        if (activeSlideIndex - 1 >= 0) {
            gameInfos[activeSlideIndex - 1].classList.add('slide-active');
        }
        else {
            gameInfos[gameInfos.length - 1].classList.add('slide-active');
        }
    }

    changeMainHitListBg();
    hitProductId = document.querySelector('.slide-active').querySelector('.hit-product-id');
    hitProductLink.setAttribute('href', "/product.php?id=" + hitProductId.textContent)
};

function isVisible(elem) {
    let coords = elem.getBoundingClientRect();

    let windowHeight = document.documentElement.clientHeight;

    let topVisible = coords.top > 0 && coords.top < windowHeight;

    let bottomVisible = coords.bottom < windowHeight && coords.bottom > 0;

    return topVisible || bottomVisible;
}

window.addEventListener('scroll', function () {
    let object1 = document.querySelector('.discount-container');

    if (isVisible(object1) && object1.classList.contains('discount-container-hidden')) {
        object1.classList.remove('discount-container-hidden')
        object1.classList.add('discount-container-visible');
    }
});

function sendFilter(filterName) {
    localStorage.setItem('filterPlatform', filterName);
}