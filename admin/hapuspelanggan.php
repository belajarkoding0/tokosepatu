<?php
$query = mysqli_query($con, "SELECT * FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");
$result = mysqli_fetch_assoc($query);

mysqli_query($con, "DELETE FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");
echo "<script>alert('pelanggan berhasil dihapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=pelanggan'>";
?>
