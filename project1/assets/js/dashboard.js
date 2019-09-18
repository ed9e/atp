require('chart.js');
require('chartjs-plugin-zoom');
require('./graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./graph/graph-styling.js');
require('./graph/dashboard_graph.js');
require('./graph/d3.js');

require('./dashboard/checkers');
require('./dashboard/ActivityBadges');
require('./dashboard/datatable');

