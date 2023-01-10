function isVisible(elem) {
    let coords = elem.getBoundingClientRect();

    let windowHeight = document.documentElement.clientHeight;

    let topVisible = coords.top > 0 && coords.top < windowHeight;

    let bottomVisible = coords.bottom < windowHeight && coords.bottom > 0;

    return topVisible || bottomVisible;
}

window.addEventListener('scroll', function () {
    let header = document.querySelector('header');
    let footer = document.querySelector('footer');
    let filter = document.querySelector('.catalogue-filter-container');

    if (!isVisible(header)) {
        filter.classList.add('catalogue-filter-container-fixed');
    }
    else {
        filter.classList.remove('catalogue-filter-container-fixed');
    }

    if (isVisible(footer)) {
        filter.classList.add('catalogue-filter-container-bottom');
    }
    else {
        filter.classList.remove('catalogue-filter-container-bottom');
    }
});

const rangeInputs = document.querySelectorAll('input[type="range"]')
const numberInputs = document.querySelectorAll('input[type="number"]')

function handleInputChange(e) {
    let target = e.target

    if (e.target.type !== 'range') {
        target = e.target.id === "rangevalue1" ? document.getElementById('range1') :
            document.getElementById('range2');
    }

    let min = target.min
    let max = target.max
    let val = target.value

    target.style.backgroundSize = (val - min) * 100 / (max - min) + '% 100%'
}

rangeInputs.forEach(input => {
    input.addEventListener('input', handleInputChange)
})

numberInputs.forEach(numberInput => {
    numberInput.addEventListener('input', handleInputChange)
})

// ФИЛЬТР НАЧАЛО

let numberPriceMin = document.getElementById('rangevalue1');
let sliderPriceMin = document.getElementById('range1');
let numberPriceMax = document.getElementById('rangevalue2');
let sliderPriceMax = document.getElementById('range2');
let allFilterPlatforms = document.querySelectorAll('.platform-fieldset input[type="checkbox"]');

for (let i = 0; i < allFilterPlatforms.length; i++) {
    allFilterPlatforms[i].addEventListener('change', filterUltra);
}

let allFilterAge = document.querySelectorAll('.age-fieldset input[type="checkbox"]');

for (let i = 0; i < allFilterAge.length; i++) {
    allFilterAge[i].addEventListener('change', filterUltra);
}

window.onload = function () {
    let key = localStorage.getItem('filterPlatform');

    if (key) {
        for (let i = 0; i < allFilterPlatforms.length; i++) {
            if (key === allFilterPlatforms[i].name) {
                allFilterPlatforms[i].setAttribute('checked', 'true');
                filterUltra();
                localStorage.removeItem('filterPlatform');
                break;
            }
        }
    }
}

numberPriceMin.addEventListener('input', filterUltra);
sliderPriceMin.addEventListener('input', filterUltra);
numberPriceMax.addEventListener('input', filterUltra);
sliderPriceMax.addEventListener('input', filterUltra);

let allGames = document.querySelectorAll('.game');

function filterUltra() {
    let priceMin = Number(numberPriceMin.value);
    let priceMax = Number(numberPriceMax.value)

    for (let i = 0; i < allGames.length; i++) {
        let mainPriceFiltered = false;

        let gamePriceElement = allGames[i].querySelector('.game-price');
        if (gamePriceElement) {
            let gamePrice = Number(gamePriceElement.textContent);

            if (gamePrice < priceMin || gamePrice >= priceMax) {
                mainPriceFiltered = true;
            }
            else {
                mainPriceFiltered = false;
            }
        }

        let discountPriceFiltered = false;

        gamePriceElement = allGames[i].querySelector('.discounted-game-new-price');
        if (gamePriceElement) {
            let gamePrice = Number(gamePriceElement.textContent);

            if (gamePrice < priceMin || gamePrice >= priceMax) {
                discountPriceFiltered = true;
            }
            else {
                discountPriceFiltered = false;
            }
        }

        let platformFiltered = false;

        let gamePlatformElement = allGames[i].querySelector('.game-platform');
        if (gamePlatformElement) {
            let gamePlatform = gamePlatformElement.textContent;
            let allCheckedPlatforms = document.querySelectorAll('.platform-fieldset input[type="checkbox"]:checked');
            let requiredPlatforms = []

            for (let j = 0; j < allCheckedPlatforms.length; j++)
                requiredPlatforms.push(allCheckedPlatforms[j].name);

            if (requiredPlatforms.length !== 0 && requiredPlatforms.indexOf(gamePlatform) === -1) {
                platformFiltered = true;
            }
            else {
                platformFiltered = false;
            }
        }

        let ageFiltered = false;

        let ageElement = allGames[i].querySelector('.game-age');
        if (ageElement) {
            let gameAge = ageElement.textContent;
            let allCheckedAges = document.querySelectorAll('.age-fieldset input[type="checkbox"]:checked');
            let requiredAges = []

            for (let j = 0; j < allCheckedAges.length; j++)
                requiredAges.push(allCheckedAges[j].name);

            if (requiredAges.length !== 0 && requiredAges.indexOf(gameAge) === -1) {
                ageFiltered = true;
            }
            else {
                ageFiltered = false;
            }
        }

        if (mainPriceFiltered || discountPriceFiltered || platformFiltered || ageFiltered) {
            allGames[i].classList.add('game-hidden');
        }
        else {
            allGames[i].classList.remove('game-hidden');
        }
    }
};

// ФИЛЬТР КОНЕЦ