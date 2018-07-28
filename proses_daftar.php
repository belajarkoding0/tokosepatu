<?php 
include 'conf/koneksi.php';
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
$password = password_hash("$password",PASSWORD_DEFAULT);

/*cek email yang sama*/
$email_sama = mysqli_query($con, "SELECT email FROM pelanggan WHERE email = '$email'");
$result = mysqli_fetch_assoc($email_sama);

/*jika email sudah ada/sama, gagl daftar*/
// if ($result) {
// 	echo "<script>alert('email sudah ada!')</script>";
// 	echo "<script>location='index.php';</script>";
// } else { /*jika tidak ada yang sama, berhasil*/
// $simpan = mysqli_query($con, "INSERT INTO pelanggan (id_pelanggan,nama_pelanggan,jenis_kelamin,tgl_lahir,no_telepon,email,password)
//   VALUES ('$idPel','$nama','$jenkel','$tanggal','$telepon','$email','$password')");
// echo "<script>alert('Anda berhasil daftar. Silahkan lakukan login.')</script>";
// echo "<script>location='login.php';</script>";
// }
/* || empty($jenkel) || empty($tanggal) || empty($telepon) || empty($email) || empty($password)*/
$errors = '';
if (empty($nama) || empty($jenkel)) {
	echo 'gagal';
}else {
	if (is_numeric($nama)) {
		$errors = "isi angka";
	}
}
endif ?>
