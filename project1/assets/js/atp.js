import {ApiUrlConfig} from "./dashboard/ApiUrlConfig";
import {ChartDataAction} from "./dashboard/ChartDataAction";

require('chart.js');
require('chartjs-plugin-zoom');
require('./atp/graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./atp/graph/graph-styling.js');
require('./atp/graph/atp_graph.js');

global.chartDataAction = new ChartDataAction(chartAtpInstance);
global.apiUrlConfig = new ApiUrlConfig();
require('./atp/ActivityBadges');
require('./atp/ActionBagdes');
require('./dashboard/ConfigBadges');
require('./atp/graph/d3.js');