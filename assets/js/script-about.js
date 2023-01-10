function isVisible(elem) {
    let coords = elem.getBoundingClientRect();

    let windowHeight = document.documentElement.clientHeight;

    let topVisible = coords.top > 0 && coords.top < windowHeight;

    let bottomVisible = coords.bottom < windowHeight && coords.bottom > 0;

    return topVisible || bottomVisible;
}

window.addEventListener('scroll', function () {
    let object2 = document.querySelectorAll('hr');

    object2.forEach(object => {
        if (isVisible(object) && object.classList.contains('hr-invisible')) {
            object.classList.remove('hr-invisible')
            object.classList.add('hr-visible');
        }
    });
});

let lines = document.querySelectorAll('hr');

lines.forEach(line => {
    if (isVisible(line) && line.classList.contains('hr-invisible')) {
        line.classList.remove('hr-invisible')
        line.classList.add('hr-visible');
    }
});