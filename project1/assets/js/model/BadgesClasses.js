import {FTP_data} from "../atp/graph/DataSetFunctions";

class Checker {

    constructor(id, chart) {
        this.id = id;
        this.chart = chart;
        this.event = {
            checker: this,
            chart: this.chart, function: this.ifToggled, push: function push(key, val) {
                this[key] = val;
            }
        };
    }

    isEnabled() {
        return false;
    }

    iCheckUncheck() {
        $('#' + this.id).iCheck('uncheck');
    }

    iCheckSetStartState() {
        if (this.isEnabled()) {
            $('#' + this.id).iCheck('check');
        } else {
            $('#' + this.id).iCheck('uncheck');
        }
        return this;
    }

    iCheckToggleSet() {
        $('#' + this.id).on('ifToggled', this.event, function (event) {
            event.data.push('iChecker', this);
            event.data.function(event);
        });
        return this;
    }

    ifToggled(event) {
    }

}

export class OptionChecker extends Checker {
    constructor(id, chart, optionsKey) {
        super(id, chart);
        this.optionKey = optionsKey;
        this.event.push('key', this.optionKey);
    }

    isEnabled() {
        return this.chart.options[this.optionKey].enabled;
    }

    ifToggled(event) {
        let key = event.data.key;
        event.data.chart.options[key].enabled = !event.data.chart.options[key].enabled;
        event.data.chart.update();
    }
}

export class ZoomToggler extends OptionChecker {
    constructor(id, chart, optionsKey) {
        super(id, chart);
        this.optionKey = optionsKey;
        this.event.push('key', this.optionKey);

    }

    isEnabled() {
        return this.chart.options[this.optionKey].speed > 0
    }

    ifToggled(event) {
        let key = event.data.key;
        this._tmp == undefined ? this._tmp = event.data.chart.options[key].speed : '';
        event.data.chart.options[key].speed = event.data.chart.options[key].speed > 0 ? 0 : this._tmp;

        event.data.chart.update();
    }
}

export class EditAtp extends Checker {

    constructor(id, chart) {
        super(id, chart);
    }

    ifToggled(event) {
        let chart = event.data.chart;
        let iChecker = event.data.iChecker;
        if (iChecker.checked) {
            global.chartDataAction.onEdit();
        } else {
            global.chartDataAction.onDisEdit();
        }
        chart.update();
    }
}

export class ResetZoom extends Checker {

    constructor(id, chart) {
        super(id, chart);
    }

    ifToggled(event) {
        event.data.chart.resetZoom();
        setTimeout(function () {
            event.data.checker.iCheckUncheck();
        }, 1000);
    }
}

global.historyTune = [];

export class ApplyChanges extends Checker {

    constructor(id, chart) {
        super(id, chart);
    }

    isEnabled() {
        return true;
    }

    ifToggled(event) {
        let chart = event.data.chart;
        let iChecker = event.data.iChecker;
        let checker = event.data.checker;
        if (!iChecker.checked) {
            global.historyTune.push(atpOptions.data.datasets.find('oldTune').data.kopia());
            global.atpOptions.data.datasets.find('oldTune').data = global.atpOptions.data.datasets.find('newTune').data.kopia();

            let a = global.atpOptions.data.datasets.find('newTune').data;
            global.atpOptions.data.datasets.find('FTPBg').data = FTP_data(a);

            let atp = checker.getAtp(a);
            console.log(atp);
            let phases = checker.getPhases(a);
            console.log(phases);
            event.data.checker.iCheckUncheck(); // TO DO: czemu to nie działa

        } else {

        }
        chart.update();
    }

    getAtp(a) {
        let res = [];
        let resDate = [];
        for (let i of a) {
            if (i.y <= 0)
                continue;
            let d = i.x.format('YYYY-MM-DD');
            resDate.push(d);
            res.push(i.y);
        }
        return Object.fromEntries(resDate.map((_, i) => {
            return [resDate[i], typeof res[i] === "string" ? null : res[i]];
        }));
    }

    getPhases(a) {
        return global.atpOptions.data.datasets.findByClass('phase');
    }
}