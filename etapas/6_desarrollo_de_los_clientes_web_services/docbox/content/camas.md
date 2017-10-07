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

#### Ejemplo Request JSON (modificar cama)

```curl
$ curl -X PUT $(echo "http://localhost:8004/camas/modificar/63/clinica medica/hab 5/cm-hab5-cama 2/5/L/false/false.json" | sed 's/ /%20/g' )
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

#### Ejemplo Response

>HTTP 201 Created

```json
{
  "La cama: t-hab1-cama3 fue ingresada al efector: SAMCO SAN JUSTO en la sala: tocoginecologia y la habitación: hab1"
}
```

#### Ejemplo Request XML (agregar cama ya existente)

```curl
curl -X POST http://localhost:8004/camas/nueva/292/tocoginecologia/hab1/t-hab1-cama3/1/L/false/false.xml
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

#### Ejemplo Response

>HTTP 404 Error

```html
<?xml version="1.0" ?>
	<response>
		<Error>La cama: cama_no_existe no fue encontrada en el efector: 72</Error>
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

#### Ejemplo Response

> HTTP 204 No Content

#### Ejemplo Request XML (liberar cama libre)

```curl
curl -X PATCH http://localhost:8004/camas/liberar/71/s1u-ua-4.xml
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

```endpoint
PATCH /camas/ocupar/{id_efector}/{nombre_cama}.{_format}
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_cama` | (Nombre único de cama en el efector
`format` | JSON o XML

Devuelve el código de estado HTTP: 204 (cama ocupada) o 404 (cama no encontrada o error)

#### Ejemplo Request JSON (ocupar cama)

```curl
curl -X PATCH http://localhost:8004/camas/ocupar/71/s1u-ua-4.json
```

#### Ejemplo Response

>HTTP 204 No Content

#### Ejemplo Request XML (ocupar cama ya ocupada)

```curl
curl -X PATCH http://localhost:8004/camas/ocupar/71/s1u-ua-4.xml
```

#### Ejemplo Response

>HTTP 404 Error

```html
<?xml version="1.0" ?>
	<response>
		<Error>La cama s1u-ua-4 está ocupada</Error>
	</response>
```