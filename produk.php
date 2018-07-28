<?php
include 'conf/koneksi.php';
?>
  <div class="container">
    <div class="row">
      <?php
      if (isset($_GET['halaman'])) {
        if ($_GET['halaman']=='kategori') {
          include 'kategori.php';
        }
        if ($_GET['halaman']=='jenis') {
          include 'jenis.php';
        }
      }else {
      ?>
        <!-- AWAL PAGINATION -->
        <?php
          $dataPerHalaman = 12;
          $query = mysqli_query($con, "SELECT * FROM barang");
          $jumlahData = mysqli_num_rows($query);
          $jumlahHalaman = ceil($jumlahData / $dataPerHalaman);
          $halamanAktif = (isset($_GET['p'])) ? $_GET['p'] : 1;
          $awalData = ($dataPerHalaman * $halamanAktif) - $dataPerHalaman;
        ?>
        <!-- AKHIR PAGINATION -->

        <div class="col-sm-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
              <li class="breadcrumb-item"><a href="#">Produk</a></li>
              <li class="breadcrumb-item active">All</li>
            </ol>
          </nav>
        </div>
        <?php
          // QUERY BATASI BARANG UNTUK PAGINATION
          $query = mysqli_query($con, "SELECT * FROM barang LIMIT $awalData,$dataPerHalaman");
        ?>
        <?php
          while ($result = mysqli_fetch_assoc($query)) {
        ?>
          <div class="col-sm-3">
            <a style="text-decoration: none;" href="detail_produk.php?id=<?=$result['id_barang'];?>">
                <div class="thumbnail">
                  <img height="200px" src="img/<?=$result['gambar']?>" alt="<?=$result['gambar']?>">
                  <div class="caption text-center">
                    <h3 class="nama_barang"><?= $result['nama_barang'] ?></h3>
                    <p class="harga">Rp. <?=number_format(($result['harga']),0,",",".")?></p>
                  </div>
                </div>
            </a>
          </div>
          <?php } ?>
          <div class="col-md-12">
            <div class="text-center">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <?php if ($halamanAktif == 1): ?>
                    <li class="page-item disabled">
                      <a class="page-link" tabindex="-1">Previous</a>
                    </li>
                  <?php else: ?>
                    <li class="page-item">
                      <a class="page-link" href="?p=<?= $halamanAktif - 1 ?>" tabindex="-1">Previous</a>
                    </li>
                  <?php endif; ?>
                  <?php for ($i=1; $i <= $jumlahHalaman; $i++) : ?>
                    <?php if ($i == $halamanAktif): ?>
                      <li class="page-item disabled" style="font-weight: bold;"><a class="page-link"><?= $i; ?></a></li>
                    <?php else: ?>
                      <li class="page-item"><a class="page-link" href="?p=<?= $i; ?>"><?= $i; ?></a></li>
                    <?php endif; ?>
                  <?php endfor; ?>
                  <?php if ($halamanAktif < $jumlahHalaman): ?>
                    <li class="page-item">
                      <a class="page-link" href="?p=<?= $halamanAktif + 1 ?>" tabindex="-1">Next</a>
                    </li>
                  <?php else: ?>
                    <li class="page-item disabled">
                      <a class="page-link" tabindex="-1">Next</a>
                    </li>
                  <?php endif; ?>
                </ul>
              </nav>
            </div>
          </div>
      <?php } ?>
    </div>
  </div>
</div>
