<!DOCTYPE html>
<html lang="vi" xml:lang="vi">

<head>
	<meta charset="UTF-8">
	<title>Nạp thẻ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" href="https://cdn.rawgit.com/daneden/animate.css/v3.1.0/animate.min.css">
	<script src='https://cdn.rawgit.com/matthieua/WOW/1.0.1/dist/wow.min.js'></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.6/css/mdb.min.css" />
	<link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
	<script type="text/javascript">
		new WOW().init();
	</script>
	<div class="container">
		<div id="status"></div>
		<div class="row" style="margin-top: 30px;">
			<div class="col-md-5">
				<form method="POST" action="#" id="myform">
					<input type="hidden" name="key_captcha" id="captcha_key" value="" />
					<table class="table table-condensed table-bordered" aria-describedby="napthe_form">
						<tbody>
							<tr bgcolor="4682B4">
								<td colspan="2" align="center">
									<h3 style="color:white;">« Nạp Thẻ »</h3>
								</td>
							</tr>
							<tr>
								<td><label>Username:</label></td>
								<td><input type="text" class="form-control" name="username" required /></td>
							</tr>
							<tr>
								<td><label>Loại thẻ:</label></td>
								<td><select class="form-control" name="card_type" required>
										<option value="">Chọn loại thẻ</option>
										<?php
										$obj = json_decode(file_get_contents("https://thesieutoc.net/card_info.php"), true);
										$length = count($obj);
										for ($i = 0; $i < $length; $i++) {
											if ($obj[$i]['status'] == 1) {
												echo '<option value="' . $obj[$i]['name'] . '">' . $obj[$i]['name'] . ' (' . $obj[$i]['chietkhau'] . '%)</option> ';
											}
										}
										?>
									</select></td>
							</tr>
							<tr>
								<td><label>Mệnh giá:</label></td>
								<td><select class="form-control" name="card_amount" required>
										<option value="">Chọn mệnh giá</option>
										<option value="10000">10.000 (<?php echo $obj[1]['Chietkhau-123']; ?>%)</option>
										<option value="20000">20.000 (<?php echo $obj[1]['Chietkhau-123']; ?>%)</option>
										<option value="30000">30.000 (<?php echo $obj[1]['Chietkhau-123']; ?>%)</option>
										<option value="50000">50.000</option>
										<option value="100000">100.000</option>
										<option value="200000">200.000</option>
										<option value="300000">300.000</option>
										<option value="500000">500.000</option>
										<option value="1000000">1.000.000</option>
									</select></td>
							</tr>
							<tr>
								<td><label>Số seri:</label></td>
								<td><input type="text" class="form-control" name="serial" required /></td>
							</tr>
							<tr>
								<td><label>Mã thẻ:</label></td>
								<td><input type="text" class="form-control" name="pin" required /></td>
							</tr>
							<tr>
								<td><label>Captcha:</label></td>
								<td>
									<center>
										<p><b>Nhập những kí tự bạn thấy vào ô bên dưới !</b></p><img width="30%" id="captcha_code" onclick="refreshCaptcha();" />
										<input type="text" style="width:30%" name="captcha" id="captcha" class="demoInputBox">
									</center>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center"><button type="submit" class="btn btn-success btn-block" name="submit">NẠP NGAY</button></td>
							</tr>
						</tbody>
					</table>
				</form>
				<script type="text/javascript">
					$("#myform").submit(function(e) {
						$("#status").html("<img src='./images/load.gif' width='30%' />");
						e.preventDefault();
						$.ajax({
							url: "./ajax/card.php",
							type: 'post',
							data: $("#myform").serialize(),
							success: function(data) {
								$("#status").html(data);
								refreshCaptcha();
								document.getElementById("myform").reset();
								$("#load_hs").load("./ajax/history.php");
							}
						});

					});

					
					refreshCaptcha();
					setTimeout(() => {
						refreshCaptcha();
					}, 120000);

					function refreshCaptcha() {
						$.ajax({
							url: "./ajax/captcha_key.php",
							dataType: 'json',
							success: function(data) {
								$("#captcha_key").attr('value', data.captcha_key);
								$("#captcha_code").attr('src', './ajax/captcha_code.php?key_captcha='+data.captcha_key);
							}
						});
					}

				</script>
			</div>
			<div class="col-md-7">
				<h4 class="text-center"> « Tiện Ích Nạp Thẻ »</h4>
				<div class="panel-body">
					<marquee>
						<p><span style="color: #ff6600;"><strong>Bạn Cảm Thấy Phiên Bản Mới Như Thế Nào Nè >< </strong> </span> </p> </marquee> </div> <div id="accordion">
										<div class="card">
											<div class="card-header" id="headingOne">
												<h5 class="mb-0">
													<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
														Lịch Sử Nạp Thẻ
													</button>
												</h5>
											</div>

											<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
												<div id="load_hs" class="card-body table-responsive">
													<center><img src='./assets/load.gif' width='50%' /></center>
												</div>
												<script>
													$("#load_hs").load("./ajax/history.php");
													setInterval(function() {
														$("#load_hs").load("./ajax/history.php");
													}, 10000);
												</script>
											</div>
										</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Thông Báo Khẩn Cấp !
							</button>
						</h5>
					</div>

					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
						<div class="card-body table-responsive">
							<p>... Nothing</p>
						</div>
					</div>
				</div>

				<div class="card">
					<div class="card-header" id="headingp">
						<h5 class="mb-0">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsep" aria-expanded="false" aria-controls="collapsep">
								Điều Khoảng Dịch Vụ !
							</button>
						</h5>
					</div>

					<div id="collapsep" class="collapse" aria-labelledby="headingp" data-parent="#accordion">
						<div class="card-body table-responsive">
							<ul>
								<li>Tài khoản dùng để đổi thẻ cào thành tiền mặt theo chiết khấu quy định của TheSieuToc tại từng thời điểm.</li>
								<li>Chủ tài khoản có thể rút tiền về tài khoản khi số tiền trong tài khoản đạt 100.000đ. Phí chuyển khoản sẽ do chủ tài khoản chi trả theo quy định của Ngân hàng..</li>
								<li>Để lập lệnh rút tiền chủ tài khoản cần thiết lập tài khoản ngân hàng trong hồ sơ tài khoản của mình. Các thiết lập bao gồm: Tên ngân hàng, Chi nhánh, Chủ tài khoản, Số tài khoản.</li>
								<li>Chủ tài khoản chịu trách nhiệm sử dụng tài khoản theo đúng quy định của TheSieuToc.</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>