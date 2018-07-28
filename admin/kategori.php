<h2> Kategori </h2>

<a href="index.php?halaman=tambahkategori" class="btn btn-primary">Tambah Kategori</a>
<br><br>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="dataTables-example">
				<thead>
					<tr>
						<th class="tengah">No</th>
						<th class="tengah">Kode Kategori</th>
						<th class="tengah">Kategori</th>
						<th class="tengah">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1 ?>
					<?php $query = mysqli_query($con, "SELECT * FROM kategori"); ?>
					<?php while ( $ambil = mysqli_fetch_assoc($query)) { ?>
					<tr>
						<td class="tengah"><?php echo $nomor; ?></td>
						<td class="tengah"><?php echo $ambil['id_kategori']; ?></td>
						<td class="tengah"><?php echo $ambil['nama_kategori']; ?></td>
						<td class="tengah">
							<a href="index.php?halaman=ubahkategori&id=<?php echo $ambil['id_kategori']; ?>" class="btn btn-xs btn-primary">Ubah</a>
							<a href="index.php?halaman=hapuskategori&id=<?php echo $ambil['id_kategori']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS KATEGORI INI ?')">hapus</a>
						</td>
					</tr>
					<?php $nomor++ ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
 	</div>
</div>
