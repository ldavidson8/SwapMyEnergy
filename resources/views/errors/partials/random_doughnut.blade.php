<?php
    $random_image_number = rand(0, 6);
    $random_rotation = rand(0, 360);
    $random_image_string = "";

    switch($random_image_number)
    {
        case 0:
            $random_image_string = asset('img/error pages/Waffle-1.png');
            break;
        case 1:
            $random_image_string = asset('img/error pages/Waffle-2.png');
            break;
        case 2:
            $random_image_string = asset('img/error pages/Waffle-3.png');
            break;
        case 3:
            $random_image_string = asset('img/error pages/Waffle-4.png');
            break;
        case 4:
            $random_image_string = asset('img/error pages/Waffle-5.png');
            break;
        case 5:
            $random_image_string = asset('img/error pages/Waffle-6.png');
            break;
        case 6:
            $random_image_string = asset('img/error pages/Waffle-7.png');
            break;
    }

    echo
        "<div class='doughnut-image-outer'>",
        "<img rel='preload' src='$random_image_string' class='doughnut-image' style='transform: translate(-50%, -50%) rotate({$random_rotation}deg);' />",
        "</div>";
