<?php
	$query = mysqli_query($con, "SELECT max(id_jenis) as maxJen FROM jenis");
	$result = mysqli_fetch_assoc($query);
	$jenis = $result['maxJen'];
	$noUrut = (int) substr($jenis, 3, 3);
	$noUrut++;
	$char = "JS-";
	$jenis = $char . sprintf("%03s", $noUrut);
?>
<h2>Tambah Jenis Sepatu</h2>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="jenis">Jenis Sepatu</label>
				<input type="text" disabled class="form-control" value="<?= $jenis ?>" name="id_jenis">
				<input type="hidden" class="form-control" value="<?= $jenis ?>" name="idjenis">
			</div>
			<div class="form-group">
				<label for="nama">Kategori</label>
				<!-- <input type="text" class="form-control" id="nama" name="nama"> -->
				<select class="form-control" name="kategori">
					<option value="">-- Pilih --</option>
					<?php $query = mysqli_query($con, "SELECT * FROM kategori"); while ( $result = mysqli_fetch_assoc($query)) { ?>
					<option value="<?=$result['id_kategori']?>"><?=$result['nama_kategori']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="jenis">Jenis Sepatu</label>
				<input type="text" class="form-control" name="jenis">
			</div>
			<button type="submit" name="simpan" class="btn btn-default">Simpan</button>
		</div>
	</div>
</form>
<?php if (isset($_POST['simpan'])):
$id = $_POST["idjenis"];
$jenis = $_POST["jenis"];
$kategori = $_POST["kategori"];
if (empty($kategori) || empty($jenis)) {
	echo "<script>alert('Data Tidak boleh kosong');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=tambahjenis'>";
}else {
$simpan = mysqli_query($con, "INSERT INTO jenis (id_jenis,jenis_sepatu,id_kategori)	VALUES ('$id','$jenis','$kategori')");
echo "<script>alert('Data Tersimpan');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=jenissepatu'>";
}
endif ?>
