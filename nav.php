<?php
include 'conf/koneksi.php';
$kode = session_id();
$query = mysqli_query($con, "SELECT * FROM keranjang WHERE id_keranjang='$kode'");
$isiKeranjang = mysqli_num_rows($query);
//include 'header.php';
?>
<?php if (ISSET($_SESSION['pelanggan'])) { ?>
<div id="nav">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">OplShop</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a class="" href="http://localhost/tokosepatu"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a>
					</li>
				</ul>
				<ul class="nav navbar-nav">
					<?php 
						$queryKat = mysqli_query($con, "SELECT * FROM kategori");
						while ($resultKat = mysqli_fetch_assoc($queryKat)) { 
					?>
					<li class="dropdown">
						<a id="dLabel" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&nbsp<?= $resultKat['nama_kategori'] ?> <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li>
								<a tabindex="-1" href="index.php?halaman=kategori&kategori=<?=$resultKat['id_kategori'];?>">All</a>
							</li>
							<?php 
								$queryJenis = mysqli_query($con, "SELECT * FROM jenis WHERE jenis.id_kategori = '$resultKat[id_kategori]'");
								while ($ambil = mysqli_fetch_assoc($queryJenis)) {
							?>
						    <li>
						    	<a tabindex="-1" href="index.php?halaman=jenis&jenis=<?=$ambil['id_jenis'];?>&kategori=<?=$resultKat['id_kategori'];?>"><?=$ambil['jenis_sepatu'] ?></a>
						    </li>
							<?php } ?>
						 </ul>
					<?php } ?>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left">
						<div class="input-group">
							<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</form>
					<li>
						<a href="keranjang.php">
							<?php if ($isiKeranjang): ?>
								<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>&nbsp<?= $isiKeranjang; ?>
							<?php else: ?>
								<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
							<?php endif ?>
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<?php $user = mysqli_query($con, "SELECT * FROM pelanggan WHERE id_pelanggan = '$_SESSION[pelanggan]'");
							while ($auserLogin = mysqli_fetch_assoc($user)) { ?>
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								Hi, <?php echo strtoupper($auserLogin['nama_pelanggan']); ?>
							<?php }?>
						</a>
						<ul class="dropdown-menu">
							<li><a href="profil.php">Profil Saya</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="riwayat.php">Transaksi</a></li>
							<li role="separator" class="divider"></li>
							<!-- <li><a href="#">Pengaturan</a></li> -->
							<!-- <li><a href="konfirmasi.php">Konfirmasi</a></li> -->
							<!-- <li role="separator" class="divider"></li> -->
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</div>
<?php } else {?>
<div id="nav">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand">OplShop</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
				<ul class="nav navbar-nav">
					<li>
						<a class="" href="http://localhost/tokosepatu"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbspHome</a>
					</li>
				</ul>
				<ul class="nav navbar-nav">
					<?php 
						$queryKat = mysqli_query($con, "SELECT * FROM kategori");
						while ($resultKat = mysqli_fetch_assoc($queryKat)) { 
					?>
					<li class="dropdown">
						<a id="dLabel" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">&nbsp<?= $resultKat['nama_kategori'] ?> <span class="caret"></span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
							<li>
								<a tabindex="-1" href="index.php?halaman=kategori&kategori=<?=$resultKat['id_kategori'];?>">All</a>
							</li>
							<?php 
								$queryJenis = mysqli_query($con, "SELECT * FROM jenis WHERE jenis.id_kategori = '$resultKat[id_kategori]'");
								while ($ambil = mysqli_fetch_assoc($queryJenis)) {
							?>
						    <li><a tabindex="-1" href="index.php?halaman=jenis&jenis=<?=$ambil['id_jenis'];?>&kategori=<?=$resultKat['id_kategori'];?>"><?=$ambil['jenis_sepatu'] ?></a></li>
							<?php } ?>
						 </ul>
					<?php } ?>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<form class="navbar-form navbar-left">
						<div class="input-group">
							<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</form>
					<li>
						<a href="daftar.php" class="bftn">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbspDaftar
						</a>
					</li>
					<li>
						<a href="login.php" class="bftn">
							<span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbspLogin
						</a>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</div>
<?php } ?>
