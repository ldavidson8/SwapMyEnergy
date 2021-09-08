<?php
    if (!isset($page_title)) $page_title = 'Service Unavailable';
?>
@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/errors.css') }}" />
@endsection

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column" style="background-color: #f0f0f0">
@endsection

@section('main-content')
        <hr/>
        <div class="flex-grow-1 row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12" style="background: #f0f0f0; background-position: left;">
                <table class="table-center-contents">
                    <tr>
                        <td>
                            <h1 class="numbers" style="color: #000;">
                                <?= 5?>@include('errors.partials.random_doughnut')3
                            </h1>
                                
                            <h1 class="error-title" style="color: #000;"> This Service Is Unavailable
                            </h1>

                            <br />

                            <div class="error-text" style="color: #000;">
                                <p>The server is  <span style="color: #00C2CB;">temporarily unable to <br /> handle your request,</span>  Please try again later.</p>

                                <br />

                                <p>You can contact us using the details below.</p>

                                <p>
                                    Telephone: {{ env('DATA_CONTACT_PHONE_NUMBER') }}<br />
                                    Email: {{ env('DATA_CONTACT_EMAIL') }}
                                </p>

                                <br />

                                <div class="error-button">
                                    <p><a href="{{ url() -> previous()}}" onclick="history.back()"><button class="big-blue-button" style="width: 300px; font-size: 23px;">Go Back</button></a></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 background-image-display-none" style="background-image: url('{{ asset('img/error pages/503.png') }}'); background-repeat: no-repeat; background-position: center; background-size: contain; background-origin: content-box; padding: 50px; opacity: 0.8;"></div>
        </div>
    </div>
@endsection

@section('after-footer')
@endsection
