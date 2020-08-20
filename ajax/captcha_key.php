<?php 
include(__DIR__ ."/../api/config.php");
include("../api/captcha_core.php");

$key = import_key_cap($conn);
echo json_encode(array("captcha_key" => $key));