<?php 
include_once 'dbconfig.php';

class Dao 
{
	var $link;
	public function __construct()
	{
			$this->link = new Dbconfig(); //object
		}

		public function login($username,$password) {
			$query = "SELECT * FROM `users` WHERE username='$username' and password = PASSWORD('$password')";
			return mysqli_query($this->link->conn, $query);
		}

		public function view($tabel)
		{
			$query = "SELECT * FROM $tabel";
			return mysqli_query($this->link->conn, $query);	
		}

		public function viewMaps()
		{
			$query = "SELECT `lokasi`.*, merk,plat_nomor,pengguna FROM `kendaraan`,`lokasi` WHERE `lokasi`.id_kendaraan = `kendaraan`.id";
			return mysqli_query($this->link->conn, $query);	
		}

		public function viewHistory()
		{
			$query = "SELECT `riwayat`.*, merk,plat_nomor,pengguna, latitude, longitude, batas FROM `kendaraan`,`lokasi`,`riwayat` WHERE `lokasi`.id_kendaraan = `kendaraan`.id AND `lokasi`.id = `riwayat`.id_lokasi";
			return mysqli_query($this->link->conn, $query);	
		}

		public function total($tabel) {
			$query = "SELECT count(*) as jml FROM `$tabel`";
			$result = mysqli_query($this->link->conn, $query);
			$result = $result->fetch_array();
			return $result['jml'];
		}

		public function execute($query)
		{
			$result = mysqli_query($this->link->conn, $query);
			if ($result) {
				return $result;
			}else{
				return mysqli_error($this->link->conn);
			}
		}


	}

	?>