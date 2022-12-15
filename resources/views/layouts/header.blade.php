<!DOCTYPE html>
<html dir="rtl" lang="ar">

<header>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupport">
                <ul class="navbar-nav ml-auto">

                    @if(Route::has('login'))
                        @auth
                        <li class="nav-item dropdown sell" >
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
                            </div>
                        </li>
                    @else

                        @endauth
                    @endif
                </ul>
            </div> <!-- .navbar-collapse -->
        </div> <!-- .container -->
    </nav>
</header>
<script src="{{asset('jquery/jquery.min.js')}}"></script>

<script src="{{asset('jquery/jquery.easing.min.js')}}"></script>

<script src="{{asset('jquery/bootstrap.bundle.min.js')}}"></script>

