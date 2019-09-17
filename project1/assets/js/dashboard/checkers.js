//http://icheck.fronteed.com/

$(document).ready(function () {
    $('.controls.badges input').each(function () {
        var self = $(this),
            label = self.next(),
            label_text = label.text();

        label.remove();
        self.iCheck({
            checkboxClass: 'icheckbox_line',
            radioClass: 'iradio_line',
            insert: '<div class="icheck_line-icon"></div>' + label_text
        });
    });
});

class zoomOption {
    constructor(chart) {
        this.chart = chart;
        this.options = this.chart.options.zoom;
    }

    isEnabled() {
        return this.options.enabled
    }

    iCheckToggleSet(id) {
        let options = this.options;
        let chart = this.chart;
        $('#' + id).on('ifToggled', function (event) {
            options.enabled = !options.enabled;
            chart.update();
        });
    }
}
const zoom = new zoomOption(chartAtpInstance);
zoom.iCheckToggleSet('toggle-zoom');


$('#toggle-pan').on('ifToggled', function (event) {
    let chart = chartAtpInstance;
    let panOptions = chart.options.pan;
    panOptions.enabled = !panOptions.enabled;
    chart.update();
    // document.getElementById('pan-switch').innerText = panOptions.enabled ? 'Disable pan mode' : 'Enable pan mode';
});

$('#edit-atp').iCheck('uncheck'); //start with unchecked edit
$('#edit-atp').on('ifToggled', function (event) {
    let chart = chartAtpInstance;
    let vals = {};
    if (this.checked) {
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
});
