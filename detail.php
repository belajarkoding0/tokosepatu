<?php
  session_start();
  $id_trans = $_GET['id'];
  include 'conf/koneksi.php';
  if (ISSET($_SESSION['pelanggan']))
  {
    // echo "<script>alert('Anda Berhasil Login !!')</script>";
  }
  else
    header("location:login.php");
  include 'header.php';
  include 'nav.php';
  $kodeunik = rand(3,199);
?>
<div id="content">
<div class="container">
  <div class="row">
    <div class="col">
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
					<li class="breadcrumb-item active">Detail</li>
			  </ol>
			</nav>
		</div>
    <?php
      $queryInv = mysqli_query($con, "SELECT * FROM transaksi JOIN pelanggan
                  ON transaksi.id_pelanggan = pelanggan.id_pelanggan
                  WHERE transaksi.id_transaksi = '$id_trans'");
      $resultInv = mysqli_fetch_assoc($queryInv);
      $date = $resultInv['tgl_transaksi'];
      $tahun = substr($date, 0,4);
      $bulan = substr($date, 5,2);
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
    <div class="col col-md-12">
      <div class="col col-md-6">
        <h1>Detail Transaksi</h1>
      </div>
      <div class="col col-md-6 kanan" style="margin: 20px 0 10px 0;">
        <p> <a href="invoice.php?id=<?=$resultInv['id_transaksi']?>"> <img src="img/cetak.png" alt="" width=5%> </a> Cetak</p>
      </div>
    </div>
    <hr>
    <div class="col col-md-4">
      <h3>Transaksi</h3>
      <table>
        <tbody>
          <tr>
            <td>No. Transaksi</td>
            <td>&nbsp:</td>
            <td>&nbsp<?=$resultInv['id_transaksi']?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>&nbsp:</td>
            <td>&nbsp<?="$tanggal $bulanx $tahun"?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col col-md-4">
      <h3>Pelanggan</h3>
      <table>
        <tbody>
          <tr>
            <td><?=$resultInv['nama_pelanggan']?></td>
          </tr>
          <tr>
            <td><?=$resultInv['email']?></td>
          </tr>
          <tr>
            <td><?=$resultInv['no_telepon']?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col col-md-4">
      <h3>Tujuan Pengiriman</h3>
      <table>
        <tbody>
          <tr>
            <td><?=$resultInv['nm_penerima']?></td>
          </tr>
          <tr>
            <td><?=$resultInv['alamat_pengiriman'].' '.$resultInv['kode_pos']?></td>
          </tr>
          <tr>
            <td><?=$resultInv['kota'].' '.$resultInv['provinsi']?></td>
          </tr>
          <tr>
            <td><?=$resultInv['no_tlp']?></td>
          </tr>
        </tbody>
      </table><br><br>
    </div>
    <?php
      $queryDetail = mysqli_query($con, "SELECT * FROM detail_transaksi
                  JOIN barang ON detail_transaksi.id_barang = barang.id_barang
                  WHERE detail_transaksi.id_transaksi = '$id_trans'");

    ?>
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="kiri">Nama Barang</th>
          <th scope="col" class="tengah">Size</th>
          <th scope="col" class="tengah">Jumlah</th>
          <th scope="col" class="kanan">Harga Barang</th>
          <th scope="col" class="kanan">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($resultDetail = mysqli_fetch_assoc($queryDetail)) : ?>
        <tr>
          <td><?= $resultDetail["nama_barang"]; ?></td>
          <td class="tengah"><?= $resultDetail['size']; ?></td>
          <td class="tengah"><?= $resultDetail['jumlah']; ?></td>
          <td class="kanan">Rp <?= number_format($resultDetail['harga']); ?></td>
          <td class="kanan">Rp <?= number_format($resultDetail['subtotal']); ?></td>
        </tr>
      <?php endwhile; ?>
        <tr>
          <?php $subtotal = $resultInv['subtotal'] ?>
          <th colspan="4" class="kanan">Biaya Kirim</th>
          <td class="kanan tebal">Rp. <?= number_format($resultInv['ongkir']) ?></td>
        </tr>
        <tr>
          <?php $subtotal = $resultInv['subtotal'] ?>
          <th colspan="4" class="kanan">Subtotal</th>
          <td class="kanan tebal">Rp. <?= number_format($subtotal) ?></td>
        </tr>
      </tbody>
    </table>
    <br>
      <div class="col-sm-6 col-sm-soffset-3">
        <span><p class="text-scenter">Silahkan lakukan pembayaran ke rekening dibawah ini</p></span>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="tengah">No</th>
              <th class="tengah">Bank</th>
              <th class="col col-xs-3 tengah">No. Rekening</th>
              <th class="tengah">Atas Nama</th>
            </tr>
          </thead>
          <tbody>
          <?php $nomor = 1 ?>
          <?php $queryBank = mysqli_query($con, "SELECT * FROM bank") ?>
          <?php while ($resultBank = mysqli_fetch_assoc($queryBank)) : ?>
            <tr>
              <td class="col col-sm-1 col-xs-1 tengah"><?php echo $nomor; ?></td>
              <td class="col col-sm-3 col-xs-1 tengah"><img src="img/bank/<?= $resultBank['logo']?>" alt="<?= $resultBank['nama_bank']?>" width="90%" height="20%"></td>
              <td class="col col-sm-3 col-xs-2 tengah"><?= $resultBank['no_rek']?></td>
              <td class="col col-sm-3 col-xs-2 tengah"><?= $resultBank['atas_nama']?></td>
            </tr>
            <?php $nomor++ ?>
          <?php endwhile ?>
          </tbody>
        </table>
        <div class="text-scenter">
          <p>Jika sudah melakukan pembayaran, silahkan klik <a href="riwayat.php">disini</a> untuk konfirmasi</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
