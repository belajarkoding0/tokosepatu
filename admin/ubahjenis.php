<?php
$query = mysqli_query($con, "SELECT * FROM jenis WHERE id_jenis = '$_GET[id]'");
$ambiljenis = mysqli_fetch_assoc($query);
$jenis = $ambiljenis['id_kategori'];
?>
<h2>Ubah Jenis Sepatu</h2>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="jenis">Jenis Sepatu</label>
				<input type="text" disabled class="form-control" value="<?= $ambiljenis['id_jenis'] ?>" name="id_jenis">
				<input type="hidden" class="form-control" value="<?= $ambiljenis['id_jenis'] ?>" name="id_jenis">
			</div>
			<div class="form-group">
				<label for="nama">Kategori</label>
				<select class="form-control" required name="kategori">
					<option value="">-- Pilih --</option>
					<?php $data = mysqli_query($con, "SELECT * FROM kategori");
					while ( $result = mysqli_fetch_assoc($data)) { ?>
					<option value="<?=$result['id_kategori']?>" <?php $jenis == $result['id_kategori'] ? print "selected" : "" ; ?>><?=$result['nama_kategori']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="jenis">Jenis Sepatu</label>
				<input type="text" required class="form-control" name="jenis" value="<?= $ambiljenis['jenis_sepatu'] ?>">
			</div>
			<button type="submit" name="ubah" class="btn btn-default">Ubah</button>
		</div>
	</div>
</form>
<?php if (isset($_POST['ubah'])):
$id = $_POST["id_jenis"];
$jenis = $_POST["jenis"];
$kategori = $_POST["kategori"];
$simpan = mysqli_query($con, "UPDATE jenis SET jenis_sepatu='$jenis',id_kategori='$kategori' WHERE id_jenis = '$_GET[id]'");
echo "<script>alert('Data Tersimpan');</script>";
echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=jenissepatu'>";
endif ?>
