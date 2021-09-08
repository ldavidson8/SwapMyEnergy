<?php
    if (!isset($page_title)) $page_title = 'Unauthorized';
?>
@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" href="{{ asset('css/errors.css') }}" />
@endsection

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column" style="background-image: linear-gradient(#f0f0f0, #f0f0f0, #f0f0f0, #00C2CB, #00C2CB, #00C2CB);">
@endsection

@section('main-content')
        <hr/>
        <div class="flex-grow-1 row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12" style="background-image: linear-gradient(#fdae36, #f0f0f0, #f0f0f0, #f0f0f0, #f0f0f0);">
                <table class="table-center-contents">
                    <tr>
                        <td>
                            <h1 style="font-weight: bold; font-size: 40px; color: #000; text-align: center; letter-spacing: -3px;"><span style="letter-spacing: 3px; font-size: 100px; color: #000;">401</span><br />Your Access Has Been Denied</h1>
                            <br />
                            <div style="color: #000; text-align: center; font-size: 18px; letter-spacing: 1px;">
                                <p>Your <span style=" color: #00C2CB;"> authorization failed </span><br />Please fill in the correct credentials and try again</p>
                                <br /><br />

                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <p><a href="{{ url() -> previous()}}" onclick="history.back()"><button class="big-blue-button" style="width: 300px; font-size: 23px;">Go Back</button></a></p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 background-image-display-none" style="background-image: url('{{ asset('img/error pages/401.png') }}'); background-repeat: no-repeat; background-position: center; background-size: contain; background-origin: content-box; padding: 50px; opacity: 0.8;"></div>
        </div>
    </div>
@endsection

@section('after-footer')
@endsection
