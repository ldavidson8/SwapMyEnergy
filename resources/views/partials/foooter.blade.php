<?php
    if (!isset($navbar_page)) $navbar_page = "";
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
                    <a class="footer-social-link" href="https://www.facebook.com/swapmyenergyuk" rel="external">
                    <img alt="facebook logo" class="footer-social-link-image lazy" data-src="{{ asset('img/social-links/facebook.svg') }}" width="50" height="auto"/>
                    </a>
                    <a class="footer-social-link" href="https://twitter.com/swapmyenergyuk" rel="external">
                    <img alt="twitter-logo" class="footer-social-link-image lazy" data-src="{{ asset('img/social-links/twitter.svg') }}" width="50" height="auto"/>
                    </a>
                    <a class="footer-social-link" href="https://www.instagram.com/swapmyenergyuk" rel="external">
                    <img alt="instagram logo" class="footer-social-link-image lazy" data-src="{{ asset('img/social-links/instagram.svg') }}" width="50" height="auto"/>
                    </a>
                    <a class="footer-social-link" href="https://www.tiktok.com/@swapmyenergyuk" rel="external">
                    <img alt="tiktok logo" class="footer-social-link-image lazy" data-src="{{ asset('img/social-links/tiktok.svg') }}" width="50" height="auto" />
                    </a>
                    <a class="footer-social-link" href="https://www.linkedin.com/company/swapmyenergyuk/" rel="external">
                    <img alt="linked in logo" class="footer-social-link-image lazy" data-src="{{ asset('img/social-links/linkedin.svg') }}" width="50" height="auto" />
                    </a>
                    <a class="footer-social-link" href="https://www.youtube.com/channel/UC7u_949FAQeV9FlZm4dH7lQ" rel="external">
                    <img alt="youtube logo" class="footer-social-link-image lazy" data-src="{{ asset('img/social-links/youtube.svg') }}" width="50" height="auto" />
                    </a>
                </div>
                <a href="https://www.znergi.co.uk/" rel="external">
                    <img alt="Our company, Znergi's logo" class="default" src="{{ asset('img/Znergi_logo.png')}}" height="60px" width="auto" style="vertical-align:top; float: left; margin: 20px 30px 20px 0;">
                </a>
                <p style="text-align: left; display:inline-block;"> 2nd Floor Estate House, <br /> Fox Street, Preston, PR1 2AB <br /> 01772 584880 (Option 1) <br /> <a style="color: #f3f2f1; text-decoration: underline;" href="https://www.znergi.co.uk/" rel="external"> www.znergi.co.uk </a></p>
            </div>
            <div class="col-12 col-lg-4 order-1 order-lg-2 center-content">
                <table id="footer-links" class="mb-3 mb-lg-0">
                    <tbody>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "terms and conditions") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.t&c") }}">Terms & Conditions</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "partners and affiliates") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.partners and affiliates") }}">Partners & Affiliates</a></td>
                        </tr>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "privacy policy") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.privacy policy") }}">Privacy Policy</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "contact") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.contact") }}#contact">Contact Us</a></td>
                            {{-- My Account Page
                                <td><a class="footer-link {{ ($navbar_page == "my account") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.my account") }}">My Account</a></td>
                            --}}
                        </tr>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "cookie policy") ? 'navigation-link-footer-current-page' : '' }}" href="{{route("$mode.cookie policy")}}">Cookie policy</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "contact") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.contact") }}#support">Support</a></td>
                        </tr>
                        <tr>
                            <td><a class="footer-link {{ ($navbar_page == "sitemap") ? 'navigation-link-footer-current-page' : '' }}" href="{{route("$mode.sitemap")}}">Sitemap</a></td>
                            <td><a class="footer-link {{ ($navbar_page == "about") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.about") }}">About</a></td>
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