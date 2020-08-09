<?php 
include_once 'config/dao.php';
$dao = new Dao();
// var_dump($_POST);die;

if ($_POST['aksi'] == 'simpan') {
	$id = $_POST['id_user'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "INSERT INTO `users`(`nama`, `username`, `password`, `email`) VALUES ('$nama','$username',PASSWORD('$password'),'$email')";
}
elseif ($_POST['aksi'] == 'edit') {
	$id = $_POST['id_user'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = "UPDATE `users` SET `nama`='$nama',`username`='$username',`password`=PASSWORD('$password'),`email`='$email' WHERE `id` = '$id'";
}
elseif ($_POST['aksi'] == 'delete') {
	$id = $_POST['id_user'];
	$query = "DELETE FROM `users` WHERE `id` = '$id'";
}
// var_dump($query);die;
$dao->execute($query);

header("location:user");
?>