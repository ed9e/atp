require('chart.js');
require('./graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');
require('../css/graphTest.css');
require('./graph/graph-styling.js');
require('./graph/graph.js');
require('./graph/d3.js');