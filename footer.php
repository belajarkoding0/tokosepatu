	<div id="footer">
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center"><hr>
						<div class="row">
							<div style="color:black;">
								<p>&copy Haffsriyandra Yusuf</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>
</div> <!-- END ID CONTAINER -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="js/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#inputProv').change(function(){

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var prov = $('#inputProv').val();

        $.ajax({
            type : 'GET',
            url : 'http://localhost/tokosepatu/cek_kabupaten.php',
            data :  'prov_id=' + prov,
            success: function (data) {

            //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
            $("#inputKota").html(data);
          }
        });
      });

      $('#kurir').change(function(){

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var kab = $('#inputKota').val();
        var kurir = $('#kurir').val();
        var berat = <?= $berat ?>;
        $.ajax({
            type : 'POST',
            url : 'http://localhost/tokosepatu/cek_service.php',
            data :  {'kab_id' : kab, 'kurir' : kurir, 'berat' : berat},
            success: function (data) {

            //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
            $("#service").html(data);
          }
        });
      });
      
      $('#service').change(function(){

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var kab = $('#inputKota').val();
        var kurir = $('#kurir').val();
        var serv = $('#service').val();
        var berat = <?= $berat ?>;
        var total = <?= $total ?>;

        $.ajax({
            type : 'POST',
            url : 'http://localhost/tokosepatu/cek_deskripsi.php',
            data :  {'kab_id' : kab, 'kurir' : kurir, 'berat' : berat, 'serv' : serv, 'total' : total},
            success: function (data) {

            //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
            $("#deskripsi").html(data);
          }
        });
      });
      $('#ukuran').change(function(){

        //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
        var idukuran = $('#ukuran').val();
        var idbrg = $('#id_barang').val();

        $.ajax({
            type : 'POST',
            url : 'http://localhost/tokosepatu/cek_stok.php',
            data :  {'id_ukuran' : idukuran, 'id_barang' : idbrg},
            success: function (data) {

            //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
            $("#stok").html(data);
          }
        });
      });
    });
  </script>
</body>
</html>
