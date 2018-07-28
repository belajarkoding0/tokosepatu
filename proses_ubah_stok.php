<?php
include 'conf/koneksi.php';
if (isset($_POST['ubahstok'])) {
$idbarang = $_POST['idbarang'];
$ukuran = $_POST['ukuran'];
$stok = $_POST['stok'];
echo "<script>alert('$stok');</script>";
//$query = mysqli_query($con, "UPDATE stok SET stok = '$stok' WHERE id_barang = '$idbarang' AND ukuran = '$ukuran'");
}
?>