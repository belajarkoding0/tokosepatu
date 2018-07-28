<?php
	session_start();
	include 'header.php';
	include 'nav.php';
?>
<?php 
$errorNama = $errorTel = $errorEmail = $errorPass = '';
$namaStat = $telStat = $mailStat = $passStat = true;
if (isset($_POST['simpan'])):
$nama = $_POST['nama'];
$telepon = $_POST['telepon'];
$email = $_POST['email'];
$tanggal = date('Y-m-d',strtotime($_POST["tanggal"]));
$password = $_POST['password'];
$jenkel = $_POST['jenkel'];
if (strlen($telepon) == 12) {
	$tlp = substr($telepon, 8,11);
}else {
	$tlp = substr($telepon, 7,11);
}
$date = date('ymd');
$idPel = $date.''.$tlp;
$passwordHash = password_hash("$password",PASSWORD_DEFAULT);

if (empty($nama) || empty($jenkel) || empty($tanggal) || empty($telepon) || empty($email) || empty($password)) {
	echo "<script>alert('data tidak boleh kosong!')</script>";
	echo "<script>location='daftar.php';</script>";
}
if (is_numeric($nama)) {
	$errorNama = "*nama tidak boleh berisi angka";
	$namaStat = false;
}
if (!is_numeric($telepon)) {
	$errorTel = "*harus menggunakan angka";
	$telStat = false;
}elseif (strlen($telepon) != 12) {
	$errorTel = "*nomor harus 12 digit";
	$telStat = false;
}
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
	$errorEmail = "*email tidak valid";
	$mailStat = false;
}
if (strlen($password) < '8') {
    $errorPass = "*Password minimal 8 karakter!";
    $passStat = false;
}elseif(!preg_match("#[0-9]+#",$password)) {
    $errorPass = "*Pasword harus ada 1 angka!";
    $passStat = false;
}elseif(!preg_match("#[A-Z]+#",$password)) {
    $errorPass = "*Pasword harus ada 1 huruf kapital!";
    $passStat = false;
}elseif(!preg_match("#[a-z]+#",$password)) {
    $errorPass = "*Pasword harus ada 1 huruf kecil!";
    $passStat = false;
}
    // else {
    /*jika email sudah ada/sama, gagal daftar*/
    /*cek email yang sama*/
	$email_sama = mysqli_query($con, "SELECT email FROM pelanggan WHERE email = '$email'");
	$result = mysqli_fetch_assoc($email_sama);
	if ($result) {
		// echo "<script>alert('email sudah ada!')</script>";
		// echo "<script>location='daftar.php';</script>";
		$errorEmail = "email sudah terdaftar";
		$mailStat = false;
	}elseif (!empty($jenkel) AND !empty($tanggal) AND $namaStat AND $telStat AND $mailStat AND $passStat){ /*jika tidak ada yang sama, berhasil*/
	$simpan = mysqli_query($con, "INSERT INTO pelanggan (id_pelanggan,nama_pelanggan,jenis_kelamin,tgl_lahir,no_telepon,email,password)
	  VALUES ('$idPel','$nama','$jenkel','$tanggal','$telepon','$email','$passwordHash')");
	echo "<script>alert('Anda berhasil daftar. Silahkan lakukan login.')</script>";
	echo "<script>location='login.php';</script>";
	}
// }
endif ?>
<!-- <?= $errorNama.' '.$errorTel.' '.$errorEmail.' '.$errorPass ?> -->
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
						<li class="breadcrumb-item active">Daftar</li>
				  </ol>
				</nav>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<div class="text-center">
							<h1>Daftar Baru</h1>
							<span>Sudah punya akun? Masuk <a href="login.php">di sini</a></span>
						</div>
					</div>
					<div class="panel panel-body">
						<div class="col-sm-12">
							<form class="form-horizontal" action="" method="post">
								<!-- <br> -->
								<div class="form-group">
									<label for="nama" class="col-sm-4 control-label label-daftar">Nama Lengkap</label>
									<div class="col-sm-7">
										<input type="text" autofocus class="form-control" name="nama">
										<span class="errors"><?= $errorNama ?></span>
									</div>
								</div>
								<div class="form-group">
									<label for="jenkel" class="col-sm-4 control-label label-daftar">Jenis Kelamin</label>
									<div class="col-sm-7">
										<select class="form-control" name="jenkel">
											<option value="">-- Pilih --</option>
											<option value="Laki-Laki">Laki-Laki</option>
											<option value="Perempuan">Perempuan</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label for="tanggal" class="col-sm-4 control-label label-daftar">Tanggal Lahir</label>
									<div class="col-sm-7">
										<input type="date" class="form-control" name="tanggal">
									</div>
								</div>
								<div class="form-group">
									<label for="telepon" class="col-sm-4 control-label label-daftar">Telepon</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" min="1" name="telepon">
										<span class="errors"><?= $errorTel ?></span>
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-4 control-label label-daftar">Email</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" name="email">
										<span class="errors"><?= $errorEmail ?></span>
									</div>
								</div>
								<div class="form-group">
									<label for="password" class="col-sm-4 control-label label-daftar">Kata Sandi</label>
									<div class="col-sm-7">
										<input type="password" name="password"class="form-control">
										<span class="errors"><?= $errorPass ?></span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<button type="submit" name="simpan" class="btn btn-primary btn-md btn-block">Daftar</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
