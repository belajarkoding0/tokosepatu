<?php
	session_start();
	include 'header.php';
	include 'nav.php';
	include 'conf/koneksi.php';
	$id_produk = $_GET['id'];
	$query = mysqli_query($con, "SELECT * FROM barang
										JOIN kategori ON kategori.`id_kategori` = barang.`id_kategori`
										JOIN jenis ON jenis.`id_jenis` = barang.`id_jenis`
										JOIN stok ON stok.`id_barang` = barang.`id_barang`
										WHERE barang.`id_barang` = '$id_produk'");
	$result = mysqli_fetch_assoc($query);
	$ukuran = $result['ukuran'];
	$berat  = 0;
	$total  = 0;
	$size = explode(",", $ukuran);
	$kode = session_id();
?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
						<li class="breadcrumb-item"><a href="#">Produk</a></li>
						<li class="breadcrumb-item active"><?= "$result[nama_barang]"; ?></li>
				  </ol>
				</nav>
				<hr>
			</div>
			<div class="col col-sm-9">
				<h1 class='nama_barang'><?= "$result[nama_barang]" ?></h1>
				<hr>
			<!-- </div>
			<div class="col col-md-9"> -->
				<div class="col col-md-6 col-sm-6 detail-gambar">
					<img class="thumbnail" src="img/<?=$result['gambar'];?>" height="50%;" width="100%" alt="<?=$result['gambar'];?>">
				</div>
				<div class="col col-md-6 col-sm-6">
					<div class="col col-md-12">
						<h3 style="color: #FF0000FF;">Rp. <?=number_format(($result['harga']),0,",",".")?></h3>
					</div>
					<div class="col col-md-12 col-xs-12">
						<form method="post">
							<table class="table table-condensed text-justify">
								<input type="hidden" id="id_barang" value="<?=$result['id_barang']?>">
								<tr>
									<td>Kategori</td>
									<td>:</td>
									<td style="padding-left: 20px;"><?= $result['nama_kategori'] ?></td>
								</tr>
								<tr>
									<td>Jenis</td>
									<td>:</td>
									<td  style="padding-left: 20px;"><?= $result['jenis_sepatu'] ?></td>
								</tr>
								<tr>
									<td>Berat</td>
									<td>:</td>
									<td style="padding-left: 20px;"><?= $result['berat'] ?> gr</td>

								</tr>
								<tr>
									<td>Stok</td>
									<td>:</td>
									<td id="stok">&nbsp&nbsp&nbsp&nbsp&nbsp---</td>
									<!-- <input type="hidden" id="stok" name="stok" value=""> -->
								</tr>
								<tr>
									<td>Size</td>
									<td>:</td>
									<td>
										<div class="col col-md-5 col-sm-5 col-xs-7">
											<select class="form-control" name="ukuran" id="ukuran">
											<?php $ukuran = array(37,38,39,40,41);?>
												<option value="">---</option>
											<?php foreach ($ukuran as $size) { ?>
												<option value="<?= $size; ?>"><?= $size; ?></option>
											<?php } ?>
											</select>
										</div>
									</td>
								</tr>
								
								<tr>
									<td>Jumlah Beli</td>
									<td>:</td>
									<td>
										<div class="sol col-sm-5 col-sm-5 col-xs-7">
											<input type="number" class="form-control" value="1" min="1" required id="jumlah" name="jumlah">
										</div>
									</td>
								</tr>
							</table>
								<tr>
									<td>
										<div class="col col-md-12">
											<button type="submit" name="beli" class="btn btn-danger btn-md btn-block"><strong><span class="glyphicon glyphicon-shopping-cart">&nbsp</span>Beli</strong></button>
										</div>
									</td>
								</tr>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<?php if (isset($_POST['beli'])):
	$kode = session_id();
	$id_barang = $result["id_barang"];
	$nama = $result["nama_barang"];
	$harga =  $result["harga"];
	$size = $_POST['ukuran'];
	$stok = $_POST['stok'];
	$berat =  $result["berat"];
	$jumlah = $_POST['jumlah'];
	$subberat = $result['berat'] * $jumlah;
	$subtotal = $jumlah * $harga;
	$_SESSION['size'] = $size;

	if (empty($jumlah) OR empty($stok)) {
		echo "<script>alert('Info pembelian kosong');</script>";
	}elseif ($jumlah > $stok) {
		echo "<script>alert('Pembelian lebih dari stok');</script>";
	}else {
	
	$query = mysqli_query($con, "SELECT * FROM keranjang WHERE id_keranjang='$kode'
					AND id_barang='$id_barang' AND ukuran='$size'");
	$result = mysqli_fetch_array($query)	;

	//jika dikeranjang sudah ada, jumlah ditambah 1
	if (mysqli_num_rows($query) === 1) {
	$jumlah = $result['jumlah'] + 1;
	$subberat = $result['berat'] * $jumlah;
	$subtotal = $result['subtotal'] + $result['harga'];
	mysqli_query($con, "UPDATE keranjang SET
				jumlah='$jumlah',
				subtotal='$subtotal',
				subberat = '$berat'
				WHERE id_keranjang='$kode' AND id_barang='$id_barang'");
	echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
	}
	//jika dikeranjang belum ada, jumlah 1
	else {
	mysqli_query($con, "INSERT INTO keranjang (id_keranjang, id_barang, nama_barang, ukuran, harga, jumlah, berat, subtotal, subberat )
	VALUES ('$kode','$id_barang','$nama','$size','$harga','$jumlah','$berat','$subtotal','$subberat')");
	echo "<meta http-equiv='refresh' content='1;url=keranjang.php'>";
	}
}
endif ?>

<?php include 'footer.php'; ?>
