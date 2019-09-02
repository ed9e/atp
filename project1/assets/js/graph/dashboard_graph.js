global.atpYAxes = {max: 1000};
let callback = undefined;

global.atpOptions = {
    type: 'bar',

    data: {
        labels: createTimeArray(done),
        datasets: [
            {
                label: 'New Tuning ',
                backgroundColor: general.newVal.bg,
                fill: true,
                data: createTimeArray(yValues),
                pointHitRadius: 10,
                pointHoverRadius: 3,
                borderWidth: 1,
                borderDash: [0, 0],
                xAxisID: "x-axis1",
                borderColor: general.newVal.borderColor,
                id: 'newTune'
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
                fill: true,
                data: createTimeArray(yValues).ftpO(),
                borderColor: general.ftp.borderColor,
                borderWidth: 1,
                borderDash: [0, 0],
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 2,
                id: 'FTP',
            },
            {
                label: 'Done',
                backgroundColor: general.bardone.bg,
                fill: true,
                data: createTimeArray(done),
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
                data: createTimeArray(done).ftpO(),
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
        elements: {
            point: {radius: 0.5},
            line: {
                tension: 0.25
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        aspectRatio: 1920/450,
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
            titleFontSize: 11,
            bodyFontSize: 11,
            displayColors: false,
            backgroundColor: general.tooltip.bg,
            bodyFontColor: general.tooltip.bodyColor,
            titleFontColor: general.tooltip.titleColor,
            borderColor: general.tooltip.borderColor,
            borderWidth: 1,
            caretSize: 5,
            cornerRadius: 10,
            // callbacks: {
            //     label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
            //     title: () => null,
            // }
        },
        animation: {
            duration: 1000,

            onComplete: function (animation) {
                //console.log(animation)
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
                        tickMarkLength: 5,
                        display: true,
                        color: '#ffffff00',
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: true,
                    },
                    ticks: {
                        padding: 1,
                        display: false,
                    },
                    categoryPercentage: .9,
                    barPercentage: .9
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
                        display: true,
                        color: general.grid.gridLinesColor,
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: false,
                        drawBorder: true,
                        tickMarkLength: 0,
                    },
                    ticks: {
                        padding: 10,
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
                    position: 'bottom',
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
                        drawTicks: false,
                        display: false,
                        color: '#ffffff00',
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: true,
                    },
                    ticks: {
                        padding: 5,
                        callback: function (value, index, values) {
                            return phases[value];
                        }
                    },

                },

            ],
            yAxes: [{

                display: false,
                scaleLabel: {
                    display: false,
                    labelString: 'VALUE'
                },
                gridLines: {
                    drawTicks: false,
                    display: false,
                    color: general.grid.gridLinesColor,
                    borderDash: [1, 2],
                    zeroLineWidth: 0
                },
                ticks: {
                    reverse: false,
                    min: -20,
                    max: atpYAxes.max,
                    display: false,
                    padding: 10
                }
            }]
        },
        pan: {
            enabled: true,
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
            speed: 0.2,
            onZoom: function ({chart}) {
            },
            onZoomComplete: function ({chart}) {
            }
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