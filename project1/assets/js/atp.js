import {ApiUrlConfig} from "./dashboard/ApiUrlConfig";
import {ChartDataAction} from "./atp/ChartDataAction";

require('chart.js');
require('chartjs-plugin-zoom');
require('chartjs-plugin-deferred');
require('./atp/graph/ftp.js');
let chartTune = document.getElementById('chartJSContainer');
global.ctx = chartTune.getContext('2d');
let BB = chartTune.getBoundingClientRect(),
    offsetX = BB.left,
    offsetY = BB.top;
let $menu = $('#contextMenu');
chartTune.addEventListener('contextmenu', handleContextMenu, false);
chartTune.addEventListener('mousedown', handleMouseDown, false);
function handleContextMenu(e){
    let paddingX = 10;
    let paddingY = 155;
    e.preventDefault();
    e.stopPropagation();
    let x = parseInt(e.clientX-offsetX+paddingX);
    let y = parseInt(e.clientY-offsetY+paddingY);
    $menu.css({left:x,top:y});
    $menu.show();
    return(false);
}

function handleMouseDown(e){
    $menu.hide();
}
 function menu(n) {
    console.log("select menu " + n);
    $menu.hide();
}


require('./atp/graph/graph-styling.js');
require('./atp/graph/atp_graph.js');

global.chartDataAction = new ChartDataAction(chartAtpInstance);
global.apiUrlConfig = new ApiUrlConfig('atp');
require('./atp/ActivityBadges');
require('./atp/ActionBagdes');
require('./dashboard/ConfigBadges');
require('./atp/graph/d3.js');
require('./functions/listeners');
require('./deafult-layout/Persons');
require('./atp/PlanFormCollapse');
