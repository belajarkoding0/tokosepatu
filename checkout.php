<?php
session_start();
include 'conf/koneksi.php';
include 'header.php';
$kode = session_id();
if (ISSET($_SESSION['pelanggan']))
{
	// echo "<script>alert('Anda Berhasil Login !!')</script>";
}
else
	header("location:login.php");
?>

<?php
$date = date("Ymd");
$notransksi = rand(4,9999);
$id_transaksi = $date.sprintf("%04d",$notransksi);
$nomor = 1;
$tanggal = date("Y-m-d");
$query = mysqli_query($con, "SELECT *, SUM(subberat), SUM(jumlah),SUM(subtotal) FROM keranjang WHERE id_keranjang='$kode'");
while ( $result = mysqli_fetch_assoc($query)) {
	$jumlah = $result['SUM(jumlah)'];
	$total  = $result['SUM(subtotal)'];
	$berat = $result['SUM(subberat)'];
}
?>
<?php include 'nav.php'; ?>
<div id="content">
	<div class="container">
		<div class="row">
		<h2>Checkout</h2><br>
		<table class="table table-bordered text-center">
			<thead class="thead-dark text-center">
				<tr>
					<th class="text-center" scope="col">No. Transaksi</th>
					<th class="text-center" scope="col">Tanggal Transaksi</th>
					<th class="text-center" scope="col">Jumlah</th>
					<th class="text-center" scope="col">Subberat</th>
					<th class="text-center" scope="col">Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-center" scope="row" class="readonly"><?= $id_transaksi; ?></td>
					<td><?= $tanggal; ?></td>
					<td><?= $jumlah; ?></td>
					<td><?= $berat ?> gr</td>
					<td>Rp. <?= number_format($total); ?></td>
				</tr>
				<?php $nomor++ ?>
			</tbody>
		</table>
		</br>
		<h4>Lengkapi Data Pengiriman dibawah</h4><br>
    	<form method="post">
		<!-- <div class="form-row"> -->
			<div class="form-group col-md-6">
				<label for="NamaLengkap">Nama Lengkap</label>
				<input type="text" class="form-control" id="NamaLengkap" required name="nama" placeholder="Masukan Nama Lengkap">
			</div>
			<div class="form-group col-md-6">
				<label for="telepon">No. Telepon</label>
				<input type="number" class="form-control" name="telepon" required id="telepon" placeholder="Masukan No. Telepon">
			</div>
			<div class="form-group col-md-5">
				<?php
					//Get Data Provinsi
					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => array(
					    "key: 77cda9b64f2a6060b77274b1ac47aab1"
					  ),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);

					echo "<label for='inputKota'>Provinsi</label>";
					echo "<select required name='inputProv' id='inputProv' class='form-control'>";
					echo "<option value=''>-- Pilih Provinsi Tujuan --</option>";
					$data = json_decode($response, true);
					for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
						echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".strtoupper($data['rajaongkir']['results'][$i]['province'])."</option>";
					}
					echo "</select>";
				?>
			</div>
			<div class="form-group col-md-5">
				<?php
					//Get Data Kota
					$curl = curl_init();
					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => array(
					    "key: 77cda9b64f2a6060b77274b1ac47aab1"
					  ),
					));

					$response = curl_exec($curl);
					$err = curl_error($curl);
					$data2 = json_decode($response, true);
				?>
				<label for="inputKota">Kabupaten/Kota</label>
				<select required id="inputKota" name="inputKota" class='form-control'>
					<option value=''>-- Pilih Kab/Kota Tujuan --</option>
				</select>
			</div>
      		<div class="form-group col-md-2">
				<label for="inputPos">Kode Pos</label>
				<input type="number" class="form-control" id="inputPos" required name="pos">
			</div>
			<div class="form-group col-md-12">
				<label for="inputAddress">Alamat Lengkap</label>
				<textarea class="form-control" id="inputAddress" required rows="3" name="alamat" placeholder="1234 Main St"></textarea>
			</div>
			<div class="form-group col-md-2">
				<label for="kurir">Pilih Kurir</label>
				<select id="kurir" name="kurir" class="form-control" required>
					<option value="">-- Pilih Kurir --</option>
					<option value="jne">JNE</option>
					<option value="tiki">TIKI</option>
					<option value="pos">POS INDONESIA</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="kurir">Pilih Service</label>
				<select id="service" name="service" class="form-control" required>
					<option value="">-- Pilih Service --</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label for="deskripsi">Deskripsi Service</label>
				<input type="text" disabled class="form-control" id="deskripsi" name="deskripsi">
			</div>
			<div class="form-group col-md-2">
				<label for="lamakirim">Lama Kirim (Hari)</label>
				<input type="text" disabled class="tengah form-control" id="lamakirim" required name="lamakirim">
			</div>
			<div class="form-group col-md-2">
				<label for="tarif">Biaya Kirim</label>
				<input class="form-control tengah" disabled type="number" name="tarif" id="tarif">
			</div>
			<div class="form-group col-md-offset-10 col-md-2">
				<!-- <label for="tarif">Biaya Kirim</label> -->
				<input class="form-control tengah" disabled type="number" name="subtotal" id="total">
			</div>
			<div class="form-group col-md-12">
				<button class="btn btn-primary" name="checkout" id="checkout">Checkout</button>
			</div>
    	</form>
	</div>
