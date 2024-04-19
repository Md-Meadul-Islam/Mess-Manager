<?php 
$ip = $_SERVER['REMOTE_ADDR'];
?>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        //catche location
        navigator.geolocation.getCurrentPosition((position) => {
            const { latitude, longitude } = position.coords;
            const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`;    
            $.get(url, function(data) {
                var village = data.address.suburb;
                var town = data.address.borough;
                var city = data.address.city;
                var country = data.address.country;
                $('.village').text(village);
                $('.town').text(town);
                $('.city').text(city);
                $('.country').text(country);
                $.ajax({
                    url:"{{route('viewtolet')}}",
                    method: "GET",
                    data:{village:village, town:town, city:city, country:country},
                    success:function(res){
                        $('.viewtolets').html(res);
                    }
                })
            }).fail(function() {
                console.log('Error fetching your local address');
            }); 
        },()=>{
            fetch(`https://ipapi.co/<?php echo $ip; ?>/json/`)
            .then(response => response.json())
            .then(data => {
                var city = data.city;
                var country = data.country_name;
                $('.city').text(city);
            $('.country').text(country);
            $.ajax({
                    url:"{{route('viewtolet')}}",
                    method: "GET",
                    data:{city:geoCity, country:geoCountry},
                    success:function(res){
                        $('.viewtolets').html(res);
                    }
                })
            })
            .catch(error => {
                // document.getElementById('location').innerHTML = 'Failed to retrieve location information.';
            });
        });
         //for pagination
         $(document).on('click', '.pagination a', function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            $.ajax({
                url:"/toletpagination?page="+page,
                success: function(res){
                    $('.viewtolets').html(res);
                }
            });
        });
        // click event for tolet add btn
        $(document).on('click', '.toletAddBtn', function (e) {
            e.preventDefault();
            $('.addtolet').toggleClass('show');
        });
        $(document).on('click', '.saveBtn', function (e) {
            e.preventDefault();
            var formData = new FormData();
            let title = $('#title').val();
            let month = $('#month').val();
            let details = $('#details').val();
            let address = $('#address').val();
            let contact = $('#contact').val();
            let photo1 = $('#photo1')[0].files;
            let photo2 = $('#photo2')[0].files;
            formData.append('title', title);
            formData.append('month', month);
            formData.append('details', details);
            formData.append('address', address);
            formData.append('contact', contact);
            if (photo1.length > 0) {
                formData.append('photo1', photo1[0]); 
            }
            if (photo2.length > 0) {
                formData.append('photo2', photo2[0]);
            }
            $.ajax({
                url: "{{route('maketolet')}}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    $('.addtolet').removeClass('show');
                    $('.viewtolets').load("{{ route('viewtolet') }}");
                    toastr.success(res.message, 'Success');                    
                    toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.message;
                    toastr.error(errors, "Cancelled");
                    toastr.options = {
                        "closeButton": true,
                        "debug": true,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                }
            });
        });
        $(document).on('click', '#mainsearch', function(e){
            e.preventDefault();
            $.ajax({
                url:"{{route('searchtolet')}}",
                method:'POST',
                data:{searchString: $('.searchString').val()},
                success:function(res){
                    $('.viewtolets').html(res);
                }
            })
        });
    });
</script>