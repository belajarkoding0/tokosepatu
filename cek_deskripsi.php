<?php

  $asal = 152;
  $id_kabupaten = $_POST['kab_id'];
  $kurir = $_POST['kurir'];
  $berat = $_POST['berat'];
  $serv  = $_POST['serv'];
  $total = $_POST['total'];

  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$id_kabupaten."&weight=".$berat."&courier=".$kurir."",
    CURLOPT_HTTPHEADER => array(
      "content-type: application/x-www-form-urlencoded",
      "key: 77cda9b64f2a6060b77274b1ac47aab1"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $response;
  }

$data = json_decode($response, true);
$data2 = $data['rajaongkir']['results'];
// echo print_r($data);
if (!empty($data2)) {
  foreach ($data2 as $d) {
    foreach ($d['costs'] as $dc) {
      if ($dc['service'] === $serv) {
        foreach ($dc['cost'] as $dcc) {
          echo "<input type='hidden' value='".strtoupper($dc['description'])."' class='form-control' id='desk' name='desk'>";
          echo "<input type='hidden' value='".$dcc['etd']."' class='form-control' id='lama' name='lama'>";
          echo "<input type='hidden' value='".$dcc['value']."' class='form-control' id=biaya name='biaya'>";
          echo "<input type='hidden' value='".$dcc['value']."' id=biaya1 name='biaya1'>";
        }
      }
    }
  }
}
?>
<script>
  $(document).ready(function(){
    var desk = $("#desk").val();
      $("#deskripsi").val(desk);
  });
  $(document).ready(function(){
    var lama = $("#lama").val();
      $("#lamakirim").val(lama);
  });
  $(document).ready(function(){
    var biaya = $("#biaya").val();
    var biaya1 = $("#biaya1").val();
    var total = <?= $total ?>;
    var subtotal = (parseFloat(total) + parseFloat(biaya1));
      $("#tarif").val(biaya);
      $("#total").val(subtotal);
  });
</script> 