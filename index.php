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
						$response['status'] = 'success';
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
					$response['status'] = 'error'; 
					$response['code'] = 300;
					$response['message'] = 'Nothing found in the database';
					$response['response'] = $getProvinsi;
				}else{
					$response['status'] = 'success'; 
					$response['code'] = 200;
					$response['message'] = 'success load data';
					$response['response'] = $getProvinsi;

				}
			break; 

			case 'getdesc':
				$db = new DBOperations();
				$desc = $db->getDesc();
				if(count($desc)<=0){
					$response['status'] = 'error'; 
					$response['code'] = 300;
					$response['message'] = 'Nothing found in the database';
					$response['response'] = $desc;
				}else{
					$response['status'] = 'success'; 
					$response['code'] = 200;
					$response['message'] = 'success load data';
					$response['response'] = $desc;
				}
			break;

			case 'getrumahadat':
				$db = new DBOperations();
				$rumah = $db->getRumahAdat();
				if(count($rumah)<=0){
					$response['status'] = 'error'; 
					$response['code'] = 300;
					$response['message'] = 'Nothing found in the database';
					$response['response'] = $rumah;
				}else{
					$response['status'] = 'success'; 
					$response['code'] = 200;
					$response['message'] = 'success load data';
					$response['response'] = $rumah;
				}
			break;
			
			case 'getpakaianadat':
				$db = new DBOperations();
				$pakaian = $db->getPakaianAdat();
				if(count($pakaian)<=0){
					$response['status'] = 'error'; 
					$response['code'] = 300;
					$response['message'] = 'Nothing found in the database';
					$response['response'] = $pakaian;
				}else{
					$response['status'] = 'success'; 
					$response['code'] = 200;
					$response['message'] = 'success load data';
					$response['response'] = $pakaian;
				}
			break;
			
			case 'getsenjataadat':
				$db = new DBOperations();
				$senjata = $db->getSenjataAdat();
				if(count($senjata)<=0){
					$response['status'] = 'error'; 
					$response['code'] = 300;
					$response['message'] = 'Nothing found in the database';
					$response['response'] = $senjata;
				}else{
					$response['status'] = 'success'; 
					$response['code'] = 200;
					$response['message'] = 'success load data';
					$response['response'] = $senjata;
				}
			break;
			
            default:
				$response['code'] = 500;
				$response['message'] = 'No operation to perform';
			
		}
		
	}else{
		$response['code'] = 200;
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
	