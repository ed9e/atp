require('chart.js');
require('chartjs-plugin-zoom');
require('./graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./graph/graph-styling.js');
require('./graph/dashboard_graph.js');
require('./graph/d3.js');

require('datatables.net-editor-bs');


$(document).ready(function () {
    let table = $('#example').DataTable({
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
        ]
    });
});