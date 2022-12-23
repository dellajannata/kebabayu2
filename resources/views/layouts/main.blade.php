<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Kebab Ayu</title>
    <link rel="styleshee" href="{{ asset('https://fonts.googleapis.com/css?family=Open+Sans:400')}}" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/templatemo-style.css')}}" />
    <!-- Favicons -->
    
</head>

<!-- header -->
@include('layouts.header')
@yield('layouts.content')
<!-- end header -->

<!--  footer -->
@include('layouts.footer')
<!-- end footer -->

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/parallax.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Handle click on paging links
        $('.tm-paging-link').click(function(e) {
            e.preventDefault();

            var page = $(this).text().toLowerCase();
            $('.tm-gallery-page').addClass('hidden');
            $('#tm-gallery-page-' + page).removeClass('hidden');
            $('.tm-paging-link').removeClass('active');
            $(this).addClass("active");
        });
    });
</script>
</body>

</html>
