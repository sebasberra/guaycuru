<?php

	// variables 
	$post = 'http://localhost:8004/camas/nueva';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '292',
		
		// nombre_sala
		2 => 'tocoginecologia',
		
		// nombre_habitacion
		3 => 'hab1',
		
		// nombre_cama
		4 => 't-hab1-cama3',
		
		// id_clasificacion_cama
		5 => '1',
		
		// estado
		6 => 'L',
		
		// rotativa
		7 => 'false',
		
		// baja
		8 => 'false'
		
	];
	
	foreach ($vars as $var){
		
		$post .= '/'.$var;
		
	}
	$post.='.'.$format;
	
	// inicializa cUrl
	$ch = curl_init($post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

	// send request
	$response = curl_exec($ch);
	$code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	
	if (!$response){
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
