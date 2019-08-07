global.atpYAxes = {max: 1500};
let animationCallback = undefined;


global.atpOptions = {
    type: 'bar',

    data: {
        labels: xKeys,
        datasets: [{
            label: 'New Tuning ',
            backgroundColor: general.newVal.bg,
            fill: true,
            data: yValues.slice(),
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
            data: yValues.slice(),
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
            data: yValues.slice().ftp(),
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
            cornerRadius: 10,
            callbacks: {
                label: tooltipItem => `${tooltipItem.yLabel}: ${tooltipItem.xLabel}`,
                title: () => null,
            }
        },
        animation: {
            duration: 1000,
            onComplete: function (animation) {
                //console.log(animation)
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
                }
            },
                {
                    display: true,
                    stacked: false,
                    id: 'czas',
                    position: 'top',
                    type: 'time',
                    time: {
                        unit: 'month',
                        max: moment(xKeys[xKeys.length - 1]).add(7, 'days').format('YYYY-MM-DD'),
                        min: moment(xKeys[0])
                    },
                    gridLines: {
                        drawTicks: false,
                        display: true,
                        color: general.grid.gridLinesColor,
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: true,
                    },
                    ticks: {
                        padding: 0,
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
                        max: moment(xKeys[xKeys.length - 1]).add(7, 'days').format('YYYY-MM-DD'),
                        min: moment(xKeys[0]),
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
                        offsetGridLines: false,
                    },
                    ticks: {
                        padding: 5,
                        callback: function (value, index, values) {
                            return phases[value];
                        }
                    }
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
        borderWidth: 3,
        pointStyle: 'line',
        radius: 0,
        xAxisID: "czas",
        pointHitRadius: 0,
        pointHoverRadius: 0,
    };
    atpOptions.data.datasets.push(dataset);
}

global.chartAtpInstance = new Chart(ctx, atpOptions);


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