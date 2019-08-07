let barGradient = ctx.createLinearGradient(0, 0, 0, 600);
let bar2Gradient = ctx.createLinearGradient(0, 0, 0, 600);
let FTPgradient = ctx.createLinearGradient(0, 0, 0, 600);
let gridGradient = ctx.createLinearGradient(0, 0, 0, 600);
let timeGradient = ctx.createLinearGradient(0, 0, 1500, 0);
barGradient.addColorStop(0, '#ff4e00ff');
barGradient.addColorStop(0.3, '#ff4e0044');
barGradient.addColorStop(1, '#ff4e0000');

timeGradient.addColorStop(1, '#ff4e00ff');
timeGradient.addColorStop(0.6, '#ff4e0055');
timeGradient.addColorStop(0, '#ff4e0022');

bar2Gradient.addColorStop(0, '#eb2966ff');
bar2Gradient.addColorStop(0.5, '#f5b51244');
bar2Gradient.addColorStop(1, '#eb296600');

FTPgradient.addColorStop(0, '#ff6900ff');
FTPgradient.addColorStop(0.5, '#ff4e0044');
FTPgradient.addColorStop(1, '#30323d00');

gridGradient.addColorStop(0, '#42444eff');
gridGradient.addColorStop(0.3, '#42444e55');
gridGradient.addColorStop(0.7, '#ff4e00aa');

global.general = {
    grid: {
        gridLinesColor: gridGradient
    },
    ftp: {
        //bg: "rgba(42, 187, 155, 1)"
        bg: FTPgradient,
        borderColor: FTPgradient
    },
    newVal: {
        bg: barGradient,
        borderColor: '#ff4e00aa'
    },
    oldVal: {
        bg: bar2Gradient,
        borderColor: '#ff4e0000'
    },
    tooltip: {
        bg: '#5a5b60',
        bodyColor: '#ababb0',
        titleColor: '#ababb0',
        borderColor: '#5a5b60',
    },
    timeline: {
        thick: 15,
        color: timeGradient
    },
    phaseDataset: {
        color: {
            Preparation: '#ffcb05',
            Base1: '#7befb2',
            Base2: '#19b5fe',
            Base3: '#3a539b',
            Build1: '#be90d4',
            Build2: '#9a12b3',
            Peak: '#2ecc71',
            Race: '#cf000f',
        }
    }
};