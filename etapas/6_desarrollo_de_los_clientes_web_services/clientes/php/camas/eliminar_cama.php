<?php

	// variables 
	$delete = 'http://localhost:8004/camas/eliminar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '72',
		
		// nombre_cama
		2 => 'cm-h01-1',
		
	];
	
	foreach ($vars as $var){
		
		$delete .= '/'.$var;
		
	}
	$delete.='.'.$format;
	
	
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
        .$response;

?>
