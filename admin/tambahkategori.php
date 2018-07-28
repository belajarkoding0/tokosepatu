<?php
	$query = mysqli_query($con, "SELECT max(id_kategori) as maxKat FROM kategori");
	$result = mysqli_fetch_assoc($query);
	$kategori = $result['maxKat'];
	$noUrut = (int) substr($kategori, 3, 3);
	$noUrut++;
	$char = "KS-";
	$kategori = $char . sprintf("%03s", $noUrut);

?>
<?php $error = ''; 	if (isset($_POST['simpan'])):
$id = $_POST["id_kategori"];
$kategori = $_POST["kategori"];
if (empty($kategori)) {
	echo "<script>alert('Data Tidak boleh kosong');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=tambahkategori'>";
}else {
$simpan = mysqli_query($con, "INSERT INTO kategori (id_kategori,nama_kategori)	VALUES ('$id','$kategori')");
echo "<script>alert('Data Tersimpan');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=kategori'>";
}
endif ?>
<h2>Tambah Kategori</h2>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="kategori">ID Kategori</label>
				<input type="text" required disabled class="form-control" value="<?= $kategori ?>" id="id_kategori" name="id_kategori">
				<input type="hidden" class="form-control" value="<?= $kategori ?>" name="id_kategori">
			</div>
			<div class="form-group">
				<label for="kategori">Kategori</label>
				<input type="text" class="form-control" id="kategori" name="kategori">
			</div>
			<button type="submit" name="simpan" class="btn btn-default">Simpan</button>
		</div>
	</div>
</form>

