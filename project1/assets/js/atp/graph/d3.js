import * as d3 from 'd3';
import {formFSB_data, FTP_data, FTP_data0} from "./DataSetFunctions";
import {PhaseDrag} from "./PhaseDrag";

d3.select(chartAtpInstance.chart.canvas).call(
    d3.drag().container(chartAtpInstance.chart.canvas)
        .on('start', getElement)
        .on('drag', updateData)
        .on('end', callback)
);

let _tmpZoomSpeed;
d3.select(chartAtpInstance.chart.canvas).call(
    d3.zoom()
        .on('start', () => scrollStart(d3.event))
        .on('zoom', () => scroll(d3.event))
        .on("end", () => scrollEnd(d3.event))
);

let par = {
    chart: undefined,
    element: undefined,
    scale: undefined,
    value: undefined,
    grabOffsetY: undefined,
    grabOffsetX: undefined,
    index: undefined,
    datasetIndex: undefined,
};

let phaseDrag;

function scrollStart(t) {
}

function scrollEnd(t) {
}

function scroll(t) {

    let e = t.sourceEvent;

    par.element = chartAtpInstance.getElementAtEvent(e)[0];
    if (par.element === undefined || e.ctrlKey === true) {
        return;
    }
    par.chart = par.element['_chart'];
    par.index = par.element['_index'];
    let scale = e.deltaMode ? 3 : 53;
    let value = e.altKey ? (parseInt(e.deltaY) / scale) * 20 : parseInt(e.deltaY) / scale;
    let newTune = par.chart.config.data.datasets.find('newTune');
    newTune.data[par.index].y = parseInt(newTune.data[par.index].y) - value;
    par.chart.config.data.datasets.find('FTP').data = FTP_data0(newTune.data);
    par.chart.config.data.datasets.find('formFSB').data = formFSB_data(newTune.data, true);
    par.chart.update(0);
}

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
    if (par.element === undefined) {
        return;
    }
    par.chart = par.element['_chart'];
    par.scale = par.element['_yScale'];
    par.datasetIndex = par.element['_datasetIndex'];
    par.index = par.element['_index'];
    global.element = par.element;
    let dataset = par.chart.config.data.datasets[par.datasetIndex];
    if (dataset.class !== undefined && dataset.class === 'phase') {
        let phaseDrag = new PhaseDrag(par, e);
        phaseDrag.getElement();
        return;
    }
    //Get pixel y-offset from datapoint to mouse/touch point
    par.grabOffsetY = par.scale.getPixelForValue(
        dataset.data[par.index],
        par.index,
        par.datasetIndex,
        false
    ) - getEventPoints(e).point[0].y;

    par.value = Math.floor(par.scale.getValueForPixel(
        par.grabOffsetY + getEventPoints(e).point[0].y) + 0.5);
    //par.value = Math.max(0, Math.min(atpYAxes.max - 100, par.value));

}

function updateData() {
    let e = d3.event.sourceEvent;
    if(global.element === undefined){
        return;
    }
    //par.element = chartAtpInstance.getElementAtEvent(e)[0];
    par.element = global.element;

    par.datasetIndex = par.element['_datasetIndex'];
    par.scale = par.element['_yScale'];
    let dataset = par.chart.config.data.datasets[par.datasetIndex];
    if (dataset.class !== undefined && dataset.class === 'phase') {

        if (phaseDrag === undefined) {
            phaseDrag = new PhaseDrag(par, e);
        }
        phaseDrag.setUp(par, e);
        phaseDrag.updateData(par, e);
        return;
    }
    if (dataset.id !== 'newTune' || par.scale === undefined) {
        return;
    }

    par.value = Math.floor(par.scale.getValueForPixel(
        par.grabOffsetY + getEventPoints(e).point[0].y) + 0.5);
    //par.value = Math.max(0, Math.min(atpYAxes.max - 100, par.value));

    if (par.value <= 0) {
        return;
    }
    dataset.data[par.index].y = par.value;
    //par.chart.config.data.datasets[2].data[par.index] =  par.value;
    par.chart.config.data.datasets.find('FTP').data = FTP_data(dataset.data);
    par.chart.config.data.datasets.find('formFSB').data = formFSB_data(dataset.data);
    drawValue(par);
    chartAtpInstance.update(0);
}

function drawValue(par) {
    par.chart.ctx.fillStyle = '#ffffff';
    par.chart.ctx.textAlign = "center";
    par.chart.ctx.textBaseline = "bottom";
    // let duration = moment.duration(par.value, 'minutes');
    // let text = duration.get('hours') + ':' + duration.get('minutes');
    par.chart.ctx.fillText(par.chart.config.data.datasets.find('newTune').data[par.index].y, par.element._model.x, par.element._model.y - 5);
}

//Show y data after point drag
function callback() {
    global.element = undefined;
    phaseDrag = undefined;
}

//Apply changes to old dataset
let history = [];
// document.getElementById('applyChanges').addEventListener('click', function () {
//     history.push(atpOptions.data.datasets.find('oldTune').data.kopia());
//     atpOptions.data.datasets.find('oldTune').data = atpOptions.data.datasets.find('newTune').data.kopia();
//     chartAtpInstance.update();
// });
//
// //Cancel changes - rrevert to old dataset
// document.getElementById('cancelChanges').addEventListener('click', function () {
//     atpOptions.data.datasets.find('newTune').data = atpOptions.data.datasets.find('oldTune').data.kopia();
//     atpOptions.data.datasets.find('FTP').data = FTP_data(atpOptions.data.datasets.find('newTune').data);
//     chartAtpInstance.update();
// });
//
// //Cancel changes - rrevert to old dataset
// document.getElementById('undoChanges').addEventListener('click', function () {
//     var data = history.pop();
//     if (data) {
//         atpOptions.data.datasets.find('newTune').data = data.kopia();
//         atpOptions.data.datasets.find('oldTune').data = data.kopia();
//         atpOptions.data.datasets.find('FTP').data = FTP_data(data.kopia());
//
//         chartAtpInstance.update();
//     }
// });
