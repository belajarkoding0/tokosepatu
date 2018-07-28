<h2>Laporan Transaksi Harian</h2>
<br><br>
<form method="post" enctype="multipart/form-data" action="cetaklaphariantrx.php">
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
		    <label for="nama">Tanggal Awal</label>
		    <input type="date" class="form-control" name="tanggalawal">
		  </div>
		</div>
		<div class="col-md-3">
		  <div class="form-group">
		    <label for="gambar">Tanggal Akhir</label>
		    <input type="date" class="form-control" name="tanggalakhir">
		  </div>
		</div>
		<div class="form-group" style="padding-top: 25px;padding-left: 0">
			<button type="submit" name="cari" class="btn btn-default">Cari</button>
		</div>
	</div>
</form>