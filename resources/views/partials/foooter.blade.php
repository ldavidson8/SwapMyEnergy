<?php
    if (!isset($navbar_page)) $navbar_page = "";

    // TODO: make code use $mode instead of 'business'
    ?>

@section('stylesheets')
<style>
    @media (max-width: 991px)
    {
        .social-links-center-md
        {
            text-align: center;
        }
    }
</style>
@endsection
<footer>
    <div class="container-fluid flex-column d-flex">
        <div class="row flex-grow-1">
            <div class="col-12 col-lg-4 order-2 order-lg-1 mb-2 mb-lg-0">
                <div class="social-links-center-md container-fluid" style="border-bottom: solid 3px #f3f2f1; display:block;">
                    <a class="footer-social-link" href="https://www.facebook.com/Swap-My-Energy-101013942165296" rel="external">
                    <img class="footer-social-link-image" src="{{ asset('img/social-links/facebook.svg') }}" width="50" height="auto" alt="facebook logo"/>
                    </a>
                    <a class="footer-social-link" href="https://twitter.com/SwapMyEnergy" rel="external">
                    <img class="footer-social-link-image" src="{{ asset('img/social-links/twitter.svg') }}" width="50" height="auto" alt="twitter-logo"/>
                    </a>
                    <a class="footer-social-link" href="https://www.instagram.com/swapmyenergy/" rel="external">
                    <img class="footer-social-link-image" src="{{ asset('img/social-links/instagram.svg') }}" width="50" height="auto" alt="instagram logo"/>
                    </a>
                    <a class="footer-social-link" href="https://www.tiktok.com/@swapmyenergy" rel="external">
                    <img class="footer-social-link-image" src="{{ asset('img/social-links/tiktok.svg') }}" width="50" height="auto" alt="tiktok logo"/>
                    </a>
                    <a class="footer-social-link" href="https://www.linkedin.com/company/77837475/admin/" rel="external">
                    <img class="footer-social-link-image" src="{{ asset('img/social-links/linkedin.svg') }}" width="50" height="auto" alt="linked in logo"/>
                    </a>
                    <a class="footer-social-link" href="https://www.youtube.com/channel/UC7u_949FAQeV9FlZm4dH7lQ" rel="external">
                    <img class="footer-social-link-image" src="{{ asset('img/social-links/youtube.svg') }}" width="50" height="auto" alt="youtube logo"/>
                    </a>
                </div>
                <a href="https://www.znergi.co.uk/" target="_blank" rel="external">
                    <img class="default" src="{{ asset('img/Znergi_logo.png')}}" height="60px" width="auto" style="vertical-align:top; float: left; margin: 20px 30px 20px 0;">
                </a>
                <p style="text-align: left; display:inline-block;"> 2nd Floor Estate House, <br /> Fox Street, Preston, PR1 2AB <br /> 01772 584880 (Option 1) <br /> <a style="color: #f3f2f1; text-decoration: underline;" href="https://www.znergi.co.uk/" rel="external"> www.znergi.co.uk </a></p>
            </div>
            <div class="col-12 col-lg-4 order-1 order-lg-2 center-content">
                <table id="footer-links" class="mb-3 mb-lg-0">
                    <tbody>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "terms and conditions") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("business.t&c") }}">Terms & Conditions</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "partners and affiliates") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("business.partners and affiliates") }}">Partners & Affiliates</a></td>
                        </tr>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "privacy policy") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("business.privacy policy") }}">Privacy Policy</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "about") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("business.about") }}">About</a></td>
                            {{-- My Account Page
                                <td><a class="footer-link {{ ($navbar_page == "my account") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("business.my account") }}">My Account</a></td>
                            --}}
                        </tr>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "contact") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("business.contact") }}#contact">Contact Us</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "contact") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("business.contact") }}#support">Support</a></td>
                        </tr>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "cookie policy") ? 'navigation-link-footer-current-page' : '' }}" href="{{route('business.cookie policy')}}">Cookie policy</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "sitemap") ? 'navigation-link-footer-current-page' : '' }}" href="{{route('business.sitemap')}}">Sitemap</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 col-lg-4 order-3 order-lg-3 center-content">
                <div style="text-align: center; margin: auto; padding: 10px; font-size: 16px;">
                    <p> Swap My Energy is a trading name of Znergi Limited in England, Company Registration Number 12937329</p>
                    <p> Copyright &copy; 2021 Znergi Limited All rights reserved </p>
                    <div style="text-align: center; font-size: 14px;">
                        <p> Swap My Energy is an energy intermediary and not a supplier.    The UK trading name follows the Utilities Intermediaries Association code of conduct and Ofgem policies. All suppliers logos are trademarks of their respective owners. Percentage energy savings quoted are against customers who let their last contract renew automatically. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>