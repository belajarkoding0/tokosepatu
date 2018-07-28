<h2> Data Barang </h2>

<a href="index.php?halaman=tambahbarang" class="btn btn-primary">Tambah Barang</a>
<br><br>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="dataTables-example">
				<thead>
					<tr>
						<th class="tengah">No</th>
						<th class="tengah">ID Barang</th>
						<th class="tengah">Nama Barang</th>
						<!-- <th>Kategori</th>
						<th>Jenis Sepatu</th> -->
						<th class="tengah">Harga</th>
						<!-- <th class="tengah" colspan="5">Ukuran - Stok</th> -->

						<th class="tengah">Foto</th>
						<th class="tengah">Deskripsi</th>
						<th class="tengah">Aksi</th>
					</tr>
					<!-- </?php $ukuran = array(37,38,39,40,41);?> -->
					<!-- <tr>
						</?php foreach ($ukuran as $size) { ?>
					  	<th><b></?php echo $size; ?></b></th>
						</?php } ?>
					 </tr> -->
				</thead>
				<tbody>
					<?php $nomor = 1 ?>
					<?php $query = mysqli_query($con, "SELECT * FROM barang
													JOIN stok ON barang.id_barang=stok.id_barang GROUP BY barang.id_barang"); ?>
					<?php while ( $ambil = mysqli_fetch_assoc($query)) { ?>						
					<tr>
						<td class="tengah"><?php echo $nomor; ?></td>
						<td><?php echo $ambil['id_barang']; ?></td>
						<td><?php echo $ambil['nama_barang']; ?></td>
						<td class="tengah">Rp. <?php echo number_format($ambil['harga']); ?></td>
							<!-- </?php foreach ($ukuran as $size) { ?>
								</?php if ($size == $ambil['ukuran']) {
									echo '<td>'.$ambil['stok'].'</td>';
								}else {
									echo '<td>0</td>';
								} ?>
							</?php } ?> -->
						</td>
						<td>
							<img src="../img/<?=$ambil['gambar']; ?>" alt="<?=$ambil['gambar']; ?>" width="100">
						</td>
						<td><?php echo $ambil['deskripsi']; ?></td>
						<td class="tengah">
							<a href="index.php?halaman=ubahbarang&id=<?php echo $ambil['id_barang']; ?>" class="btn btn-xs btn-primary">Ubah</a>
							<a href="index.php?halaman=detailbarang&id=<?php echo $ambil['id_barang']; ?>" class="btn btn-xs btn-default">detail</a><br>
							<a href="index.php?halaman=hapusbarang&id=<?php echo $ambil['id_barang']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PRODUK INI ?')">hapus</a>
						</td>
					</tr>
					<?php $nomor++ ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
 	</div>
</div>
