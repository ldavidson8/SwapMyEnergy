@extends('layouts.master')

@section('stylesheets')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nothing+You+Could+Do&display=swap" rel="stylesheet">

    <style>

        .card-wrapper
        {
            text-align: center;

        }

        .card
        {
            background-color: transparent;
            border: none;
            width: 100%;
            height: 100%;
        }

        h3
        {
            font-family: 'Nothing You Could Do', cursive;
            font-weight: 700;
        }

        h4
        {
            font-family: 'Nothing You Could Do', cursive;
            font-weight: 400;
        }



    </style>
@endsection
@section('before.header')

@endsection

@section('main-content')
<div class="wrapper">
    <div class="team-header">
        <h1 style="font-family: Nothing You Could Do; "> Our Team </h1>
    </div>
    <div class="team-wrapper row center-content">
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Andrew Jaeger</h3>
                <h4>Business Development Manager</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Sami Sattar</h3>
                <h4>Business Development Manager</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Karol Szaro</h3>
                <h4>Business Development Manager</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Tamara De Lima</h3>
                <h4>Business Development Manager</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Matt Ainsworth</h3>
                <h4>Business Development Manager</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Shaquille Gregory</h3>
                <h4>Business Development Manager</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Johnathan Finn</h3>
                <h4>Customer Sales Advisor</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Maggie Gavin</h3>
                <h4>Customer Sales Advisor</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Jack Moore</h3>
                <h4>Customer Sales Advisor</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Michael Ranstead</h3>
                <h4>Data Officer</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Olly Potter</h3>
                <h4>Administrator</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Lewis Davidson</h3>
                <h4>Developer</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Mark Graham</h3>
                <h4>Developer</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Cryshae Tucker</h3>
                <h4>Developer</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Alex Burton</h3>
                <h4>Digital Marketer</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Robbi Graham</h3>
                <h4>Digital Marketer</h4>
            </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-12 card-wrapper">
            <div class="card">
                <h3>Sam Coltman</h3>
                <h4>Social Media Analyst</h4>
            </div>
        </div>
    </div>
</div>

@endsection