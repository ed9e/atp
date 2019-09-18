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

export class EditAtp extends Checker {

    constructor(id, chart) {
        super(id, chart);
    }

    ifToggled(event) {
        let chart = event.data.chart;
        let vals = {};
        let iChecker = event.data.iChecker;
        if (iChecker.checked) {
            if (chart.config.data.datasets.find('newTune').hasOwnProperty('data_')) {
                vals = chart.config.data.datasets.find('newTune').data_;
            } else {
                vals = objectConcat(yDone, yValues);
            }
            chart.config.data.datasets.find('newTune').data = vals;
            chart.config.data.datasets.find('FTP').data = vals.ftpO();
            chart.config.data.datasets.find('FTPDone').data = vals.ftpOReset();
            chart.config.data.datasets.find('Done').data = vals.ftpOReset();
        } else {
            vals = createTimeArray(yDone);
            chart.config.data.datasets.find('newTune').data_ = chart.config.data.datasets.find('newTune').data;
            chart.config.data.datasets.find('newTune').data = [];
            chart.config.data.datasets.find('FTP').data = vals.ftpOReset();
            chart.config.data.datasets.find('FTPDone').data = vals.ftpO();
            chart.config.data.datasets.find('Done').data = vals;
            // chart.config.data.datasets.find('oldTune').data = vals;
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