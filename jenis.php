<?php
	$kat = $_GET['kategori'];
	$jenis = $_GET['jenis'];
	$dataPerHalaman = 12;
	$query = mysqli_query($con, "SELECT * FROM barang
		WHERE barang.`id_kategori` = '$kat'
		AND barang.`id_jenis` = '$jenis'");
	$jumlahData = mysqli_num_rows($query);
	$jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
	$halamanAktif = (isset($_GET['p'])) ? $_GET['p'] : 1;
	$awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;
	$query = mysqli_query($con, "SELECT * FROM barang
							JOIN kategori ON kategori.`id_kategori` = barang.`id_kategori`
							JOIN jenis ON jenis.`id_jenis` = barang.`id_jenis`
							WHERE barang.`id_kategori` = '$kat'
							AND barang.`id_jenis` = '$jenis' LIMIT $awalData,$dataPerHalaman");
?>
<div class="col-sm-12">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
			<li class="breadcrumb-item"><a href="#">Produk</a></li>
			<?php $queryJenis = mysqli_query ($con, "SELECT * FROM kategori
			JOIN jenis ON jenis.`id_kategori` = kategori.`id_kategori`
			WHERE kategori.`id_kategori` = '$kat' AND jenis.`id_jenis` = '$jenis'"); ?>
			<?php while ($resultJenis = mysqli_fetch_assoc($queryJenis)){ ?>
			<li class="breadcrumb-item"><a href="#"><?= $resultJenis['nama_kategori'] ?></a></li>
			<li class="breadcrumb-item active"><?= $resultJenis['jenis_sepatu'] ?></li>
			<?php } ?>
	  </ol>
	</nav>
</div>
<div class="container">
	<div class="row">
		<?php if (mysqli_num_rows($query) > 0) { ?>
			<?php while ($result = mysqli_fetch_assoc($query)) {?>
				<div class="col-sm-3">
					<a style="text-decoration: none;" href="detail_produk.php?id=<?= $result['id_barang'] ?>">
					    <div class="thumbnail">
					      <img height="200px" src="img/<?= $result['gambar']?>" alt="<?=$result['gambar'] ?>">
					      <div class="caption text-center">
					        <h3 class="nama_barang"><?= $result['nama_barang'] ?></h3>
					        <p class="harga">Rp. <?=number_format(($result['harga']),0,",",".")?></p>
					      </div>
					    </div>
					</a>
				</div>
			<?php } ?>
		<?php }else { ?>
			<div class="col-md-12">
				<div class="text-center">
					<p class="font-weight-bold"  style="font-size: 18px">Mohon Maaf, Produk Tidak Tersedia</p>
				</div>
			</div>
		<?php } ?>
		<div class="col-md-12">
			<div class="text-center">
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">

					<!-- PREVIOUS -->
					<?php if ($halamanAktif == 1): ?>
						<li class="page-item disabled">
							<a class="page-link" tabindex="-1">Previous</a>
						</li>
					<?php else: ?>
						<li class="page-item">
							<a class="page-link" href="?halaman=jenis&jenis=<?= $jenis ?>&kategori=<?= $kat ?>&p=<?= $halamanAktif - 1 ?>" tabindex="-1">Previous</a>
						</li>
					<?php endif; ?>
					<!-- END PREVIOUS -->

					<!-- PAGE -->
					<?php for ($i=1; $i <= $jumlahHalaman; $i++) : ?>
						<?php if ($i == $halamanAktif): ?>
							<li class="page-item disabled" style="font-weight: bold;">
								<a class="page-link"><?= $i; ?></a>
							</li>
						<?php else: ?>
							<li class="page-item">
								<a class="page-link" href="?halaman=jenis&jenis=<?= $jenis ?>&kategori=<?= $kat ?>&p=<?= $i; ?>"><?= $i; ?></a>
							</li>
						<?php endif; ?>
					<?php endfor; ?>
					<!-- END PAGE -->

					<!-- NEXT -->
					<?php if ($halamanAktif < $jumlahHalaman): ?>
						<li class="page-item">
							<a class="page-link" href="?halaman=jenis&jenis=<?= $jenis ?>&kategori=<?= $kat ?>&p=<?= $halamanAktif + 1 ?>" tabindex="-1">Next</a>
						</li>
					<?php else: ?>
						<li class="page-item disabled">
							<a class="page-link" tabindex="-1">Next</a>
						</li>
					<?php endif; ?>
					<!-- END NEXT -->
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
