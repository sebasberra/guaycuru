## Alta, baja y modificación de Camas

Conjunto de WS para actualizar el estado de las camas de un efector en la base centralizada.

### Ver cama

Obtiene los datos de la cama

```endpoint
GET /camas/ver/{id_efector}/{nombre_cama}.{_format}
```
Variable | Descripción
---|---
`id_efector` |ID efector
`nombre_cama` | Nombre único de cama en el efector
`format` | JSON o XML

Devuelve el código de estado HTTP: 200 (OK - Información de cama) o 404 (cama no encontrada)

#### Ejemplo Request JSON (ver cama)

```curl
$ curl http://localhost:8004/camas/ver/121/HD4.json
```
```php
<?php

	// variables 
	$get = 'http://localhost:8004/camas/ver';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '121',
		
		// nombre_cama
		2 => 'HD4'
		
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
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/ver/121/HD4.json"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "GET", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send
    
    'response
    MsgBox xmlhttp.responseText, , sUrl
    
```
#### Ejemplo Response

```json
{
	"idEfector":121,
	"nomEfector":"HOSP DE NIÑOS DR ORLANDO ALASSIA",
	"nombre":"HD4",
	"abreviatura":"CPO",
	"categoriaEdad":"PED",
	"clasificacionCama":"CRITICAS PEDIATRICAS C/OXIGENO",
	"estado":"F",
	"rotativa":false,
	"baja":false
}
```

#### Ejemplo Request JSON con espacios escapados (ver cama)

```curl
$ curl $(echo "http://localhost:8004/camas/ver/63/cgcq-hab2-cama 2.json" | sed 's/ /%20/g' )
```

