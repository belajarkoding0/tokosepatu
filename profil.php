<?php
session_start();
include 'conf/koneksi.php';
$kode = session_id();
if (ISSET($_SESSION['pelanggan']))
{
	// echo "<script>alert('Anda Berhasil Login !!')</script>";
}
else
	header("location:daftar.php");
  include 'header.php';
  include 'nav.php';
?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
						<li class="breadcrumb-item active">Profil</li>
					</ol>
				</nav>
			</div>
		</div>
  </div>
</div>

<?php include 'footer.php'; ?>