function toggleNav() {
    var nav = document.querySelector('nav');
    nav.classList.toggle('show');
}
function toggleNav() {
    var nav = document.querySelector('nav');
    nav.classList.toggle('show');
}
document.body.addEventListener('click', function (event) {
    var nav = document.querySelector('nav');
    var targetElement = event.target;
    if (!nav.contains(targetElement) && targetElement.className !== 'bi bi-list') {
        nav.classList.remove('show');
    }
});