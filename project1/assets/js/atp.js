require('chart.js');
require('chartjs-plugin-zoom');
require('./graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');
require('../css/atp.css');
require('./graph/graph-styling.js');
require('./graph/graph.js');
require('./graph/d3.js');