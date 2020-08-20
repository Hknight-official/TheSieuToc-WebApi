<?php

function import_key_cap($conn) {
    $key = key_img_cap();
    $value =  randomString_cap();
    $conn->query("DELETE FROM `captcha` WHERE `expires` < NOW()");
    $conn->query("INSERT INTO `captcha`(`key_captcha`, `value`, `lifetime`) VALUES ('{$key}', '{$value}', NOW() + INTERVAL 2 MINUTE)");
    return $key;
}

function check_cap($conn, $key, $value) {
    $conn->query("DELETE FROM `captcha` WHERE `expires` < NOW()");
    $query = $conn->query("SELECT * FROM captcha WHERE `key_captcha` = '{$key}'");
    if ($query->num_rows < 1){
        return false;
    }
    $row = $query->fetch_array(MYSQLI_ASSOC);
    if ($value == $row['value']){
        $conn->query("DELETE FROM `captcha` WHERE `id` = {$row['id']}");
        return true;
    } else {
        $conn->query("DELETE FROM `captcha` WHERE `id` = {$row['id']}");
        return false;
    }
}

function get_value($conn, $key) {
    $conn->query("DELETE FROM `captcha` WHERE `expires` < NOW()");
    $query = $conn->query("SELECT * FROM captcha WHERE `key_captcha` = '{$key}' AND `status_image` = 0");
    if ($query->num_rows < 1){
        return false;
    }
    $row = $query->fetch_array(MYSQLI_ASSOC);
    $conn->query("UPDATE `captcha` SET status_image = 1 WHERE `id` = {$row['id']} ");
    return $row['value'];
}

 function key_img_cap() {
        list($usec, $sec) = explode(" ", microtime());
        $microtime_float = substr(str_replace(".", "", ((float)$usec + (float)$sec)), 0, -1);
        $string = md5($microtime_float);
        $array_string = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
        $newstring = "";
        $i = 0;
        foreach ($array_string as $value) {
            $newstring .= $value;
            if ($i == 7 || $i == 16 || $i == 20) {
                $newstring .= "-";
            }
            $i++;
        }
        return $newstring;
}

function randomString_cap($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

