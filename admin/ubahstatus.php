<?php
  include '../conf/koneksi.php';
  $id_trans = $_GET['id'];
  $queryTrx = mysqli_query($con,"SELECT * FROM transaksi WHERE id_transaksi = '$id_trans'");
  while ($resultTrx = mysqli_fetch_assoc($queryTrx)){;
  $status = $resultTrx['status']+1;
  // $queryBarang = mysqli_query($con, "SELECT * FROM barang WHERE id_barang = '$resultDet[id_barang]'");
  // $resultBarang = mysqli_fetch_assoc($queryBarang);
  // $stokBarang = $resultBarang['stok'] + $resultDet['jumlah'];
  // $updateBarang = mysqli_query($con, "UPDATE barang SET stok = $stokBarang WHERE id_barang = '$resultDet[id_barang]'");

  $updateStatus = mysqli_query($con, "UPDATE transaksi SET status='$status' WHERE id_transaksi = '$id_trans'");
  // echo "<script>alert('Pembatalan Transaksi Berhasil');</script>";
  echo "<script>location='index.php?halaman=konfirmasi';</script>";
  }
?>