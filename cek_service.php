<?php

  $asal = 152;
  $id_kabupaten = $_POST['kab_id'];
  $kurir = $_POST['kurir'];
  $berat = $_POST['berat'];

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
      "key: 7445298c644e837530aad1a5b2638f15"
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
echo "<option value=''>-- Pilih Service --</option>";
$data2 = $data['rajaongkir']['results'];
// echo print_r($data);
if (!empty($data2)) {
  foreach ($data2 as $d) {
    foreach ($d['costs'] as $dc) {
      foreach ($dc['cost'] as $dcc) {
        echo "<option value='".$dc['service']."'>".strtoupper($dc['service'])."</option>";
      }
    }
  }
}
?>
