export function createTimeArray(oIn) {
    let arr = [];

    Object.keys(oIn).forEach(function (x) {
        arr.push({
            x: moment(x),
            y: oIn[x]
        });
    });

    return arr;
}