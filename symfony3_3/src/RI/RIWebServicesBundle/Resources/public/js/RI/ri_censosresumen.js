agregarEstiloTablaDatatable = function (win) {

    $(win.document.body)
        .css( 'font-size', '10pt' );

    $(win.document.body).find( 'table' )
        .addClass( 'compact' )
        .css( 'font-size', 'inherit' );

    // Tamaño de la letra de la tabla
    $(win.document.body).find('table').addClass('display').css('font-size', '9px');

    $(win.document.body).find('tr:nth-child(odd) td').each(function(index){
        $(this).css('background-color','#D0D0D0');
    });

    // Borde de las tablas
    $(win.document.body).find('table').each(function(index){
        $(this).css('border','1px solid black');
    });

    $(win.document.body).find('tr').each(function(index){
        $(this).css('border','1px solid black');
    });

    $(win.document.body).find('td').each(function(index){
        $(this).css('border','1px solid black');
    });

    // Estilos para los bordes de las tablas.
    $(win.document.body).find('table').css('border-collapse', 'collapse');
    $(win.document.body).find('table').css('width', '100%');

    $(win.document.body).find('h1').css('text-align','center');

}

$(document).ready(
    function () {

        /* captura datos para los reportes */
        var $efector = $("#ri-cr-efector")[0].firstChild.nodeValue.trim();
        var $acd = $("#ri-cr-titulo")[0].firstChild.nodeValue.replace(/\n/gi, '').split(":");
        var $cd = $acd[0].trim() + ": " + $acd[1].trim();

        var $afecha_desde = $("#ri-cr-fecha-desde")[0].firstChild.nodeValue.replace(/\n/gi, '').trim().split(":");
        var $fecha_desde = $afecha_desde[0].trim() + ": " + $afecha_desde[1].trim();

        var $afecha_hasta = $("#ri-cr-fecha-hasta")[0].firstChild.nodeValue.replace(/\n/gi, '').trim().split(":");
        var $fecha_hasta = $afecha_hasta[0].trim() + ": " + $afecha_hasta[1].trim();

        var d = new Date();
        var fecha_emision = riFormatFechaLocale(d);

        var css = '@page { size: legal landscape; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet){
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);

        $('#resumencensoperiodo').DataTable({

            scrollY: 300,
            scrollX: true,
            responsive: false,
            paging: false,
            stateSave: true,
            ordering: false,
            columnDefs: [

                /* pases de salas */
                {
                    targets: [3],
                    visible: false,
                    searchable: true
                },

                /* pases a salas */
                {
                    targets: [8],
                    visible: false,
                    searchable: true
                },
            ],
            language: {
                url: "../../bundles/ri/js/datatable/espanol.json",
                buttons: {
                    colvis: '<i class="fa fa-columns"></i>',
                    colvisRestore: 'Restaurar'
                }
            },

            processing: true,

            /*

             l - length changing input control
             f - filtering input
             t - The table!
             i - Table information summary
             p - pagination control
             r - processing display element

             */

            dom: 'Blftirp',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF',
                    extension: ".pdf",
                    filename: "Censo Resumen",
                    title: "",
                    orientation: 'landscape',
                    content: [{style: 'fullWidth'}],
                    styles: { // style for printing PDF body
                        fullWidth: {fontSize: 6}
                    },
                    customize: function (doc) {

                        doc.styles = {
                            subheader: {
                                fontSize: 6,
                                bold: true,
                                color: 'black'
                            },
                            tableHeader: {
                                bold: true,
                                fontSize: 6,
                                color: 'black'
                            },
                            lastLine: {
                                bold: true,
                                fontSize: 6,
                                color: 'blue'
                            },
                            defaultStyle: {
                                fontSize: 6,
                                color: 'black'
                            },
                            table: {
                                fontSize: 6
                            },
                            tableBodyOdd:{
                                fontSize: 6
                            },
                            tableBodyEven:{
                                fontSize: 6
                            }
                        }

                        var defaultLayout = {
                            hLineWidth: function (i, node) {
                                return 1;
                            },
                            vLineWidth: function (i, node) {
                                return 1;
                            },
                            hLineColor: function (i, node) {
                                return 'black';
                            },
                            vLineColor: function (i, node) {
                                return 'black';
                            },
                            paddingLeft: function (i, node) {
                                return 1;
                            },
                            paddingRight: function (i, node) {
                                return 1;
                            },
                            paddingTop: function (i, node) {
                                return 2;
                            },
                            paddingBottom: function (i, node) {
                                return 2;
                            },
                            fillColor: function (i, node) {
                                return (i % 2 === 0) ? '#CCCCCC' : null;
                            },
                            defaultBorder: true
                        };

                        // Se utiliza para que ocupe el ancho de la hoja
                        doc.content[0].table.widths =
                            Array(doc.content[0].table.body[0].length + 1).join('*').split('');

                        // Se setea el layout para la tabla principal
                        doc.content[0].layout = defaultLayout;

                        var fecha_desde = $("#censos_resumen_salas_fecha_censo_desde").val();
                        if (fecha_desde !== "") {
                            fecha_desde = "Fecha desde " + fecha_desde;

                        }

                        var fecha_hasta = $("#censos_resumen_salas_fecha_censo_hasta").val();
                        if (fecha_hasta !== "") {
                            fecha_hasta = "Fecha hasta " + fecha_hasta;

                        }

                        debugger;

                        doc.content.splice(0, 0, {

                            table: {
                                widths: [300, '*', '*'],
                                body: [
                                    [
                                        {
                                            text: 'Efector \n ' + $("#censos_resumen_efectores option:selected").text(),
                                            bold: true,
                                            fontSize: 10
                                        }
                                        , {text: fecha_desde, bold: true, fontSize: 10}
                                        , {text: fecha_hasta, bold: true, fontSize: 10}]
                                ]
                            },

                            margin: [0, 0, 0, 12],
                            alignment: 'center'
                        });

                        doc['footer'] = (function (page, pages) {
                            return {
                                margin: [10, 10],
                                columns: [
                                    'Fecha de emisión: ' + fecha_emision,
                                    {
                                        alignment: 'right',
                                        text: [
                                            {text: 'Página ', bold: true},
                                            {text: page.toString(), bold: true},
                                            {text: ' de ', bold: true},
                                            {text: pages.toString(), bold: true}
                                        ]
                                    }
                                ]
                            };
                        });

                        debugger;

                    },
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'CSV',
                    fieldSeparator: ';',
                    fieldBoundary: '"',
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'print',
                    customize: function ( win ) {

                        $(win.document.head).empty();

                        $(win.document.body).find("h1").remove()

                        agregarEstiloTablaDatatable(win);

                        var fecha_desde = $("#censos_resumen_salas_fecha_censo_desde").val();
                        if (fecha_desde !== "") {
                            fecha_desde = "Fecha desde " + fecha_desde;

                        }

                        var fecha_hasta = $("#censos_resumen_salas_fecha_censo_hasta").val();
                        if (fecha_hasta !== "") {
                            fecha_hasta = "Fecha hasta " + fecha_hasta;

                        }

                        // sala o servicio
                        var str = $("h4").html();
                        str = str.replace(/\s/g, '').toUpperCase();

                        var table = "";
                        table += "<style>";
                        table += "#printStyles {font-size: 12px !important}";
                        table += "#printStyles2 {font-size: 10px !important;margin-top:15px; margin-bottom:15px}";
                        table += "table {";
                        table += "    font-family: arial, sans-serif;";
                        table += "    border-collapse: collapse;";
                        table += "    width: 100%;";
                        table += "}";
                        table += "";
                        table += "td, th {";
                        table += "    border: 1px solid black;";
                        table += "    text-align: center;";
                        table += "    padding: 8px; background-color: white !important";
                        table += "}";
                        table += "";
                        table += "tr:nth-child(even) {";
                        table += "    background-color: white !important;";
                        table += "}";
                        table += "<\/style>";
                        table += "<table id='printStyles2'>";
                        table += "  <tr>";
                        table += "    <th style='font-size: 9px'>PROVINCIA DE SANTA FE <br> <negrita style='font-weight: bolder'>MINISTERIO DE SALUD, MEDIO <br>AMBIENTE Y ACCIÓN SOCIAL</negrita><\/th>";
                        table += "    <th colspan='2'><titulo style='font-size: 16px; font-weight: bolder'>CENSO RESUMEN "+ str +" </titulo><br>Para uso interno del hospital<\/th>";
                        table += "    <th>Efector <br> " + $("#censos_resumen_efectores option:selected").text() + "<\/th>";
                        table += "    <th>Fecha desde <br> " + fecha_desde + "<\/th>";
                        table += "    <th>Fecha hasta <br> " + fecha_hasta + "<\/th>";
                        table += "  <\/tr>";
                        table += "<\/table>";

                        $(win.document.body)
                            .prepend(
                                table
                            );

                        // Mandamos a imprimir automaticamente el reporte.

                        win.print();

                        // Luego de elegir una opción hacemos que se cierre la ventana abierta.

                        win.close();

                    },
                    text: '<i class="fa fa-print"></i>',
                    exportOptions: {
                        columns: ':visible',
                    }
                },

                {
                    extend: 'colvis',
                    postfixButtons: ['colvisRestore'],
                    collectionLayout: 'fixed four-column'
                }

            ]

        });

    }
);