</div>
<?php if (isset($_POST['checkout'])):
	$prov = $_POST['inputProv'];
	$kota = $_POST['inputKota'];
	$kurir = $_POST['kurir'];
	$service = $_POST['service'];
	$deskripsi = $_POST['desk'];
	$etd = $_POST['lama'];
	$tarif = $_POST['biaya'];
	$subtotal = $total + $tarif;
	$data = $data['rajaongkir']['results'];
	$data2 = $data2['rajaongkir']['results'];
	if (!empty($data)) {
	  	foreach ($data as $d) {
	      if ($d['province_id'] === $prov) {
	        $prov = $d['province'];
	      }
	  	}
	}
	if (!empty($data2)) {
		foreach ($data2 as $d) {
	      if ($d['city_id'] === $kota) {
	        $kota = $d['city_name'];
	      }
	  	}
	}
	$id_pelanggan = $_SESSION['pelanggan'];
	$nama = $_POST['nama'];
	$telepon = $_POST['telepon'];
	$pos = $_POST['pos'];
	$alamat = $_POST['alamat'];
	
	$simpanTrans = mysqli_query($con, "INSERT INTO transaksi (id_transaksi, id_pelanggan, tgl_transaksi, subtotal, nm_penerima, no_tlp, alamat_pengiriman, kota, kode_pos, provinsi, kurir, service, ongkir, status, resi) VALUES ('$id_transaksi','$id_pelanggan','$tanggal','$subtotal','$nama','$telepon','$alamat','$kota','$pos','$prov','$kurir','$service','$tarif','1','')");
	// if ()
	// {
	// 	echo mysqli_error($con);
	// }
	// QUERY AMBIL DATA KERANJANG, SIMPAN KE DETAIL_TRANS
	$keranjang = mysqli_query($con, "SELECT * FROM keranjang WHERE id_keranjang='$kode'");
	while ($resultKeranjang = mysqli_fetch_assoc($keranjang)) {
	$id_barang = $resultKeranjang['id_barang'];
	$harga = $resultKeranjang['harga'];
	$size = $resultKeranjang['ukuran'];
	$berat = $resultKeranjang['berat'];
	$jumlah = $resultKeranjang['jumlah'];
	$subberat = $resultKeranjang['subberat'];
	$subtotal = $resultKeranjang['subtotal'];

	$simpanDet = mysqli_query($con, "INSERT INTO detail_transaksi (id_transaksi, id_barang, harga, berat, jumlah, subberat, subtotal, size) VALUES ('$id_transaksi','$id_barang','$harga','$berat','$jumlah','$subberat','$subtotal','$size')");
	$queryStok = mysqli_query($con, "SELECT * FROM stok WHERE id_barang = '$id_barang' AND ukuran = '$size'");
	$resultStok = mysqli_fetch_assoc($queryStok);
	$stokBarang = $resultStok['stok'] - $jumlah;
	$updateBarang = mysqli_query($con, "UPDATE stok SET stok = $stokBarang WHERE id_barang = '$id_barang' AND ukuran = '$size'");
	}
	if (!$simpanTrans AND !$simpanDet)
	{
		echo mysqli_error($con);
	}
	else
	{
		echo "<script>location='pembayaran.php?id=$id_transaksi';</script>";
	}
	// MENGHAPUS KERANJANG
	mysqli_query($con, "TRUNCATE keranjang");
endif ?>

<?php include 'footer.php'; ?>
