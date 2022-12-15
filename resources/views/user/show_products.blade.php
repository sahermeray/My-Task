<!DOCTYPE html>
<html dir="ltr" lang="ar">
<?php
$editSearch = false;
?>
<style>
    .pag {
        height: 20px;
        margin-top: 20px;
        margin-left: 3.7%;
        padding-bottom: 10px;
    }
    .pag p{
        display: none;
    }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .pag{
            margin-left: 32.5%;
        }
    }
    @media only screen and (min-width: 540px) and (max-width: 767px) {
        .pag{
            margin-left: 27%;
        }
    }
    @media only screen and (min-width: 500px) and (max-width: 539px) {
        .pag{
            margin-left: 25%;
        }
    }
    @media only screen and (min-width: 460px) and (max-width: 499px) {
        .pag{
            margin-left: 23%;
        }
    }

    @media only screen and (min-width: 400px) and (max-width: 459px) {
        .pag{
            margin-left: 19%;
            height: 5px;

        }
    }
    @media only screen and (min-width: 325px) and (max-width: 355px) {
        .pag{
            margin-left: 13%;
            height: 2px;
            padding-bottom: 2px;
        }
    }
    @media only screen and (min-width: 356px) and (max-width: 399px) {
        .pag{
            margin-left: 16%;
            height: 3px;
        }
    }
    @media only screen and (min-width: 316px) and (max-width: 324px) {
        .pag{
            margin-left: 8%;
            height: 2px;
            padding-bottom: 2px;
        }
    }
    @media only screen and (min-width: 250px) and (max-width: 315px) {
        .pag{
            margin-left: 6%;
            height: 2px;
            padding-bottom: 2px;
        }
    }
    @media only screen and (min-width: 992px) and (max-width: 1199px) {
        .pag{
            margin-left: 1.5%;
        }
    }
</style>
@extends('layouts.main')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
@section('page-title')
    My Products
@endsection
@section('content')
    <div class="page-section bg-light" style="min-height: 400px;">
        <div class="container">

            <div class="card">
                <div class="card-header" style="text-align: left;">
                    <div class="row" style="text-align: center">
                        <div class="col">
My Products
                        </div>
                        <a class="btn btn-danger float-right" style="-moz-margin-end: 2%" href="{{route("home")}}">cancel</a>
                    </div>
                </div>
                <div class="card-body" style="text-align: right">
                    @if(\Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success" style="text-align: right">
                            {{\Illuminate\Support\Facades\Session::get('success')}}
                        </div>
                    @elseif(\Illuminate\Support\Facades\Session::has('error'))
                        <div class="alert alert-danger" style="text-align: right">
                            {{\Illuminate\Support\Facades\Session::get('error')}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td><img src="{{asset("products-image/".$product->image)}}" style="height:60px;width: 60px"></td>
                                    <td>{{$product->description}}</td>
                                    <td>
                                        <a href="" class="btn btn-warning">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="pag" style="text-align: right;">
                {{$products->links()}}
            </div>
        </div>
    </div>
@endsection
</html>
