<?php
 
class DBOperations
{
    private $con;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '\DBConnect.php';
        $db = new DBConnect();
        $this->con = $db->connect();
    }

	//postPengaduan
	public function addProvinsi($id_prov, $name_prov, $lambang_prov){
		$stmt = $this->con->prepare("INSERT INTO province (id_prov, name_prov, lambang_prov) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $id_prov, $name_prov, $lambang_prov);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	//getPengaduan
	public function getProvinsi(){
		$stmt = $this->con->prepare("SELECT id_prov, name_prov, lambang_prov FROM province ORDER BY id_prov DESC");
		$stmt->execute();
		$stmt->bind_result($id_prov, $name_prov, $lambang_prov);
		$getProvince = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['id_prov'] = $id_prov;
			$temp['name_prov'] = $name_prov;
			$temp['lambang_prov'] = $lambang_prov;
			array_push($getProvince, $temp);
		}
		return $getProvince; 
	}

	//getaKebudayaan
	public function getDesc(){
			if (isTheseParametersAvailable(array('id_prov'))) {
				$id_prov = $_POST['id_prov'];

			$stmt = $this->con->prepare("SELECT kebudayaan.id_desc_prov, nama , pulau, gubernur, wakil, kd_bps, kd_iso, kd_iso, kd_telp, kd_pos, luas, populasi, kepadatan, pembagian_adm, semboyan, kebudayaan.id_prov FROM kebudayaan INNER JOIN desc_prov WHERE kebudayaan.id_prov = ?");
			$stmt->bind_param("s", $id_prov);
			$stmt->execute();
			$stmt->bind_result($id_desc_prov, $nama, $pulau, $gubernur, $wakil, $kd_bps, $kd_iso, $kd_kendaraan, $kd_telp, $kd_pos, $luas, $populasi, $kepadatan, $pembagian_adm, $semboyan, $id_prov);
			$kebudayaan = array();
			
			while($stmt->fetch()){
				$temp['id_desc_prov'] = $id_desc_prov;
				$temp['id_prov'] = $id_prov;
				$temp['nama'] = $nama; 
				$temp['pulau'] = $pulau;
				$temp['gubernur'] = $gubernur;
				$temp['wakil'] = $wakil;
				$temp['kd_bps'] = $kd_bps;
				$temp['kd_iso'] = $kd_iso;
				$temp['kd_kendaraan'] = $kd_kendaraan;
				$temp['kd_telp'] = $kd_telp;
				$temp['kd_pos'] = $kd_pos;
				$temp['luas'] = $luas;
				$temp['populasi'] = $populasi;
				$temp['kepadatan'] = $kepadatan;
				$temp['pembagian_adm'] = $pembagian_adm;
				$temp['semboyan'] = $semboyan;
				array_push($kebudayaan, $temp);
			}
			return $kebudayaan; 
		}
	}

}