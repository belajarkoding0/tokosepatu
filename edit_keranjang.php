<?php

if(isset($_GET['tambah'])){
			include 'conf/koneksi.php';
			session_start();
			$kode = session_id();
			$size = $_GET['size'];
			$tambah = $_GET['tambah'];

	$query = mysqli_query($con, "SELECT * FROM keranjang WHERE id_keranjang='$kode' AND id_barang='$tambah' AND ukuran='$size'");
	$result = mysqli_fetch_array($query)	;

	$jumlah = $result['jumlah'] + 1;
	$berat = $result['berat'] * $jumlah;
	$subtotal = $result['subtotal'] + $result['harga'];

	$query = mysqli_query($con, "UPDATE keranjang SET
					jumlah='$jumlah',
					subtotal='$subtotal',
					subberat = '$berat'
					WHERE id_keranjang='$kode' AND id_barang='$tambah' AND ukuran='$size'");

	header("location:keranjang.php");

}

?>


<?php

if(isset($_GET['kurang'])){
			include 'conf/koneksi.php';
			session_start();
			$kode = session_id();
			$size = $_GET['size'];
			$kurang=$_GET['kurang'];

	$query = mysqli_query($con, "SELECT * FROM keranjang WHERE id_keranjang = '$kode' AND id_barang = '$kurang' AND ukuran='$size'");
	$result = mysqli_fetch_array($query)	;


	if ($result['jumlah'] <= 1 ){

		mysqli_query($con, "DELETE FROM keranjang WHERE id_keranjang='$kode' AND id_barang ='$kurang' AND ukuran='$size'");
		header("location:keranjang.php");
	}
	else{

	$jumlah = $result['jumlah'] - 1 ;
	$berat = $result['berat'] * $jumlah;
	$subtotal = $result['subtotal'] - $result['harga'];

	$query = mysqli_query($con, "UPDATE keranjang SET
					jumlah = '$jumlah',
					subtotal = '$subtotal',
					subberat = '$berat'
					WHERE id_keranjang = '$kode' AND id_barang = '$kurang' AND ukuran='$size'");

	header("location:keranjang.php");
	}
}

?>




<?php

if(isset($_GET['hapus'])){
			include 'conf/koneksi.php';
			session_start();
			$kode = session_id();
			$size = $_GET['size'];
			$hapus=$_GET['hapus'];

	mysqli_query($con, "DELETE FROM keranjang WHERE id_keranjang = '$kode' AND id_barang = '$hapus' AND ukuran='$size'");
	header("location:keranjang.php");

}

?>
