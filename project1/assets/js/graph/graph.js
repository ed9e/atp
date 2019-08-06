global.atpYAxes = {max: 1500};
let animationCallback = undefined;
let phases = {
    '2021-02-21': 'Phase 1'
};
global.atpOptions = {
    type: 'bar',

    data: {
        onAnimationComplete: function () {
            console.log('asd')
        },
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
        }, {
            label: 'Phase 1',
            type: 'line',
            backgroundColor: '#ff4e00ff',
            fill: false,
            data: getDateArray('2020-12-20', '2021-01-10'),
            borderColor: '#ff4e00ff',
            borderWidth: 3,
            pointStyle: 'line',
            radius: 0,
            xAxisID: "czas",
            pointHitRadius: 0,
            pointHoverRadius: 0,
        }, {
            label: 'Phase 2',
            type: 'line',
            backgroundColor: '#ff4e00ff',
            fill: false,
            data: getDateArray('2021-02-07', '2021-03-07'),
            borderColor: '#ff4e00ff',
            borderWidth: 3,
            pointStyle: 'line',
            radius: 0,
            xAxisID: "czas",
            pointHitRadius: 0,
            pointHoverRadius: 0,
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
            display: true,
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
                        drawTicks: true,
                        display: true,
                        color: general.grid.gridLinesColor,
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: false,
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
                        }
                    },
                    gridLines: {
                        drawTicks: true,
                        display: false,
                        color: general.grid.gridLinesColor,
                        borderDash: [1, 2],
                        zeroLineWidth: 0,
                        offsetGridLines: false,
                    },
                    ticks: {
                        padding: 0,
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