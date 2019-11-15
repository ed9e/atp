global.atpYAxes = {max: 150};
let callback = undefined;

global.atpOptions = {
    type: 'bar',

    data: {
        labels: createTimeArray(yDone),
        datasets: [{
            label: 'Form FSB',
            type: 'line',
            backgroundColor: general.ftp.bg,
            fill: true,
            data: createTimeArray(yDone).formFSB(),
            borderColor: general.ftp.borderColor,
            borderWidth: 1,
            borderDash: [0, 0],
            xAxisID: "x-axis1",
            yAxisID: "fsb",
            pointHitRadius: 10,
            pointHoverRadius: 2,
            id: 'formFSB',

        },
            {
                label: 'New Tuning',
                backgroundColor: general.newVal.bg,
                fill: true,
                data: createTimeArray(yValues),
                pointHitRadius: 10,
                pointHoverRadius: 3,
                borderWidth: 1,
                borderDash: [0, 0],
                xAxisID: "x-axis1",
                borderColor: general.newVal.borderColor,
                id: 'newTune',
                hidden: true,
            },
            {
                label: 'Old Tuning',
                backgroundColor: general.oldVal.bg,
                fill: true,
                data: createTimeArray(yValues),
                borderWidth: 0,
                borderDash: [2, 2],
                borderColor: general.oldVal.borderColor,
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 3,
                id: 'oldTune'
            },
            {
                label: 'FTP',
                type: 'line',
                backgroundColor: general.ftp.bg,
                fill: false,
                data: createTimeArray(yDone).formFSB(),
                borderColor: general.ftp.borderColor,
                borderWidth: 1,
                borderDash: [0, 0],
                xAxisID: "x-axis1",
                yAxisID: "fsb",
                pointHitRadius: 10,
                pointHoverRadius: 2,
                id: 'FTP',
                hidden: true,
            },
            {
                label: 'Done',
                backgroundColor: general.bardone.bg,
                fill: true,
                data: createTimeArray(yDone),
                borderWidth: 1,
                borderDash: [0, 0],
                borderColor: general.bardone.borderColor,
                xAxisID: "x-axis1",
                id: 'Done'
            },
            {
                label: 'FTP DONE',
                type: 'line',
                backgroundColor: general.ftpDone.bg,
                fill: true,
                data: createTimeArray(yDone).ftpO(),
                borderColor: general.ftpDone.borderColor,
                borderWidth: 2,
                borderDash: [1, 2],
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 2,
                id: 'FTPDone'
            },

        ]
    },
    options: {
        plugins: {
            deferred: {           // enabled by default
                xOffset: 150,     // defer until 150px of the canvas width are inside the viewport
                yOffset: '50%',   // defer until 50% of the canvas height are inside the viewport
                delay: 2000       // delay of 500 ms after the canvas is considered inside the viewport
            }
        },
        elements: {
            point: {radius: 0.5},
            line: {
                tension: 0.2
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        aspectRatio: 1920 / 450,
        layout: {
            padding: {
                left: 0,
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
            titleFontSize: 12,
            bodyFontSize: 11,
            displayColors: false,
            backgroundColor: general.tooltip.bg,
            bodyFontColor: general.tooltip.bodyColor,
            titleFontColor: general.tooltip.titleColor,
            borderColor: general.tooltip.borderColor,
            borderWidth: 1,
            caretSize: 5,
            cornerRadius: 3,
            callbacks: {
                label: () => {
                    //tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`

                },
                title: (x, y) => {

                    let d = moment(x[0].label, 'MMM Do YYYY, h:mm:ss a');
                    let from = d.add(-4, 'days').format('DD');
                    let to = d.add(7, 'days').format('DD/MM/YY');
                    return from + '-' + to;
                    //console.log(x)
                },
            }
        },
        animation: {
            duration: 800,

            onComplete: function (animation) {
            }
        },
        scaleStartValue: 0,
        scales: {
            xAxes: [
                {
                    stacked: true,
                    id: "x-axis1",
                    display: true,
                    type: 'time',
                    time: {
                        unit: 'week',
                        max: moment(xKeys[xKeys.length - 1]).add(0, 'days').format('YYYY-MM-DD'),
                        min: moment(xKeys[0]).add(0, 'days').format('YYYY-MM-DD'),
                        displayFormats: {
                            day: 'YYYY-MM-DD'
                        },
                        minUnit: 'day',
                        stepSize: 1
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'TIME',
                    },
                    gridLines: {
                        drawTicks: true,
                        tickMarkLength: 1,
                        display: true,
                        color: '#ffffff00',
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: true,
                    },
                    ticks: {
                        padding: 0,
                        display: false,
                    },
                    categoryPercentage: .91,
                    barPercentage: .91
                },
                {
                    display: true,
                    stacked: false,
                    id: 'czas',
                    position: 'top',
                    type: 'time',
                    time: {
                        unit: 'month',
                        max: moment(xKeys[xKeys.length - 1]).add(0, 'days').format('YYYY-MM-DD'),
                        min: moment(xKeys[0]).add(0, 'days').format('YYYY-MM-DD'),
                        minUnit: 'day',
                        stepSize: 1
                    },
                    gridLines: {
                        drawTicks: false,
                        tickMarkLength: 0,
                        display: true,
                        color: general.grid.gridLinesColor,
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: false,
                        drawBorder: true,

                    },
                    ticks: {
                        padding: 3,
                        lineHeight: 1.2,
                        fontColor: general.grid.fontColor,
                        fontSize: 10,
                        callback: function (value, index, values) {
                            if (index % 2)
                                return value;
                            return '';
                        }
                    }
                },
                {
                    display: true,
                    stacked: false,
                    id: 'fazy',
                    position: 'top',
                    type: 'time',
                    time: {
                        unit: 'day',
                        max: moment(xKeys[xKeys.length - 1]).add(0, 'days').format('YYYY-MM-DD'),
                        min: moment(xKeys[0]).add(0, 'days').format('YYYY-MM-DD'),
                        displayFormats: {
                            day: 'YYYY-MM-DD'
                        },
                        minUnit: 'day',
                        stepSize: 1
                    },
                    gridLines: {
                        drawTicks: true,
                        tickMarkLength: 9,
                        display: true,
                        color: general.grid.gridPhasesLinesColor,
                        borderDash: [1, 1],
                        zeroLineWidth: 0,
                        offsetGridLines: true,
                    },
                    ticks: {
                        fontSize: 10,
                        fontColor: general.grid.fontColor,
                        mirror: false,
                        padding: 5,
                        callback: function (value, index, values) {
                            return phases[value];
                        }
                    },

                },

            ],
            yAxes: [{

                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'VALUE'
                },
                gridLines: {
                    drawTicks: true,
                    display: true,
                    color: general.grid.gridLinesColor,
                    borderDash: [1, 2],
                    zeroLineWidth: 0
                },
                ticks: {
                    reverse: false,
                    min: 0,
                    //max: atpYAxes.max,
                    display: true,
                    padding: 10,

                },
                position: 'left'
            }, {
                id: 'fsb',
                display: true,
                scaleLabel: {
                    display: false,
                    labelString: 'VALUE'
                },
                gridLines: {
                    drawTicks: true,
                    display: true,
                    color: general.grid.gridLinesColor,
                    borderDash: [1, 2],
                    zeroLineWidth: 0
                },
                ticks: {
                    reverse: false,
                    min: -10,
                    max: 1,
                    display: false,
                    padding: 10,

                },
                position: 'left'
            }]
        },
        pan: {
            enabled: false,
            mode: "x",
            speed: 10,
            threshold: 10,
            rangeMin: {
                // Format of min pan range depends on scale type
                x: null,
                y: null
            },
            rangeMax: {
                // Format of max pan range depends on scale type
                x: null,
                y: null
            },

            // Function called while the user is panning
            onPan: function ({chart}) {
            },
            // Function called once panning is completed
            onPanComplete: function ({chart}) {
            }
        },
        zoom: {
            enabled: true,
            drag: false,
            mode: "x",
            limits: {
                max: 10,
                min: 0.5
            },
            rangeMin: {
                x: null,
                y: null
            },
            rangeMax: {
                x: null,
                y: null
            },
            // Speed of zoom via mouse wheel
            // (percentage of zoom on a wheel event)
            speed: 0,
            // onZoom: function (chart) {
            //     console.log(chart)
            //
            // },
            // onZoomComplete: function ({chart}) {
            // }
        }
    }
};

Object.entries(phases2).forEach(createPhaseDataset);

function createPhaseDataset(d) {
    let label = d[0];
    let from = d[1][0];
    let to = d[1][1];

    let dataset = {
        label: label,
        type: 'line',
        backgroundColor: general.phaseDataset.color[label],
        fill: false,
        data: getDateArray(from, to),
        borderColor: general.phaseDataset.color[label],
        borderWidth: general.timeline.thick2,
        //pointStyle: 'line',
        //radius: 0,
        xAxisID: "czas",
        pointHitRadius: 0,
        pointHoverRadius: 0,
    };
    atpOptions.data.datasets.push(dataset);
}


//TODO: to tu
global.chartAtpInstance = new Chart(ctx, atpOptions);
global.chartAtpInstance.config.data.datasets.find = function (id) {
    for (let o in this) {
        if (this[o].id === id) {
            return this[o];
        }
    }
    return null;
};
global.chartAtpInstance.readyZoom = function (min) {

    Chart.helpers.each(global.chartAtpInstance.scales, function (scale) {

        let timeOptions = scale.options.time;
        let tickOptions = scale.options.ticks;

        if (timeOptions) {
            timeOptions.min = min;
        }
    });

    chartAtpInstance.update();
};


function getDateArray(start, end) {
    let
        arr = [],
        dt = new Date(moment(start).add(1, 'days'));
    end = new Date(moment(end).add(-1, 'days'));
    while (dt <= end) {
        arr.push({
            x: new Date(dt),
            y: -1 * general.timeline.thick
        });
        dt.setDate(dt.getDate() + 1);
    }
    return arr;
}

function createTimeArray(oIn) {
    let arr = [];

    Object.keys(oIn).forEach(function (x) {
        arr.push({
            x: moment(x),
            y: oIn[x]
        });
    });

    return arr;
}

function objectConcat(oIn, pIn) {
    let arr = [];

    Object.keys(oIn).forEach(function (x) {
        if (!(x in pIn)) {
            arr.push({
                x: moment(x),
                y: oIn[x]
            });
        } else {
            arr.push({
                x: moment(x),
                y: pIn[x]
            });
        }
    });

    return arr;
}