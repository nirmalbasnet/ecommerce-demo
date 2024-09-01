<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
    <title>@yield('title') | {{\App\Helpers\Constants::PROJECT_NAME}}</title>
    @yield('metaog')
    @include('frontend.include.style')
    <style>
        .ajs-header{
            display: none !important;
        }

        span.help-block{
            font-weight: 600;
            color: maroon;
        }

        div.responseMessage{
            display: flex;
            justify-content: space-between;
            min-height: 50px;
            margin-top: 15px;
        }

        i.closeResponseMessage{
            cursor: pointer;
        }
    </style>
    @yield('styles')
</head>
<body>
<section>
    @include('frontend.include.header')
    <div class="dynamic-part">
        @yield('main-section')
    </div>
    @include('frontend.include.footer')
</section>
@include('frontend.include.script')
<script>
    var baseurl = "<?php echo \Illuminate\Support\Facades\URL::to('/') ?>";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $('.closeResponseMessage').on('click', function () {
        $('.responseMessage').remove();
    });

    $('#newsletterForm').on('submit', function (e) {
        e.preventDefault();
        $('#newsletterForm input[type=submit]').prop('disabled', true);
        $('form#newsletterForm i.fa-spinner').show();
        var email = $('#newsletterForm input.newsletter-subscriber-email').val();
       $.ajax({
          url: baseurl+'/subscribe-newsletter?email='+email,
           type: 'get',
           success: function (data) {
               if(data.status === 'validation-error')
               {
                   alertify.alert(data.message);
               }else if(data.status === 'success')
               {
                   if(data.message === 'true')
                   {
                       $('#myModal p.ajax-text').hide();
                       $('#myModal p.auto-text').show();
                       $('#myModal').modal('show');
                   }else{
                       $('#myModal p.ajax-text').html(data.message).show();
                       $('#myModal p.auto-text').hide();
                       $('#myModal').modal('show');
                   }
               }else{
                   alertify.alert('Oops ! something went wrong. Please try later.');
               }
               $('#newsletterForm input[type=submit]').prop('disabled', false);
               $('form#newsletterForm i.fa-spinner').hide();
           }, error: function (data) {
               alertify.alert('Oops ! something went wrong. Please try later.');
               $('#newsletterForm input[type=submit]').prop('disabled', false);
               $('form#newsletterForm i.fa-spinner').hide();
           }
       });
    });

    @if(\Illuminate\Support\Facades\Session::has('alert-message'))
    $('#myModal p.ajax-text').html("{{\Illuminate\Support\Facades\Session::get('alert-message')}}").show();
    $('#myModal p.auto-text').hide();
    $('#myModal').modal('show');
    @endif
</script>
@yield('scripts')
</body>
</html>
