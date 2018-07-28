<?php
include 'conf/koneksi.php';
$ukuran = $_POST['id_ukuran'];
$barang = $_POST['id_barang'];
$query = mysqli_query($con, "SELECT * FROM stok WHERE id_barang = '$barang' AND ukuran = '$ukuran'");
if (mysqli_num_rows($query) == 1) {
	while($row = mysqli_fetch_assoc($query))
	{
	  	if ($row['stok'] == 0) { ?>
	    <td style="padding-left: 20px;"><?= "Stok Habis"?></td>
		<?php }else{ ?>
	    <td name="stok" style="padding-left: 20px;"><?= $row['stok']; ?></td>
	    <input type="hidden" id="stok" name="stok" value="<?= $row['stok']; ?>">
	  	<?php } ?>
	<?php 
	}
}else { ?>
	<td style="padding-left: 20px;"><?= "Maaf, Tidak Tersedia"?></td>
<?php }
?>
