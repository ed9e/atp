global.theme = require('./themes/orange.js').orange;

let barGradient = ctx.createLinearGradient(0, 0, 0, 900);
let bar2Gradient = ctx.createLinearGradient(0, 0, 0, 900);
let FTPgradient = ctx.createLinearGradient(0, 0, 0, 900);
let FTPDonegradient = ctx.createLinearGradient(0, 0, 0, 900);
let gridGradient = ctx.createLinearGradient(0, 0, 0, 900);
let timeGradient = ctx.createLinearGradient(0, 0, 1500, 0);
barGradient.addColorStop(0, theme.gradient.bar + 'ff');
barGradient.addColorStop(0.3, theme.gradient.bar + '44');
barGradient.addColorStop(1, theme.gradient.bar + '00');

timeGradient.addColorStop(1, theme.gradient.time + 'ff');
timeGradient.addColorStop(0.6, theme.gradient.time + '55');
timeGradient.addColorStop(0, theme.gradient.time + '22');

bar2Gradient.addColorStop(0, theme.gradient.bar2 + 'ff');
bar2Gradient.addColorStop(0.5, theme.gradient.bar2 + '44');
bar2Gradient.addColorStop(1, theme.gradient.bar2 + '00');

FTPgradient.addColorStop(0, theme.gradient.ftp + 'ee');
FTPgradient.addColorStop(0.5, theme.gradient.ftp + '44');
FTPgradient.addColorStop(1, theme.gradient.ftp + '00');
FTPDonegradient.addColorStop(0, theme.gradient.ftpDone + 'ff');
FTPDonegradient.addColorStop(0.5, theme.gradient.ftpDone + '44');
FTPDonegradient.addColorStop(1, theme.gradient.ftpDone + '00');

gridGradient.addColorStop(0, theme.gradient.grid + 'ff');
gridGradient.addColorStop(0.3, theme.gradient.grid + '55');
gridGradient.addColorStop(0.7, theme.gradient.grid + 'aa');

global.general = {
    grid: {
        gridLinesColor: gridGradient
    },
    ftp: {
        //bg: "rgba(42, 187, 155, 1)"
        bg: FTPgradient,
        borderColor: FTPgradient
    },
    ftpDone: {
        bg: FTPDonegradient,
        borderColor: FTPDonegradient
    },
    newVal: {
        bg: barGradient,
        borderColor: theme.borderColor.bar,
    },
    oldVal: {
        bg: bar2Gradient,
        borderColor: theme.borderColor.bar2,
    },
    tooltip: {
        bg: '#5a5b60',
        bodyColor: '#ababb0',
        titleColor: '#ababb0',
        borderColor: '#5a5b60',
    },
    timeline: {
        thick: 12,
        thick2: 5,
        color: timeGradient
    },
    phaseDataset: {
        color: {
            Preparation: theme.phasesDataset.Preparation,
            Base1: theme.phasesDataset.Base1,
            Base2: theme.phasesDataset.Base2,
            Base3: theme.phasesDataset.Base3,
            Build1: theme.phasesDataset.Build1,
            Build2: theme.phasesDataset.Build2,
            Peak: theme.phasesDataset.Peak,
            Race: theme.phasesDataset.Race,
        }
    },
    bar: {
        valueColor: theme.bar.valueColor
    },
    bardone: {
        bg: theme.bar.valueColor
    }
};