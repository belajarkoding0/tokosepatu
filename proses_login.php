<?php session_start();
$kode = session_id();
include 'conf/koneksi.php';
if (isset($_POST['submit'])):
$username = $_POST["username"];
$password = $_POST["password"];

/*cek email di database*/
	if (empty($username) OR empty($password)) {
		echo "<script>alert('Login gagal ! Pastikan anda mengisi username dan password.')</script>";
		echo "<script>location='login.php';</script>";
	}else{
	$cek_email = mysqli_query($con, "SELECT * FROM pelanggan WHERE email = '$username'");
	if (mysqli_num_rows($cek_email) === 1) {
		/*cek password*/
		$pass = mysqli_fetch_assoc($cek_email);
		if (password_verify($password,$pass["password"])) {
			$_SESSION['pelanggan']= $pass["id_pelanggan"];

			$keranjang = mysqli_query($con, "SELECT * FROM keranjang");
			// $hit = mysqli_num_rows($keranjang);
			// if ($hit > 0) {
			// 	echo "<script>location='keranjang.php';</script>";
			// }else{
			// 	header("location: index.php");
			// }
			$hit = mysqli_fetch_assoc($keranjang);
			$id_keranjang = $hit['id_keranjang'];
			if ($id_keranjang == $kode ) {
				echo "<script>location='keranjang.php';</script>";
			}else{
				header("location: index.php");
			}
		}else {
			echo "<script>alert('Login gagal ! Pastikan Password anda benar.')</script>";
			echo "<script>location='login.php';</script>";
		}
	}else {
		echo "<script>alert('Login gagal ! Email tidak terdaftarkan.')</script>";
		echo "<script>location='login.php';</script>";
	}
}
endif ?>
