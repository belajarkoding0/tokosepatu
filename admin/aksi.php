<?php
include '../conf/koneksi.php';
$stok = $_POST["stok"];
$ukuran = $_POST["ukuran"];
if (empty($stok)) {
	echo "<script>alert('Stok Masih Kosong');</script>";
}else{
	mysqli_query($con,"INSERT INTO tmp_brg (ukuran,stok) VALUES ('$ukuran','$stok')");
}
?>