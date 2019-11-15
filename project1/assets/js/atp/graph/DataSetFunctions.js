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

function formFSB_data(newV) {
    Object.keys(newV).forEach(function (x) {

        if (newV[x].y === 0) {
            newV[x].y = done[newV[x].x.format('YYYY-MM-DD')]
        }
    });
    return newV.formFSB();
}

export {FTP_data, FTP_data0, bar_data, formFSB_data};