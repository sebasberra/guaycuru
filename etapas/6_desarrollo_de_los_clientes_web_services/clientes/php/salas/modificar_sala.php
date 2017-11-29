<?php

	// variables 
	$put = 'http://localhost:8004/salas/modificar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '167',
		
		// nombre_sala
		2 => 'emergencias',
		
		// area_cod_servicio
		3 => 'null',
		
		// area_sector
		4 => 'null',
		
		// area_subsector
		5 => 'null',
		
		// mover_camas
		6 => 'false',
		
		// baja
		7 => 'false',
		
	];
	
	foreach ($vars as $var){
		
		$put .= '/'.$var;
		
	}
	$put.='.'.$format;
		
	// inicializa cUrl
	$ch = curl_init($put);
	curl_setopt($ch, CURLOPT_PUT, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// send request
	$response = curl_exec($ch);
	$code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	
	if (!$response && $code!=204){
		die('Error: "' . curl_error($ch) . '" - Código: ' . curl_errno($ch));
	}
	
	// cierra conexión, libera recursos
	curl_close($ch);

	// response
	echo 
        'Codigo HTTP: '
        .$code
        .' - Contenido: '
        .$response;

?>
