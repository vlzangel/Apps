<?php 
	include("openpay/Openpay.php");

	// Modo Producción
	// $openpay = Openpay::getInstance('mbagfbv0xahlop5kxrui', 'sk_b485a174f8d34df3b52e05c7a9d8cb22');
	// Openpay::setProductionMode(true);

	// Modo Pruebas

	if( $_POST["token_id"] != "" && $_POST["deviceIdHiddenFieldName"] != "" ){

		$openpay = Openpay::getInstance('mbdcldmwlolrgxkd55an', 'sk_532855907c61452898d492aa521c8c9f');

		$customer = array(
			'name' 			=> "Angel",
			'last_name' 	=> "Veloz",
			'phone_number' 	=> "+584243128807",
			'email' 		=> "vlzangel91@gmail.com"
		);

		$chargeData = array(
		    'method' 			=> 'card',
		    'source_id' 		=> $_POST["token_id"],
		    'amount' 			=> (float) $_POST["monto"],
		    'description' 		=> "Pago de pruebas",
		    'device_session_id' => $_POST["deviceIdHiddenFieldName"],
		    'customer' 			=> $customer
		    );

		$charge = $openpay->charges->create($chargeData);

		echo json_encode($charge);

	}else{
		echo json_encode(array(
			"Error" => "Sin tokens",
			"Data"  => $_POST
		));
	}

	
?>