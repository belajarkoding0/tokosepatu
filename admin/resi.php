<?php
	include '../conf/koneksi.php';
	$id_trans = $_GET['id'];
?>
<h2> Update resi pengiriman </h2>
<form method="post">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
			    <label for="resi">No. Resi</label>
			    <input type="text" class="form-control" id="resi" name="resi">
			</div>
		  <button type="submit" name="simpan" class="btn btn-default">Simpan</button>
  		</div>
  	</div>
</form>
<?php if (isset($_POST['simpan'])):
	$resi = $_POST["resi"];$queryTrx = mysqli_query($con,"SELECT * FROM transaksi WHERE id_transaksi = '$id_trans'");
  	while ($resultTrx = mysqli_fetch_assoc($queryTrx)){;
  	$status = $resultTrx['status']+1;
	$updateResi = mysqli_query($con, "UPDATE transaksi SET resi='$resi',status='$status' WHERE id_transaksi = '$id_trans'");
	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=konfirmasi'>";
	}
endif ?>