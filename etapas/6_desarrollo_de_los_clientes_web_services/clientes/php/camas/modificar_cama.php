<?php

	// variables 
	$put = 'http://localhost:8004/camas/modificar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '63',
		
		// nombre_sala
		2 => 'clinica medica',
		
		// nombre_habitacion
		3 => 'hab 5',
		
		// nombre_cama
		4 => 'cm-hab5-cama 2',
		
		// id_clasificacion_cama
		5 => '5',
		
		// estado
		6 => 'L',
		
		// rotativa
		7 => 'false',
		
		// baja
		8 => 'false'
		
	];
	
	foreach ($vars as $var){
		
		$put .= '/'.$var;
		
	}
	$put.='.'.$format;
	
	// reemplaza espacios
	$put = str_replace ( ' ', '%20', $put);
	
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
