@extends('layouts.master')
@section('content')
@include('layouts.inc.nav')


<section class="container-fluid">
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-6">
                <form class="form-container">
                    @csrf
                    <h2 class="text-center bg-dark p-2 text-white">Add Users Listing</h2>
                 
                    <div class="form-group">
                        <label for="">Business Name</label>
                        <input type="text" name="business_name" class="form-control" id="business_name"
                            placeholder="Enter Business Name">
                    </div>
                 
                    <div class="form-group">
                        <label for="business_email">Business Email</label>
                        <input type="text" name="business_email" class="form-control" id="business_email"
                            placeholder="Enter Business Email">
                    </div>
                 
                    <div class="form-group">
                        <label for="business_phone">Business Phone</label>
                        <input type="text" class="form-control" name="business_phone" id="business_phone"
                            placeholder="Enter Business Phone">
                    </div>
                  
                    <div class="form-group">
                        <label for="business_web">Business Website</label>
                        <input type="text" name="business_web" class="form-control" id="business_web"
                            placeholder="Enter Business Website">
                    </div>
                    
                    <button type="submit" class="btn btn-dark btn-block save_btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection


@push('javascript')
<script>
    var receiver_id = '';
    var my_id = "{{ Auth::id() }}";

    $(document).ready(function () {
        var pusher = new Pusher(my_id, {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            alert(JSON.stringify(data));
            if (data.from) {
                // $('#' + data.from).click();

                var pending = parseInt($('#' + data.from).find('.pending').html());
                if (pending) {
                    $('#' + data.from).find('.pending').html(pending + 1);
                } else {
                    $('#' + data.from).html(
                        '<a href="#" class="nav-link" data-toggle="dropdown"><i class="fa fa-bell text-white">&nbsp;&nbsp;<span class="badge badge-danger pending">1</span></i></a>'
                        );
                }
            }
        });


        $('.user').click(function () {
            $(this).find('.pending').remove();
            receiver_id = $(this).attr('id');

            $.ajax({
                type: 'GET',
                url: 'message/' + receiver_id,
                data: "",
                cache: false,
                success: function (data) {

                    $('#messages').html(data);
                }
            });
        });



        $('.save_btn').on('click', function (e) {
            var business_name = $('#business_name').val();
            var business_email = $('#business_email').val();
            var business_phone = $('#business_phone').val();
            var business_web = $('#business_web').val();


            var form = $(this).parents('form');
            console.log(form);
            $(form).validate({
                rules: {
                    business_name: {
                        required: true,
                    },
                    business_email: {
                        required: true,
                        email: true,
                    },
                    business_phone: {
                        required: true,
                    },
                    business_web: {
                        required: true,
                    },
                },
                messages: {
                    business_name: "Business Name is required.",
                    business_phone: "Business Phone is required.",
                },

                submitHandler: function () {

                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: 'save_business',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {

                            console.log(data);
                            if (data.status) {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background', 'green');
                                $('#notifDiv').text(
                                    'Business listing created successfully');
                                setTimeout(() => {
                                    $('#notifDiv').fadeOut();
                                }, 3000);
                                $('[name="business_name"]').val('');
                                $('[name="business_email"]').val('');
                                $('[name="business_phone"]').val('');
                                $('[name="business_web"]').val('');
                            } else {
                                $('#notifDiv').fadeIn();
                                $('#notifDiv').css('background', 'red');
                                $('#notifDiv').text(
                                    'An error occured. Please try later');
                                setTimeout(() => {
                                    $('#notifDiv').fadeOut();
                                }, 3000);
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                }
            });
        });
    });

</script>
@endpush
