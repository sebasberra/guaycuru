<?php

	// variables 
	$delete = 'http://localhost:8004/habitaciones/eliminar';
	$format = 'xml';
	$vars = [
		// id_efector
		1 => '5',
		
		// nombre_sala
		2 => 'sala- pediatria',
		
		// nombre_habitacion
		3 => 'hab de prueba',
		
	];
	
	foreach ($vars as $var){
		
		$delete .= '/'.$var;
		
	}
	$delete.='.'.$format;
	
	// reemplaza espacios
	$delete = str_replace ( ' ', '%20', $delete);
	
	// inicializa cUrl
	$ch = curl_init($delete);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
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
        .htmlspecialchars($response);

?>
