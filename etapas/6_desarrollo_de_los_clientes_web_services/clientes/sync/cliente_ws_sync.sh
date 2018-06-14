# 1) Genera la consulta Informe Configuracion Edilicia
#
#		mysql -uroot alassia_hmi2_20161111 <informe_confedilicia.sql
#
# 2) La salida la transforma a archivo "csv" con el comando "sed"
#
#	Comando "sed":
#		2.1) escapa los '
#				s/'/\'/
#		2.2) reemplaza los "tab" por: ","
#				s/\t/\",\"/g
#		2.3) reemplaza el comienzo de linea por: "
#				s/^/\"/
#		2.4) reemplaza el fin de linea por: "
#				s/$/\"/
#
# 3) Genera el archivo "confedilicia.csv"
#
#		>confedilicia.csv
mysql -uroot alassia_hmi2_20161111 <informe_confedilicia.sql | sed "s/'/\'/;s/\t/\",\"/g;s/^/\"/;s/$/\"/" >confedilicia.csv

# Genera una peticion(Request) POST con el archivo "confedilicia.csv" como "BODY"
echo -e $(curl -u user_ws:user_ws  -H usuario:cpodesta -H password:77551a4d953835191ccd8c8eb223f631 --data-binary @confedilicia.csv -H 'Content-type:text/plain; charset=utf-8' http://localhost:8005/api/sync/121.json)
