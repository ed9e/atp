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
let border_bar = getColor('border-bar');
let border_bar2 = getColor('border-bar2');
let border_ftp = getColor('border-ftp');
let bardone = getColor('bardone');
let bardoneBorder = getColor('bardoneborder');
let grid = getColor('grid');
exports.sass = {
    gradient: {
        bar: bar, //'#ff4e00',
        bar2: bar2, //'#ff4e00',
        time: '#ff4e00',
        ftp: ftp, //'#ff6900',
        ftpDone: ftpDone, //'#db6d3a',
        grid: grid, //'#42444e',
    },
    borderColor: {
        bar: border_bar, //'#ff4e00',
        bar2: border_bar2, //'#ff4e00',
        ftp: border_ftp, //'#ff4e00',
        barDone: bardoneBorder,
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
        borderColor: bardoneBorder
    }
};
exports.orange = {
    gradient: {
        bar: '#ff4e00',
        bar2: '#ff4e00',
        time: '#ff4e00',
        ftp: '#ff6900',
        ftpDone: '#db6d3a',
        grid: '#42444e',
    },
    borderColor: {
        bar: '#ff4e00',
        bar2: '#ff4e00',
        ftp: '#ff4e00',
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
        valueColor: '#c8f7c5',
        borderColor: '#c8f7c5',
    }
};
exports.blue = {
    gradient: {
        bar: '#19b5fe',
        bar2: '#22a7f0',
        time: '#34495e',
        ftp: '#00b5cc',
        ftpDone: '#00b5cc',
        grid: '#c5eff7',
    },
    borderColor: {
        bar: '#19b5fe',
        bar2: '#22a7f0',
        ftp: '#22a7f0',
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
        valueColor: '#c8f7c5',
        borderColor: '#c8f7c5'
    }
};
exports.red = {
    gradient: {
        bar: '#cf794a',
        bar2: '#81171b',
        time: '#ad2e24',
        ftp: '#ad2e24',
        ftpDone: '#db6d3a',
        grid: '#000000',
    },
    borderColor: {
        bar: '#cf794a',
        bar2: '#81171b',
        ftp: '#ff000077',
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
        valueColor: '#c8f7c5',
        borderColor: '#c8f7c5'
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