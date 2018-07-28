<?php
  include 'conf/koneksi.php';
  if (isset($_POST['batal'])){
  $id_trans = $_POST['notrans'];
  $status = 0;
  $queryDet = mysqli_query($con, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$id_trans'");
  while ($resultDet = mysqli_fetch_assoc($queryDet)){;
  
  $queryBarang = mysqli_query($con, "SELECT * FROM stok WHERE id_barang = '$resultDet[id_barang]' AND ukuran = '$resultDet[size]'");
  $resultBarang = mysqli_fetch_assoc($queryBarang);
  $stokBarang = $resultBarang['stok'] + $resultDet['jumlah'];
  $updateBarang = mysqli_query($con, "UPDATE stok SET stok = $stokBarang WHERE id_barang = '$resultDet[id_barang]' AND ukuran = '$resultDet[size]'");

  $updateStatus = mysqli_query($con, "UPDATE transaksi SET status='$status' WHERE id_transaksi = '$id_trans'");
  echo "<script>alert('Pembatalan Transaksi Berhasil');</script>";
  echo "<script>location='riwayat.php';</script>";
  }
}