<?php
  session_start();
  include 'conf/koneksi.php';
  $kode = session_id();
  if (ISSET($_SESSION['pelanggan']))
  {
    // echo "<script>alert('Anda Berhasil Login !!')</script>";
  }
  else
    header("location:login.php");
  include 'header.php';
  include 'nav.php';
  $idpelanggan = $_SESSION['pelanggan'];
?>
<div id="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
  			<nav aria-label="breadcrumb">
  			  <ol class="breadcrumb">
  			    <li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
  					<li class="breadcrumb-item active">Transaksi</li>
  			  </ol>
  			</nav>
  		</div>
      <div class="col-lg-12"><h1>Daftar Transaksi</h1><hr>
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th class="tengah">No.</th>
                  <th class="tengah">No. Transaksi</th>
                  <th class="tengah">Tanggal</th>
                  <th class="tengah">Total</th>
                  <th class="tengah">Status</th>
                  <th class="tengah">Resi</th>
                  <th class="tengah">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $nomor = 1; $queryTransaksi = mysqli_query($con, "SELECT * FROM transaksi WHERE id_pelanggan = '$idpelanggan' ORDER BY tgl_transaksi DESC"); ?>
                <?php while ($resultTransaksi = mysqli_fetch_assoc($queryTransaksi)) { ?>
                <?php switch ($resultTransaksi['status']) {
                  case '0': $status = "Transaksi Dibatalkan"; break;
                  case '1': $status = "Menunggu Proses Pembayaran"; break;
                  case '2': $status = "Menunggu Pembayaran Diverifikasi"; break;
                  case '3': $status = "Pembayaran Sudah Diverifikasi"; break;
                  case '4': $status = "Pesanan sudah dikirim"; break;
                } ?>
                <tr>
                  <td class="tengah"><?= $nomor ?></td>
                  <td class="tengah"><?= $resultTransaksi['id_transaksi'] ?></td>
                  <td class="tengah"><?= $resultTransaksi['tgl_transaksi'] ?></td>
                  <td class="tengah">Rp. <?= number_format($resultTransaksi['subtotal']) ?></td>
                  <td class="tengah"><?= $status ?></td>
                  <td class="tengah"><?= $resultTransaksi['resi'] ?></td>
                  <td class="tengah">
                    <a class="btn btn-info btn-xs" href="detail.php?id=<?=$resultTransaksi['id_transaksi'] ?>">Detail</a>
                    <?php $i=1; if ($resultTransaksi['status'] < $i OR $resultTransaksi['status'] > $i): ?>
                      <a class="btn btn-success btn-xs" disabled >Konfirmasi</a>
                      <a class="btn btn-danger btn-xs" disabled >Batal</a>
                      <?php else: ?>
                      <!-- <a class="btn btn-success btn-xs" href="konfirmasi.php?id=<?=$resultTransaksi['id_transaksi'] ?>">Konfirmasi</a> -->
                      <a class="btn btn-success btn-xs" data-toggle="modal" data-target="#konf_<?=$resultTransaksi['id_transaksi'] ?>">Konfirmasi</a>
                      <!-- <a class="btn btn-danger btn-xs" href="proses_batal.php?id=<?=$resultTransaksi['id_transaksi'] ?>">Batal</a> -->
                      <a class="btn btn-danger btn-xs" data-toggle="modal" data-target="#batal_<?=$resultTransaksi['id_transaksi'] ?>">Batal</a>
                    <?php endif ?>
                    
                  </td>
                </tr>
                <div class="modal fade" id="konf_<?=$resultTransaksi['id_transaksi'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Konfirmasi pembayaran </h4>
                      </div>
                      <div class="modal-body">
                        <form action="proses_konfirmasi.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="NoTransaksi">No. Transaksi</label>
                            <input type="text" disabled class="form-control" required name="notrans" value="<?= $resultTransaksi['id_transaksi'] ?>">
                            <input type="hidden" name="no_trans" value="<?= $resultTransaksi['id_transaksi'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="id">ID Pelanggan</label>
                            <input type="text" disabled class="form-control" name="id" value="<?= $_SESSION['pelanggan'] ?>">
                            <input type="hidden" name="id" value="<?= $_SESSION['pelanggan'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="inputJumlah">Jumlah Tagihan</label>
                            <input type="text" disabled class="form-control" name="tagihan" value="Rp. <?= number_format($resultTransaksi['subtotal']) ?>">
                            <input type="hidden" name="tagihan" value="<?= $resultTransaksi['subtotal'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="inputJumlah">Jumlah Transfer</label>
                            <input type="text" class="form-control" required name="jumlah">
                          </div>
                          <div class="form-group">
                            <label for="gambar">Upload bukti</label>
                            <input type="file" id="gambar" name="gambar" required class="form-control">
                            <span><em>catatan : max size 2MB</em></span>
                          </div>
                          <!-- <div class="form-group">
                            <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
                          </div> -->
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-success" type="submit" name="upload">Simpan</button>
                          </div>
                        </form>  
                      </div>
                    </div>
                  </div>
                </div><!-- modal konfirmasi  -->

                <div class="modal fade" id="batal_<?=$resultTransaksi['id_transaksi'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h5 class="modal-title" id="myModalLabel">Konfirmasi Pembatalan</h5>
                      </div>
                      <div class="modal-body">
                        <form action="proses_batal.php" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="notrans" value="<?= $resultTransaksi['id_transaksi'] ?>">
                          <div class="form-group">
                            <p>Apakah anda yakin akan membatalkan transaksi ini ?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                            <button class="btn btn-sm btn-success" type="submit" name="batal">Simpan</button>
                          </div>
                        </form>  
                      </div>
                    </div>
                  </div>
                </div><!-- modal batal  -->
                <?php $nomor++; } ?>
              </tbody>
            </table>
          </div>
        </div>
  	  </div>
  	</div>
  </div>
</div>
<?php include 'footer.php'; ?>
