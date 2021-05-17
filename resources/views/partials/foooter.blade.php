<?php
    if (!isset($navbar_page)) $navbar_page = "";
?>
<footer>
    <div class="container">
        <table id="footer-links">
            <tbody>
                <tr>
                    <td><a class="footer-link {{ ($navbar_page == "terms and conditions") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.t&c") }}">Terms & Conditions</a></td>
                    <td><a class="footer-link {{ ($navbar_page == "partners and affiliates") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.partners and affiliates") }}">Partners & Affiliates</a></td>
                </tr>
                <tr>
                    <td><a class="footer-link {{ ($navbar_page == "privacy policy") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.privacy policy") }}">Privacy Policy</a></td>
                    <td><a class="footer-link {{ ($navbar_page == "my account") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.my account") }}">My Account</a></td>
                </tr>
                <tr>
                    <td><a class="footer-link {{ ($navbar_page == "support") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.support") }}#contact">Contact Us</a></td>
                    <td><a class="footer-link {{ ($navbar_page == "support") ? 'navigation-link-footer-current-page' : '' }}" href="{{ route("$mode.support") }}#support">Support</a></td>
                </tr>
            </tbody>
        </table>
        
        <!-- 6 social links -->
    </div>
</footer>
