<?php
$query = mysqli_query($con, "SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'");
$result = mysqli_fetch_assoc($query);

mysqli_query($con, "DELETE FROM kategori WHERE id_kategori = '$_GET[id]'");
echo "<script>alert('kategori berhasil dihapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
?>
