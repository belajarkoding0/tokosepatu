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
				<input type="text" class="form-control" required readonly name="idbarang" value="<?= $result['id_barang'] ?>">
		  </div>
			<div class="form-group">
		    <label for="nama">Nama Barang</label>
				<input type="text" class="form-control" readonly name="nama" value="<?= $result['nama_barang'] ?>">
		  </div>
		  <div class="form-group">
		    <label for="kategori">Kategori</label>
		    <input type="text" class="form-control" name="kategori" disabled value="<?= $result['nama_kategori'] ?>">
		  </div>
		  <div class="form-group">
				<label>Jenis Sepatu</label>
				<input type="text" class="form-control" name="jenis" disabled value="<?= $result['jenis_sepatu'] ?>">
		  </div>
		  <div class="form-group">
		    <label for="harga">Harga (Rp)</label>
		    <input type="text" class="form-control" name="harga" value="<?=$result['harga'] ?>">
		  </div>
		  <div class="form-group">
		    <label for="berat">Berat (Gr)</label>
		    <input type="text" class="form-control" name="berat" value="<?= $result['berat'] ?>">
		  </div>
		  <!-- <div class="tampildatastok"></div> -->
		  <div class="form-group">
		    <label for="ukuran">Ukuran - Stok</label>
		    <table class="table table-bordered">
		    	<thead>
		    	<tr>
		    		<th class="tengah">No</th>
		    		<th class="tengah">Ukuran</th>
		    		<th class="tengah">Stok</th>
		    		<th class="tengah">Aksi</th>
		    	</tr>
		    	</thead>
		    	<tbody>
		    		<?php $nomor = 1 ?>
		    		<?php $querStok = mysqli_query($con, "SELECT * FROM barang JOIN stok ON barang.id_barang = stok.id_barang WHERE barang.id_barang = '$_GET[id]'"); ?>
		    		<?php while ($resultStok = mysqli_fetch_assoc($querStok)) { ?>
		    	<tr>
		    		<td class="tengah"><?= $nomor ?></td>
		    		<td class="tengah"><?= $resultStok['ukuran'] ?></td>
		    		<td class="tengah"><?= $resultStok['stok'] ?></td>
		    		<td class="tengah">
		    			<a class="btn btn-info btn-xs" data-toggle="modal" data-target="#stok_<?=$resultStok['id_stok'] ?>">ubah</a>
							<a href="index.php?halaman=hapusstok&id=<?= $resultStok['id_barang']; ?>&size=<?= $resultStok['ukuran']; ?>" class="btn btn-xs btn-danger">hapus</a>
		    		</td>
		    	</tr>
		    	<div class="modal fade" id="stok_<?=$resultStok['id_stok'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Ubah ukuran - stok</h4>
					      </div>
					      <div class="modal-body">
					        <form enctype="multipart/form-data" method="post">
					        	<input type="hidden" class="form-control" required readonly name="idbrg" value="<?= $result['id_barang'] ?>">
					          <div class="form-group">
					            <label for="ukuran">Ukuran</label>
					            <input type="text" readonly class="form-control" required name="ukuran" value="<?= $resultStok['ukuran'] ?>">
                      <input type="hidden" name="ukuran" value="<?= $resultStok['ukuran'] ?>">
					          </div>
					          <div class="form-group">
					            <label for="ukuran">Stok</label>
					            <input type="text" class="form-control" name="stok" value="<?= $resultStok['stok'] ?>">
					          </div>
					          <div class="modal-footer">
					            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					            <button class="btn btn-success" type="submit" name="ubahstok">ubah</button>
					          </div>
					        </form>  
					      </div>
					    </div>
					  </div>
					</div><!-- modal konfirmasi  -->
		    		<?php $nomor++ ?>
		    		<?php } ?>
		    	</tbody>
		    </table>
		  </div>
		  <div class="form-group">
		  	<label for="gambar">Gambar Produk</label><br>
		  	<img src="../img/<?= $result['gambar'] ?>" width="200">
		  </div>
		  <div class="form-group">
		    <label for="gambar">Ganti Foto</label>
		    <input type="file" id="gambar" name="gambar" class="form-control">
		  </div>
		  <div class="form-group">
		    <label for="deskripsi">Deskripsi</label>
		    <textarea class="form-control" rows="5" name="deskripsi">
		    	<?= $result['deskripsi'] ?>
		    </textarea>
		  </div>
		  <button type="submit" name="ubah" class="btn btn-default">Ubah</button>
  	</div>
  </div>
</form>
<?php
if (isset($_POST['ubahstok'])) {
$idbarang = $_POST['idbrg'];
$ukuran = $_POST['ukuran'];
$stok = $_POST['stok'];
//echo "<script>alert('$idbarang');</script>";
$query = mysqli_query($con, "UPDATE stok SET stok = '$stok' WHERE id_barang = '$idbarang' AND ukuran = '$ukuran'");
}
else{
	if (isset($_POST['ubah'])) {
		$gambar = $_FILES['gambar']['name'];
		$lokasi = $_FILES['gambar']['tmp_name'];
		if (!empty($lokasi)) {
			move_uploaded_file($lokasi, "../img/".$gambar);

			mysqli_query($con, "UPDATE barang SET nama_barang='$_POST[nama]',harga='$_POST[harga]',berat='$_POST[berat]',gambar='$gambar',deskripsi='$_POST[deskripsi]' WHERE id_barang = '$_GET[id]'");
		}
		else{
			mysqli_query($con, "UPDATE barang SET nama_barang='$_POST[nama]',harga='$_POST[harga]',berat='$_POST[berat]',deskripsi='$_POST[deskripsi]' WHERE id_barang = '$_GET[id]'");
		}
		echo "<script>alert('barang berhasil diubah');</script>";
		echo "<script>location='index.php?halaman=barang';</script>";
	}
}
?>
