var animationItems = $('.header-switch-animation-item');
var modeSwitchTags = $(".mode-switch");
var headerAnimationStarted = false;
modeSwitchTags.one("click", function (event) {
    if (!headerAnimationStarted) {
        for (var i = 0; i < animationItems.length; i++) {
            animationItems.addClass('animate');
        }

        setTimeout(function () {
            location.assign(modeSwitchTags[0].href);
        }, 1000);

        event.preventDefault();
    }
});

var chatbox = document.getElementById('fb-customer-chat');
chatbox.setAttribute("page_id", "101013942165296");
chatbox.setAttribute("attribution", "biz_inbox");
window.fbAsyncInit = function () {
    FB.init({
        xfbml: true,
        version: 'v11.0'
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/en_GB/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
