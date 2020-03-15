<!DOCTYPE html>
<html>
<?php include_once 'template/head.php'; ?>
<script type="text/javascript">
	function add() {
		$('#aksi').val('simpan');
		$('#id_user').val('');
		$('#nama').val('');
		$('#username').val('');
		$('#password').val('');
		$('#tombol').text('Save');
		$('#ModalUser').modal('show');
	}

	function edit(id,nama,username) {
		$('#aksi').val('edit');
		$('#id_user').val(id);
		$('#nama').val(nama);
		$('#username').val(username);
		$('#password').val('');
		$('#tombol').text('Edit');
		$('#ModalUser').modal('show');
	}

</script>
<body>
	<?php include_once 'template/nav.php'; ?>
	<?php include_once 'template/sidebar.php'; ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">User</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">User</h1>
				<div class="panel">
					<div class="panel-body container-fluid">
						<button class="btn btn-sm btn-primary" onclick="add();"><i class="fa fa-plus"></i> Tambah</button>
						<br><br>
						<table class="table table-striped">
							<thead style="background-color: #1E90FF; color:white;" class="text-center">
								<th>No</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Password</th>
								<th>Hak Akses</th>
								<!-- <th>Aksi</th> -->
							</thead>
							<tbody>
								<?php 
								include_once 'config/dao.php';
								$dao = new Dao();
								$result = $dao->view('users');
								$no = 1;
								foreach ($result as $value) { 
									$edit = "'".$value['id']."','".$value['nama']."','".$value['username']."'";
									$delete = "'".$value['id']."','".$value['nama']."'";
									?>
									<tr>
										<td><?php echo $no; $no++; ?></td>
										<td><?php echo $value['nama'] ?></td>
										<td><?php echo $value['username'] ?></td>
										<td><?php echo $value['password'] ?></td>
										<!-- <td><?php echo $value['roles'] ?></td> -->
										<td nowrap="">
											<button class="btn btn-sm btn-warning" onclick="edit(<?php echo $edit ?>);"><i class="fa fa-edit"></i> Edit</button>
											<button class="btn btn-sm btn-danger"><i class="fa fa-edit"></i> Delete</button>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>

	<!-- Modal -->
	<div class="modal fade" id="ModalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h5 class="modal-title">Data User</h5>
				</div> 
				<div class="modal-body">
					<form action="_crud_user" method="post">
						<div class="row">
							<div class="col-md-12">
								<label>Nama</label>
								<input type="hidden" name="aksi" id="aksi">
								<input type="hidden" name="id_user" id="id_user">
								<input type="text" name="nama" required="yes" id="nama" class="form-control" placeholder="Nama">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Username</label>
								<input type="text" name="username" required="yes" id="username" class="form-control" placeholder="Username">
							</div>
							<div class="col-md-6">
								<label>Password</label>
								<input type="password" name="password" required="yes" id="nama" class="form-control" placeholder="Password">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary"><span id="tombol"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include_once 'template/js.php'; ?>	
</body>
</html>