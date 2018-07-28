<h2> Data Pelanggan </h2>
<!-- <br>
<a href="index.php?halaman=tambahpelanggan" class="btn btn-primary">Tambah Pelanggan</a>
<br><br> -->
<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="dataTables-example">
				<thead>
					<tr>
						<th class="tengah">No</th>
						<th class="tengah">No. ID</th>
						<th class="tengah">Nama Lengkap</th>
						<th class="tengah">Jenis Kelamin</th>
						<th class="tengah">Tanggal Lahir</th>
						<th class="tengah">No. Telepon</th>
						<th class="tengah">E-mail</th>
						<th class="tengah">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1 ?>
					<?php $query = mysqli_query($con, "SELECT * FROM pelanggan"); ?>
					<?php while ( $ambil = mysqli_fetch_assoc($query)) { ?>
					<tr>
						<td class="tengah"><?php echo $nomor; ?></td>
						<td class="tengah"><?php echo $ambil['id_pelanggan']; ?></td>
						<td class="tengah"><?php echo $ambil['nama_pelanggan']; ?></td>
						<td class="tengah"><?php echo $ambil['jenis_kelamin']; ?></td>
						<td class="tengah"><?php echo date('d-m-Y',strtotime($ambil['tgl_lahir'])); ?></td>
						<td class="tengah"><?php echo $ambil['no_telepon']; ?></td>
						<td class="tengah"><?php echo $ambil['email']; ?></td>
						<td class="tengah">
							<a href="index.php?halaman=hapuspelanggan&id=<?php echo $ambil['id_pelanggan']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PELANGGAN INI ?')">hapus</a>
						</td>
					</tr>
					<?php $nomor++ ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
 	</div>
</div>
