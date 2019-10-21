function FTP_data(newV) {
    Object.keys(newV).forEach(function (x) {

        if (newV[x].y === 0) {
            newV[x].y = done[newV[x].x.format('YYYY-MM-DD')]
        }
    });
    return newV.ftpO();
}

function FTP_data0(newV) {
    Object.keys(newV).forEach(function (x) {

        // if (newV[x].y === 0) {
        //     newV[x].y = done[newV[x].x.format('YYYY-MM-DD')]
        // }
    });
    return newV.ftpO();
}

function bar_data(oIn, func = null) {
    let arr = [];

    Object.keys(oIn).forEach(function (x) {
        if (typeof func === 'function') {
            oIn[x] = func(oIn[x])
        }
        arr.push({
            x: moment(x),
            y: oIn[x],
            get: () => {
                return {x: oIn[x]}
            }
        });
    });

    return arr;
}


function phases_dataset(d) {
    Object.entries(d[1]).forEach(eachPhasesDataset);
}

function eachPhasesDataset(d) {

    let label = d[1]['label'] || d[0];
    let colorInd = d[1]['color'] || d[0];
    let from = d[1][0];
    let to = d[1][1];

    let dataset = {
        label: label,
        type: 'line',
        backgroundColor: general.phaseDataset.color[colorInd],
        fill: false,
        data: getDateArray(from, to),
        borderColor: general.phaseDataset.color[colorInd],
        borderWidth: general.timeline.thick2,
        //pointStyle: 'line',
        //radius: 0,
        xAxisID: "czas",
        yAxisID: "static",
        pointHitRadius: 5,
        pointHoverRadius: 3,
        class: 'phase',
    };
    atpOptions.data.datasets.push(dataset);
}

function getDateArray(start, end) {
    let
        arr = [],
        dt = new Date(moment(start).add(1, 'days'));

    end = new Date(moment(end).add(-1, 'days'));

    arr.push({
        x: new Date(dt),
        y: 1 * general.timeline.thick
    });
    arr.push({
        x: new Date(end),
        y: 1 * general.timeline.thick
    });
    // while (dt <= end) {
    //     arr.push({
    //         x: new Date(dt),
    //         y: 1 * general.timeline.thick
    //     });
    //     dt.setDate(dt.getDate() + 1);
    // }
    return arr;
}

export {FTP_data, FTP_data0, bar_data, phases_dataset};