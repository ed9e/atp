require('chart.js');
require('chartjs-plugin-zoom');
require('./atp/graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./atp/graph/graph-styling.js');
require('./atp/graph/atp_graph.js');
require('./atp/graph/d3.js');