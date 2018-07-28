<?php
$query = mysqli_query($con, "SELECT * FROM jenis WHERE id_jenis = '$_GET[id]'");
$result = mysqli_fetch_assoc($query);

mysqli_query($con, "DELETE FROM jenis WHERE id_jenis = '$_GET[id]'");
echo "<script>alert('jenis kategori berhasil dihapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=jenissepatu'>";
?>
