<script>
     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        //for to let
        $(document).on('click', '.dashboardtolet', function(){
            $.ajax({
                url:"{{route('dashboard.tolet')}}",
                method:'GET',
                success:function(res){
                    $('.mainrow').html(res);
                }
            })
        });
        $(document).on('click','.edittolet', function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{route('edit.tolet')}}",
                method:'GET',
                data:{id:id},
                success:function(res){
                    $('.edittoletdiv').fadeIn(1000, function() {
                    $(this).html(res);
                    });
                }
            })
        });
        $(document).on('click', '.hideeditmodal',function(){
            $('.edittoletdiv').fadeOut(1000, function() {
            $(this).html(' ');
             });
         });
         $(document).on('click', '.updateBtn', function(){
            let id = $('#toletid').val();
            let title = $('#title').val();
            let month = $('#month').val();
            let contact = $('#contact').val();
            let details = $('#details').val();
            let address = $('#address').val();
            let photo1 = $('#photo1')[0].files;
            let photo2 = $('#photo2')[0].files;
            let formData = new FormData();
            formData.append('id', id);
            formData.append('title', title);
            formData.append('month', month);
            formData.append('contact', contact);
            formData.append('details', details);
            formData.append('address', address);
            if (photo1.length > 0) {
                formData.append('photo1', photo1[0]); 
            }
            if (photo2.length > 0) {
                formData.append('photo2', photo2[0]);
            }
            $.ajax({
                url: "{{ route('tolet.update') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    $('.mainrow').load("{{ route('dashboard.tolet') }}");
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
                error: function(xhr) {
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
         })
        $(document).on('click', '.deletetolet', function(){
            var id = $(this).data('id');
            if(confirm('Are you sure to delete this To-Let ??')){
                $.ajax({
                url:"{{route('tolet.delete')}}",
                method:"POST",
                data:{id:id},
                success:function(res){
                    $('.mainrow').load("{{route('dashboard.tolet')}}");
                }
            });
            }
        })
    });
</script>