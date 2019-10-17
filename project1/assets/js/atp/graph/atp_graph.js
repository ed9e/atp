import {bar_data, FTP_data, phases_dataset} from "./DataSetFunctions";

global.atpYAxes = {max: 1300};
let callback = undefined;

global.atpOptions = {
    type: 'bar',

    data: {
        labels: bar_data(done),
        datasets: [

            {
                label: 'Done',
                backgroundColor: general.bardone.bg,
                fill: true,
                data: bar_data(done),
                borderWidth: 1,
                borderDash: [1, 1],
                borderColor: general.bardone.borderColor,
                xAxisID: "x-axis1",
                id: 'Done'
            },
            {
                label: 'New Tuning ',
                backgroundColor: general.newVal.bg,
                fill: true,
                data: bar_data(yValues, (x) => {
                    return typeof x === 'string' ? 0 : x
                }),
                pointHitRadius: 10,
                pointHoverRadius: 3,
                borderWidth: 0,
                borderDash: [1, 1],
                xAxisID: "x-axis1",
                borderColor: general.newVal.borderColor,
                id: 'newTune'
            },
            {
                label: 'Old Tuning',
                backgroundColor: general.oldVal.bg,
                fill: true,
                data: bar_data(yValues, (x) => {
                    return typeof x === 'string' ? 0 : x
                }),
                borderWidth: 0,
                borderDash: [2, 2],
                borderColor: general.oldVal.borderColor,
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 3,
                id: 'oldTune'
            },
            {
                label: 'FTP DONE',
                type: 'line',
                backgroundColor: general.ftpDone.bg,
                fill: true,
                data: bar_data(done).ftpO(),
                borderColor: general.ftpDone.borderColor,
                borderWidth: 1,
                borderDash: [0, 0],
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 2,
                id: 'FTPDone'
            },
            {
                label: 'FTP DONE BG',
                type: 'line',
                backgroundColor: '#010101a4',
                fill: true,
                data: bar_data(done).ftpO(),
                borderColor: '#010101ff',
                borderWidth: 1,
                //borderDash: [1, 1],
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 2,
                id: 'FTPDoneBg'
            },
            {
                label: 'FTP',
                type: 'line',
                backgroundColor: general.ftp.bg,
                fill: true,
                data: FTP_data(bar_data(yValues, (x) => {
                    return typeof x === 'string' ? 0 : x
                })),
                borderColor: general.ftp.borderColor,
                borderWidth: 1,
                borderDash: [0, 0],
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 2,
                id: 'FTP',
            },
            {
                label: 'FTP BG',
                type: 'line',
                backgroundColor: '#05000033',
                fill: true,
                data: FTP_data(bar_data(yValues, (x) => {
                    return typeof x === 'string' ? 0 : x
                })),
                borderColor: '#00000022',
                borderWidth: 1,
                //borderDash: [1, 1],
                xAxisID: "x-axis1",
                pointHitRadius: 10,
                pointHoverRadius: 2,
                id: 'FTPBg'
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
            point: {radius: 0},
            line: {
                tension: 0.4
            }
        },
        responsive: true,
        maintainAspectRatio: true,
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
            duration: 800,

            onComplete: function (animation) {
                //console.log(animation)
            }
        },
        //scaleStartValue: -10,
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
                        padding: 0,
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
                        //fontColor: general.grid.fontColor,
                        padding: 5,
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
                        //fontColor: general.grid.fontColor,
                        padding: 2,
                        callback: function (value, index, values) {
                            return phases[value];
                        }
                    },

                },
                {
                    display: true,
                    stacked: false,
                    id: 'flags',
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
                        //fontColor: general.grid.fontColor,
                        fontSize: 10,
                        mirror: false,
                        padding: 5,
                        callback: function (value, index, values) {
                            return flags[value];
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
                    min: 0,
                    //max: 1500,
                    display: false,
                    id: 'nonstatic',
                    callback: function (value, index, values) {

                        if (global.chartAtpInstance !== undefined) {
                            global.chartAtpInstance.chart.config.options.scales.yAxes[0].ticks.min = -1 * values[0] * 0.016
                        }
                    }
                }
            },
                {
                    id: 'static',
                    display: true,
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
                        reverse: true,
                        min: -200,
                        max: 15,
                        display: false,

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


//paski faz
Object.entries(phases2).forEach(phases_dataset);


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