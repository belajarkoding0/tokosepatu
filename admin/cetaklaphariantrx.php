<?php session_start(); ?>
<?php $user = $_SESSION['admin']['username']; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Laporan Pelanggan</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <!-- CUSTOM STYLES-->
  <!-- <link href="assets/css/custom.css" rel="stylesheet" /> -->
  <!-- GOOGLE FONTS-->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	<style>
	body{
		width: 80%;
		margin: 0 auto;

	}
		.kanan{
		  text-align: right;
		}

		.kiri{
		  text-align: left;
		}

		.tengah{
		  text-align: center;
		}
		.tebal{
		  font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="tengah">
		<h3 style="font-family: 'Lobster', cursive; font-size: 50px; color: red;">OPLSHOP</h3>
		<p class="tebal">Jl. Salemba Tengah No. 152C Jakarta Pusat</p>
		<p class="tebal">Telepon : (021) 3915957</p>
	</div>
	<hr>
	<h3 class="tengah tebal">LAPORAN DATA TRANSAKSI HARIAN OPLSHOP</h3><br>
	<div>
		<button onclick="window.print()">Cetak</button>
	</div>
	<?php
	if (isset($_POST['cari'])) {
		$tanggalawal = date('Y-m-d',strtotime($_POST["tanggalawal"]));
		$tanggalakhir = date('Y-m-d',strtotime($_POST["tanggalakhir"])); ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="tengah">No</th>
					<th class="tengah">No. Transaksi</th>
					<th class="tengah">Nama Pelanggan</th>
					<th class="tengah">Tanggal Transaksi</th>
					<th class="tengah">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php include '../conf/koneksi.php';$nomor = 1 ?>
				<?php $query = mysqli_query($con, "SELECT * FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan WHERE transaksi.tgl_transaksi BETWEEN '$tanggalawal' AND '$tanggalakhir' ORDER BY tgl_transaksi DESC"); ?>
				<?php while ($ambil = mysqli_fetch_assoc($query)) { ?>
				<tr>
					<td class="tengah"><?php echo $nomor; ?></td>
					<td class="tengah"><?php echo $ambil['id_transaksi']; ?></td>
					<td class="tengah"><?php echo $ambil['nama_pelanggan']; ?></td>
					<td class="tengah"><?php echo date('d-m-Y',strtotime($ambil['tgl_transaksi'])); ?></td>
					<td class="tengah">Rp. <?php echo number_format($ambil['subtotal']); ?></td>
				</tr>
				<?php $nomor++ ?>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>
	<div class="tengah">
		Dicetak pada : <?= date('d-m-Y H:i:s'); ?><br>
		Oleh : <?= $user; ?>
	</div>

	<script src="assets/js/jquery-1.10.2.js"></script>
  <script src="assets/js/jquery.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/dataTables/jquery.dataTables.js"></script>
  <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>