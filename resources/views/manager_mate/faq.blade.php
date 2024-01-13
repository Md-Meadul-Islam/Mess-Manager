@extends('manager_mate_layouts.app')
@section('manager_title', 'FAQ | Dashboard')
@section('breadcrumb', 'Dashboard / Mates / FAQ')
@section('manager_content')
<style>
    .faq-header {
    font-size: 15px;
    transition: 0.4s;
    color: white;
    background: rgb(194, 194, 194);
    border-bottom: 2px solid white;
}

.faq-header i {
    color: saddlebrown;
    transition: .5s;
}

.faq-header.active {
    cursor: pointer;
}

.faq-header.active i {
    color: seagreen;
    transition: all .5s;
}

.faq-body {
    padding: 0 18px;
    background-color: rgb(180, 168, 168);
    display: none;
    overflow: hidden;
    transition: all .5s;
}
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <h1 class="text-center" style="font-family: cursive; font-weight:600">Frequently Asked Question</h1>
            <div class="card m-2 p-3">
              @php
                  $faqJson = File::get(base_path('public/JSON/faq.json'));
                  $faqData = json_decode($faqJson);
              @endphp
              @foreach ($faqData as $key=>$faq)
              <div class="faq-content">
                <div class="faq-header p-2">
                  <h4 style="position: relative">{!!__( $faq->title )!!}<span
                      style="position: absolute; right:5px"><i class="fa-solid fa-angle-down"></i></span></h4>
                </div>
                <div class="faq-body pt-2">
                  <p>{!!__( $faq->body )!!}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
    </div>
</div>
<script>
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

</script>
@endsection