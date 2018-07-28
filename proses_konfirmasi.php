<?php
include 'conf/koneksi.php';
if (isset($_POST['upload'])) {
$status = 2;
$id = $_POST['id'];
$idtrans = $_POST['no_trans'];
$jumlah = $_POST['jumlah'];
$tagihan = $_POST['tagihan'];
$error = $_FILES['gambar']['error'];
  if ($jumlah != $tagihan) {
      echo "<script>alert('jumlah tidak sama');</script>";
      echo "<script>location='riwayat.php';</script>";
  }
  elseif ($error === 0 )
  {
    $gambar = $_FILES['gambar']['name'];
    $temp = $_FILES['gambar']['tmp_name'];
    $folder = 'img/konfirmasi';
    move_uploaded_file($temp, "$folder/$gambar");
    $konfirmasi = mysqli_query($con, "INSERT INTO konfirmasi (id_transaksi,id_pelanggan,jumlah_transfer,bukti_bayar) VALUES ('$idtrans','$id','$jumlah','$gambar')");
    $updateStatus = mysqli_query($con, "UPDATE transaksi SET status='$status' WHERE id_transaksi = '$idtrans'");
    echo "<script>alert('Konfirmasi Berhasil');</script>";
    echo "<script>location='riwayat.php';</script>";
  } else
  {
    echo "gagal".$error;
  }
}
?>