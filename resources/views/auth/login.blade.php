<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
?>
@extends('layouts.main')
@section('page-title')
    Login
@endsection
@section('content')
    <div class="page-section bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: center;">{{ __('Login') }}</div>


                <div class="card-body">
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <div style="text-align: right">
                        <strong>{{\Illuminate\Support\Facades\Session::get('error')}}</strong>
                        </div>
                    @endif
                    <form method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label style="text-align: center;" for="email" class="col-md-4 col-form-label text-md-end">{{ __('Phone or Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert" style="text-align: right">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-12" style="text-align: center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <a href="/"  class="btn btn-danger">
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