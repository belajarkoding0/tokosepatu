<h2> Pembayaran Sudah Dikonfirmasi </h2>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="dataTables-example">
				<thead>
					<tr>
						<th class="tengah">No</th>
						<th class="tengah">No. Transaksi</th>
						<th class="tengah">Nama Pelanggan</th>
						<th class="tengah">Tgl Transaksi</th>
						<!-- <th class="tengah">Total</th> -->
						<th class="tengah">Status</th>
						<th class="tengah">Resi</th>
						<th class="tengah">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1 ?>
					<?php $query = mysqli_query($con, "SELECT * FROM transaksi 
					JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
					JOIN konfirmasi ON konfirmasi.id_transaksi = transaksi.id_transaksi"); ?>
					<?php while ($ambil = mysqli_fetch_assoc($query)) { ?>
					<?php switch ($ambil['status']) {
	                  case '0': $status = "Transaksi Dibatalkan"; break;
	                  case '1': $status = "Menunggu Proses Pembayaran"; break;
	                  case '2': $status = "Menunggu Pembayaran Diverifikasi"; break;
	                  case '3': $status = "Pembayaran Sudah Diverifikasi"; break;
	                  case '4': $status = "Pesanan sudah dikirim"; break;
	                } ?>
					<tr>
						<td class="tengah"><?php echo $nomor; ?></td>
						<td class="tengah"><?php echo $ambil['id_transaksi']; ?></td>
						<td class="tengah"><?php echo $ambil['nama_pelanggan']; ?></td>
						<td class="tengah"><?php echo date('d-m-Y',strtotime($ambil['tgl_transaksi'])); ?></td>
						<!-- <td class="tengah">Rp. <?php echo number_format($ambil['subtotal']); ?></td> -->
						<td class="tengah"><?php echo $status ?></td>
						<td class="tengah" width="20%"><?php echo $ambil['resi']; ?></td>
						<td class="tengah">
							<!-- <a href="index.php?halaman=detail&id=<?php echo $ambil['id_transaksi']; ?>" class="btn btn-info btn-xs">detail</a> -->
							<a class="btn btn-default btn-xs" data-toggle="modal" data-target="#lihat_<?= $ambil['id_transaksi']; ?>">lihat</a>
							<?php $i=2; if ($ambil['status'] < $i OR $ambil['status'] > $i): ?>
							<a class="btn btn-primary btn-xs" disabled data-toggle="modal" data-target="#lihat_<?= $ambil['id_transaksi']; ?>">acc</a>
							<?php if ($ambil['resi'] == true) { ?>
								<a class="btn btn-success btn-xs" disabled href="index.php?halaman=resi&id=<?php echo $ambil['id_transaksi']; ?>">update</a>	
							<?php } else{?>
							<a class="btn btn-success btn-xs" href="index.php?halaman=resi&id=<?php echo $ambil['id_transaksi']; ?>">update</a>
								<?php } ?>
							<?php else: ?>
							<a class="btn btn-primary btn-xs" href="ubahstatus.php?id=<?php echo $ambil['id_transaksi']; ?>">acc</a>
							<a class="btn btn-success btn-xs" disabled href="resi.php?id=<?php echo $ambil['id_transaksi']; ?>">update</a>
							<?php endif ?>
						</td>
					</tr>
					<div class="modal fade" id="lihat_<?= $ambil['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title biru2" id="myModalLabel">ID Transaksi : <?php echo $ambil['id_transaksi']; ?></h4>
						  </div>
						  <div class="modal-body">
						  
						  <div class="row">
						  <div class="col-md-8 col-md-offset-2">
							
							  <img class="img-responsive" src="../img/konfirmasi/<?php echo $ambil['bukti_bayar']; ?>">
							
						  </div>
							</div>
										
						  </div>
						  <div class="modal-footer">
							
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						  </div>
							
					  </div>
					</div>				
					</div>
					<?php $nomor++ ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
 	</div>
</div>