var animationItems = $('.header-switch-animation-item');
var modeSwitchTags = $(".mode-switch");
var headerAnimationStarted = false;
modeSwitchTags.one("click", function(event)
{
    if (!headerAnimationStarted)
    {
        for (var i = 0; i < animationItems.length; i++)
        {
            animationItems.addClass('animate');
        }
    
        setTimeout(function()
        {
            location.assign(modeSwitchTags[0].href);
        }, 1000);

        event.preventDefault();
    }
});