import {createTimeArray} from "../functions/tools";

export class ChartDataAction {
    constructor(chart) {
        this.chart = chart;
        this.datasets = this.chart.config.data.datasets;
        this.atp = this.datasets.find('newTune');
        this.done = this.datasets.find('Done');
        this.atpFTP = this.datasets.find('FTP');
        this.doneFTP = this.datasets.find('FTPDone');
        this.formFSB = this.datasets.find('formFSB');
    }

    onEdit() {
        let vals = [];
        if (this.atp.hasOwnProperty('data_')) {
            vals = this.atp.data_;
        } else {
            vals = this.done.data.kopia()
        }

        this.atp.data = vals;
        this.atp.hidden = false;
        this.atpFTP.data = vals.ftpO();
        this.atpFTP.hidden = false;
        this.done.data_ = this.done.data.kopia();
        this.done.data = vals.ftpOReset();
        this.doneFTP.data = vals.ftpOReset();
    }

    onDisEdit() {
        let vals = this.done.data_.kopia();
        this.atp.data_ = this.atp.data.kopia();
        this.atp.data = this.atp.data.kopia().ftpOReset();
        this.atpFTP.data = vals.kopia().ftpOReset();
        this.doneFTP.data = vals.ftpO();
        this.done.data = vals;
    }

    onDataLoad(data) {
        let vals = createTimeArray(data.data.done);
        let ftp = vals.ftpO();
        global.chartAtpInstance.options.scales.yAxes[0].ticks.max = global.maxFTP*1.2;
        this.done.data = vals;
        this.atp.data = vals.kopia();
        this.formFSB.data = vals.kopia().formFSB();
        this.doneFTP.data = ftp;
        this.atpFTP.hidden = true;

        this.chart.readyZoom(data.data.zoomMin);//czy zoomować do wybranego obsaru
        this.chart.update();

        this.atp.hasOwnProperty('data_') ? delete this.atp.data_ : '';

    }
}
