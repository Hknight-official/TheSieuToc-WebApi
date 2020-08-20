<?php
	$apikey = '15876493476519537157'; //API key, lấy từ website calong.pro thay vào trong cặp dấu ''
	// database Mysql config
	$local_db = "local";
	$user_db = "user";
	$pass_db = "pass";
	$name_db = "api_thesieutoc";
	# đừng đụng vào 
  $conn = new mysqli($local_db, $user_db, $pass_db, $name_db);
  $conn->set_charset("utf8");
