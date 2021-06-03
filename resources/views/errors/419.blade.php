<?php
    $page_title = 'Page Expired';
?>
@extends('layouts.master')

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column" style="background-image: linear-gradient(#f0f0f0, #00C2CB, #fdae36);">
@endsection

@section('main-content')
        <hr/>
        <div>
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content" style="background-image: url(); background-position: left; background: #f0f0f0;">
                <h1 style="font-weight: bold; font-size: 40px; color: #000; text-align: center; letter-spacing: -3px;"><span style="letter-spacing: 3px; font-size: 90px;color: #00C2CB;">419</span><br />Your Session Has Expired</h1>
                <br />
                <br />
                <p style="color: #000; text-align: center; font-size: 18px;letter-spacing: 1px;">CSRF token <span style=" color: #00C2CB;">missing or expired</span><br />Please refresh the page and try again<p>
                <br />
                <br />
                <div style="display: flex; justify-content: center; align-items: center;">
                   <p><a href="{{ route("$mode.home") }}"><button class="big-blue-button" style="width: 300px; font-size: 23px;">Home</button></a></p>
                   @if ($exception -> getMessage() != '')
                   <h2>{{ $exception -> getMessage() }}</h2>
                   @endif
                </div>
                <br />
                <br />
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block" style="background-image: url(https://i.postimg.cc/D00Pxq6F/419.png); background-repeat: no-repeat; background-position: center;"></div>
        </div>
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