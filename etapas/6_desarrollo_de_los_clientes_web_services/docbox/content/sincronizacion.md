## Enviar informe completo

Librería de Web Services para ABM de la Configuración Edilicia Hospitalaria Prov. de Santa Fe

### Resincronización de datos centralizados

Inicialización y resincronización de la Configuración Edilicia de un efector.

```endpoint
POST /sync.format
```

#### Ejemplo Request (resincronización)

```curl
$ curl --data-binary @confedilicia.csv -H 'Content-type:text/plain; charset=utf-8' http://localhost:8004/sync.json
```

#### Ejemplo Response (Resincronización)

```json
{
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
```