<?php
	$con = mysqli_connect("localhost","root","") or die ("gagal koneksi ke server");
	mysqli_select_db($con, "tokosepatu") or die (mysqli_error() ." Error : ". mysqli_errno())
?>
