<?php
$query = mysqli_query($con, "SELECT * FROM kategori WHERE id_kategori = '$_GET[id]'");
$result = mysqli_fetch_assoc($query);
?>
<h2>Ubah Kategori</h2>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="kategori">ID Kategori</label>
				<input type="text" required disabled class="form-control" id="id_kategori" name="id_kategori" value="<?= $result['id_kategori'] ?>">
				<input type="hidden" class="form-control" name="id_kategori" value="<?= $result['id_kategori'] ?>">
			</div>
			<div class="form-group">
				<label for="kategori">Kategori</label>
				<input type="text" required class="form-control" id="kategori" name="kategori" value="<?= $result['nama_kategori'] ?>">
			</div>
			<button type="submit" name="ubah" class="btn btn-default">Ubah</button>
		</div>
	</div>
</form>
<?php if (isset($_POST['ubah'])):
$id = $_POST["id_kategori"];
$kategori = $_POST["kategori"];
$simpan = mysqli_query($con, "UPDATE kategori SET id_kategori='$id',nama_kategori='$kategori' WHERE id_kategori = '$_GET[id]'");
echo "<script>alert('Data Tersimpan');</script>";
echo "<script>location='index.php?halaman=kategori';</script>";
endif ?>
