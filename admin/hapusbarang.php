<?php
$query = mysqli_query($con, "SELECT * FROM barang WHERE id_barang = '$_GET[id]'");
$result = mysqli_fetch_assoc($query);
$gambar = $result['gambar'];
if (file_exists("../img/$gambar")) {
	unlink("../img/$gambar");
}
mysqli_query($con, "DELETE FROM barang WHERE id_barang = '$_GET[id]'");
echo "<script>alert('barang berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=barang';</script>";
?>
