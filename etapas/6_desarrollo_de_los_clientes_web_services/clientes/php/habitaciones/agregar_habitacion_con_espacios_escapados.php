<?php

	// variables 
	$post = 'http://localhost:8004/habitaciones/nueva';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '71',
		
		// nombre_sala
		2 => 'sala 1  uti',
		
		// nombre_habitacion
		3 => 'hab f',
		
		// sexo
		4 => '3',
		
		// edad_desde
		5 => '0',
		
		// edad_hasta
		6 => '255',
		
		// tipo_edad
		7 => '6',
		
		// baja
		8 => '0'
		
	];
	
	foreach ($vars as $var){
		
		$post .= '/'.$var;
		
	}
	$post.='.'.$format;
	
	// reemplaza espacios
	$post = str_replace ( ' ', '%20', $post);
	
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
