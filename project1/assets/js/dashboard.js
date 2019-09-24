import {ChartDataAction} from "./dashboard/ChartDataAction";
import {ApiUrlConfig} from "./dashboard/ApiUrlConfig";

require('chart.js');
require('chartjs-plugin-zoom');
require('chartjs-plugin-deferred');
require('./graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./graph/graph-styling.js');
require('./graph/dashboard_graph.js');
require('./graph/d3.js');

global.chartDataAction = new ChartDataAction(chartAtpInstance);
global.apiUrlConfig = new ApiUrlConfig();
require('./dashboard/Ajax');
require('./dashboard/datatable');
require('./dashboard/ActivityBadges');
require('./dashboard/ActionBagdes');
require('./dashboard/ConfigBadges');




