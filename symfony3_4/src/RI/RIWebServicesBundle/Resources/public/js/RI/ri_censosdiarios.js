agregarEstiloTablaDatatable = function (win) {

    $(win.document.body)
        .css('font-size', '10pt');

    $(win.document.body).find('table')
        .addClass('compact')
        .css('font-size', 'inherit');

    // Tamaño de la letra de la tabla
    $(win.document.body).find('table').addClass('display').css('font-size', '9px');

    $(win.document.body).find('tr:nth-child(odd) td').each(function (index) {
        $(this).css('background-color', '#D0D0D0');
    });

    // Borde de las tablas
    $(win.document.body).find('table').each(function (index) {
        $(this).css('border', '1px solid black');
    });

    $(win.document.body).find('tr').each(function (index) {
        $(this).css('border', '1px solid black');
    });

    $(win.document.body).find('td').each(function (index) {
        $(this).css('border', '1px solid black');
    });

    // Estilos para los bordes de las tablas.
    $(win.document.body).find('table').css('border-collapse', 'collapse');
    $(win.document.body).find('table').css('width', '100%');

    $(win.document.body).find('h1').css('text-align', 'center');

}

$(document).ready(
    function () {

        /* captura datos para los reportes */
        var $efector = $("#ri-cd-efector")[0].firstChild.nodeValue.trim();
        var $acd = $("#ri-cd-titulo")[0].firstChild.nodeValue.replace(/\n/gi, '').split(":");
        var $cd = $acd[0].trim() + ": " + $acd[1].trim();

        var $afecha = $("#ri-cd-fecha")[0].firstChild.nodeValue.replace(/\n/gi, '').trim().split(":");
        var $fecha = $afecha[0].trim() + ": " + $afecha[1].trim();

        var d = new Date();
        var fecha_emision = riFormatFechaLocale(d);

        var today = new Date();
        var date = today.getDate() + '-' + (today.getMonth() + 1) + '-' + today.getFullYear();


        /*  set iconos de info extra de las celdas del listado que la usen */
        $(".ri-tabla-censo-lista-info").addClass("fa-file-text");
        $(".ri-tabla-censo-lista-info-mas").addClass("fa-file-text-o");

        $('#listacensodiario').DataTable({

            scrollY: 204,
            lengthMenu: [
                [4, 7, 10, 15, 20, -1],
                [4, 7, 10, 15, 20, "Todo"]
            ],
            responsive: true,
            paging: true,
            pagingType: "full_numbers",
            stateSave: true,
            columnDefs: [

                {
                    targets: [2],
                    orderData: [2, 3]
                },

                {
                    targets: [3],
                    orderData: [3, 2]
                },

                /* links */
                {
                    targets: [0],
                    visible: false,
                    searchable: false
                },

                /* vista rapida */
                {
                    targets: [1],
                    visible: false,
                    searchable: true
                },

                /* DNI */
                {
                    targets: [4],
                    visible: false,
                    searchable: false
                },

                /* servicio o sala */
                {
                    targets: [5],
                    visible: false,
                    searchable: true
                },

                /* pase de sala */
                {
                    targets: [9],
                    visible: false,
                    searchable: true
                },

                /* pase a sala */
                {
                    targets: [14],
                    visible: false,
                    searchable: true
                },

                /* estada servicio-sala */
                {
                    targets: [16],
                    visible: false,
                    searchable: true
                },

                /* estada total */
                {
                    targets: [17],
                    visible: false,
                    searchable: true
                }

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
                    filename: "censo " + date,
                    title: "",
                    pageSize: 'A4',
                    orientation: 'landscape',
                    customize: function (doc) {

                        doc.styles.tableHeader = {
                            color: 'black',
                            background: 'grey',
                            alignment: 'center'
                        }

                        doc.styles = {
                            subheader: {
                                fontSize: 10,
                                bold: true,
                                color: 'black'
                            },
                            tableHeader: {
                                bold: true,
                                fontSize: 10.5,
                                color: 'black'
                            },
                            lastLine: {
                                bold: true,
                                fontSize: 11,
                                color: 'blue'
                            },
                            defaultStyle: {
                                fontSize: 10,
                                color: 'black'
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
                                return 6;
                            },
                            paddingRight: function (i, node) {
                                return 6;
                            },
                            paddingTop: function (i, node) {
                                return 4;
                            },
                            paddingBottom: function (i, node) {
                                return 4;
                            },
                            fillColor: function (i, node) {
                                return (i % 2 === 0) ? '#CCCCCC' : null;
                            },
                            defaultBorder: true
                        };

                        var objLayout = {};
                        objLayout['hLineWidth'] = function (i) {

                            if (i === 0) return 1;
                            else
                                return .8;
                        };
                        objLayout['vLineWidth'] = function (i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function (i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function (i) {
                            return 8;
                        };
                        objLayout['paddingRight'] = function (i) {
                            return 8;
                        };

                        // Se utiliza para que ocupe el ancho de la hoja
                        doc.content[0].table.widths =
                            Array(doc.content[0].table.body[0].length + 1).join('*').split('');

                        // Se setea el layout para la tabla principal
                        doc.content[0].layout = defaultLayout;

                        // Definimos una nueva tabla en content 1
                        doc.content.splice(1, 0, {

                            table: {
                                widths: ['*', '*', '*', '*', '*', '*', '*', '*', '*', '*', '*'],
                                body: [
                                    [
                                        {text: 'TOTALES', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}]
                                ]
                            },

                            margin: [0, 0, 0, 12],
                            alignment: 'center'
                        })
                        ;

                        var totalesLayout = {
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
                                return 6;
                            },
                            paddingRight: function (i, node) {
                                return 6;
                            },
                            paddingTop: function (i, node) {
                                return 15;
                            },
                            paddingBottom: function (i, node) {
                                return 15;
                            },
                            fillColor: function (i, node) {
                                return 'red';
                            },
                            defaultBorder: true
                        };

                        doc.content[1].table.widths = doc.content[0].table.widths;

                        doc.content[1].layout = totalesLayout;

                        var sinLineasLayout = {
                            hLineWidth: function (i, node) {
                                return 0;
                            },
                            vLineWidth: function (i, node) {
                                return 0;
                            },
                            hLineColor: function (i, node) {
                                return 'black';
                            },
                            vLineColor: function (i, node) {
                                return 'black';
                            },
                            paddingLeft: function (i, node) {
                                return 6;
                            },
                            paddingRight: function (i, node) {
                                return 6;
                            },
                            paddingTop: function (i, node) {
                                return 15;
                            },
                            paddingBottom: function (i, node) {
                                return 15;
                            },
                            fillColor: function (i, node) {
                                return 'red';
                            },
                            defaultBorder: true
                        };

                        // margin: [left, top, right, bottom]

                        // Variable que contendra todos los valores de la tabla de resumen de censo diario.
                        var vars = {};

                        $("#resumencensodiario tr:last td").each(function (index) {

                            valor = $("#resumencensodiario tr:last td").eq(index)[0].innerText;
                            vars['resumentCensoDiario' + index] = valor;

                        });

                        // Definimos una nueva tabla en content 2
                        doc.content.splice(2, 0, {
                            pageBreak: 'before',
                            table: {
                                widths: ['*', '*', '*', '*', '*', '*', '*', '*', '*', '*', '*'],
                                body: [
                                    [
                                        {
                                            rowSpan: 3,
                                            text: 'EXISTENCIA A LAS 0 Hs.',
                                            bold: true,
                                            fontSize: 10,
                                            fillColor: '#eeeeee'
                                        }
                                        , {rowSpan: 3, text: 'INGRESOS', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {rowSpan: 3, text: 'Pases de', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {colSpan: 3, text: 'EGRESOS', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {rowSpan: 3, text: '', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {rowSpan: 3, text: '', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {rowSpan: 3, text: 'Pases a', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {
                                        rowSpan: 3,
                                        text: 'Existencia a las 24 Hs',
                                        bold: true,
                                        fontSize: 10,
                                        fillColor: '#eeeeee'
                                    }
                                        , {
                                        rowSpan: 3,
                                        text: 'Entradas y salidas en el día',
                                        bold: true,
                                        fontSize: 10,
                                        fillColor: '#eeeeee'
                                    }
                                        , {
                                        rowSpan: 3,
                                        text: 'Pacientes días',
                                        bold: true,
                                        fontSize: 10,
                                        fillColor: '#eeeeee'
                                    }
                                        , {
                                        rowSpan: 3,
                                        text: 'Camas disponibles',
                                        bold: true,
                                        fontSize: 10,
                                        fillColor: '#eeeeee'
                                    }],
                                    [
                                        {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {rowSpan: 2, text: 'Altas', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {
                                        colSpan: 2,
                                        text: 'DEFUNCIONES',
                                        bold: true,
                                        fontSize: 10,
                                        fillColor: '#eeeeee'
                                    }
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}]
                                    ,
                                    [
                                        {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '-48Hs.', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {text: '+48Hs.', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}
                                        , {text: '', bold: true, fontSize: 10}]
                                    ,
                                    [
                                        {
                                            text: vars["resumentCensoDiario0"],
                                            bold: true,
                                            fontSize: 10,
                                            margin: [0, 10, 0, 10]
                                        }
                                        , {
                                        text: vars["resumentCensoDiario1"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario2"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario3"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario4"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario5"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario6"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario7"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario8"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario9"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }
                                        , {
                                        text: vars["resumentCensoDiario10"],
                                        bold: true,
                                        fontSize: 10,
                                        margin: [0, 10, 0, 10]
                                    }]
                                ]
                            },

                            margin: [0, 20, 0, 12],
                            alignment: 'center'
                        })
                        ;


                        // Hacemos que la tabla definida en content 2 ocupe el ancho completo de la hoja.
                        doc.content[2].table.widths =
                            Array(doc.content[2].table.body[0].length + 1).join('*').split('');

                        // margin: [left, top, right, bottom]

                        // Definimos una nueva tabla en content 3
                        doc.content.splice(3, 0, {

                            table: {
                                widths: ['*', '*', '*'],
                                body: [
                                    [
                                        {
                                            text: '',
                                            bold: true,
                                            fontSize: 10,
                                            margin: [0, 30, 0, 30],
                                            fillColor: '#eeeeee'
                                        }
                                        , {
                                        text: '',
                                        bold: true,
                                        fontSize: 10,
                                        border: [false, false, false, false],
                                        layout: sinLineasLayout
                                    }
                                        , {text: '', bold: true, fontSize: 10, fillColor: '#eeeeee'}
                                    ]
                                ]
                            },

                            margin: [0, 20, 0, 12],
                            alignment: 'center'
                        })
                        ;

                        // Hacemos que la tabla definida en content 3 ocupe el ancho completo de la hoja.
                        doc.content[3].table.widths =
                            Array(doc.content[3].table.body[0].length + 1).join('*').split('');

                        doc.content.splice(0, 0, {
                            text: [
                                {text: $efector, italics: true, fontSize: 12}
                            ],
                            margin: [0, 0, 0, 12],
                            alignment: 'center'
                        });

                        doc.content.splice(0, 0, {

                            table: {
                                widths: [300, '*', '*'],
                                body: [
                                    [
                                        {
                                            text: 'Sala \n ' + $("#censos_diarios_salas_salas option:selected").text(),
                                            bold: true,
                                            fontSize: 10
                                        }
                                        , {text: $efector, bold: true, fontSize: 10}
                                        , {text: $fecha, bold: true, fontSize: 10}]
                                ]
                            },

                            margin: [0, 0, 0, 12],
                            alignment: 'center'
                        });


                        doc.content.splice(0, 0, {

                            table: {
                                widths: [300, '*'],
                                body: [
                                    [
                                        {
                                            text: [
                                                {text: 'PROVINCIA DE SANTA FE \n', fontSize: 10},
                                                {
                                                    text: 'MINISTERIO DE SALUD, MEDIO \n AMBIENTE Y ACCION SOCIAL',
                                                    bold: true,
                                                    fontSize: 10
                                                }

                                            ]
                                        }
                                        , {
                                        text: [
                                            {
                                                text: 'CENSO DIARIO \n',
                                                bold: true, fontSize: 18
                                            },
                                            {
                                                text: 'Para uso interno del hospital',
                                                fontSize: 10
                                            }

                                        ]
                                    }]
                                ]
                            },

                            margin: [0, 0, 0, 22],
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

                        doc["pageBreakBefore"] = function (currentNode, followingNodesOnPage, nodesOnNextPage, previousNodesOnPage) {
                            //check if signature part is completely on the last page, add pagebreak if not
                            if (currentNode.id === 'signature' && (currentNode.pageNumbers.length != 1 || currentNode.pageNumbers[0] != currentNode.pages)) {
                                return true;
                            }
                            //check if last paragraph is entirely on a single page, add pagebreak if not
                            else if (currentNode.id === 'closingParagraph' && currentNode.pageNumbers.length != 1) {
                                return true;
                            }
                            return false;
                        };

                        console.log(doc);

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
                    footer: true,
                    text: '<i class="fa fa-print"></i>',
                    exportOptions: {
                        columns: ':visible',
                    },
                    customize: function (win) {

                        $(win.document.head).empty();

                        //debugger;

                        $(win.document.body).find("h1").remove()

                        //$(win.document.body).remove();

                        // Variable que contendra todos los valores de la tabla de resumen de censo diario.
                        var vars = {};

                        $("#resumencensodiario tr:last td").each(function (index) {

                            valor = $("#resumencensodiario tr:last td").eq(index)[0].innerText;
                            vars['resumentCensoDiario' + index] = valor;

                        });

                        agregarEstiloTablaDatatable(win);

                        // sala o servicio
                        var str = $("h4").html();
                        str = str.replace(/\s/g, '').toUpperCase();

                        if (str != "SALAS") {
                            texto = "Servicio";
                            salaServicio = $("#censos_diarios_servicios_efectores_servicios option:selected").text();
                        }
                        else {
                            texto = "Sala";
                            salaServicio = $("#censos_diarios_salas_salas option:selected").text();
                        }

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
                        table += "    padding: 8px; background-color: white !important;";
                        table += "}";
                        table += "";
                        table += "tr:nth-child(even) {";
                        table += "    background-color: white !important;";
                        table += "}";
                        table += "<\/style>";
                        table += "<table id='printStyles'>";
                        table += "  <tr>";
                        table += "    <th style='width: 350px;font-size: 9px'>PROVINCIA DE SANTA FE <br> <negrita style='font-weight: bolder'>MINISTERIO DE SALUD, MEDIO <br>AMBIENTE Y ACCIÓN SOCIAL</negrita><\/th>";
                        table += "    <th colspan='2'><titulo style='font-size: 16px; font-weight: bolder'>CENSO DIARIO " + str + "</titulo><br>Para uso interno del hospital<\/th>";
                        table += "  <\/tr>";
                        table += "<\/table>";
                        table += "<table id='printStyles2'>";
                        table += "  <tr>";
                        table += "    <th> " + texto + " <br> " + salaServicio + "<\/th>";
                        table += "    <th>Efector <br> " + $efector + "<\/th>";
                        table += "    <th>Fecha <br> " + $fecha + "<\/th>";
                        table += "  <\/tr>";
                        table += "<\/table>";

                        $(win.document.body)
                            .prepend(
                                table
                            );

                        var table = "";
                        table += "<style>";
                        table += "#printStyles3 {font-size: 10px !important;margin-top:15px; margin-bottom:15px;}";
                        table += "<\/style>";
                        table += "<table id='printStyles3'>";
                        table += "  <tr>";
                        table += "    <th rowspan='3'>Existencia a las 0 Hs.<\/th>";
                        table += "    <th rowspan='3'>Ingresos<\/th>";
                        table += "    <th rowspan='3'>Pases de<\/th>";
                        table += "    <th colspan='3'>EGRESOS<\/th>";
                        table += "    <th rowspan='3'>Pases a<\/th>";
                        table += "    <th rowspan='3'>Existencia a las 24 Hs.<\/th>";
                        table += "    <th rowspan='3'>Entradas y salidas en el día<\/th>";
                        table += "    <th rowspan='3'>Pacientes días<br><\/th>";
                        table += "    <th rowspan='3'>Camas disponibles<\/th>";
                        table += "  <\/tr>";
                        table += "  <tr>";
                        table += "    <th> Altas<\/th>";
                        table += "    <th colspan='2'>DEFUNCIONES<\/th>";
                        table += "  <\/tr>";
                        table += "  <tr>";
                        table += "    <th> -48 Hs.<\/th>";
                        table += "    <th>+48 Hs.<\/th>";
                        table += "  <\/tr>";
                        table += "  <tr>";
                        table += "    <th> " + vars["resumentCensoDiario0"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario1"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario2"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario3"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario4"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario5"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario6"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario7"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario8"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario9"] + "<\/th>";
                        table += "    <th> " + vars["resumentCensoDiario10"] + "<\/th>";
                        table += "  <\/tr>";
                        table += "<\/table>";

                        $(win.document.body)
                            .append(table);

                        var table = "";
                        table += "<style>";
                        table += "#printStyles4 {font-size: 10px !important;margin-top:15px; margin-bottom:15px}";
                        table += "<\/style>";
                        table += "<table id='printStyles4'>";
                        table += "  <tr>";
                        table += "    <th rowspan='3' style='text-align:left !important'>OBSERVACIONES<\/th>";
                        table += "    <th rowspan='3' style='border-top:0px; border-bottom: 0px;width: 150px'><\/th>";
                        table += "    <th rowspan='2' style='text-align:left !important;border-bottom: 0px;'>FIRMA<\/th>";
                        table += "  <\/tr>";

                        table += "  <tr>";

                        table += "  <\/tr>";

                        table += "  <tr>";
                        table += "    <th style='border-top:0px !important;text-align:left !important'>ACLARACION<\/th>";
                        table += "  <\/tr>";


                        table += "<\/table>";

                        $(win.document.body)
                            .append(table);

                        // Mandamos a imprimir automaticamente el reporte.

                        win.print();

                        // Luego de elegir una opción hacemos que se cierre la ventana abierta.

                        win.close();

                    },
                    text: '<i class="fa fa-print"></i>',
                    exportOptions: {
                        columns: ':visible'
                    }
                },

                {
                    extend: 'colvis',
                    postfixButtons: ['colvisRestore'],
                    collectionLayout: 'fixed four-column'
                }

            ]

        });


        $('#resumencensodiario').DataTable({

            responsive: true,
            paging: false,
            searching: false,
            ordering: false,
            bInfo: false,
            language: {
                url: "../../bundles/ri/js/datatable/espanol.json"
            },
            columnDefs: [

                /* pases de salas */
                {
                    targets: [2],
                    visible: false,
                    searchable: true
                },

                /* pases a salas */
                {
                    targets: [7],
                    visible: false,
                    searchable: true
                },

                /* pases a salas */
                {
                    targets: [7],
                    visible: false,
                    searchable: true
                },

                /* dias de estada */
                {
                    targets: [11],
                    visible: false,
                    searchable: true
                },

                /* total camas */
                {
                    targets: [12],
                    visible: false,
                    searchable: true
                }
            ]

        });


    }
);
