<!DOCTYPE html>
<html dir="ltr" lang="ar">
<?php
$editSearch = false;
?>
@extends('layouts.main')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
@section('content')
    <div class="page-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="text-align: center">
                           My Profile
                        </div>
                        <div class="card-body" style="text-align: left">

                                <div class="row mb-3">
                                    <label style="text-align: center;" for="name" class="col-md-4 col-form-label text-md-end">{{ __('first name') }}</label>
                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="name" autofocus>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label style="text-align: center;" for="name" class="col-md-4 col-form-label text-md-end">{{ __('last name') }}</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="name" autofocus>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label style="text-align: center;" for="email" class="col-md-4 col-form-label text-md-end">{{ __('email') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="phone">
                                    </div>
                                </div>
                            <div class="row mb-3">
                                <label style="text-align: center;" for="email" class="col-md-4 col-form-label text-md-end">{{ __('phone') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"  class="form-control @error('email') is-invalid @enderror" name="phone" value="{{ $user->phone}}" required autocomplete="phone">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('jquery/bootstrap.bundle.min.js')}}"></script>

@endsection
</html>
