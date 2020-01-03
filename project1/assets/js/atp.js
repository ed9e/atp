require('../css/atp.scss');
require('./atp/graph/ftp.js');
require('./atp/graph/fsb.js');
import {ChartDataAction} from "./atp/ChartDataAction";

require('chart.js');
require('chartjs-plugin-zoom');
require('chartjs-plugin-deferred');

global.chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');

require('./atp/ContextMenu');

require('./atp/graph/graph-styling.js');
require('./atp/graph/atp_graph.js');

global.chartDataAction = new ChartDataAction(chartAtpInstance);

require('./atp/ActivityBadges');
require('./atp/ActionBagdes');
require('./dashboard/ConfigBadges');
require('./atp/graph/d3.js');
require('./functions/listeners');
require('./atp/listeners');
require('./graph-layout/Persons');
require('./atp/Plans');
