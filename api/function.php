<?php
class napthe
{

	private static $key;
	private static $secret;

	public function __construct($key)
	{ // nhập dữ liệu key api khi gọi class
		self::$key = $key;
	}
	# apiv2 thesieutoc
	#    cấu trúc mặc định của $method
	// $method = array (
	// 'pin' => $pin,
	// 'type' => $type, 
	// 'amount' => $amount,
	// 'seri' => $seri,	
	// 'content' = $content  
	// )
	public function get_card_v2($method)
	{ // hàm gửi card lên api
		$url = "https://thesieutoc.net/chargingws/v2?APIkey=" . self::$key . "&mathe=" . $method['pin'] . "&seri=" . $method['seri'] . "&type=" . $method['type'] . "&menhgia=" . $method['amount'] . "&content=" . $method['content'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		curl_setopt($ch, CURLOPT_REFERER, $actual_link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$out = json_decode(curl_exec($ch));
		if (isset($out->status)) {
			$error = 200;
		}
		curl_close($ch);
		return array(
			'check' => $error, // trả về 200 là hoạt động
			'msg' => $out->msg,
			'url' => $url,
			'status' => $out->status, // tham số này trả ra nếu bằng 00 thì thành công ; bằng số khác thì thất bại , chi tiết lỗi nằm ở msg
			'title' => $out->title // thông báo thất bại hay thành công :v		 
		); # Các tham số trả ra : check là tham số kiểm tra curl ; msg là messange server trả về ; status là trạng thái ; tran_id là mã bí mật dùng để check card hiệu lực thông thường là 24h
	}
	# mã hóa name -> uuid minecraft
	public function uuid_mc($user)
	{
		$val = md5("OfflinePlayer:" . $user, true);
		$byte = array_values(unpack('C16', $val));

		$tLo = ($byte[0] << 24) | ($byte[1] << 16) | ($byte[2] << 8) | $byte[3];
		$tMi = ($byte[4] << 8) | $byte[5];
		$tHi = ($byte[6] << 8) | $byte[7];
		$csLo = $byte[9];
		$csHi = $byte[8] & 0x3f | (1 << 7);

		if (pack('L', 0x6162797A) == pack('N', 0x6162797A)) {
			$tLo = (($tLo & 0x000000ff) << 24) | (($tLo & 0x0000ff00) << 8) | (($tLo & 0x00ff0000) >> 8) | (($tLo & 0xff000000) >> 24);
			$tMi = (($tMi & 0x00ff) << 8) | (($tMi & 0xff00) >> 8);
			$tHi = (($tHi & 0x00ff) << 8) | (($tHi & 0xff00) >> 8);
		}

		$tHi &= 0x0fff;
		$tHi |= (3 << 12);

		$uuid = sprintf(
			'%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
			$tLo,
			$tMi,
			$tHi,
			$csHi,
			$csLo,
			$byte[10],
			$byte[11],
			$byte[12],
			$byte[13],
			$byte[14],
			$byte[15]
		);
		return $uuid;
	}
	public function ValidateCallback($out)
	{ //Hàm kiểm tra callback từ sever
		if (isset($out['status'],
		$out['serial'],
		$out['pin'],
		$out['card_type'],
		$out['amount'],
		$out['content'],
		$out['real_amount'])) {
			return $out; //xác thực thành công, return mảng dữ liệu từ sever trả về.

		} else {
			return false; //Xác thực callback thất bại.
		}
	}
}
