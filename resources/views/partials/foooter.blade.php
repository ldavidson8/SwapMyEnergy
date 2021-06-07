<?php
    if (!isset($navbar_page)) $navbar_page = "";
?>
<footer>
    <div class="container">
        <div style="text-align: center; font-weight: 700; font-size: 16px;">
        <p> Swap My Energy is part of the Znergi Limited Registered in England, Company Registration Number 12937329 </p>
        <p> Copyright &#169; 2021 Znergi Limited All rights reserved. Swap My Energy is an energy intermediary and not supplier. <br /> The UK trading name follows the Utilities Intermediaries Association code of conduct and Ofgem policies. </p>
        <p> All suppliers logos are trademarks of their respective owners. </p>
        <p> Percentage energy savings quoted are against customers who let their last contract renew automatically. </p>
        <a href="https://www.znergi.co.uk/"> www.znergi.co.uk </a>
        </div>
        <div style="text-align: center; margin: 20px;">
            <a href="https://www.znergi.co.uk/">
            <img class="default" src="{{ asset('img/Znergi_logoo.png')}}">
            </a>
        </div>
        <table id="footer-links">
            <tbody>
                <tr>
                    <td><a class="footer-link {{ ($navbar_page == "terms and conditions") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.t&c") }}">Terms & Conditions</a></td>
                    <td><a class="footer-link {{ ($navbar_page == "partners and affiliates") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.partners and affiliates") }}">Partners & Affiliates</a></td>
                </tr>
                <tr>
                    <td><a class="footer-link {{ ($navbar_page == "privacy policy") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.privacy policy") }}">Privacy Policy</a></td>
                    <td><a class="footer-link {{ ($navbar_page == "about") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.about") }}">About</a></td>
                    {{-- My Account Page
                        <td><a class="footer-link {{ ($navbar_page == "my account") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.my account") }}">My Account</a></td>
                    --}}
                </tr>
                <tr>
                    <td><a class="footer-link {{ ($navbar_page == "contact") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.contact") }}#contact">Contact Us</a></td>
                    <td><a class="footer-link {{ ($navbar_page == "contact") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.contact") }}#support">Support</a></td>
                </tr>
            </tbody>
        </table>
        <div style="text-align: center; margin: 10px;">
            <a class="footer-social-link" href="https://www.facebook.com/Swap-My-Energy-101013942165296">
            <img class="footer-social-link-image" src="{{ asset('img/social-links/facebook.svg') }}" width="50" height="auto" />
            </a>
            <a class="footer-social-link" href="https://twitter.com/SwapMyEnergy">
            <img class="footer-social-link-image" src="{{ asset('img/social-links/twitter.svg') }}" width="50" height="auto"/>
            </a>
            <a class="footer-social-link" href="https://www.instagram.com/swapmyenergy/">
            <img class="footer-social-link-image" src="{{ asset('img/social-links/instagram.svg') }}" width="50" height="auto"/>
            </a>
            <a class="footer-social-link" href="https://www.tiktok.com/@swapmyenergy">
            <img class="footer-social-link-image" src="{{ asset('img/social-links/tiktok.svg') }}" width="50" height="auto"/>
            </a>
            <a class="footer-social-link" href="https://www.linkedin.com/company/77837475/admin/">
            <img class="footer-social-link-image" src="{{ asset('img/social-links/linkedin.svg') }}" width="50" height="auto"/>
            </a>
            <a class="footer-social-link" href="https://www.youtube.com/channel/UC7u_949FAQeV9FlZm4dH7lQ">
            <img class="footer-social-link-image" src="{{ asset('img/social-links/youtube.svg') }}" width="50" height="auto"/>
            </a>
        </div>

    </div>
</footer>
