<?php 
    session_start();
    $captcha = imagecreatefrompng("captcha.png");
    $color = imagecolorallocate($captcha,0,0,255);
    $color_line = imagecolorallocate($captcha,0 ,255, 0);
    $text = substr(md5(rand(0, 9999)),0, 5);
    $_SESSION["captcha"] = $text;//save in to session memmory.
    $font = "arial.ttf";
    imagettftext($captcha, 16, 0, 1, 17, $color, $font, $text);
    imageline($captcha, 0, 10, 60, 10, $color_line);
    header("content-type: image/png");
    imagepng($captcha);
    imagedestroy($captcha);
    