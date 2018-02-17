## Habitaciones

Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe

### Ver habitación

Obtiene los datos de la habitación

```endpoint
GET /habitaciones/ver/{id_efector}/{nombre_sala}/{nombre_habitacion}.{_format}
```
Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala
`format` | JSON o XML

Devuelve el código de estado HTTP: 200(OK - Información de habitación) o 404 (habitación no encontrada)

#### Ejemplo Request JSON (ver habitación)

```curl
$ curl http://localhost:8000/habitaciones/ver/183/guardia/aislados.json
```
```php
<?php

	// variables 
	$get = 'http://localhost:8000/habitaciones/ver';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '183',
		
		// nombre_sala
		2 => 'guardia',
		
		// nombre_habitacion
		3 => 'aislados'
		
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
	sUrl = "http://192.168.56.1:8000/habitaciones/ver/183/guardia/aislados.json"

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

>HTTP 200 OK

```json
{
	"idEfector": 183,
	"nomEfector": "HOSP PROVINCIAL CENTENARIO",
	"nombre_sala": "GUARDIA",
	"nombre_habitacion": "AISLADOS",
	"sexo": 3,
	"edadDesde": 0,
	"edadHasta": 255,
	"tipoEdad": "1",
	"cantCamas": 2,
	"baja": false
}
```

#### Ejemplo Request JSON con espacios escapados (ver habitación)
```curl
$ curl $(echo "http://localhost:8000/habitaciones/ver/121/cim iii/cim iii.json" | sed 's/ /%20/g' )
```
```php
<?php

	// variables 
	$get = 'http://localhost:8000/habitaciones/ver';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '121',
		
		// nombre_sala
		2 => 'cim iii',
		
		// nombre_habitacion
		3 => 'cim iii'
		
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
	sUrl = "http://192.168.56.1:8000/habitaciones/ver/121/cim iii/cim iii.json"

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

>HTTP 200 OK

```json
{
	"idEfector": 121,
	"nomEfector": "HOSP DE NIÑOS DR ORLANDO ALASSIA",
	"nombre_sala": "CIM III",
	"nombre_habitacion": "CIM III",
	"sexo": 3,
	"edadDesde": 0,
	"edadHasta": 18,
	"tipoEdad": "1",
	"cantCamas": 30,
	"baja": false
}
```

#### Ejemplo Request XML (ver habitación)

```curl
$ curl http://localhost:8000/habitaciones/ver/72/obstetricia/anexo.xml
```
```php
<?php

	// variables 
	$get = 'http://localhost:8000/habitaciones/ver';
	$format = 'xml';
	$vars = [
		// id_efector
		1 => '72',
		
		// nombre_sala
		2 => 'obstetricia',
		
		// nombre_habitacion
		3 => 'anexo'
		
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
	sUrl = "http://192.168.56.1:8000/habitaciones/ver/72/obstetricia/anexo.xml"

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

>HTTP 200 OK

```html
<?xml version="1.0" ?>
<response>
	<idEfector>72</idEfector>
	<nomEfector>HOSP DR J B ITURRASPE</nomEfector>
	<nombre_sala>OBSTETRICIA</nombre_sala>
	<nombre_habitacion>ANEXO</nombre_habitacion>
	<sexo>3</sexo>
	<edadDesde>0</edadDesde>
	<edadHasta>255</edadHasta>
	<tipoEdad>1</tipoEdad>
	<cantCamas>8</cantCamas>
	<baja>0</baja>
</response>
```
     
### Modificar habitación

Modificar datos de la habitación.
NOTA: si la modificación es sobre el campo baja, entonces las camas asociadas a la habitación se actualizan junto con los valores de los campos cant_camas de la habitación y de la sala que contiene a ésta.

```endpoint
PUT /habitaciones/modificar/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala
`sexo` | 1=varones 2=mujeres 3=mixta
`edad_desde` | Edad desde permitida
`edad_hasta` | Edad hasta permitida
`tipo_edad` | 1=años 2=meses 3=días 4=horas 5=minutos 6=se ignora
`baja` | 0=habilitada; 1=baja
`format` | JSON o XML

Devuelve el código de estado HTTP: 204 (habitación actualizada) o 404 (error de actualización)

#### Ejemplo Request JSON (modificar habitación)

```curl
curl -X PUT http://localhost:8000/habitaciones/modificar/72/obstetricia/anexo/2/12/55/1/0.json
```
```php
<?php

	// variables 
	$put = 'http://localhost:8000/habitaciones/modificar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '72',
		
		// nombre_sala
		2 => 'obstetricia',
		
		// nombre_habitacion
		3 => 'anexo',
		
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
	sUrl = "http://192.168.56.1:8000/habitaciones/modificar/72/obstetricia/anexo/2/12/55/1/0.json"

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

>HTTP 204 No Content

#### Ejemplo Request XML (modificar habitación que no existe)

```curl
curl -X PUT http://localhost:8000/habitaciones/modificar/72/obstetricia/anexo1/2/12/55/1/0.xml
```
```php
<?php

	// variables 
	$put = 'http://localhost:8000/habitaciones/modificar';
	$format = 'xml';
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
	sUrl = "http://192.168.56.1:8000/habitaciones/modificar/72/obstetricia/anexo1/2/12/55/1/0.xml"

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

