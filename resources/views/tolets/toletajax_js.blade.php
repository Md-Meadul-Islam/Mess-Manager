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
                $.ajax({
                    url:"{{route('viewtolet')}}",
                    method: "POST",
                    data:{village:village, town:town, city:city, country:country},
                    success:function(res){
                        $('.village').text(res.village);
                        $('.town').text(res.town);
                        $('.city').text(res.city);
                        $('.viewtolets').html(res.tolets);
                        $('.viewtolets').html(res.message);
                    }
                })
            }).fail(function() {
                console.log('Error fetching your local address');
            }); 
        },()=>{
            $.ajax({
                    url:"{{route('viewtolet')}}",
                    method: "POST",
                    success:function(res){
                        $('.village').text(res.village);
                        $('.town').text(res.town);
                        $('.city').text(res.city);
                        $('.viewtolets').html(res.tolets);
                        $('.viewtolets').html(res.message);
                    }
                })
        });
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            $.ajax({
                url: "/homepagination?page=" + page,
                success: function (res) {
                    $('.viewtolets').html(res);
                }
            });
        });
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
                    toastr.success(res.message, 'Success');
                    $('.viewtolets').load();
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
                    console.log(xhr);
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