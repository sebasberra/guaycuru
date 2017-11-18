<?php

	// variables 
	$patch = 'http://localhost:8004/camas/ocupar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '71',
		
		// nombre_cama
		2 => 's1u-ua-4',
		
	];
	
	foreach ($vars as $var){
		
		$patch .= '/'.$var;
		
	}
	$patch.='.'.$format;
	
	
	// inicializa cUrl
	$ch = curl_init($patch);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
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
