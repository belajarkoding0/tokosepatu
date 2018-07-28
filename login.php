<?php
	session_start();
	include 'header.php';
	include 'nav.php';
?>
<div id="content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Beranda</a></li>
						<li class="breadcrumb-item active">Login</li>
				  </ol>
				</nav>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-default">
					<div class="panel panel-heading">
						<div class="text-center">
							<h1>Login</h1>
							<span>Belum punya akun? Daftar <a href="daftar.php">di sini</a></span>
						</div>
					</div>
					<div class="panel panel-body">
						<div class="col-sm-10 col-sm-offset-1">
						<form action="proses_login.php" method="post">
							<br>
							<div class="form-group">
								<input type="text" autofocus class="form-control" placeholder="Alamat Email Anda" name="username">
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Kata Sandi" name="password">
							</div>
							<div class="form-group">
								<button type="submit" name="submit" class="btn btn-primary btn-md btn-block">Login</button>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
