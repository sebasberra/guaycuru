<?php

	// variables 
	$post = 'http://localhost:8004/salas/nueva';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '63',
		
		// nombre_sala
		2 => 'TRAUMATOLOGIA',
		
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
