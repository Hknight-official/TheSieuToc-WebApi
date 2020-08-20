<?php
include(__DIR__ ."/../api/config.php");
include("../api/captcha_core.php");

if (empty($_GET['key_captcha'])){
    exit(json_encode(array("status" => "error", "msg" => "captcha fail !")));
}
$key = $conn->real_escape_string(strip_tags(addslashes($_GET['key_captcha']))); 
$captcha_code = get_value($conn, $key);
if ($captcha_code == false){
    http_response_code(400);
    exit();
}
//echo $captcha_code;
$target_layer = imagecreatetruecolor(70, 30);
$captcha_background = imagecolorallocate($target_layer, 255, 160, 119);
imagefill($target_layer, 0, 0, $captcha_background);
$captcha_text_color = imagecolorallocate($target_layer, 0, 0, 0);
imagestring($target_layer, 5, 5, 5, $captcha_code, $captcha_text_color);
header("Content-type: image/jpeg");
imagejpeg($target_layer);


