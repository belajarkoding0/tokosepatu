<h2>Detail Transaksi</h2>
<?php include '../conf/koneksi.php'; ?>
<?php
$query = mysqli_query($con, "SELECT * FROM transaksi
	JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan
	-- JOIN ongkir ON transaksi.ongkir = ongkir.ongkir
	WHERE id_transaksi = '$_GET[id]'");
	$detail = mysqli_fetch_assoc($query);
	$date 	= $detail['tgl_transaksi'];
	$tahun 	= substr($date, 0,4);
  	$bulan 	= substr($date, 5,2);
  	$tanggal = substr($date, 8,2);
	switch ($bulan) {
      	case '01': $bulanx = "Januari";	break;
      	case '02': $bulanx = "Februari"; break;
      	case '03': $bulanx = "Maret"; break;
      	case '04': $bulanx = "April"; break;
      	case '05': $bulanx = "Mei"; break;
      	case '06': $bulanx = "Juni"; break;
      	case '07': $bulanx = "Juli"; break;
      	case '08': $bulanx = "Agustus"; break;
      	case '09': $bulanx = "September"; break;
      	case '10': $bulanx = "Oktober"; break;
      	case '11': $bulanx = "November"; break;
      	case '12': $bulanx = "Desember"; break;
    }
?>
<table>
	<thead>
		<th><p>Transaksi</p></th>
	</thead>
	<tbody>
		<tr>
			<td width="100"><strong>Nomor</strong></td>
			<td><?php echo $detail['id_transaksi']; ?></td>
		</tr>
		<tr>
			<td width="100"><strong>Tanggal</strong></td>
			<td><?= "$tanggal $bulanx $tahun" ?></td>
		</tr>
		<!-- <tr>
			<td width="100"><strong>Total</strong></td>
			<td>Rp. <?//php echo number_format($detail['subtotal']); ?></td>
		</tr> -->
	</tbody>
	<thead>
		<th><p>Pelanggan</p></th>
	</thead>
	<tbody>
		<tr>
			<td width="100"><strong>Nama</strong></td>
			<td><?php echo $detail['nama_pelanggan']; ?></td>
		</tr>
		<tr>
			<td width="100"><strong>No. Telepon</strong></td>
			<td><?php echo $detail['no_telepon']; ?></td>
		</tr>
		<tr>
			<td width="100"><strong>E-mail</strong></td>
			<td><?php echo $detail['email']; ?></td>
		</tr>
	</tbody>
	<thead>
		<th width="150"><p>Alamat Pengiriman</p></th>
	</thead>
	<tbody>
		<tr>
			<td width="100"><strong>Penerima</strong></td>
			<td><?php echo $detail['nm_penerima']; ?></td>
		</tr>
		<tr>
			<td width="100"><strong>Alamat</strong></td>
			<td><?php echo $detail['alamat_pengiriman'].' '.$detail['kode_pos']; ?></td>
		</tr>
		<tr>
			<td width="100"><strong>No. Telepon</strong></td>
			<td><?php echo $detail['no_tlp']; ?></td>
		</tr>
		<!-- <tr>
			<td width="100"><strong>Biaya Kirim</strong></td>
			<td>Rp. <//?php echo number_format($detail['ongkir']); ?></td>
		</tr> -->
	</tbody>
</table>
<br><br>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Nama Produk</th>
			<th>Jumlah</th>
			<th>Berat</th>
			<th>Harga</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$subtotal = 0;
		$query = mysqli_query($con, "SELECT * FROM transaksi
			JOIN detail_transaksi ON detail_transaksi.id_transaksi = transaksi.id_transaksi
			JOIN barang ON detail_transaksi.id_barang = barang.id_barang
			-- JOIN ongkir ON detail_transaksi.id_ongkir = ongkir.id_ongkir
			WHERE transaksi.id_transaksi = '$_GET[id]'");
		while ($detail = mysqli_fetch_assoc($query)) {
			$kurir = $detail['kurir'];
			$service = $detail['service'];
			$ongkir = $detail['ongkir'];
			$subtotal = $subtotal + $detail['subtotal'];
		?>
		<tr>
			<td><?php echo $detail['nama_barang']; ?></td>
			<td><?php echo $detail['jumlah']; ?></td>
			<td><?php echo $detail['berat']; ?>gr</td>
			<td>Rp. <?php echo number_format($detail['harga']); ?></td>
			<td>Rp. <?php echo number_format($detail['subtotal']); ?></td>
		</tr>
	<?php } ?>
		<tr>
			<td colspan="2"><strong>Biaya Kirim</strong></td>
			<td><strong><?php echo strtoupper($kurir) ?></strong></td>
			<td><strong><?php echo $service ?></strong></td>
			<td><strong>Rp. <?php echo number_format($ongkir);?></strong></td>
		</tr>
		<tr>
			<td colspan="4"><strong>Sub Total</strong></td>
			<td><strong>Rp. <?php echo number_format($subtotal+$ongkir);?></strong></td>
		</tr>
	</tbody>
</table>
