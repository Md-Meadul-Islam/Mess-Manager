@if ($tolets)
@foreach ($tolets as $index=> $tolet)
<div class="col-lg-4 col-md-6 col-sm-12 px-1 py-0">
  <div class="card text-center">
    <div class="carousel slide position-relative" data-bs-interval="false" data-index="{{ $index }}">
      <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
              <img src="{{ asset('storage/tolet_img/' . $tolet->photo_1) }}"class="img-fluid files"
                  style="width:100%; height:300px; object-fit: cover;" alt="First slide">
          </div>
          @if ($tolet->photo_2)
          <div class="carousel-item active">
              <img src="{{ asset('storage/tolet_img/' . $tolet->photo_2) }}"class="img-fluid files"
                  style="width:100%; height:300px; object-fit: cover;" alt="Second slide">
          </div>
          @endif
      </div>
      <button class="carousel-control-prev" type="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" style="background-color: green; text-shadow: 0 10px 10px black" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" style="background-color: green; text-shadow: 0 10px 10px black" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
  </div> 
    <div class="card-body">
      <h4 class="card-header">{{$tolet->title}}</h4>
      <p>{{__("From: ".$tolet->from_month)}}</p>
      <p>{{__("Details: ".$tolet->details)}}</p>
      <p>{{ __("Address: ".$tolet->address)}}</p>
      <p>{{ __("Contact: ".$tolet->contacts)}}</p>
    </div>
  </div>
</div>
@endforeach
@endif
<script>
    $(document).ready(function () {
         $('.carousel').each(function () {
             var index = $(this).data('index');
             $(this).children('.carousel-control-prev').on('click', function () {
                 navigateCarousel($(this).closest('.carousel'), 'prev');
             });
             $(this).children('.carousel-control-next').on('click', function () {
                 navigateCarousel($(this).closest('.carousel'), 'next');
             });
         });
     }); 
     // Function to navigate a specific carousel
     function navigateCarousel(carousel, direction) {
         var carouselItems = carousel.find('.carousel-inner .carousel-item');
         var activeIndex = getActiveIndex(carouselItems);
         if (direction === 'prev') {
             activeIndex = (activeIndex - 1 + carouselItems.length) % carouselItems.length;
         } else {
             activeIndex = (activeIndex + 1) % carouselItems.length;
         }
         carouselItems.each(function (i, item) {
             $(item).toggleClass('active', i === activeIndex);
         });
     } 
     // Function to get the index of the active carousel item
     function getActiveIndex(items) {
         for (var i = 0; i < items.length; i++) {
             if ($(items[i]).hasClass('active')) {
                 return i;
             }
         }
         return 0;
     }
</script>