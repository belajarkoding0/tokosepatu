<?php
	session_start();
	if(isset($_SESSION['pelanggan']))
  	unset($_SESSION['pelanggan']);
  	header("location:index.php");
  	
?>