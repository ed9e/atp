import {ChartDataAction} from "./dashboard/ChartDataAction";

require('chart.js');
require('chartjs-plugin-zoom');
require('./graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./graph/graph-styling.js');
require('./graph/dashboard_graph.js');
require('./graph/d3.js');

global.chartDataAction = new ChartDataAction(chartAtpInstance);
require('./dashboard/Ajax');
require('./dashboard/datatable');
require('./dashboard/ActivityBadges');
require('./dashboard/ActionBagdes');
require('./dashboard/ConfigBadges');




