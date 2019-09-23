export class ChartDataAction {
    constructor(chart) {
        this.chart = chart;
        this.datasets = this.chart.config.data.datasets;
        this.atp = this.datasets.find('newTune');
        this.done = this.datasets.find('Done');
        this.atpFTP = this.datasets.find('FTP');
        this.doneFTP = this.datasets.find('FTPDone');
    }

    onEdit() {
        let vals = {};
        if (this.atp.hasOwnProperty('data_')) {
            vals = this.atp.data_;
        } else {
            vals = this.done.data;
        }
        this.atp.data = vals;

        this.atpFTP.data = vals.ftpO();
        this.done.data_ = this.done.data;
        this.done.data = vals.ftpOReset();
        this.doneFTP.data = vals.ftpOReset();
    }

    onDisEdit() {
        let vals = this.done.data_;
        this.atp.data_ = this.atp.data;
        this.atp.data = [];
        this.atpFTP.data = vals.ftpOReset();
        this.doneFTP.data = vals.ftpO();
        this.done.data = vals;

    }

    onDataLoad(data) {
        let vals = createTimeArray(data.data.done);
        this.done.data = vals;
        this.doneFTP.data = vals.ftpO();
        this.chart.update();

        this.atp.hasOwnProperty('data_') ? this.atp.data_ = vals : '';
    }
}