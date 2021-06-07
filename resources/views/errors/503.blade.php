<?php
    $page_title = 'Service Unavailable';
?>
@extends('layouts.master')

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column" style="background-color: #f0f0f0">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content" style="background-image: url(); background-position: left; background: #f0f0f0;">
                <h1 style="font-weight: bold; font-size: 40px; color: #000;  text-align: center; letter-spacing: -3px;"><span style="letter-spacing: 3px; font-size: 90px; color: #00C2CB;">503</span><br />This Service Is Unavailable</h1>
                <br /><br /><br />
                <p style="color: #000; text-align: center; font-size: 18px; letter-spacing: 1px;">The server is  <span style="color: #00C2CB;">temporarily unable to <br /> handle your request,</span>  Please try again later<p> 
                <br />
                <br />
                <div style="display: flex; justify-content: center; align-items: center;">
                    <p><a href="{{ url() -> previous()}}" onclick="history.back()"><button class="big-blue-button" style="width: 300px; font-size: 23px;">Go Back</button></a></p>
                    @if ($exception -> getMessage() != '')
                    <h2>{{ $exception -> getMessage() }}</h2>
                    @endif
                </div>
                <br />
                <br />
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block" style="background-image: url(https://i.postimg.cc/x1ccTXY6/503.png); background-repeat: no-repeat; background-position: center; background-size: 650px; opacity: 0.8;"></div>
        </div>
    <style>
    button:hover{
        color: #ffca79;
        background-size:
    }
    </style>
@endsection

@section('after-footer')
    </div>
@endsection