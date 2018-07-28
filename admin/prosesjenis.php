<?php
	include '../conf/koneksi.php';
	$kategori = $_GET['kategori'];
	$query=mysqli_query($con, "SELECT * FROM jenis WHERE id_kategori = '$kategori'");
	echo '<select class="form-control" required name="jenis">';
	echo '<option value="">--Pilih Jenis Sepatu--</option>';
	while ($result = mysqli_fetch_assoc($query)) {
	    echo "<option value=$result[id_jenis]>$result[jenis_sepatu]</option>";
	}
	echo '<select>';
?>
