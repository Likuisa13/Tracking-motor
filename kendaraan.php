<!DOCTYPE html>
<html>
<?php include_once 'template/head.php'; ?>
<body>
	<?php include_once 'template/nav.php'; ?>
	<?php include_once 'template/sidebar.php'; ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Kendaraan</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Kendaraan</h1>
				<div class="panel">
					<div class="panel-body container-fluid">
						<button class="btn btn-sm btn-primary"><i class="fa fa-plus"> Tambah</i></button>
						<br><br>
						<table class="table table-striped">
							<thead style="background-color: #1E90FF; color:white;" class="text-center">
								<th>No</th>
								<th>Merk</th>
								<th>Plat Nomor</th>
								<th>Pengguna</th>
								<th>Aksi</th>
							</thead>
							<tbody>
								<?php 
								include_once 'config/dao.php';
								$dao = new Dao();
								$result = $dao->view('kendaraan');
								$no = 1;
								foreach ($result as $value) { ?>
									<tr>
										<td><?php echo $no; $no++; ?></td>
										<td><?php echo $value['merk'] ?></td>
										<td><?php echo $value['plat_nomor'] ?></td>
										<td><?php echo $value['pengguna'] ?></td>
										<td nowrap="">
											<button class="btn btn-sm btn-warning"><i class="fa fa-edit"> Edit</i></button>
											<button class="btn btn-sm btn-danger"><i class="fa fa-edit"> Delete</i></button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once 'template/js.php'; ?>	
</body>
</html>