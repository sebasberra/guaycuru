/**
 * Devuelve un string formateado con el Locale y con la hora quitando los segundo
 * 
 * @param {Date} d
 * @return {String}
 */
function riFormatFechaLocale(d){
        
    return d.toLocaleDateString() + 
           " " + 
           d.toLocaleTimeString().substring(0,d.toLocaleTimeString().length-3) + 
           " hs";

}

/**
 * Obtiene un Date del campo formateado 'dd/mm/yyyy'
 * 
 * @param {String} str_fecha
 * @return {Date}
 */
function riGetDateOfCampoFecha(str_fecha){
    
    var dia=(str_fecha).substring(0,2);
    var mes=(str_fecha).substring(3,5);
    var anio=(str_fecha).substring(6,11);

    var fc = new Date(anio+"-"+mes+"-"+dia);
    
    return fc;
    
}

/**
 * Obtiene un string 'dd/mm/yyyy' del string fecha pasado como parametro 
 * 
 * @param {String} str_fecha
 * @return {String}
 */
function riGetStringOfStringFecha(str_fecha){
    
    var fc = new Date(str_fecha);
    
    var dia_aux = (String)(fc.getDate());
    var dia = ('00' + dia_aux ).substring(dia_aux.length);
    
    var mes_aux = (String)(fc.getMonth()+1);
    var mes = ('00' + mes_aux).substring(mes_aux.length);
    
    var anio_aux = (String)(fc.getFullYear());
    var anio=('0000' + anio_aux).substring(anio_aux.length);
    
    var res = dia+"/"+mes+"/"+anio;
    
    //console.log(res);
    return res;
    
}


/**
 * Devuelve tipo String formateado dd/mm/yyyy del Date pasado como parametro
 * 
 * @param {Date} fecha
 * @return {String}
 */
function riGetCampoFechaOfDate(fecha){
    
    var diam1=fecha.getUTCDate();
    var mesm1=(fecha.getUTCMonth()+1);

    if (diam1<10) {
        diam1='0'+diam1;
    }
    if (mesm1<10){
        mesm1='0'+mesm1;
    }
    
    return (diam1+"/"+mesm1+"/"+fecha.getUTCFullYear());
    
}
