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

    <style>
        .sea{
            padding-left: 150px;
            padding-right: 50px;
        }
        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .sea{
                padding-left: 40px;
                padding-right: 40px;
            }
        }
        @media only screen and (max-width: 991px) {
            .sea{
                padding-left: 0px;
                padding-right: 0px;
            }
        }
        @media only screen and (max-width: 482px) {
            .sea{
                padding-left: 0px;
                padding-right: 0px;
                padding-bottom: 5px;
            }
        }
        .sell{
            padding-right: 250px;
        }
        @media only screen and (max-width: 991px) {
            .sell{
                text-align: right;
                padding-right: 0px;
            }
        }
        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .sell{
                text-align: right;
                padding-right: 200px;
            }
        }
    </style>
</head>
<header>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/"><span><img src="{{asset('../assets/img/atfakna.jpg')}}" alt="" style="height: 50px;width: 50px;border-radius: 100px"></span></a>


            <form action="{{ route('find-products')}}" class="sea">
                <div class="input-group input-navbar" style="max-width: 395px;@if($editSearch == true)padding-top:15px;@endif">
                    <div class="input-group-prepend" style="width: 10%">
                        <button style="border: none;width: 100%;" type="submit"><span style="color:#4E5AFE;" class="mai-search"></span></button>
                    </div>
                    <select style="width: 27%" class="form-control" aria-label="Default select example" id="search_city_id" name="search_city_id">
                        <option value="" selected>المدينة</option>
                        @foreach($searchCities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    <select style="width:23%" class="form-control" aria-label="Default select example" id="search_category_id" name="search_category_id">
                        <option value="" selected>القسم</option>
                        @foreach($searchCategories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <select style="width: 40%" class="form-control" aria-label="Default select example" id="search_subcategory_id" name="search_subcategory_id">
                        <option value="" selected>القسم الفرعي</option>
                    </select>
                </div>
            </form>


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupport">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item active sell">
                        <a style="color:#4E5AFE; " class="nav-link sell" href="{{route('messages')}}">الرسائل</a>
                    </li>
                    @if(Route::has('login'))
                        @auth
                        <li class="nav-item dropdown" style="">
                            <a style="text-align: right;" id="navbarDropdown" class="nav-link dropdown-toggle sell" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a style="text-align: right;" class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('خروج') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a style="text-align: right;" class="dropdown-item" href="{{ route('get-products') }}">
                                    {{ __('منتجاتي') }}
                                </a>

                                <a style="text-align: right;" class="dropdown-item" href="{{ route('add-product')}}">
                                    {{ __('اضافة منتج') }}
                                </a>
                                <a style="text-align: right;" class="dropdown-item" href="{{ route('messages')}}">
                                    الرسائل @include('unread-count')
                                </a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-secondary ml-lg-3" href="{{ route('login') }}">تسجيل دخول</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary ml-lg-3" href="{{ route('register') }}">اشتراك</a>
                        </li>
                        @endauth
                    @endif
                </ul>
            </div> <!-- .navbar-collapse -->
        </div> <!-- .container -->
    </nav>
</header>
<body>
<div class="page-section bg-light" style="min-height: 400px">
<div class="container">
    @yield('content')
</div>
</div>
@include('layouts.footer')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="/../assets/js/jquery-3.5.1.min.js"></script>

<script src="/../assets/js/bootstrap.bundle.min.js"></script>

<script src="/../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="/../assets/vendor/wow/wow.min.js"></script>

<script src="/../assets/js/theme.js"></script>
</body>


</html>