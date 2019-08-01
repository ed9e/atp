Array.prototype.ftp = function (data1) {

    let A, k, sum, l, dzielnik;
    let O = Object(this);
    let len = O.length >>> 0;
    A = new Array(len);
    k = 0;

    sum = 0;
    while (k < len) {
        let kValue, mappedValue;
        if (k in O) {
            kValue = O[k];
            pData = data1[k];
            pValue = 1;
            sum += pData;
            if (k > 0) {
                pValue = O[k - 1];
                pData = data1[k - 1]
            }
            mappedValue = data1[k];
            l = 1;
            while (l <= k) {
                dzielnik = (1.9 * l);
                if (k == 0) {
                    dzielnik = 2;
                }
                mappedValue += data1[k - l] / dzielnik;
                l++;
            }

            A[k] = Math.floor(mappedValue);
        }
        k++;
    }

    return A;

};
let chartTune = document.getElementById('chartJSContainer');
let ctx = chartTune.getContext('2d');

let barGradient = ctx.createLinearGradient(0, 0, 0, 600);
let bar2Gradient = ctx.createLinearGradient(0, 0, 0, 600);
let FTPgradient = ctx.createLinearGradient(0, 0, 0, 600);
let gridGradient = ctx.createLinearGradient(0, 0, 0, 600);
barGradient.addColorStop(0, '#ff4e00ff');
barGradient.addColorStop(0.3, '#ff4e0044');
barGradient.addColorStop(1, '#ff4e0000');

bar2Gradient.addColorStop(0, '#eb2966ff');
bar2Gradient.addColorStop(0.5, '#f5b51244');
bar2Gradient.addColorStop(1, '#eb296600');

FTPgradient.addColorStop(0, '#ff6900ff');
FTPgradient.addColorStop(0.5, '#ff4e0044');
FTPgradient.addColorStop(1, '#30323d00');

gridGradient.addColorStop(0, '#42444eff');
gridGradient.addColorStop(0.3, '#42444e55');
gridGradient.addColorStop(0.7, '#ff4e00aa');

let general = {
    ftp: {
        //bg: "rgba(42, 187, 155, 1)"
        bg: FTPgradient,
        borderColor: FTPgradient
    },
    newVal: {
        bg: barGradient,
        borderColor: '#ff4e00aa'
    },
    oldVal: {
        bg: bar2Gradient,
        borderColor: '#ff4e0000'
    },
    tooltip: {
        bg: '#5a5b60',
        bodyColor: '#ababb0',
        titleColor: '#ababb0',
        borderColor: '#5a5b60',
    }
};


let yAxes = {max: 1500};
let animationCallback = undefined;
let options = {
    type: 'bar',
    data: {
        labels: keys,
        datasets: [{
            label: 'New Tuning ',
            backgroundColor: general.newVal.bg,
            fill: true,
            data: defaultY.slice(),
            pointHitRadius: 10,
            pointHoverRadius: 3,
            borderWidth: 1,
            borderDash: [2, 2],
            xAxisID: "x-axis1",
            borderColor: general.newVal.borderColor,
        }, {
            label: 'Old Tuning',
            backgroundColor: general.oldVal.bg,
            fill: true,
            data: defaultY.slice(),

            borderWidth: 1,
            borderDash: [2, 2],
            borderColor: general.oldVal.borderColor,
            xAxisID: "x-axis1",
            pointHitRadius: 10,
            pointHoverRadius: 3,
        }, {

            label: 'FTP',
            type: 'line',
            backgroundColor: general.ftp.bg,
            fill: true,
            data: defaultY.slice().ftp(defaultY.slice()),
            borderColor: general.ftp.borderColor,
            borderWidth: 2,
            borderDash: [1, 2],
            xAxisID: "x-axis1",
            pointHitRadius: 10,
            pointHoverRadius: 2,
        }
        ]
    },
    options: {
        elements: {
            point: {radius: 1}, line: {
                tension: 0.2
            }
        },
        responsive: true,
        layout: {
            padding: {
                left: 10,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
        legend: {
            display: false,
        },
        tooltips: {
            mode: 'index',
            enabled: true,
            titleFontSize: 11,
            bodyFontSize: 11,
            displayColors: false,
            backgroundColor: general.tooltip.bg,
            bodyFontColor: general.tooltip.bodyColor,
            titleFontColor: general.tooltip.titleColor,
            borderColor: general.tooltip.borderColor,
            borderWidth: 1,
            caretSize: 5,
            cornerRadius: 10
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
        scaleStartValue: 0,
        scales: {
            xAxes: [{
                stacked: true,
                id: "x-axis1",
                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'TIME',
                },
                gridLines: {
                    drawTicks: false,
                    display: true,
                    color: gridGradient,
                    borderDash: [1, 2],
                    zeroLineWidth: 0,
                    offsetGridLines: true,

                },
                ticks: {
                    padding: 10
                }

            },
                {
                    stacked: true,
                    id: "x-axis2",
                    display: false,
                    scaleLabel: {
                        display: false,
                        labelString: 'TIME',
                    },
                    gridLines: {
                        color: gridGradient,
                    },

                }],
            yAxes: [{

                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'VALUE'
                },
                gridLines: {
                    drawTicks: false,
                    display: true,
                    color: gridGradient,
                    borderDash: [1, 2],
                    zeroLineWidth: 0
                },
                ticks: {
                    reverse: false,
                    min: 0,
                    max: yAxes.max,
                    display: true,
                    padding: 10
                }
            }]
        }
    }
};

let chartInstance = new Chart(ctx, options);

d3.select(chartInstance.chart.canvas).call(
    d3.drag().container(chartInstance.chart.canvas)
        .on('start', getElement)
        .on('drag', updateData)
        .on('end', callback)
);

let par = {
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
    let e = d3.event.sourceEvent;

    if (par.datasetIndex != 0) {
        return;
    }


    par.value = Math.floor(par.scale.getValueForPixel(
        par.grabOffsetY + getEventPoints(e).point[0].y) + 0.5);
    par.value = Math.max(0, Math.min(yAxes.max - 100, par.value));

    par.chart.config.data.datasets[par.datasetIndex].data[par.index] = par.value;
    //par.chart.config.data.datasets[2].data[par.index] =  par.value;
    par.chart.config.data.datasets[2].data = par.chart.config.data.datasets[2].data.ftp(par.chart.config.data.datasets[par.datasetIndex].data);

    chartInstance.update(0);
}


let chartXyDisplay = document.getElementById("yPos");

//Show y data after point drag
function callback() {
    chartXyDisplay.innerHTML = par.value;
}

//Apply changes to old dataset
let history = [];
document.getElementById('applyChanges').addEventListener('click', function () {
    history.push(options.data.datasets[1].data.slice());
    options.data.datasets[1].data = options.data.datasets[0].data.slice();
    chartInstance.update();
});

//Cancel changes - rrevert to old dataset
document.getElementById('cancelChanges').addEventListener('click', function () {
    options.data.datasets[0].data = options.data.datasets[1].data.slice();
    options.data.datasets[2].data = options.data.datasets[2].data.slice().ftp(options.data.datasets[1].data.slice());
    chartInstance.update();
});

//Cancel changes - rrevert to old dataset
document.getElementById('undoChanges').addEventListener('click', function () {
    var data = history.pop();
    if (data) {
        options.data.datasets[0].data = data.slice();
        options.data.datasets[1].data = data.slice();
        options.data.datasets[2].data = options.data.datasets[2].data.ftp(data.slice());

        chartInstance.update();
    }
});