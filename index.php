<?php 
	
	require_once 'DBOperations.php';
	$response = array();  
	
	if(isset($_GET['apicall'])){
		
		switch($_GET['apicall']){	

			case 'addprovinsi':
                if(
				isset($_POST['id_prov']) &&
				isset($_POST['name_prov']) &&
				isset($_POST['lambang_prov'])){
                    $db = new DBOperations();
					if($db->addProvinsi($_POST['id_prov'], $_POST['name_prov'], $_POST['lambang_prov'])){
						$response['status'] = 'sukses';
						$response['code'] = 200;
                        $response['message'] = 'pengaduan added successfully';
					}else{
						$response['status'] = 'error';
						$response['code'] = 300;
						$response['message'] = 'Could not add pengaduan';
					}
				}else{
					$response['status'] = 'error';
					$response['code'] = 400; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 
			
			case 'getprovinsi':
				$db = new DBOperations();
				$getProvinsi = $db->getProvinsi();
				if(count($getProvinsi)<=0){
					$response['error'] = true; 
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false; 
					$response['count'] = count($getProvinsi);
					$response['data'] = $getProvinsi;

				}
			break; 

			case 'getdesc':
				$db = new DBOperations();
				$desc = $db->getDesc();
				if(count($desc)<=0){
					$response['error'] = true;
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false;
					$response['message'] = 'Sukses';
					$response['data'] = $desc;
				}
			break;

			case 'getkategori':
				$db = new DBOperations();
				$kategori = $db->getKategori();
				if(count($kategori)<=0){
					$response['error'] = true;
					$response['message'] = 'Nothing found in the database';
				}else{
					$response['error'] = false;
					$response['data'] = $kategori;
				}
            break;
            
            default:
				$response['error'] = true;
				$response['message'] = 'No operation to perform';
			
		}
		
	}else{
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}
	
	//displaying the data in json 
	echo json_encode($response);
	function isTheseParametersAvailable($params){
		foreach ($params as $param) {
			if (!isset($_POST[$param])) {
				return false;
			}
		}
	
		return true;
	}

	function getBaseURL(){
        $url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $url .= $_SERVER['SERVER_NAME'];
        $url .= $_SERVER['REQUEST_URI'];
        return dirname($url) . '/';
	}
	