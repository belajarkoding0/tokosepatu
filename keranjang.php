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
<?php
  $query = mysqli_query($con, "SELECT * FROM keranjang WHERE id_keranjang='$kode'");
  $hit = mysqli_num_rows($query);
  if ($hit) { ?>
  <div id="content">
		<div class="container">
			<div class="row">
				<div class="col">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
							<li class="breadcrumb-item active">Keranjang</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="text-center">
				<h2>Keranjang Belanja</h2><br>
			</div>
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Nama Barang</th>
						<th scope="col">Size</th>
						<th scope="col">Harga Barang</th>
						<th scope="col">Berat</th>
						<th scope="col">Jumlah</th>
						<th scope="col">Subtotal</th>
            <th colspan="1" scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$nomor = 1;
					$total = 0;
					?>
					<?php $query = mysqli_query($con, "SELECT * FROM keranjang WHERE id_keranjang='$kode'"); ?>
					<?php while ( $result = mysqli_fetch_assoc($query)) { $total  = $total + $result['subtotal']; $berat = $result['berat']; ?>
					<tr>
						<!-- <th scope="row"><?= $nomor; ?></th> -->
						<td class="col-sm-4"><?= $result['nama_barang']; ?></td>
						<td class="col-sm-1"><?= $result['ukuran']; ?></td>
						<td class="col-sm-2">Rp <?= number_format($result['harga']); ?></td>
						<td class="col-sm-1"><?= $berat ?> gr</td>
						<td class="col-sm-2">
							<div class="btn-group-sm" role="group" aria-label="Basic example">
								<a class="btn btn-xs" href="edit_keranjang.php?kurang=<?=$result['id_barang'];?>&size=<?=$result['ukuran'];?>">
									<i class="glyphicon glyphicon-minus"></i>
								</a>
								<?=$result['jumlah'];?>
								<a class="btn btn-xs" href="edit_keranjang.php?tambah=<?=$result['id_barang'];?>&size=<?=$result['ukuran'];?>">
									<i class="glyphicon glyphicon-plus"></i>
								</a>
							</div>
						</td>
						<td class="col-sm-1">Rp <?= number_format($result['subtotal']); ?></td>
            <td class="col-sm-1 text-center	">
              <a class="btn btn-xs" href="edit_keranjang.php?hapus=<?=$result['id_barang'];?>&size=<?=$result['ukuran'];?>">
                <i class="glyphicon glyphicon-remove"></i>
              </a>
            </td>

					</tr>
					<?php $nomor++ ?>
				<?php } ?>
				  <tr style="font-weight: bold;">
					  <td colspan="5">Total</td>
					  <td colspan="2">Rp <?= number_format($total); ?></td>
				  </tr>
			  </tbody>
		  </table>
      <div class="">
        <!-- <button class="col-sm-2 btn btn-primary" name="proses">Lanjutkan Belanja</button>
        <button class="col-sm-2 btn btn-primary" name="proses">Proses</button> -->
        <a href="index.php" class="btn btn-primary">Lanjutkan Belanja</a>
				<a href="checkout.php" class="btn btn-primary">Checkout</a>
      </div>
		</div>
  <?php } else { ?>
		<div class="container">
			<div class="row">
					<div class="col">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
								<li class="breadcrumb-item active">Keranjang</li>
							</ol>
						</nav>
					</div>
					<hr><br>
				<div class="col text-center">
					<h2 class="text-center">Keranjang Belanja Kosong</h2>
					<a href="index.php" class="btn btn-danger text-center">Silahkan Belanja</a>
					<!-- <?//php echo $kode ?> -->
				</div>
				<!-- <div class="container" style="margin-top: 120px;">
					<div class="row">
						<div class="col col-md-12">
							<label for="nama" class="col-form-label" style="font-weight: bold;">Produk Terkait</label>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos, ipsam vitae quasi hic, laborum dolorum similique veniam porro voluptatem. Quam asperiores dolorem velit. Asperiores, recusandae voluptate excepturi laudantium molestiae ab distinctio nesciunt est blanditiis maiores reprehenderit culpa inventore modi, ullam dolor qui dolore placeat labore! Architecto tempora placeat delectus temporibus quas accusamus amet eveniet, tenetur, earum totam. Necessitatibus maxime doloribus quis, similique neque architecto ex soluta eveniet culpa iure modi ipsam eligendi repellat voluptatibus repellendus adipisci deserunt id impedit, accusantium iste dolore cumque et sit voluptates. Unde laboriosam dolorem quisquam, ipsam, sequi illo beatae vel, ducimus commodi architecto libero?</p>
						</div>
					</div>
				</div> -->
				<!-- <hr> -->
			</div>
		</div>
	<?php } ?>
	</div>
<?php include 'footer.php'; ?>
