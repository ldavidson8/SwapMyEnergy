@extends('layouts.master')

@section('stylesheets')
<style>
ul{
    list-style: none;
}
</style>
@endsection

@section('main-content')
    <main class="col-md-12">
        <div class="container">
            <div class="title">
                <br />
                <h1> SwapMyEnergy.co.uk Sitemap </h1>
                <br />
                <div>
                    <p>Swap My Energy is a free, independent and totally impartial online service that aims to bring you great deals for your gas, electricity and energy supplies, whatever your circumstances or preferences. We do this by allowing you to compare deals from all energy suppliers on one single site. Our aim is to help all UK consumers get the great savings on their energy bills, quickly, easily and securely.</p>
                    <br />
                </div>
            </div>
            <section>
                <div class="">
                    <p class="font-weight-bold">SwapMyEnergy information</p>
                    <ul>
                        <li>
                            <p><a href="/about">About Us</a></p>
                            <p><a href="/partners-and-affiliates">Our Affiliate Program</a></p>
                            <p><a href="/contact#contact">Contact Us</a></p>
                            <p><a href="/terms-and-conditions">Terms and Conditions</a></p>
                            <p><a href="/privacy-policy">Privacy Policy</a></p>
                            <p><a href="#">Our Cookie policy</a></p>
                        </li>
                    </ul>
                </div>
                <div class="">
                    <p class="font-weight-bold">Our Energy Suppliers</p>
                    <ul>
                        <li>
                            <p><a href="https://www.avantigas.com/" target="_blank">Avanti Gas Ltd</a></p>
                            <p><a href="https://www.bristol-energy.co.uk/" target="_blank">Bristol Energy</a></p>
                            <p><a href="https://www.britishgas.co.uk/" target="_blank">British Gas</a></p>
                            <p><a href="https://www.crowngas.co.uk/" target="_blank">Crown Gas & Power</a></p>
                            <p><a href="https://www.eonenergy.com/" target="_blank">E.ON</a></p>
                            <p><a href="https://www.opusenergy.com/" target="_blank">Opus Energy</a></p>
                            <p><a href="https://www.ovoenergy.com/" target="_blank">OVO Energy</a></p>
                            <p><a href="https://www.scottishpower.co.uk/" target="_blank">Scottish Power</a></p> 
                            <p><a href="https://sse.co.uk/home" target="_blank">SSE</a></p>
                            <p><a href="https://utilita.co.uk/" target="_blank">Utilita Energy</a></p>
                        </li>
                    </ul>
                    <br />
                </div>
            </section>
        </div>
    </main>                
@endsection()