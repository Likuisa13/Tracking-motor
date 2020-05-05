<?php 
include_once '../config/dao.php';
$dao = new Dao();

if (!empty($_POST)) {
	$id_kendaraan = $_POST['id_kendaraan'];
	$latitude_now = $_POST['latitude'];
	$longitude_now = $_POST['longitude'];

	$data = $dao->cekJarak($id_kendaraan, $latitude_now, $longitude_now);
	$jarak = $data['jarak'];
	$status = $data['status'];
	$data = $dao->execute("SELECT `lokasi`.*, merk,plat_nomor,pengguna FROM `kendaraan`,`lokasi` WHERE `lokasi`.id_kendaraan = `kendaraan`.id AND `lokasi`.id_kendaraan = '$id_kendaraan' AND `lokasi`.status = '1'");
	
	if ($data->num_rows == 1) {
		$data = $data->fetch_array();
		$nama_lokasi = $data['nama_lokasi'];
		$latitude = $data['latitude'];
		$longitude = $data['longitude'];
		$batas = $data['batas'];
		$merk = $data['merk'];
		$plat_nomor = $data['plat_nomor'];
		$pengguna = $data['pengguna'];

		$query = "INSERT INTO `riwayat`(`merk`,`plat_nomor`,`pengguna`,`nama_lokasi`,`latitude`,`longitude`,`batas`,`latitude_now`, `longitude_now`, `jarak_now`, `status`) VALUES ('$merk','$plat_nomor','$pengguna','$nama_lokasi','$latitude','$longitude','$batas','$latitude_now','$longitude_now','$jarak','$status')";
		$dao->execute($query);
		echo $status;
	}else{
		echo "Di Izinkan";
	}
}
else{
	echo "tidak ada data yang dikirim";
}