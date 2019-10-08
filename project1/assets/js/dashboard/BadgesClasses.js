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
        console.log(event.data.chart.options[key].enabled);
        event.data.chart.options[key].enabled = !event.data.chart.options[key].enabled;
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