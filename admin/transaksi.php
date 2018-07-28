<h2> Data Transaksi </h2>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="dataTables-example">
				<thead>
					<tr>
						<th class="tengah">No</th>
						<th class="tengah">No. Transaksi</th>
						<th class="tengah">Nama Pelanggan</th>
						<th class="tengah">Tanggal Transaksi</th>
						<th class="tengah">Total</th>
						<th class="tengah">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1 ?>
					<?php $query = mysqli_query($con, "SELECT * FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan ORDER BY tgl_transaksi DESC"); ?>
					<?php while ($ambil = mysqli_fetch_assoc($query)) { ?>
					<tr>
						<td class="tengah"><?php echo $nomor; ?></td>
						<td class="tengah"><?php echo $ambil['id_transaksi']; ?></td>
						<td class="tengah"><?php echo $ambil['nama_pelanggan']; ?></td>
						<td class="tengah"><?php echo date('d-m-Y',strtotime($ambil['tgl_transaksi'])); ?></td>
						<td class="tengah">Rp. <?php echo number_format($ambil['subtotal']); ?></td>
						<td class="tengah">
							<a href="index.php?halaman=detail&id=<?php echo $ambil['id_transaksi']; ?>" class="btn btn-info btn-xs">detail</a>
						</td>
					</tr>
					<?php $nomor++ ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
 	</div>
</div>
