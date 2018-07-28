<h2>Jenis Sepatu</h2>

<a href="index.php?halaman=tambahjenis" class="btn btn-primary">Tambah Jenis Sepatu</a>
<br><br>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="dataTables-example">
				<thead>
					<tr>
						<th class="tengah">No</th>
						<th class="tengah">Jenis Sepatu</th>
						<th class="tengah">Kategori</th>
						<th class="tengah">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $nomor = 1 ?>
					<?php $query = mysqli_query($con, "SELECT * FROM jenis JOIN kategori
												ON jenis.id_kategori = kategori.id_kategori"); ?>
					<?php while ( $ambil = mysqli_fetch_assoc($query)) { ?>
					<tr>
						<td class="tengah"><?php echo $nomor; ?></td>
						<td class="tengah"><?php echo $ambil['jenis_sepatu']; ?></td>
						<td class="tengah"><?php echo $ambil['nama_kategori']; ?></td>
						<td class="tengah">
							<a href="index.php?halaman=ubahjenis&id=<?php echo $ambil['id_jenis']; ?>" class="btn btn-xs btn-primary">Ubah</a>
							<a href="index.php?halaman=hapusjenis&id=<?php echo $ambil['id_jenis']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS JENIS SEPATU INI ?')">hapus</a>
						</td>
					</tr>
					<?php $nomor++ ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
 	</div>
</div>
