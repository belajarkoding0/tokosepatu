<h2>Laporan</h2>
<br><br>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Pelanggan
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        <a class="btn btn-warning" href="cetakpelanggan.php">Laporan Pelanggan</a>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
         Transaksi Harian
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <form method="post" enctype="multipart/form-data" action="cetaklaphariantrx.php">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
						    <label for="nama">Tanggal Awal</label>
						    <input type="date" class="form-control" name="tanggalawal">
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
						    <label for="gambar">Tanggal Akhir</label>
						    <input type="date" class="form-control" name="tanggalakhir">
						  </div>
						</div>
						<div class="form-group" style="padding-top: 25px;padding-left: 0">
							<button type="submit" name="cari" class="btn btn-default">Cari</button>
						</div>
					</div>
				</form>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Transaksi Bulanan
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
      	<form method="post" enctype="multipart/form-data" action="cetaklapbultrx.php">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
						    <label for="nama">Pilih Bulan</label>
						    <?php $bulan = array(
						    	'01'=>'Januari',
						    	'02'=>'Februari',
						    	'03'=>'Maret',
						    	'04'=>'April',
						    	'05'=>'Mei',
						    	'06'=>'Juni',
						    	'07'=>'Juli',
						    	'08'=>'Agustus',
						    	'09'=>'September',
						    	'10'=>'Oktober',
						    	'11'=>'November',
						    	'12'=>'Desember',
						    );?>
								<select class="form-control" name="bulan" id="bulan">
								<option value="">---</option>
								<?php foreach ($bulan as $key => $isi) { ?>
						      <option value="<?= $key ?>"><?= $isi; ?></option>
								<?php } ?>
						     </select>
						  </div>
						</div>
						<div class="form-group" style="padding-top: 25px;padding-left: 0">
							<button type="submit" name="cari" class="btn btn-default">Cari</button>
						</div>
					</div>
				</form>
      </div>
    </div>
  </div>
</div>