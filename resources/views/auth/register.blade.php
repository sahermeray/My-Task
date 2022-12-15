<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
?>
@extends('layouts.main')
@section('page-title')
    Register
@endsection
@section('content')
    <div class="page-section bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label style="text-align: center;" for="name" class="col-md-4 col-form-label text-md-end">{{ __('first name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

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
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label style="text-align: center;" for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="phone">

                                @error('email')
                                <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label style="text-align: center;" for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label style="text-align: center;" for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a href="/"  class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12 mt-2" style="text-align: center;">
                        <a class="btn btn-link" style="text-align: center" href="{{ route('get-register-with-phone-form') }}">
                            {{ __('register with mobile?') }}
                        </a>
                    </div>
                       <div class="col-md-12" style="text-align: center;">
                                <a class="btn btn-link" style="text-align: center" href="{{ route('login') }}">
                                    {{ __('already have account?') }}
                                </a>
                        </div>
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