<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="copyright" content="MACode ID, https://macodeid.com/">

    <title>@yield('page-title')</title>

    <link rel="stylesheet" href="/../assets/css/maicons.css">

    <link rel="stylesheet" href="/../assets/css/bootstrap.css">

    <link rel="stylesheet" href="/../assets/vendor/owl-carousel/css/owl.carousel.css">

    <link rel="stylesheet" href="/../assets/vendor/animate/animate.css">

    <link rel="stylesheet" href="/../assets/css/theme.css">

    <script src="{{ asset('/js/app.js') }}" defer></script>
</head>

<body>


@yield('content')

@include('layouts.footer')



<script src="/../assets/js/bootstrap.bundle.min.js"></script>

<script src="/../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="/../assets/vendor/wow/wow.min.js"></script>

<script src="/../assets/js/theme.js"></script>


</body>
</html>
