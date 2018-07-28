<?php include '../conf/koneksi.php'; ?>
<?php
$query = mysqli_query($con, "SELECT * FROM barang
										JOIN kategori ON barang.id_kategori=kategori.id_kategori
										JOIN jenis ON barang.id_jenis=jenis.id_jenis WHERE id_barang = '$_GET[id]'");
$result = mysqli_fetch_assoc($query);
?>
<h2>Ubah Barang</h2>
<form method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
		    <label for="nama">ID Barang</label>
				<input type="text" class="form-control" required readonly name="nama" value="<?= $result['id_barang'] ?>">
		  </div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
		    <label for="nama">Nama Barang</label>
				<input type="text" class="form-control" required readonly name="nama" value="<?= $result['nama_barang'] ?>">
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="kategori">Kategori</label>
		    <input type="text" class="form-control" required name="kategori" value="<?= $result['nama_kategori'] ?>" readonly>
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
				<label>Jenis Sepatu</label>
				<input type="text" class="form-control" required name="jenis" readonly value="<?= $result['jenis_sepatu'] ?>">
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="harga">Harga (Rp)</label>
		    <input type="text" class="form-control" required readonly name="harga" value="<?=$result['harga'] ?>">
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="berat">Berat (Gr)</label>
		    <input type="text" class="form-control" required readonly name="berat" value="<?= $result['berat'] ?>">
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="stok">Stok</label>
		    <input type="text" class="form-control" required readonly name="stok" value="<?= $result['stok'] ?>">
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
		    <label for="ukuran">Ukuran</label>
		    <input type="text" class="form-control" required name="ukuran" value="<?= $result['ukuran'] ?>">
		    <span><em>NB : pisahkan dengan tanda koma ( , )</em></span>
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
		  	<label for="gambar">Gambar Produk</label><br>
		  	<img src="../img/<?= $result['gambar'] ?>" width="200">
		  </div>
<!-- 		</div>
		<div class="col-md-6"> -->
		  <!-- <div class="form-group">
		    <label for="gambar">Ganti Foto</label>
		    <input type="file" id="gambar" name="gambar">
		  </div> -->
		</div>
		<div class="col-md-12">
		  <div class="form-group">
		    <label for="deskripsi">Deskripsi</label>
		    <textarea class="form-control" rows="5" name="deskripsi">
		    	<?= $result['deskripsi'] ?>
		    </textarea>
		  </div>
		</div>
		  <!-- <button type="submit" name="ubah" class="btn btn-default">Ubah</button> -->
  </div>
</form>
<?php
if (isset($_POST['ubah'])) {
	$gambar = $_FILES['gambar']['name'];
	$lokasi = $_FILES['gambar']['tmp_name'];
	if (!empty($lokasi)) {
		move_uploaded_file($lokasi, "../img/".$gambar);

		mysqli_query($con, "UPDATE barang SET nama_barang='$_POST[nama]',harga='$_POST[harga]',berat='$_POST[berat]',stok='$_POST[stok]',ukuran='$_POST[ukuran]',gambar='$gambar',deskripsi='$_POST[deskripsi]' WHERE id_barang = '$_GET[id]'");
	}
	else{
		mysqli_query($con, "UPDATE barang SET nama_barang='$_POST[nama]',harga='$_POST[harga]',berat='$_POST[berat]',stok='$_POST[stok]',ukuran='$_POST[ukuran]',deskripsi='$_POST[deskripsi]' WHERE id_barang = '$_GET[id]'");
	}
	echo "<script>alert('barang berhasil diubah');</script>";
	echo "<script>location='index.php?halaman=barang';</script>";
}
?>
