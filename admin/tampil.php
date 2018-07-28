<?php
include '../conf/koneksi.php';
?>
<table class="table table-bordered text-center">
	<thead class="thead-dark text-center">
		<tr>
			<th class="text-center" scope="col">Ukuran</th>
			<th class="text-center" scope="col">Stok</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$queryTmp = mysqli_query($con,"SELECT * FROM tmp_brg");
			while ($resultTmp = mysqli_fetch_assoc($queryTmp)) {
		?>
		<tr>
			<td><?= $resultTmp['ukuran'] ?></td>
			<td><?= $resultTmp['stok'] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>