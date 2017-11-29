<?php

	// variables 
	$put = 'http://localhost:8004/habitaciones/modificar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '72',
		
		// nombre_sala
		2 => 'obstetricia',
		
		// nombre_habitacion
		3 => 'anexo1',
		
		// sexo
		4 => '2',
		
		// edad_desde
		5 => '12',
		
		// edad_hasta
		6 => '55',
		
		// tipo_edad
		7 => '1',
		
		// baja
		8 => '0'
		
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
