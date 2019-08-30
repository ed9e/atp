require('chart.js');
require('chartjs-plugin-zoom');
require('./graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./graph/graph-styling.js');
require('./graph/dashboard_graph.js');
require('./graph/d3.js');
require( 'datatables.net-bs4' );
require( 'datatables.net-editor-bs4' );
require( 'datatables.net-buttons-bs4' );
require( 'datatables.net-buttons/js/buttons.colVis.js' );
require( 'datatables.net-colreorder-bs4' );
require( 'datatables.net-fixedcolumns-bs4' );
require( 'datatables.net-fixedheader-bs4' );
require( 'datatables.net-responsive-bs4' );
require( 'datatables.net-rowreorder-bs4' );
require( 'datatables.net-scroller-bs4' );
require( 'datatables.net-select-bs4' );


$(document).ready(function () {
    let table = $('#data-table').DataTable({
        'ajax': '/api',
        //'rowsGroup': [2],
        'columns': [
            {"data": "startTimeLocal.date"},
            {"data": "activityName"},
            {"data": "activityTypeKey"},
            {"data": "distance"},
            {"data": "duration"},
            {"data": "averageSpeed"},
            {"data": "averageHR"},
            {"data": "averageRunCadence"},
            {"data": "strideLength"},
            {"data": "verticalOscillation"},
            {"data": "trainingEffect"},
            {"data": "vO2MaxValue"},
            {"data": "avgGroundContactBalance"},
        ],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        let data = row.data();
                        return 'Details for ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        paging: false,
        colReorder: true,
        select: true
    });
});