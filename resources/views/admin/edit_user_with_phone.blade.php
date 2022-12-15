<!DOCTYPE html>
<html dir="ltr" lang="ar">
<?php
$editSearch = false;
?>
@extends('layouts.main')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
@section('page-title')
    Edit User
    @endsection
@section('content')
    <div class="page-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <div class="card">
        <div class="card-header" style="text-align: center">
            Update User
        </div>
        <div class="card-body" style="text-align: right">
            @if(\Illuminate\Support\Facades\Session::has('success'))
               <div class="alert alert-success" style="text-align: left">
                   {{\Illuminate\Support\Facades\Session::get('success')}}
               </div>
            @elseif(\Illuminate\Support\Facades\Session::has('error'))
                <div class="alert alert-danger" style="text-align: left">
                    {{\Illuminate\Support\Facades\Session::get('error')}}
                </div>
            @endif
                <form method="POST" action="{{ route('update-user-with-phone',$user->id) }}">
                    @csrf

                    <div class="row mb-3">
                        <label style="text-align: center;" for="name" class="col-md-4 col-form-label text-md-end">{{ __('first name') }}</label>

                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{$user->first_name}}" required autocomplete="name" autofocus>

                            @error('first_name')
                            <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label style="text-align: center;" for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="name" autofocus>

                            @error('last_name')
                            <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label style="text-align: center;" for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="text"  class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" autocomplete="phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-0">
                        <div class="col-md-12" style="text-align: center;">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                            <a href="{{route("home")}}"  class="btn btn-danger">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </form>
        </div>
    </div>
                </div>
            </div>
        </div>
        </div>


    <script src="{{asset('jquery/bootstrap.bundle.min.js')}}"></script>

@endsection
</html>
