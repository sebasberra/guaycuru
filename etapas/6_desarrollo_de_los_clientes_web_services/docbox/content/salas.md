## Salas

Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe

### Ver sala

Obtiene los datos de la sala

```endpoint
GET /salas/ver/{id_efector}/{nombre_sala}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`format` | JSON o XML

Response Devuelve el código de estado HTTP: 200(OK - Información de sala) o 404 (sala no encontrada)

#### Ejemplo Request JSON (ver sala)

```curl
$ curl http://localhost:8004/salas/ver/267/obstetricia.json
```
```php
<?php

	// variables 
	$get = 'http://localhost:8004/salas/ver';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '267',
		
		// nombre_sala
		2 => 'obstetricia',
		
	];
	
	foreach ($vars as $var){
		
		$get .= '/'.$var;
		
	}
	$get.='.'.$format;
	
	// inicializa cUrl
	$ch = curl_init($get);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// send request
	$response = curl_exec($ch);
	$code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	
	if (!$response){
		die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
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
```
#### Ejemplo Response

>HTTP 200 OK

```json
{
	"idEfector": 267,
	"nomEfector": "SAMCO CORONDA",
	"idSala": 267004,
	"nroSala": 4,
	"nombre": "OBSTETRICIA",
	"areaCodServicio": null,
	"areaSector": null,
	"areaSubsector": null,
	"nomServicioEstadistica": null,
	"moverCamas": false,
	"cantCamas": 3,
	"baja": false
}
```

#### Ejemplo Request JSON con espacios escapados (ver sala que no existe)

```curl
$ curl $(echo "http://localhost:8004/salas/ver/5/sala que no existe.json" | sed 's/ /%20/g' )
```
```php
<?php

	// variables 
	$get = 'http://localhost:8004/salas/ver';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '5',
		
		// nombre_sala
		2 => 'sala que no existe',
		
	];
	
	foreach ($vars as $var){
		
		$get .= '/'.$var;
		
	}
	$get.='.'.$format;
	
	// reemplaza espacios
	$get = str_replace ( ' ', '%20', $get);
	
	// inicializa cUrl
	$ch = curl_init($get);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// send request
	$response = curl_exec($ch);
	$code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	
	if (!$response){
		die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
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
```
#### Ejemplo Response

>HTTP 404 Error

```json 
{
	"Error": "La sala: sala que no existe no fue encontrada en el efector: 5"
}
```

#### Ejemplo Request XML con espacios escapados (ver sala)

```curl
$ curl $(echo "http://localhost:8004/salas/ver/292/medicina general mujeres.xml" | sed 's/ /%20/g' )
```
```php
<?php

	// variables 
	$get = 'http://localhost:8004/salas/ver';
	$format = 'xml';
	$vars = [
		// id_efector
		1 => '292',
		
		// nombre_sala
		2 => 'medicina general mujeres',
		
	];
	
	foreach ($vars as $var){
		
		$get .= '/'.$var;
		
	}
	$get.='.'.$format;
	
	// reemplaza espacios
	$get = str_replace ( ' ', '%20', $get);
	
	// inicializa cUrl
	$ch = curl_init($get);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// send request
	$response = curl_exec($ch);
	$code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	
	if (!$response){
		die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
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
```
#### Ejemplo Response

>HTTP 200 OK

```html
<?xml version="1.0" ?>
<response>
	<idEfector>292</idEfector>
	<nomEfector>SAMCO SAN JUSTO</nomEfector>
	<idSala>292005</idSala>
	<nroSala>5</nroSala>
	<nombre>MEDICINA GENERAL MUJERES</nombre>
	<areaCodServicio/>
	<areaSector/>
	<areaSubsector/>
	<nomServicioEstadistica/>
	<moverCamas>0</moverCamas>
	<cantCamas>16</cantCamas>
	<baja>0</baja>
</response>
```

### Modificar sala

Modificar datos de la sala
NOTA: si la modificación es sobre el campo baja, entonces las habitaciones y sus camas asociadas se actualizan junto con los valores de los campos cant_camas de cada habitación, además del campo cant_camas de la sala.

```endpoint
PUT /salas/modificar/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`area_cod_servicio` | código de 3 dígitos del área SIPES
`area_sector` | campo sector correspondiente al área SIPES (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)
`area_subsector` | subsector correspondiente al área SIPES (4=internación; 5=CE; 6=atención domiciliaria)
`mover_camas` | bandera para el sistema que indica si se permite mover camas entre las habitaciones de la misma sala. por ejemplo: las incubadoras
`baja` | 0=habilitada; 1=baja
`format` | JSON o XML

Devuelve el código de estado HTTP: 204 (sala actualizada) o 404 (error de actualización)

#### Ejemplo Request JSON (modificar sala)

```curl
curl -X PUT http://localhost:8004/salas/modificar/167/emergencias/null/null/null/false/false.json
```
```php
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
```
#### Ejemplo Response (modificar sala)

>HTTP 204 No Content

### Agregar sala

Agregar una sala.

```endpoint
POST /salas/nueva/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`area_cod_servicio` | código de 3 dígitos del área SIPES
`area_sector` | campo sector correspondiente al área SIPES (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)
`area_subsector` | subsector correspondiente al área SIPES (4=internación; 5=CE; 6=atención domiciliaria)
`mover_camas` | bandera para el sistema que indica si se permite mover camas entre las habitaciones de la misma sala. por ejemplo: las incubadoras
`baja` | 0=habilitada; 1=baja
`format` | JSON o XML

Response Devuelve el código de estado HTTP: 201 (sala nueva ingresada) o 404 (error al agregar la sala)

#### Ejemplo Request (agregar sala)

```curl
curl -X POST http://localhost:8004/salas/nueva/63/TRAUMATOLOGIA/null/null/null/false/false.json
```
```php
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
```
#### Ejemplo Response (agregar sala)

>HTTP 201 Created

```json
{
 "La sala: TRAUMATOLOGIA fue ingresada al efector: 63. El id de sala asignado es: 63005"
}
```
### Eliminar sala

Eliminar una sala.

```endpoint
DELETE /salas/eliminar/{id_efector}/{nombre_sala}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`format` | JSON o XML

Devuelve el código de estado HTTP:200 (sala eliminada) o 404 (sala no encontrada o error)

#### Ejemplo Request (eliminar sala)

```curl
$ curl -X DELETE http://localhost:8004/salas/eliminar/63/TRAUMATOLOGIA.json
```
```php
<?php

	// variables 
	$delete = 'http://localhost:8004/salas/eliminar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '63',
		
		// nombre_sala
		2 => 'TRAUMATOLOGIA',
				
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
```
#### Ejemplo Response (eliminar sala)

>HTTP 200 OK

```json
{
 "La sala: TRAUMATOLOGIA fue eliminada/baja del efector: HOSP PROTOMEDICO MANUEL RODRIGUEZ"
}
```
