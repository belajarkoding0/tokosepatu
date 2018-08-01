<?php
session_start();
include 'conf/koneksi.php';
$idpelanggan = $_SESSION['pelanggan'];
if (ISSET($_SESSION['pelanggan']))
{
	// echo "<script>alert('Anda Berhasil Login !!')</script>";
}
else
	header("location:daftar.php");
  include 'header.php';
	include 'nav.php';
	$errorNama = $errorTel = $errorEmail = $errorPass = $errorPass2 = '';
	$namaStat = $telStat = $mailStat = $pass1Stat = $pass2Stat = true;
	if (isset($_POST['ubah'])):
		$nama = $_POST['nama'];
		$telepon = $_POST['telepon'];
		$email = $_POST['email'];
		$tanggal = date('Y-m-d',strtotime($_POST["tanggal"]));
		$jenkel = $_POST['jenkel'];
		if (strlen($telepon) == 12) {
			$tlp = substr($telepon, 8,11);
		}else {
			$tlp = substr($telepon, 7,11);
		}
		$date = date('ymd');
		$idPel = $date.''.$tlp;
		
		if (empty($nama) || empty($jenkel) || empty($tanggal) || empty($telepon) || empty($email)) {
			echo "<script>alert('data tidak boleh kosong!')</script>";
			echo "<script>location='profil.php';</script>";
		}
		if (is_numeric($nama)) {
			$errorNama = "*nama tidak boleh berisi angka";
			$namaStat = false;
		}
		if (!is_numeric($telepon)) {
			$errorTel = "*harus menggunakan angka";
			$telStat = false;
		}elseif (strlen($telepon) != 12) {
			$errorTel = "*nomor harus 12 digit";
			$telStat = false;
		}
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$errorEmail = "*email tidak valid";
			$mailStat = false;
		}
		
			/*jika email sudah ada/sama, gagal daftar*/
			/*cek email yang sama*/
			$email_sama = mysqli_query($con, "SELECT email FROM pelanggan WHERE email = '$email'");
			$result = mysqli_fetch_assoc($email_sama);
			if ($result) {
				$errorEmail = "email sudah terdaftar";
				$mailStat = false;
			}elseif (!empty($jenkel) AND !empty($tanggal) AND $namaStat AND $telStat AND $mailStat){
			/*jika tidak ada yang sama, berhasil*/
			$update = mysqli_query($con, "UPDATE pelanggan SET nama_pelanggan='$nama', jenis_kelamin='$jenkel', tgl_lahir='$tanggal', no_telepon='$telepon' ,email='$email' WHERE id_pelanggan ='$idpelanggan'");
			echo "<script>alert('Berhasil disimpan')</script>";
			echo "<script>location='profil.php';</script>";
			}
		endif;

		if (isset($_POST['simpan'])):
			$password1 = $_POST['password1'];
			$password2 = $_POST['password2'];
			$passwordHash = password_hash("$password1",PASSWORD_DEFAULT);
			
			if (empty($password1) || empty($password2)) {
				echo "<script>alert('data tidak boleh kosong!')</script>";
				echo "<script>location='profil.php';</script>";
			}
			if (strlen($password1) < '8') {
					$errorPass = "*Password minimal 8 karakter!";
					echo "<script>alert('Gagal! Password minimal 8 karakter')</script>";
					echo "<script>location='profil.php';</script>";
					$pass1Stat = false;
			}elseif(!preg_match("#[0-9]+#",$password1)) {
					$errorPass = "*Password harus ada 1 angka!";
					echo "<script>alert('Gagal! Password harus ada 1 angka')</script>";
					echo "<script>location='profil.php';</script>";
					$pass1Stat = false;
			}elseif(!preg_match("#[A-Z]+#",$password1)) {
					$errorPass = "*Password harus ada 1 huruf kapital!";
					echo "<script>alert('Gagal! Password harus ada 1 huruf kapital')</script>";
					echo "<script>location='profil.php';</script>";
					$pass1Stat = false;
			}elseif(!preg_match("#[a-z]+#",$password1)) {
					$errorPass = "*Password harus ada 1 huruf kecil!";
					echo "<script>alert('Gagal! Password harus ada 1 huruf kecil')</script>";
					echo "<script>location='profil.php';</script>";
					$pass1Stat = false;
			}
				/*cek kesamaan password*/
				if ($password1 !== $password2) {
					$errorPass2 = "Kombinasi password tidak sama";
					echo "<script>alert('Kombinasi password tidak sama')</script>";
					echo "<script>location='profil.php';</script>";
					$pass2Stat = false;
				}elseif ($pass1Stat AND $pass2Stat){
					/*jika tidak ada yang sama, berhasil*/
				$update = mysqli_query($con, "UPDATE pelanggan SET password='$passwordHash' WHERE id_pelanggan ='$idpelanggan'");
				echo "<script>alert('Berhasil disimpan')</script>";
				echo "<script>location='profil.php';</script>";
				}
			// }
			endif
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
		<div class="row">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#biodata" aria-controls="biodata" role="tab" data-toggle="tab">Biodata</a></li>
				<li role="presentation"><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Password</a></li>
			</ul>
		</div>
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="biodata"><br>
				<?php
					$query = mysqli_query($con, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idpelanggan'");
					$result = mysqli_fetch_assoc($query);
				?>
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label for="nama" class="control-label label-daftar">Nama Lengkap</label>
						<div>
							<input type="text" class="form-control" name="nama" value="<?=$result['nama_pelanggan']?>">
							<span class="errors"><?= $errorNama ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="jenkel" class="control-label label-daftar">Jenis Kelamin</label>
						<div>
							<select class="form-control" name="jenkel">
								<option value="">-- Pilih --</option>
								<option value="Laki-Laki" <?php $result['jenis_kelamin'] == "Laki-laki" ? print "selected" : "" ;?>>Laki-laki</option>
								<option value="Perempuan" <?php $result['jenis_kelamin'] == "Perempuan" ? print "selected" : "" ;?>>Perempuan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="tanggal" class="control-label label-daftar">Tanggal Lahir</label>
						<div>
							<input type="date" class="form-control" name="tanggal" value="<?=$result['tgl_lahir']?>">
						</div>
					</div>
					<div class="form-group">
						<label for="telepon" class="control-label label-daftar">Telepon</label>
						<div>
							<input type="text" class="form-control" min="1" name="telepon" value="<?=$result['no_telepon']?>">
							<span class="errors"><?= $errorTel ?></span>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="control-label label-daftar">Email</label>
						<div>
							<input type="text" class="form-control" name="email" value="<?=$result['email']?>">
							<span class="errors"><?= $errorEmail ?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" name="ubah" class="btn btn-primary btn-md">Ubah</button>
						</div>
					</div>
				</form>
			</div>
			<div role="tabpanel" class="tab-pane" id="password">
				<form class="form-horizontal" action="" method="post">
					<div class="form-group">
						<label for="password1" class="control-label label-daftar">Password Baru</label>
						<div>
							<input type="text" class="form-control" name="password1">
							<span class="errors"><?= $errorPass ?></span>
							<span style="font-style:italic;">Perhatikan a-z,A-Z,0-9 dan minimal 8 karakter</span>
						</div>
					</div>
					<div class="form-group">
						<label for="password2" class="control-label label-daftar">Konfirmasi Password</label>
						<div>
							<input type="text" class="form-control" name="password2">
							<span class="errors"><?= $errorPass2 ?></span>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<button type="submit" name="simpan" class="btn btn-primary btn-md">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
  </div>
</div>

<?php include 'footer.php'; ?>