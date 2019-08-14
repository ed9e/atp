function rgb2hex(rgb) {

    rgb = rgb.match(/^rgb\((\d+),\s(\d+),\s(\d+),?([^,\s)]+)?\)$/);
    let alpha = (rgb && rgb[4] || "").trim(),
        a = 0o1;
    if (alpha !== "") {
        a = alpha;
    }
    // multiply before convert to HEX
    a = ((a * 255) | 1 << 8).toString(16).slice(1);
    return "#" +
        ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2);
}

function getColor(name) {
    let tmp = $('<a class="' + name + '"></a>');
    $('body').append(tmp);
    name = '.' + name;
    let color = rgb2hex($(name).css('color'));
    tmp.remove();
    return color;
}

let ftp = getColor('ftp');
let ftpDone = getColor('ftpDone');
let bar = getColor('bar');
let bar2 = getColor('bar2');
let bardone = getColor('bardone');
let grid = getColor('grid');
exports.orange = {
    gradient: {
        bar: bar, //'#ff4e00',
        bar2: bar2, //'#ff4e00',
        time: '#ff4e00',
        ftp: ftp, //'#ff6900',
        ftpDone: ftpDone, //'#db6d3a',
        grid: grid, //'#42444e',
    },
    borderColor: {
        bar: bar, //'#ff4e00',
        bar2: bar2, //'#ff4e00',
    },
    phasesDataset: {
        Preparation: '#ffcb05',
        Base1: '#7befb2',
        Base2: '#19b5fe',
        Base3: '#3a539b',
        Build1: '#be90d4',
        Build2: '#9a12b3',
        Peak: '#2ecc71',
        Race: '#cf000f',
    },
    bar: {
        valueColor: bardone, //'#c8f7c5'
    }
};
exports.blue = {
    gradient: {
        bar: '#19b5fe',
        bar2: '#22a7f0',
        time: '#34495e',
        ftp: '#00b5cc',
        grid: '#c5eff7',
    },
    borderColor: {
        bar: '#19b5fe',
        bar2: '#22a7f0',
    },
    phasesDataset: {
        Preparation: '#ffcb05',
        Base1: '#7befb2',
        Base2: '#19b5fe',
        Base3: '#3a539b',
        Build1: '#be90d4',
        Build2: '#9a12b3',
        Peak: '#2ecc71',
        Race: '#cf000f',
    },
    bar: {
        valueColor: '#c8f7c5'
    }
};
exports.red = {
    gradient: {
        bar: '#cf794a',
        bar2: '#81171b',
        time: '#ad2e24',
        ftp: '#ad2e24',
        grid: '#000000',
    },
    borderColor: {
        bar: '#cf794a',
        bar2: '#81171b',
    },
    phasesDataset: {
        Preparation: '#ffcb05',
        Base1: '#7befb2',
        Base2: '#19b5fe',
        Base3: '#3a539b',
        Build1: '#be90d4',
        Build2: '#9a12b3',
        Peak: '#2ecc71',
        Race: '#cf000f',
    },
    bar: {
        valueColor: '#c8f7c5'
    }
};
exports.green = {
    gradient: {
        bar: '#00e640',
        bar2: '#23cba7',
        time: '#23cba7',
        ftp: '#2ecc71',
        ftpDone: '#86e2d5',
        grid: '#91b496',
    },
    borderColor: {
        bar: '#00e640',
        bar2: '#23cba7',
    },
    phasesDataset: {
        Preparation: '#ffcb05',
        Base1: '#7befb2',
        Base2: '#19b5fe',
        Base3: '#3a539b',
        Build1: '#be90d4',
        Build2: '#9a12b3',
        Peak: '#2ecc71',
        Race: '#cf000f',
    },
    bar: {
        valueColor: '#c8f7c5'
    }
};