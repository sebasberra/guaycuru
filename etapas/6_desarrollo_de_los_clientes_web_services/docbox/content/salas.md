## Salas

Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe

### Ver sala

Obtiene los datos de la sala

```endpoint
GET /salas/ver/{id_efector}/{nombre_sala}.format
```

#### Ejemplo Request (ver sala)

```curl
$ curl https://localhost:8004/salas/ver/{id_efector}/{nombre_sala}.json
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector

#### Ejemplo Response (ver sala)

```json
{
"idSala": 121003,
"nroSala": 3,
"nombre": "CIM III",
"cantCamas": 30,
"moverCamas": false,
"areaCodServicio": null,
"areaSector": null,
"areaSubsector": null,
"baja": false,
"fechaModificacion": "2017-05-24T22:08:22+00:00",
"idEfector":{
	"idEfector": 121,
	"idNodo": 3,
	"idSubnodo": 13,
	"idDependenciaAdm": 4,
	"idRegimenJuridico": 2,
	"idNivelComplejidad": 2,
	"claveestd": "06309362",
	"clavesisa": "11820632184264",
	"tipoEfector": "2",
	"nomEfector": "HOSP DE NIÑOS DR ORLANDO ALASSIA",
	"nomRedEfector": "SANTA FE HOSPITAL DE NIÑOS",
	"nodo": 3,
	"subnodo": 1,
	"internacion": true,
	"baja": false,
	"idLocalidad":{
		"idLocalidad": 279,
		"idDpto": 9,
		"nomLoc": "SANTA FE",
		"codLoc": "27",
		"codDpto": "063",
		"codProv": "82",
		"codPais": "200",
		"codPostal": "3000",
		"__initializer__": null,
		"__cloner__": null,
		"__isInitialized__": true
	},
	"__initializer__": null,
	"__cloner__": null,
	"__isInitialized__": true
}
}
```
Response Devuelve el código de estado HTTP: 200(OK - Información de sala) o 404 (sala no encontrada)
     
### Modificar sala

Modificar datos de la sala

```endpoint
PUT /salas/modificar/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}.format
```

#### Ejemplo Request (modificar sala)

```curl
curl -X PUT https://localhost:8004/salas/modificar/{id_efector}/{nombre_sala}/{area_cod_servicio}/{area_sector}/{area_subsector}/{mover_camas}/{baja}.json
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`area_cod_servicio` | código de 3 dígitos del área SIPES
`area_sector` | campo sector correspondiente al área SIPES (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)
`area_subsector` | subsector correspondiente al área SIPES (4=internación; 5=CE; 6=atención domiciliaria)
`mover_camas` | bandera para el sistema que indica si se permite mover camas entre las habitaciones de la misma sala. por ejemplo: las incubadoras
`baja` | 0=habilitada; 1=baja

#### Ejemplo Response (modificar sala)

```json
{
  "owner": "{username}",
  "id": "{wobble_id}",
  "name": null,
  "description": null,
  "created": "{timestamp}",
  "modified": "{timestamp}"
}
```
Devuelve el código de estado HTTP: 204 (sala actualizada) o 404 (error de actualización)

### Agregar sala

Agregar una sala.

```endpoint
POST /salas/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.format
```

#### Ejemplo Request (agregar sala)

```curl
curl https://localhost:8004/salas/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.json
```
Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`area_cod_servicio` | código de 3 dígitos del área SIPES
`area_sector` | campo sector correspondiente al área SIPES (1=varones; 2=mujeres; 3=mixto; >3 mixto estudios, talleres, etc)
`area_subsector` | subsector correspondiente al área SIPES (4=internación; 5=CE; 6=atención domiciliaria)
`mover_camas` | bandera para el sistema que indica si se permite mover camas entre las habitaciones de la misma sala. por ejemplo: las incubadoras
`baja` | 0=habilitada; 1=baja

#### Ejemplo Response (agregar sala)

```json
{
  "owner": "{username}",
  "id": "{wobble_id}",
  "created": "{timestamp}",
  "modified": "{timestamp}"
}
```
Response Devuelve el código de estado HTTP: 201 (sala nueva ingresada) o 404 (error al agregar la sala)

### Eliminar sala

Eliminar una sala.

```endpoint
DELETE /salas/eliminar/{id_efector}/{nombre_sala}.format
```

#### Ejemplo Request (eliminar sala)

```curl
$ curl -X DELETE https://localhost:8004/salas/eliminar/{id_efector}/{nombre_sala}.json
```
Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector

#### Ejemplo Response (eliminar sala)

```json
{
  "owner": "{username}",
  "id": "{wobble_id}",
  "name": "foo",
  "description": "bar",
  "created": "{timestamp}",
  "modified": "{timestamp}"
}
```
Devuelve el código de estado HTTP:200 (sala eliminada) o 404 (sala no encontrada o error)