<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
$showSearch = true;
$editSearch = false;
?>
@extends('layouts.main')
@section('page-title')
@section('content')
    <div class="page-section bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;">{{ __('change password') }}</div>


                <div class="card-body" style="text-align: left">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success" style="text-align: right">
                            {{\Illuminate\Support\Facades\Session::get('success')}}
                        </div>
                    @elseif(\Illuminate\Support\Facades\Session::has('error'))
                        <div class="alert alert-danger" style="text-align: left">
                            {{\Illuminate\Support\Facades\Session::get('error')}}
                        </div>
                    @endif
                    <form method="POST" action="{{route('change-password',\Illuminate\Support\Facades\Auth::id())}}">
                        @csrf

                        <div class="row mb-3">
                            <label style="text-align: center;" for="old_password" class="col-md-4 col-form-label text-md-end">{{ __('old password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required>

                                @error('old_password')
                                <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label style="text-align: center;" for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label style="text-align: center;" for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('confirm password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12" style="text-align: center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('change') }}
                                </button>
                                <a href="{{route('home')}}"  class="btn btn-danger">
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
@endsection
</html>