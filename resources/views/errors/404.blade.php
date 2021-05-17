<?php
    $page_title = 'Not Found';
?>
@extends('layouts.master')

@section('before-header')
    <div class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>404 - Not Found</h1>
                <br />
                <p><a href="{{ route("$mode.home") }}"><button class="big-blue-button">Home</button></a></p>
                @if ($exception -> getMessage() != '')
                    <h2>{{ $exception -> getMessage() }}</h2>
                @endif
            </div>
        </div>
    </div>
@endsection
