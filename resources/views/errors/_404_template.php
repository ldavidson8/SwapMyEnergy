<?php
    $page_title = 'Not Found';
?>
@extends('layouts.master')

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column" style="background-image: linear-gradient(#f0f0f0 10%, #00C2CB, #00C2CB);">
@endsection

@section('main-content')
        <hr/>
        <div>
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content" style="background-image: linear-gradient(#4f4f4f, #1a1816, #1a1816, #1a1816, #4f4f4f, #5c5c5c); background-position: left; background; #454545;">
            <h1 style="font-weight: bold; font-size: 40px; color: #f0f0f0; text-align: center; letter-spacing: -3px;"><span style="letter-spacing: 3px;font-size: 100px; color: #00C2CB;">404</span><br /> Uh-oh! Looks Like The Lights Went Out</h1>
                <br />
                <p style="color: #f0f0f0; font-size: 18px; text-align: center; letter-spacing: 1px;">~There's nothing to see here~<br />This page does not or no longer exists<p> 
                <br />
                <br />
                <div style="display: flex; justify-content: center; align-items: center;">
                   <p><a href="{{ route("$mode.home") }}"><button class="big-blue-button" style="width: 300px; font-size: 23px;">Turn on the lights</button></a></p>
                   @if ($exception -> getMessage() != '')
                   <h2>{{ $exception -> getMessage() }}</h2>
                   @endif
                </div>
                <br />
                <br />
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block" style="background-image: url(https://media.istockphoto.com/vectors/broken-light-bulb-vector-flat-icon-vector-id664676934?k=6&m=664676934&s=612x612&w=0&h=w7hEuWvC_c2tFvrndQtf9a-fGnV_iSksuzIX3O0K5cI=); background-repeat: no-repeat; background-position: center; background-size: center;"></div>
        </div>
    </div>
    <style>
    button:hover{
        color: #ffca79;  
    }
    </style>
@endsection