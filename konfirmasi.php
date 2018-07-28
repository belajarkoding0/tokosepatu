<?php
session_start();
include 'header.php';
$idtrans = $_GET['id'];
if (ISSET($_SESSION['pelanggan']))
{
// echo "<script>alert('Anda Berhasil Login !!')</script>";
}
else
header("location:login.php");
?>
<?php include 'nav.php'; ?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
						<li class="breadcrumb-item active">Konfirmasi</li>
					</ol>
				</nav>
			</div>
			<h1>Konfirmasi Pembayaran</h1><hr><br>
			<form action="proses_konfirmasi.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="NoTransaksi">No. Transaksi</label>
					<input type="text" disabled class="form-control" required name="notrans" value="<?= $idtrans ?>">
					<input type="hidden" name="no_trans" value="<?= $idtrans ?>">
				</div>
				<div class="form-group">
					<label for="NoTransaksi">Nama Pelanggan</label>
					<input type="text" disabled class="form-control" name="nama" value="">
					<input type="hidden" name="no_trans" value="<?= $idtrans ?>">
				</div>
				<div class="form-group">
					<label for="inputJumlah">Jumlah Transfer</label>
					<input type="text" class="form-control" required name="jumlah">
				</div>
				<div class="form-group">
					<label for="gambar">Upload bukti</label>
					<input type="file" id="gambar" name="gambar" class="form-control">
					<span><em>catatan : max size 2MB</em></span>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit" name="submit">Simpan</button>
				</div>
			</form>
			</br>
		</div>
	</div>
</div>
<?php include 'footer.php';?>