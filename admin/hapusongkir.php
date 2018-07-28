<?php
$query = mysqli_query($con, "SELECT * FROM ongkir WHERE id_ongkir = '$_GET[id]'");
$result = mysqli_fetch_assoc($query);

mysqli_query($con, "DELETE FROM ongkir WHERE id_ongkir = '$_GET[id]'");
echo "<script>alert('ongkir berhasil dihapus');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=ongkir'>";
?>
