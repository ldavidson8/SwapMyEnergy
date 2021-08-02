document.addEventListener("DOMContentLoaded", function()
{
    var lazyloadImages;

    if ("IntersectionObserver" in window)
    {
        lazyloadImages = document.querySelectorAll(".lazy");
        var imageObserver = new IntersectionObserver(function(entries, observer)
        {
            for (var i = 0; i < entries.length; i++)
            {
                var entry = entries[i];
                if (entry.isIntersecting)
                {
                    var image = entry.target;
                    image.src = image.dataset.src;
                    image.classList.remove("lazy");
                    imageObserver.unobserve(image);
                }
            }
        });

        for (var i = 0; i < lazyloadImages.length; i++)
        {
            var image = lazyloadImages[i];
            imageObserver.observe(image);
        }
    }
    else
    {
        var lazyloadThrottleTimeout;
        lazyloadImages = document.querySelectorAll(".lazy");

        function lazyload ()
        {
            if (lazyloadThrottleTimeout)
            {
                clearTimeout(lazyloadThrottleTimeout);
            }

            lazyloadThrottleTimeout = setTimeout(function()
            {
                var scrollTop = window.pageYOffset;

                for (var i = 0; i < lazyloadImages.length; i++)
                {
                    var img = lazyloadImages[i];
                    if (img.offsetTop < (window.innerHeight + scrollTop))
                    {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                    }
                }

                if (lazyloadImages.length == 0)
                {
                    document.removeEventListener("scroll", lazyload);
                    window.removeEventListener("resize", lazyload);
                    window.removeEventListener("orientationChange", lazyload);
                }
            }, 20);
        }

        document.addEventListener("scroll", lazyload);
        window.addEventListener("resize", lazyload);
        window.addEventListener("orientationChange", lazyload);
    }
});