```php
<?php

	// variables 
	$get = 'http://localhost:8004/camas/ver';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '63',
		
		// nombre_cama
		2 => 'cgcq-hab2-cama 2'
		
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
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/ver/63/cgcq-hab2-cama 2.json"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "GET", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

```json
{
	"idEfector": 63,
	"nomEfector": "HOSP PROTOMEDICO MANUEL RODRIGUEZ",
	"nombre": "CGCQ-HAB2-CAMA 2",
	"abreviatura": "IGAO",
	"categoriaEdad": "ADU",
	"clasificacionCama": "INTERNACION GRAL ADULTOS C/OXIGENO",
	"estado": "L",
	"rotativa": false,
	"baja": false
}
```

#### Ejemplo Request XML (ver cama)

```curl
$ curl http://localhost:8004/camas/ver/121/HD4.xml
```

```php
<?php

	// variables 
	$get = 'http://localhost:8004/camas/ver';
	$format = 'xml';
	$vars = [
		// id_efector
		1 => '121',
		
		// nombre_cama
		2 => 'HD4'
		
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
        .htmlspecialchars($response);

?>
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String
	
	'URL
	sUrl = "http://192.168.56.1:8005/camas/ver/121/HD4.xml"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "GET", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

```html
<?xml version="1.0" ?>
	<response>
		<idEfector>121</idEfector>
		<nomEfector>HOSP DE NIÑOS DR ORLANDO ALASSIA</nomEfector>
		<nombre>HD4</nombre>
		<abreviatura>CPO</abreviatura>
		<categoriaEdad>PED</categoriaEdad>
		<clasificacionCama>CRITICAS PEDIATRICAS C/OXIGENO</clasificacionCama>
		<estado>F</estado>
		<rotativa>0</rotativa>
		<baja>0</baja>
	</response>
```

### Modificar cama

Modificar datos de la cama

```endpoint
PUT /camas/modificar/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre de la sala del efector
`nombre_habitacion` | Nombre de la habitación donde está la cama
`nombre_cama` | (Nombre único de cama en el efector
`id_clasificacion_cama` | ID de clasificación de cama. Ver tabla clasificaciones_camas
`estado` | L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada
`rotativa` | TRUE o FALSE
`baja` | TRUE o FALSE
`format` | JSON o XML

Devuelve el código de estado HTTP: 204 (cama actualizada)  o 404 (error de actualización)

#### Ejemplo Request JSON con espacios escapados (modificar cama)

```curl
$ curl -X PUT $(echo "http://localhost:8004/camas/modificar/63/clinica medica/hab 5/cm-hab5-cama 2/5/L/false/false.json" | sed 's/ /%20/g' )
```
```php
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
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/modificar/63/clinica medica/hab 5/cm-hab5-cama 2/5/L/false/false.json"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "PUT", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

>HTTP: 204 No Content

### Agregar cama

Agregar una cama

```endpoint
POST /camas/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{nombre_cama}/{id_clasificacion_cama}/{estado}/{rotativa}/{baja}.{_format}
```
Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre de la sala del efector
`nombre_habitacion` | Nombre de la habitación donde está la cama
`nombre_cama` | (Nombre único de cama en el efector
`id_clasificacion_cama` | ID de clasificación de cama. Ver tabla clasificaciones_camas
`estado` | L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada
`rotativa` | TRUE o FALSE
`baja` | TRUE o FALSE
`format` | JSON o XML

Devuelve el código de estado HTTP: 201 (cama nueva ingresada) o 404 (error al agregar la cama)

#### Ejemplo Request JSON (agregar cama)

```curl
curl -X POST http://localhost:8004/camas/nueva/292/tocoginecologia/hab1/t-hab1-cama3/1/L/false/false.json
```
```php
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
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/nueva/292/tocoginecologia/hab1/t-hab1-cama3/1/L/false/false.json"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "POST", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

>HTTP 201 Created

```json
{
  "La cama: t-hab1-cama3 fue ingresada al efector: SAMCO SAN JUSTO en la sala: tocoginecologia y la habitación: hab1"
}
```

#### Ejemplo Request XML (agregar cama ya existente)

>Suponiendo que el ejemplo anterior (Request JSON) agregó la cama con éxito, el siguiente ejemplo deberá responder con código 404

```curl
curl -X POST http://localhost:8004/camas/nueva/292/tocoginecologia/hab1/t-hab1-cama3/1/L/false/false.xml
```
```php
<?php

	// variables 
	$post = 'http://localhost:8004/camas/nueva';
	$format = 'xml';
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
        .htmlspecialchars($response);

?>
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String
	
	'URL
	sUrl = "http://192.168.56.1:8005/camas/nueva/292/tocoginecologia/hab1/t-hab1-cama3/1/L/false/false.xml"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "POST", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```

#### Ejemplo Response

>HTTP 404 Not Found

```html
<?xml version="1.0" ?>
	<response>
		Error>(1) El nombre de cama ya existe en el efector.</Error>
	</response>
```

### Eliminar cama

Eliminar una cama

```endpoint
DELETE /camas/eliminar/{id_efector}/{nombre_cama}.{_format}
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_cama` | (Nombre único de cama en el efector
`format` | JSON o XML

Devuelve el código de estado HTTP: 200 (cama eliminada) o 404 (cama no encontrada o error)

#### Ejemplo Request JSON (eliminar cama)

```curl
curl -X DELETE http://localhost:8004/camas/eliminar/72/cm-h01-1.json
```
```php
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
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String
	
	'URL
	sUrl = "http://192.168.56.1:8005/camas/eliminar/72/cm-h01-1.json"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "DELETE", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

>HTTP 200 OK

```json
{
 "La cama: cm-h01-1 fue eliminada del efector: HOSP DR J B ITURRASPE"
}
```

#### Ejemplo Request XML (eliminar cama no existente)

```curl
curl -X DELETE http://localhost:8004/camas/eliminar/72/cama_no_existe.xml
```
```php
<?php

	// variables 
	$delete = 'http://localhost:8004/camas/eliminar';
	$format = 'xml';
	$vars = [
		// id_efector
		1 => '72',
		
		// nombre_cama
		2 => 'cama_no_existe',
		
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
        .htmlspecialchars($response);

?>
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String
	
	'URL
	sUrl = "http://192.168.56.1:8005/camas/eliminar/72/cama_no_existe.xml"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "DELETE", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

>HTTP 404 Error

```html
<?xml version="1.0" ?>
	<response>
		<Error>El nombre de cama: cama_no_existe no se encuentra en el efector: 72</Error>
	</response>
```
### Liberar cama

Liberar o desocupar una cama

```endpoint
PATCH /camas/liberar/{id_efector}/{nombre_cama}.{_format}
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_cama` | (Nombre único de cama en el efector
`format` | JSON o XML

Devuelve el código de estado HTTP: 204 (cama liberada) o 404 (cama no encontrada o error)

#### Ejemplo Request JSON (liberar cama)

```curl
curl -X PATCH http://localhost:8004/camas/liberar/71/s1u-ua-4.json
```
```php
<?php

	// variables 
	$patch = 'http://localhost:8004/camas/liberar';
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
        die(' Error: "' . curl_error($ch) . '" - Código: ' . curl_errno($ch));
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
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/liberar/71/s1u-ua-4.json"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "PATCH", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

> HTTP 204 No Content

#### Ejemplo Request XML (liberar cama libre)

```curl
curl -X PATCH http://localhost:8004/camas/liberar/71/s1u-ua-4.xml
```
```php
<?php

	// variables 
	$patch = 'http://localhost:8004/camas/liberar';
	$format = 'xml';
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
        die(' Error: "' . curl_error($ch) . '" - Código: ' . curl_errno($ch));
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
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/liberar/71/s1u-ua-4.xml"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "PATCH", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

> HTTP 404 Error

```html
<?xml version="1.0" ?>
	<response>
		<Error>La cama s1u-ua-4 ya está libre</Error>
	</response>
```

### Ocupar cama

Ocupar una cama

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_cama` | (Nombre único de cama en el efector
`format` | JSON o XML

Devuelve el código de estado HTTP: 204 (cama ocupada) o 404 (cama no encontrada o error)


```endpoint
PATCH /camas/ocupar/{id_efector}/{nombre_cama}.{_format}
```

#### Ejemplo Request JSON (ocupar cama)

```curl
curl -X PATCH http://localhost:8004/camas/ocupar/71/s1u-ua-4.json
```
```php
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
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```vb6
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/ocupar/71/s1u-ua-4.json"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "PATCH", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

>HTTP 204 No Content

#### Ejemplo Request XML (ocupar cama ya ocupada)

```curl
curl -X PATCH http://localhost:8004/camas/ocupar/71/s1u-ua-4.xml
```
```php
<?php

	// variables 
	$patch = 'http://localhost:8004/camas/ocupar';
	$format = 'xml';
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
        .htmlspecialchars($response);

?>
```
```sql
/* Ejemplo no disponible */
```
```bash
# Ver ejemplo cUrl
```
```
	'Agregar la refencia Microsoft XML
	Dim xmlhttp As MSXML2.ServerXMLHTTP

	'var
	Dim sUrl As String

	'URL
	sUrl = "http://192.168.56.1:8005/camas/ocupar/71/s1u-ua-4.xml"

	'inicializa objeto http
	Set xmlhttp = New MSXML2.ServerXMLHTTP

	'request sincrono
	xmlhttp.open "PATCH", sUrl, False
	xmlhttp.setRequestHeader "Content-Type", "application/x-www-form-urlencoded"
	xmlhttp.send

	'response
	MsgBox xmlhttp.Status & " " + xmlhttp.statusText + " " + xmlhttp.responseText, , sUrl
```
#### Ejemplo Response

>HTTP 404 Error

```html
<?xml version="1.0" ?>
	<response>
		<Error>La cama s1u-ua-4 está ocupada</Error>
	</response>
```