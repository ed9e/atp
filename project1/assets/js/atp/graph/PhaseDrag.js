export class PhaseDrag {

    constructor(par, e) {
        this.par = par;
        this.par.scale = this.par.element['_xScale'];
        this.par.datasetIndex = this.par.element['_datasetIndex'];
        this.par.index = this.par.element['_index'];
        this.e = e;
        this.dataset = this.par.chart.config.data.datasets[this.par.datasetIndex];
        let neighbour = this.par.index === 0 ? -1 : 1;
        this.datasetNeighbour = this.par.chart.config.data.datasets[this.par.datasetIndex + neighbour];
        this.indexNeighbour = this.par.index - neighbour;
        this.x = moment(this.dataset.data[this.par.index].x);

    }

    getElement() {
        //let x = this.par.scale.getValueForPixel(getEventPoints(this.e).point[0].x);
    }

    updateData() {

        let x = this.par.scale.getValueForPixel(getEventPoints(this.e).point[0].x);

        let durationDays = moment.duration(x.diff(this.x)).asDays();
        let sign = durationDays > 0 ? 1 : -1;
        if (Math.abs(durationDays / 7) >= 1) {
            this.x = moment(this.x).add(sign * 7, 'days');
            this.dataset.data[this.par.index].x = this.x;
            this.datasetNeighbour.data[this.indexNeighbour].x = moment(this.datasetNeighbour.data[this.indexNeighbour].x).add(sign * 7, 'days');

            chartAtpInstance.update(0);
        }

    }

}