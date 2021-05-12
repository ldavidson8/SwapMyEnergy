@extends('layouts.master')

@section('before-header')
    <div id="section01" class="full-size container-fluid d-flex h-100 flex-column">
@endsection

@section('main-content')
        <hr/>
        <div class="row flex-grow-1 no-padding">
            <div class="col-xl-1 col-lg-1 col-md-2 d-none d-md-block"></div>
            <div class="col-xl-5 col-lg-6 col-md-8 col-12 left-column-content">
                <h1>Error 404</h1>
                @if ($exception -> getMessage() != '')
                    <h2>{{ $exception -> getMessage() }}</h2>
                @endif
            </div>
            <div class="col-xl-6 col-lg-5 col-md-2 d-none d-md-block">
                <a id="scroll-down-link" class="d-md-inline d-none" href="#HowItWorks"><span></span>How It Works</a>
            </div>
        </div>
    </div>
@endsection