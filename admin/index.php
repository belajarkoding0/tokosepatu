<?php
  session_start();
  include '../conf/koneksi.php';

  if (!isset($_SESSION['admin'])) {
    echo "<script>location='login.php';</script>";
    exit();
  }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OplShop  ::  Administrator</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <script language="javascript" type="text/javascript" src="assets/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        mode: "exact",
        theme_advanced_toolbar_location : "top",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
        + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
        + "bullist,numlist,outdent,indent",
        theme_advanced_buttons2 : "link,unlink,anchor,image,separator,"
        +"undo,redo,cleanup,code,separator,sub,sup,charmap",
        theme_advanced_buttons3 : "",
        height:"250px",
        width:"600px"
     });
    </script>
  </head>
  <body>
    <div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
          <a class="navbar-brand" href="index.php">Admin</a>
      </div>
      <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
        &nbsp; <a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust">Logout</a>
      </div>
    </nav>
        <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
          <li class="text-center">
            <img src="assets/img/find_user.png" class="user-image img-responsive"/>
          </li>
          <li>
            <a href="index.php"><i class="fa fa-dashboard fa-2x"></i> Home</a>
          </li>
          <li>
            <a href="index.php?halaman=barang"><i class="fa fa-dashboard fa-2x"></i> Barang</a>
          </li>
          <li>
            <a href="index.php?halaman=pelanggan"><i class="fa fa-dashboard fa-2x"></i> Pelanggan</a>
          </li>
	        <li>
            <a href="index.php?halaman=kategori"><i class="fa fa-dashboard fa-2x"></i> Kategori Sepatu</a>
          </li>
          <li>
            <a href="index.php?halaman=jenissepatu"><i class="fa fa-dashboard fa-2x"></i> Jenis Sepatu</a>
          </li>
          <li>
            <a href="index.php?halaman=konfirmasi"><i class="fa fa-dashboard fa-2x"></i> Konfirmasi</a>
          </li>
          <li>
            <a href="index.php?halaman=transaksi"><i class="fa fa-dashboard fa-2x"></i> Transaksi</a>
          </li>
          <li>
            <a href="index.php?halaman=laporan"><i class="fa fa-dashboard fa-2x"></i> Laporan</a>
          </li>
        </ul>
      </div>
    </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
          <div id="page-inner">
            <?php
              if (isset($_GET['halaman'])) {
                if ($_GET['halaman']=='barang') {
                  include 'barang.php';
                }
                elseif ($_GET['halaman']=='pelanggan') {
                  include 'pelanggan.php';
                }
				        elseif ($_GET['halaman']=='kategori') {
                  include 'kategori.php';
                }
                elseif ($_GET['halaman']=='jenissepatu') {
                  include 'jenissepatu.php';
                }
                elseif ($_GET['halaman']=='konfirmasi') {
                  include 'konfirmasi.php';
                }
                elseif ($_GET['halaman']=='laporan') {
                  include 'laporan.php';
                }
                elseif ($_GET['halaman']=='transaksi') {
                  include 'transaksi.php';
                }
                elseif ($_GET['halaman']=='detail') {
                  include 'detail.php';
                }
                elseif ($_GET['halaman']=='tambahbarang') {
                  include 'tambahbarang.php';
                }
                elseif ($_GET['halaman']=='hapusbarang') {
                  include 'hapusbarang.php';
                }
                elseif ($_GET['halaman']=='ubahbarang') {
                  include 'ubahbarang.php';
                }
                elseif ($_GET['halaman']=='detailbarang') {
                  include 'detailbarang.php';
                }
                elseif ($_GET['halaman']=='tambahpelanggan') {
                  include 'tambahpelanggan.php';
                }
                elseif ($_GET['halaman']=='hapuspelanggan') {
                  include 'hapuspelanggan.php';
                }
                elseif ($_GET['halaman']=='hapusstok') {
                  include 'hapusstok.php';
                }
				        elseif ($_GET['halaman']=='tambahkategori') {
                  include 'tambahkategori.php';
                }
                elseif ($_GET['halaman']=='hapuskategori') {
                  include 'hapuskategori.php';
                }
                elseif ($_GET['halaman']=='ubahkategori') {
                  include 'ubahkategori.php';
                }
                elseif ($_GET['halaman']=='tambahjenis') {
                  include 'tambahjenis.php';
                }
                elseif ($_GET['halaman']=='hapusjenis') {
                  include 'hapusjenis.php';
                }
                elseif ($_GET['halaman']=='ubahjenis') {
                  include 'ubahjenis.php';
                }
                elseif ($_GET['halaman']=='resi') {
                  include 'resi.php';
                }
                elseif ($_GET['halaman']=='lap_hari_trx') {
                  include 'lap_hari_trx.php';
                }
                elseif ($_GET['halaman']=='logout') {
                  include 'logout.php';
                }
              }
              else {
                include 'home.php';
              }
            ?>
          </div>
          <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
      </div>
      <!-- /. WRAPPER  -->
      <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
      <!-- JQUERY SCRIPTS -->
      <script src="assets/js/jquery-1.10.2.js"></script>
      <script src="assets/js/jquery.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
      <script src="assets/js/bootstrap.min.js"></script>
      <!-- METISMENU SCRIPTS -->
      <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
      <script src="assets/js/dataTables/jquery.dataTables.js"></script>
      <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <script>
          $(document).ready(function () {
              $('#dataTables-example').dataTable();
          });
      </script>
      <script>
      $(document).ready(function(){
        $("#kategori").change(function(){
          var kategori = $("#kategori").val();
          $.ajax({
            url:"prosesjenis.php",
            data:"kategori=" + kategori,
            success:function(data){
              $("#jenis").html(data);
            }
          });
        });
      });
      </script>
      <script>
      $(document).ready(function(){
        $("#provinsi").change(function(){
          var provinsi = $("#provinsi").val();
          $.ajax({
            url:"prosesprov.php",
            data:"provinsi=" + provinsi,
            success:function(data){
              $("#kabupaten").html(data);
            }
          });
        });
      });
      </script>
      <script type="text/javascript">
      $(document).ready(function(){
        $(".inputTemp").click(function(){
          var data = $('.form-user').serialize();
          $.ajax({
            type: 'POST',
            url: "aksi.php",
            data: data,
            success: function() {
              $('.tampildata').load("tampil.php");
            }
          });
        });
      });
      </script>
      <script type="text/javascript">
      $(document).ready(function(){
        $(".cari").click(function(){
          var data = $('.form-cari').serialize();
          $.ajax({
            type: 'POST',
            url: "aksilap.php",
            data: data,
            success: function() {
              $('.tampildata').load("tampil.php");
            }
          });
        });
      });
      </script>
      <!-- CUSTOM SCRIPTS -->
      <script src="assets/js/custom.js"></script>
    </body>
  </html>
