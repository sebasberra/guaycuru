## Habitaciones

Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe

### Ver habitación

Obtiene los datos de la habitación

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala

```endpoint
GET /habitaciones/ver/{id_efector}/{nombre_sala}/{nombre_habitacion}.format
```

#### Ejemplo Request (ver habitación)

```curl
$ curl http://localhost:8004/habitaciones/ver/{id_efector}/{nombre_sala}/{nombre_habitacion}.json
```
##### Ejemplo Request con espacios escapados (ver habitación)
```curl
$ curl $(echo "http://localhost:8004/habitaciones/ver/121/cim iii/cim iii.json" | sed 's/ /%20/g' )
```

#### Ejemplo Response (ver habitación)

```json
{
"idHabitacion":{
	"idHabitacion": 5,
	"nombre": "CIM III",
	"sexo": 3,
	"edadDesde": 0,
	"edadHasta": 18,
	"tipoEdad": "1",
	"cantCamas": 30,
	"baja": false,
	"fechaModificacion": "2017-05-24T22:08:22+00:00",
	"idSala":{
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
		},
	"areaEfectorServicio": null,
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

Devuelve el código de estado HTTP: 200(OK - Información de habitación) o 404 (habitación no encontrada)
     
### Modificar habitación

Modificar datos de la habitación

```endpoint
PUT /habitaciones/modificar/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.format
```

#### Ejemplo Request (modificar habitación)

```curl
curl -X PUT http://localhost:8004/habitaciones/modificar/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.json
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala
`sexo` | 1=varones 2=mujeres 3=mixta
`edad_desde` | Edad desde permitida
`edad_hasta` | Edad hasta permitida
`tipo_edad` | 1=años 2=meses 3=días 4=horas 5=minutos 6=se ignora
`baja` | 0=habilitada; 1=baja

#### Ejemplo Response (modificar habitación)

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

Devuelve el código de estado HTTP: 204 (habitación actualizada) o 404 (error de actualización)
     
### Agregar habitación

Agregar una habitación

```endpoint
POST /habitaciones/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.format
```

#### Ejemplo Request (agregar habitación)

```curl
curl http://localhost:8004/habitaciones/nueva/{id_efector}/{nombre_sala}/{nombre_habitacion}/{sexo}/{edad_desde}/{edad_hasta}/{tipo_edad}/{baja}.json
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala
`sexo` | 1=varones 2=mujeres 3=mixta
`edad_desde` | Edad desde permitida
`edad_hasta` | Edad hasta permitida
`tipo_edad` | 1=años 2=meses 3=días 4=horas 5=minutos 6=se ignora
`baja` | 0=habilitada; 1=baja

#### Ejemplo Response (agregar habitación)

```json
{
  "owner": "{username}",
  "id": "{wobble_id}",
  "created": "{timestamp}",
  "modified": "{timestamp}"
}
```

Devuelve el código de estado HTTP: 201 (habitación nueva ingresada) o 404 (error al agregar la habitación)
     
### Eliminar habitación

Eliminar una habitación

```endpoint
DELETE /habitaciones/eliminar/{id_efector}/{nombre_sala}/{nombre_habitacion}.format
```

#### Ejemplo Request (eliminar habitación)

```curl
$ curl -X DELETE https://localhost:8004/habitaciones/eliminar/{id_efector}/{nombre_sala}/{nombre_habitacion}.json
```

Propiedad | Descripción
---|---
`id_efector` | ID efector
`nombre_sala` | Nombre único de sala en el efector
`nombre_habitacion` | Nombre único de habitación dentro de la sala

#### Ejemplo Response (eliminar habitación)

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

Response Devuelve el código de estado HTTP:200 (habitación eliminada) o 404 (habitación no encontrada o error)