import * as d3 from 'd3';

d3.select(chartAtpInstance.chart.canvas).call(
    d3.drag().container(chartAtpInstance.chart.canvas)
        .on('start', getElement)
        .on('drag', updateData)
        .on('end', callback)
);

let par = {
    chart: undefined,
    element: undefined,
    scale: undefined,
    value: undefined,
    grabOffsetY: undefined,
    index: undefined,
    datasetIndex: undefined,
};

//Get an class of {points: [{x, y},], type: event.type} clicked or touched
function getEventPoints(event) {
    let retval = {
        point: [],
        type: event.type
    };
    //Get x,y of mouse point or touch event
    if (event.type.startsWith("touch")) {
        //Return x,y of one or more touches
        //Note 'changedTouches' has missing iterators and can not be iterated with forEach
        for (let i = 0; i < event.changedTouches.length; i++) {
            let touch = event.changedTouches.item(i);
            retval.point.push({
                x: touch.clientX,
                y: touch.clientY
            })
        }
    } else if (event.type.startsWith("mouse")) {
        //Return x,y of mouse event
        retval.point.push({
            x: event.layerX,
            y: event.layerY
        })
    }
    return retval;
}

function getElement() {
    let e = d3.event.sourceEvent;

    //would be nice if the reference to chartinstance was found in e
    //How?

    par.scale = undefined;

    par.element = chartAtpInstance.getElementAtEvent(e)[0];

    par.chart = par.element['_chart'];
    par.scale = par.element['_yScale'];

    par.datasetIndex = par.element['_datasetIndex'];
    par.index = par.element['_index'];

    //Get pixel y-offset from datapoint to mouse/touch point
    par.grabOffsetY = par.scale.getPixelForValue(
        par.chart.config.data.datasets[par.datasetIndex].data[par.index],
        par.index,
        par.datasetIndex,
        false
    ) - getEventPoints(e).point[0].y;

    par.value = Math.floor(par.scale.getValueForPixel(
        par.grabOffsetY + getEventPoints(e).point[0].y) + 0.5);
    par.value = Math.max(0, Math.min(atpYAxes.max - 100, par.value));
    drawValue(par);
}


function updateData() {
    let e = d3.event.sourceEvent;

    if (par.datasetIndex != 0) {
        return;
    }

    par.value = Math.floor(par.scale.getValueForPixel(
        par.grabOffsetY + getEventPoints(e).point[0].y) + 0.5);
    par.value = Math.max(0, Math.min(atpYAxes.max - 100, par.value));

    par.chart.config.data.datasets[par.datasetIndex].data[par.index].y = par.value;
    //par.chart.config.data.datasets[2].data[par.index] =  par.value;
    par.chart.config.data.datasets[2].data = par.chart.config.data.datasets[par.datasetIndex].data.ftpO();

    chartAtpInstance.update(0);

    drawValue(par);
}

function drawValue(par) {
    par.chart.ctx.fillStyle = general.bar.valueColor;
    par.chart.ctx.textAlign = "center";
    par.chart.ctx.textBaseline = "bottom";
    let duration = moment.duration(par.value, 'minutes');
    let text = duration.get('hours') + ':' + duration.get('minutes');
    par.chart.ctx.fillText(text, par.element._model.x, par.element._model.y - 5);
}

let chartXyDisplay = document.getElementById("yPos");

//Show y data after point drag
function callback() {
    chartXyDisplay.innerHTML = par.value;
}

//Apply changes to old dataset
let history = [];
document.getElementById('applyChanges').addEventListener('click', function () {
    history.push(atpOptions.data.datasets[1].data.slice());
    atpOptions.data.datasets[1].data = atpOptions.data.datasets[0].data.slice();
    chartAtpInstance.update();
});

//Cancel changes - rrevert to old dataset
document.getElementById('cancelChanges').addEventListener('click', function () {
    atpOptions.data.datasets[0].data = atpOptions.data.datasets[1].data.slice();

});

//Cancel changes - rrevert to old dataset
document.getElementById('undoChanges').addEventListener('click', function () {
    var data = history.pop();
    if (data) {
        atpOptions.data.datasets[0].data = data.slice();
        atpOptions.data.datasets[1].data = data.slice();
        atpOptions.data.datasets[2].data = data.slice().ftpO();

        chartAtpInstance.update();
    }
});