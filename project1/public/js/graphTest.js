var defaultY = Array.from({length: 100}, (v, k) => 50 * Math.random());
var animationCallback = undefined;
var options = {
    type: 'bar',
    data: {
        labels: Array.from({length: 100}, (v, k) => k),
        datasets: [{
            label: 'New Tuning ',
            backgroundColor: "rgba(196, 93, 105, 0.3)",
            fill: true,
            data: defaultY.slice(),
            pointHitRadius: 30,
            pointHoverRadius: 6,
            borderWidth: 1,
            borderDash: [2, 2],
            xAxisID: "bar-x-axis1"
        }, {
            label: 'Old Tuning',
            backgroundColor: "rgba(32, 162, 219, 0.05)",
            fill: true,
            data: defaultY.slice(),
            borderWidth: 1,
            xAxisID: "bar-x-axis1"
        }]
    },
    options: {
        tooltips: {
            enabled: false
        },
        animation: {
            duration: 1000,
            onComplete: function (animation) {
                if (typeof animationCallback === "function") {
                    // Execute custom animate/update complete callback function​
                    animationCallback();
                }
            }
        },

        scales: {
            xAxes: [{
                id: "bar-x-axis1",
                stacked: true,
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'RPM',
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Power %'
                },
                ticks: {
                    reverse: false,
                    min: 0,
                    max: 100
                }
            }]
        }
    }
};

var chartTune = document.getElementById('chartJSContainer')
var ctx = chartTune.getContext('2d');
var chartInstance = new Chart(ctx, options);

d3.select(chartInstance.chart.canvas).call(
    d3.drag().container(chartInstance.chart.canvas)
        .on('start', getElement)
        .on('drag', updateData)
        .on('end', callback)
);

var par = {
    chart: undefined,
    element: undefined,
    scale: undefined,
    datasetIndex: undefined,
    index: undefined,
    value: undefined,
    grabOffsetY: undefined,
    index: undefined,
    datasetIndex: undefined,
};


//Get an class of {points: [{x, y},], type: event.type} clicked or touched
function getEventPoints(event) {
    var retval = {
        point: [],
        type: event.type
    };
    //Get x,y of mouse point or touch event
    if (event.type.startsWith("touch")) {
        //Return x,y of one or more touches
        //Note 'changedTouches' has missing iterators and can not be iterated with forEach
        for (var i = 0; i < event.changedTouches.length; i++) {
            var touch = event.changedTouches.item(i);
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
    var e = d3.event.sourceEvent;

    //would be nice if the reference to chartinstance was found in e
    //How?

    par.scale = undefined;

    par.element = chartInstance.getElementAtEvent(e)[0];
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

}


function updateData() {
    var e = d3.event.sourceEvent;

    if (par.datasetIndex == 1) {
        return;
    }


    par.value = Math.floor(par.scale.getValueForPixel(
        par.grabOffsetY + getEventPoints(e).point[0].y) + 0.5);
    par.value = Math.max(0, Math.min(100, par.value));
    par.chart.config.data.datasets[par.datasetIndex].data[par.index] = par.value;
    chartInstance.update(0);
}


var chartXyDisplay = document.getElementById("yPos");

//Show y data after point drag
function callback() {
    chartXyDisplay.innerHTML = par.value;
}

//Apply changes to old dataset
var history = [];
document.getElementById('applyChanges').addEventListener('click', function () {
    history.push(options.data.datasets[1].data.slice());
    options.data.datasets[1].data = options.data.datasets[0].data.slice();
    chartInstance.update();
});

//Cancel changes - rrevert to old dataset
document.getElementById('cancelChanges').addEventListener('click', function () {
    options.data.datasets[0].data = options.data.datasets[1].data.slice();
    chartInstance.update();
});

//Cancel changes - rrevert to old dataset
document.getElementById('undoChanges').addEventListener('click', function () {
    var data = history.pop();
    if (data) {
        options.data.datasets[0].data = data.slice();
        options.data.datasets[1].data = data.slice();
        chartInstance.update();
    }
});