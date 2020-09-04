<table class="table table-striped" id="riwayat">
	<thead style="background-color: #1E90FF; color:white;" class="text-center">
		<th><center>No</center></th>
		<th>Waktu</th>
		<th>Motor</th>
		<th>Pengguna</th>
		<th width="300px">Koordinat Awal</th>
		<th>Jarak Dari<br>Koordinat Awal</th>
		<th>Status</th>
		<th></th>
	</thead>
	<tbody>
		<?php 
		include_once 'config/dao.php'; 
		$dao = new Dao();
		$result = $dao->viewHistory();
		$no = 1;
		foreach ($result as $value) { ?>
			<tr>
				<td><?php echo $no; $no++; ?></td>
				<td><?php echo $value['waktu'] ?></td>
				<td><?php echo $value['merk'].' ('.$value['plat_nomor'].')' ?></td>
				<td><?php echo $value['pengguna'] ?></td>
				<td><?php echo $value['nama_lokasi'] ?></td>
				<td><?php echo $value['jarak_now'].' Km' ?></td>
				<?php if ($value['status'] == 'Di Izinkan'): ?>
					<td><span class="badge" style="background-color: blue;"><?php echo $value['status'] ?></span></td>
				<?php endif ?>
				<?php if ($value['status'] == 'Di Larang'): ?>
					<td><span class="badge" style="background-color: red;color:white;"><?php echo $value['status'] ?></span></td>
				<?php endif ?>
				<td><center><a href="detail-history?id=<?=$value['id']?>"><button class="btn btn-link btn-sm"><em class="fa fa-mail-forward">&nbsp;</em>Detail</button></a></center></td>
			</tr>
		<?php } ?>
	</tbody>
</table>

<script>
	$(document).ready(function() {
		$('#riwayat').DataTable();
	} );
</script>