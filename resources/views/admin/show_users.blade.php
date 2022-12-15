<!DOCTYPE html>
<html dir="ltr" lang="en">
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
    All Users
@endsection
@section('content')
    <div class="page-section bg-light" style="min-height: 400px;">
        <div class="container">

    <div class="card">
        <div class="card-header" style="text-align: left;">
            <div class="row" style="text-align: center">
                <div class="col">
                    All Users
                </div>
                <a class="btn btn-danger float-right" style="-moz-margin-end: 2%" href="{{route("home")}}">Cancel</a>
            </div>
        </div>
<div class="card-body" style="text-align: left">
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success" style="text-align: left">
            {{\Illuminate\Support\Facades\Session::get('success')}}
        </div>
    @elseif(\Illuminate\Support\Facades\Session::has('error'))
        <div class="alert alert-danger" style="text-align: left">
            {{\Illuminate\Support\Facades\Session::get('error')}}
        </div>
    @endif
    <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Nmae</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            <a href="{{route('edit-user',$user->id)}}" class="btn btn-warning">Edit</a>
                            <a href="{{route('delete-user',$user->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>

</div>
    </div>
            <div class="pag" style="text-align: right;">
                {{$users->links()}}
            </div>
</div>
    </div>
@endsection
</html>
