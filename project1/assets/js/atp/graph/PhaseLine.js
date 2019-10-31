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
        pointStyle: 'circle',
        radius: 0,
        xAxisID: "czas",
        yAxisID: "static",
        pointHitRadius: 4,
        pointHoverRadius: 4,
        pointBackgroundColor: '#00000000',
        pointBorderColor: '#00000000',
        pointBorderWidth: 1,
        pointHoverBorderColor: '#ffffffaa',
        pointHoverBackgroundColor: '#00000077',
        class: 'phase',
    };
    atpOptions.data.datasets.push(dataset);
}

function getDateArray(start, end) {
    let
        arr = [],
        dt = new Date(moment(start).add(general.phaseDataset.paddingLeft, 'hours'));
    end = new Date(moment(end).add(general.phaseDataset.paddingRight, 'hours'));
    arr.push({
        x: new Date(dt),
        y: 1 * general.timeline.thick
    });
    arr.push({
        x: new Date(end),
        y: 1 * general.timeline.thick
    });
    return arr;
}

export {phases_dataset};