var introvideo = document.getElementById("IVideo");
var el = document.getElementById("playButton");
var replay = document.getElementById("replayButton");
replay.style.visibility = 'hidden';
pauseButton.style.visibility = 'hidden';


function playPause() {
    replay.style.visibility = 'hidden';
    if (introvideo.paused) {
        introvideo.play();
        el.className = "";
    }
    else {
        introvideo.pause();
        el.className = "playButton";
    }
}

function playPauseControls() {
    replay.style.visibility = 'hidden';
    if (!introvideo.paused) {
        el.className = "";

    } else {
        el.className = "playButton";
    }
}

function hideHoverPauseButton() {
    replay.style.visibility = 'hidden';
    if (!introvideo.paused) {
        el.className = "";
    } else {
        el.className = "playButton";
    }
}

function showHoverPauseButton() {
    replay.style.visibility = 'hidden';
    if (!introvideo.paused) {
        el.className = "pauseButton";
    } else {
        el.className = "playButton";
    }
}

function videoEnd() {
    replay.style.visibility = 'visible';
    el.className = "";
    introvideo.setAttribute("controls", "controls");
}

function showControls() {
    introvideo.setAttribute("controls", "controls");
}
function hideControls() {
    introvideo.removeAttribute("controls", "controls");
}
introvideo.addEventListener("click", playPause, false);
introvideo.addEventListener("play", playPauseControls, false);
introvideo.addEventListener("pause", playPauseControls, false);
introvideo.addEventListener("mouseover", hideControls, false);
introvideo.addEventListener("mouseout", hideControls, false);
introvideo.addEventListener("mouseover", showHoverPauseButton, true);
introvideo.addEventListener("mouseout", hideHoverPauseButton, true);
el.addEventListener("mouseover", showHoverPauseButton, true);
el.addEventListener("mouseover", hideControls, false);
replay.addEventListener("mouseover", hideControls, false);
introvideo.addEventListener("ended", videoEnd, false);
//intro video ended
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