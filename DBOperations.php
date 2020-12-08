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

	//getdesc
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

	//getrumahadat
	public function getRumahAdat(){
		if (isTheseParametersAvailable(array('id_prov'))) {
			$id_prov = $_POST['id_prov'];

			$stmt = $this->con->prepare("SELECT kebudayaan.id_rumah_adat, nama_rumah_adat , desc_rumah_adat, image_rumah_adat, kebudayaan.id_prov FROM kebudayaan INNER JOIN rumah_adat WHERE kebudayaan.id_prov = ?");
			$stmt->bind_param("s", $id_prov);
			$stmt->execute();
			$stmt->bind_result($id_rumah_adat, $nama_rumah_adat, $desc_rumah_adat, $image_rumah_adat, $id_prov);
			$rumah = array();
			
			while($stmt->fetch()){
				$temp['id_rumah_adat'] = $id_rumah_adat;
				$temp['id_prov'] = $id_prov;
				$temp['nama_rumah_adat'] = $nama_rumah_adat;
				$temp['desc_rumah_adat'] = $desc_rumah_adat; 
				$temp['image_rumah_adat'] = $image_rumah_adat;
				array_push($rumah, $temp);
			}
			return $rumah; 
		}
	}

	//pakaian adat
	public function getPakaianAdat(){
		if (isTheseParametersAvailable(array('id_prov'))) {
			$id_prov = $_POST['id_prov'];

			$stmt = $this->con->prepare("SELECT kebudayaan.id_pakaian_adat, nama_pakaian_adat , desc_pakaian_adat, image_pakaian_adat, kebudayaan.id_prov FROM kebudayaan INNER JOIN pakaian_adat WHERE kebudayaan.id_prov = ?");
			$stmt->bind_param("s", $id_prov);
			$stmt->execute();
			$stmt->bind_result($id_pakaian_adat, $nama_pakaian_adat, $desc_pakaian_adat, $image_pakaian_adat, $id_prov);
			$pakaian = array();
			
			while($stmt->fetch()){
				$temp['id_pakaian_prov'] = $id_pakaian_adat;
				$temp['id_prov'] = $id_prov;
				$temp['nama_pakaian_adat'] = $nama_pakaian_adat;
				$temp['desc_pakaian_adat'] = $desc_pakaian_adat; 
				$temp['image_pakaian_adat'] = $image_pakaian_adat;
				array_push($pakaian, $temp);
			}
			return $pakaian; 
		}
	}

	//senjata adat
	public function getSenjataAdat(){
		if (isTheseParametersAvailable(array('id_prov'))) {
			$id_prov = $_POST['id_prov'];

			$stmt = $this->con->prepare("SELECT kebudayaan.id_senjata_adat, nama_senjata_adat , desc_senjata_adat, image_senjata_adat, kebudayaan.id_prov FROM kebudayaan INNER JOIN senjata_adat WHERE kebudayaan.id_prov = ?");
			$stmt->bind_param("s", $id_prov);
			$stmt->execute();
			$stmt->bind_result($id_senjata_adat, $nama_senjata_adat, $desc_senjata_adat, $image_senjata_adat, $id_prov);
			$senjata = array();
			
			while($stmt->fetch()){
				$temp['id_senjata_prov'] = $id_senjata_adat;
				$temp['id_prov'] = $id_prov;
				$temp['nama_senjata_adat'] = $nama_senjata_adat;
				$temp['desc_senjata_adat'] = $desc_senjata_adat; 
				$temp['image_senjata_adat'] = $image_senjata_adat;
				array_push($senjata, $temp);
			}
			return $senjata; 
		}
	}

}