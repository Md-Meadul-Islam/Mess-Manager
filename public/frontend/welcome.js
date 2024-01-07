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

var faqHeader = document.getElementsByClassName('faq-header');
var i;

for (i = 0; i < faqHeader.length; i++) {
    faqHeader[i].addEventListener("click", function () {
        for (var j = 0; j < faqHeader.length; j++) {
            var otherFaqBody = faqHeader[j].parentElement.childNodes[3];
            if (otherFaqBody !== this.parentElement.childNodes[3]) {
                otherFaqBody.style.display = 'none';
                faqHeader[j].classList.remove("active");
                faqHeader[j].childNodes[1].lastElementChild.childNodes[0].classList.remove('fa-rotate-180');
            }
        }
        var faqBody = this.parentElement.childNodes[3];
        faqBody.style.display = faqBody.style.display === "block" ? "none" : "block";
        this.classList.toggle("active");
        this.childNodes[1].lastElementChild.childNodes[0].classList.toggle('fa-rotate-180');
    });
}