>HTTP 404 Error

```html
<?xml version="1.0" ?>
<response>
	<Error>La habitación: anexo1 de la sala: obstetricia no fue encontrada en el efector: 72</Error>
</response>
```
 
### Agregar habitación

Agregar una habitación

```endpoint
POST /habitaciones/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala
`sexo` | 1=varones 2=mujeres 3=mixta
`edad_desde` | Edad desde permitida
`edad_hasta` | Edad hasta permitida
`tipo_edad` | 1=años 2=meses 3=días 4=horas 5=minutos 6=se ignora
`baja` | 0=habilitada; 1=baja
`format` | JSON o XML

Devuelve el código de estado HTTP: 201 (habitación nueva ingresada) o 404 (error al agregar la habitación)

#### Ejemplo Request JSON con espacios escapados (agregar habitación)

```curl
curl -X POST $(echo "http://localhost:8000/habitaciones/nueva/71/sala 1  uti/hab d/3/0/255/6/0.json" | sed 's/ /%20/g' )
```
```php
<?php

	// variables 
	$post = 'http://localhost:8000/habitaciones/nueva';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '71',
		
		// nombre_sala
		2 => 'sala 1  uti',
		
		// nombre_habitacion
		3 => 'hab d',
		
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
	sUrl = "http://192.168.56.1:8000/habitaciones/nueva/71/sala 1  uti/hab d/3/0/255/6/0.json"

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
	"La habitación: hab d fue ingresada en la sala: SALA 1 UTI del efector: HOSP DR JOSE MARIA CULLEN"}
```

#### Ejemplo Request XML (agregar habitación ya existente)

```curl
curl -X POST http://localhost:8000/habitaciones/nueva/121/ucip/ucip/3/0/255/6/0.xml
```
```php
<?php

	// variables 
	$post = 'http://localhost:8000/habitaciones/nueva';
	$format = 'xml';
	$vars = [
		// id_efector
		1 => '121',
		
		// nombre_sala
		2 => 'ucip',
		
		// nombre_habitacion
		3 => 'ucip',
		
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
	sUrl = "http://192.168.56.1:8000/habitaciones/nueva/121/ucip/ucip/3/0/255/6/0.xml"

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

>HTTP 404 Error

```html
<?xml version="1.0" ?>
<response>
	<Error>(1) El nombre de habitación: "ucip", ya existe en la sala.</Error>
</response>
```
 
### Eliminar habitación

Eliminar una habitación.
NOTA: si la habitación tiene camas asociadas a ella, entonces las camas y la habitación no se eliminan, sino que se marcan como dadas de baja.

```endpoint
DELETE /habitaciones/eliminar/{id_efector}/{nombre_sala}/{nombre_habitacion}.{_format}
```

Variable | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala
`format` | JSON o XML

Response Devuelve el código de estado HTTP:200 (habitación eliminada) o 404 (habitación no encontrada o error)

#### Ejemplo Request JSON (eliminar habitación)

```curl
$ curl -X DELETE http://localhost:8000/habitaciones/eliminar/121/ucip/ucip.json
```
```php
<?php

	// variables 
	$delete = 'http://localhost:8000/habitaciones/eliminar';
	$format = 'json';
	$vars = [
		// id_efector
		1 => '121',
		
		// nombre_sala
		2 => 'ucip',
		
		// nombre_habitacion
		3 => 'ucip',
		
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
	sUrl = "http://192.168.56.1:8000/habitaciones/eliminar/121/ucip/ucip.json"

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
"La habitación: ucip fue eliminada/baja de la sala: UCIP del efector: HOSP DE NIÑOS DR ORLANDO ALASSIA"}
```

#### Ejemplo Request XML con espacios escapados (eliminar habitación que no existe)

```curl
$ curl -X DELETE $(echo "http://localhost:8000/habitaciones/eliminar/5/sala- pediatria/hab de prueba.xml" | sed 's/ /%20/g' )
```
```php
<?php

	// variables 
	$delete = 'http://localhost:8000/habitaciones/eliminar';
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
	sUrl = "http://192.168.56.1:8000/habitaciones/eliminar/5/sala- pediatria/hab de prueba.xml"

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
{
<?xml version="1.0" ?>
<response>
	<Error>La habitación: [hab de prueba] de la sala: [sala- pediatria] no fue encontrada en el efector: [5]</Error>
</response>

```
