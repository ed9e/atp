global.theme = require('./themes/orange.js').sass;

let barGradient = ctx.createLinearGradient(0, 0, 0, 700);
let bar2Gradient = ctx.createLinearGradient(0, 0, 0, 700);
let FTPgradient = ctx.createLinearGradient(0, 0, 0, 700);
let FSBgradient = ctx.createLinearGradient(0, 0, 0, 700);
let FTPDonegradient = ctx.createLinearGradient(0, 0, 0, 700);
let gridGradient = ctx.createLinearGradient(0, 0, 0, 700);
let gridPhasesGradient = ctx.createLinearGradient(0, 0, 0, 700);
let timeGradient = ctx.createLinearGradient(0, 0, 1500, 0);
let bardoneBorderGradient = ctx.createLinearGradient(0, 0, 0, 700);
barGradient.addColorStop(0, theme.gradient.bar + 'ff');
barGradient.addColorStop(0.3, theme.gradient.bar + '77');
barGradient.addColorStop(0.6, theme.gradient.bar + '22');

timeGradient.addColorStop(1, theme.gradient.time + 'ff');
timeGradient.addColorStop(0.6, theme.gradient.time + '88');
timeGradient.addColorStop(0, theme.gradient.time + '44');
bardoneBorderGradient.addColorStop(1, theme.bar.borderColor + 'cc');
bardoneBorderGradient.addColorStop(0.6, theme.bar.borderColor + '66');
bardoneBorderGradient.addColorStop(0, theme.bar.borderColor + '22');

bar2Gradient.addColorStop(0, theme.gradient.bar2 + 'ff');
bar2Gradient.addColorStop(0.6, theme.gradient.bar2 + 'aa');
bar2Gradient.addColorStop(1, theme.gradient.bar2 + '66');

FTPgradient.addColorStop(0, theme.gradient.ftp + 'ff');
FTPgradient.addColorStop(0.5, theme.gradient.ftp + '44');
FTPgradient.addColorStop(0.8, theme.gradient.ftp + '00');

FSBgradient.addColorStop(0, theme.gradient.ftp + '11');
FSBgradient.addColorStop(0.5, theme.gradient.ftp + 'ee');
FSBgradient.addColorStop(0.8, theme.gradient.ftp + 'ff');

FTPDonegradient.addColorStop(0, theme.gradient.ftpDone + 'ff');
FTPDonegradient.addColorStop(0.3, theme.gradient.ftpDone + 'ee');

FTPDonegradient.addColorStop(0.7, theme.gradient.ftpDone + '11');
FTPDonegradient.addColorStop(1, theme.gradient.ftpDone + '00');

gridGradient.addColorStop(0, theme.gradient.grid + 'ff');
gridGradient.addColorStop(0.3, theme.gradient.grid + '22');
gridGradient.addColorStop(0.6, theme.gradient.grid + '00');
gridPhasesGradient.addColorStop(0, theme.gradient.grid + 'ff');
gridPhasesGradient.addColorStop(0.4, theme.gradient.grid + '22');
gridPhasesGradient.addColorStop(0.6, theme.gradient.grid + '00');

global.general = {
    grid: {
        fontColor: theme.grid.fontColor,
        gridLinesColor: gridGradient,
        gridPhasesLinesColor: gridPhasesGradient
    },
    ftp: {
        //bg: "rgba(42, 187, 155, 1)"
        bg: FTPgradient,
        borderColor: theme.borderColor.ftp
    },
    fsb: {
        bg: FSBgradient,
        borderColor: theme.borderColor.ftp
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
        bg: theme.bar.valueColor,
        borderColor: bardoneBorderGradient
    }
};
