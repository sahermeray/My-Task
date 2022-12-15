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
    Add Product
@endsection
@section('content')
    <div class="page-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="text-align: center">
                            Add Product
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
                            <form method="POST" action="{{route('admin-add-product')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label style="text-align: center" for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required placeholder="Enter Product Name">
                                        @error('name')
                                        <span style="text-align: right" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label style="text-align: center" for="image" class="col-md-4 col-form-label text-md-end">{{ __('image') }}</label>
                                    <div class="col-md-6">
                                        <input id="image" type="file" class="form-control  @error('image') is-invalid @enderror" name="image" accept="image/*" value="{{old('image')}}" required>
                                        @error('image')
                                        <span style="text-align: right" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label style="text-align: center" for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description')}}</label>
                                    <div class="col-md-6">
                                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required></textarea>
                                        @error('description')
                                        <span style="text-align: right" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label style="text-align: center" for="description" class="col-md-4 col-form-label text-md-end">{{ __('select user')}}</label>
                                    <div class="col-md-6">
                        <select class="form-control @error('user_id') is-invalid @enderror"  aria-label="Default select example" id="user_id" name="user_id">
                            <option value="" selected>user</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name}}</option>
                            @endforeach
                        </select>

                                        @error('user_id')
                                        <span style="text-align: right" class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                    </div>
                </div>
                                <div class="row mb-0">
                                    <div class="col-md-12" style="text-align: center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Add') }}
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


    <script src="{{asset('jquery/bootstrap.bundle.min.js')}}"></script>


@endsection
</html>
