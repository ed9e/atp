import {bar_data, FTP_data0} from "./graph/DataSetFunctions";

export class ChartDataAction {
    constructor(chart) {
        this.chart = chart;
        this.datasets = this.chart.config.data.datasets;
        this.atp = this.datasets.find('newTune');
        this.atpOld = this.datasets.find('oldTune');
        this.done = this.datasets.find('Done');
        this.atpFTP = this.datasets.find('FTP');
        this.atpFTPBg = this.datasets.find('FTPBg');
        this.doneFTP = this.datasets.find('FTPDone');
        this.doneFTPBg = this.datasets.find('FTPDoneBg');
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
        global.maxFTP = 0;
        let vals = bar_data(data.data.done);
        let ftp = vals.ftpO();
        let atpData = bar_data(data.data.values, (x) => {
            return x === 0 ? "0" : x
        });
        let atpFTP = FTP_data0(atpData);
        global.chartAtpInstance.options.scales.yAxes[0].ticks.max = global.maxFTP*1.2;
        this.done.data = vals;

        this.atp.data = atpData;
        this.atpOld.data = atpData;
        this.atpFTP.data = atpFTP;
        this.atpFTPBg.data = atpFTP;
        this.doneFTP.data = ftp;
        this.doneFTPBg.data = ftp;
        this.formFSB.data = atpData.kopia().formFSB();
        //this.atp.hidden = true;
        //this.atpFTP.hidden = true;

        this.chart.update();

        //this.atp.hasOwnProperty('data_') ? delete this.atp.data_ : '';
    }
}
