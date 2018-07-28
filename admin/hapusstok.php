<?php
$query = mysqli_query($con, "SELECT * FROM stok WHERE id_barang = '$_GET[id]' AND ukuran = '$_GET[size]'");
$result = mysqli_fetch_assoc($query);

mysqli_query($con, "DELETE FROM stok WHERE id_barang = '$_GET[id]' AND ukuran = '$_GET[size]'");
echo "<script>alert('data berhasil dihapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=ubahbarang&id=$_GET[id]>";
?>
