<?php
	include '../conf/koneksi.php';
	$date = date("ym");
	$idbrg = rand(4,9999);
	$idbarang = $date.sprintf("%04d",$idbrg);
?>
<h2>Tambah Barang</h2>
<form method="post" enctype="multipart/form-data" class="form-user">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
		    <label for="nama">Nama Barang</label>
		    <input type="text" class="form-control" name="nama">
		  </div>
		  <div class="form-group">
		    <label for="kategori">Kategori</label>
		    <select class="form-control" name="kategori" id="kategori">
          <option value="">--Pilih Kategori--</option>
          <?php
          $query=mysqli_query($con, "SELECT * FROM kategori");
          while ($data=mysqli_fetch_assoc($query)){
          echo '<option value="'.$data['id_kategori'].'">'.$data['nama_kategori'].'</option>';
          }
          ?>
        <select>
		  </div>
		  <div class="form-group">
				<label>Jenis Sepatu</label>
				<select class="form-control" name="jenis" id="jenis">
		          <option value="">--Pilih Jenis Sepatu--</option>
		        </select>
		  </div>
		  <div class="form-group">
		    <label for="harga">Harga (Rp)</label>
		    <input type="number" class="form-control" min=1 id="harga" name="harga">
		  </div>
		  <div class="form-group">
		    <label for="berat">Berat (Gr)</label>
		    <input type="number" class="form-control" min=1 id="berat" name="berat">
		  </div>
		  <div class="row">
		  	<div class="col-md-12">
				  <div class="form-group col-md-3" style="padding-left: 0">
				    <label>Ukuran</label>
						<?php $ukuran = array(37,38,39,40,41);?>
						<select class="form-control" name="ukuran" id="ukuran">
						<option value="">---</option>
						<?php foreach ($ukuran as $size) { ?>
				      <option value="<?= $size; ?>"><?= $size; ?></option>
						<?php } ?>
				     </select>
				  </div>
				  <div class="form-group col-md-3" style="padding-left: 0">
				    <label for="stok">Stok</label>
				    <input type="number" class="form-control" id="stok" name="stok" min="1">
				  </div>
				  <div class="form-group col-md-3" style="padding-top: 25px;padding-left: 0">
			  		<a name="inputTemp" class="btn btn-primary inputTemp">Input</a>
			  	</div>
			  </div>
		  </div>
		  <div class="tampildata"></div>
		  <div class="form-group">
		    <label for="gambar">Gambar</label>
		    <input type="file" id="gambar" name="gambar">
		  </div>
		  <div class="form-group">
		    <label for="deskripsi">Deskripsi</label>
		    <textarea rows="5" name="deskripsi" id="deskripsi">
		    </textarea>
		  </div>
		  <button type="submit" name="simpan" class="btn btn-default">Simpan</button>
  		</div>
  	</div>
</form>
<?php
if (isset($_POST['simpan'])):
	$nama = $_POST["nama"];
	$kategori =  $_POST["kategori"];
	$jenis =  $_POST["jenis"];
	$harga = $_POST["harga"];
	$berat = $_POST["berat"];
	$deskripsi = $_POST["deskripsi"];
	$gambar = $_FILES['gambar']['name'];
	$lokasi = $_FILES['gambar']['tmp_name'];

	if (empty($nama) || empty($kategori) || empty($jenis) || empty($harga) || empty($berat) || empty($gambar) || empty($deskripsi) ) {
	echo "<script>alert('Data Tidak Boleh Kosong');</script>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=tambahbarang'>";
	}else {

	/*AMBIL TMP_BRG BUAT DISIMPAN KE STOK*/
	$ambilTmp = mysqli_query($con,"SELECT * FROM tmp_brg");
	$test = mysqli_num_rows($ambilTmp) > 0;
	if ($test) {
		while ($resultTmp = mysqli_fetch_assoc($ambilTmp)) {
		$ukuran = $resultTmp['ukuran'];
		$stok = $resultTmp['stok'];

			/*SIMPAN BARANG*/
		$simpan = mysqli_query($con, "INSERT INTO barang (id_barang,nama_barang,id_kategori,id_jenis,harga,berat,gambar,deskripsi)
		 	VALUES ('$idbarang','$nama','$kategori','$jenis','$harga','$berat','$gambar','$deskripsi')");
		move_uploaded_file($lokasi, "../img/".$gambar);

		/*SIMPAN STOK*/
		$simpan = mysqli_query($con, "INSERT INTO stok (id_barang,ukuran,stok)
	 	VALUES ('$idbarang','$ukuran','$stok')");
		};
		echo "<script>alert('Data Tersimpan');</script>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=barang'>";
	}else {
		echo "<script>alert('Ukuran & Size Tidak Boleh Kosong');</script>";
	}
}
	mysqli_query($con, "TRUNCATE tmp_brg");
endif
?>
