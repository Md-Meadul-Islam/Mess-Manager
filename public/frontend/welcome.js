
//faq section start
var faqHeader = document.getElementsByClassName('faq-header');
var i;
for (i = 0; i < faqHeader.length; i++) {
    faqHeader[i].addEventListener("click", function () {
        this.classList.toggle("active");
        this.childNodes[1].lastElementChild.childNodes[0].classList.toggle('fa-rotate-180');
        var faqBody = this.parentElement.childNodes[3];
        if (faqBody.style.display === "block") {
            faqBody.style.display = "none";
        } else {
            faqBody.style.display = "block";
        }
    });
}