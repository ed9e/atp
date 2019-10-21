export class PhaseDrag {

    constructor(par, e) {

        this.par = par;
        this.par.scale = this.par.element['_xScale'];
        this.par.datasetIndex = this.par.element['_datasetIndex'];
        this.par.index = this.par.element['_index'];
        this.e = e;
        this.dataset = this.par.chart.config.data.datasets[this.par.datasetIndex];
        this.neighbour = this.par.index === 0 ? -1 : 1;
        this.datasetNeighbour = this.par.chart.config.data.datasets[this.par.datasetIndex + this.neighbour];
        this.indexNeighbour = this.par.index - this.neighbour;
        this.x = moment(this.dataset.data[this.par.index].x);
        this.tick = this.getHalfTime();
    }

    getElement() {
        //let x = this.par.scale.getValueForPixel(this.getEventPoints(this.e).point[0].x);


    }

    getHalfTime() {
        let s = moment(this.dataset.data[0].x);
        let e = moment(this.dataset.data[1].x);
        let halfTime = Math.abs(s.diff(e, 'seconds') / 2);
        return s.add(halfTime, 'seconds').format('Y-MM-DD');
    }


    updateData2() {
        let x = this.par.scale.getValueForPixel(this.getEventPoints(this.e).point[0].x);
        this.dataset.data[this.par.index].x = x;
        this.datasetNeighbour.data[this.indexNeighbour].x = moment(x).add(this.neighbour, 'days');
        chartAtpInstance.update(0);
    }

    updateData() {

        let x = this.par.scale.getValueForPixel(this.getEventPoints(this.e).point[0].x);
        console.log(x);
        let durationDays = moment.duration(x.diff(this.x)).asDays();
        let sign = durationDays > 0 ? 1 : -1;
        if (Math.abs(durationDays / 4) >= 1) {
            this.x = moment(this.x).add(sign * 7, 'days');
            this.dataset.data[this.par.index].x = this.x;
            this.datasetNeighbour.data[this.indexNeighbour].x = moment(this.datasetNeighbour.data[this.indexNeighbour].x).add(sign * 7, 'days');
            chartAtpInstance.update(0);

            this.fixTick();
        }
    }

    fixTick() {

        let tick = phases[this.tick];
        console.log(tick);
        phases[this.tick] = undefined;
        console.log(this.getHalfTime());
        phases[this.getHalfTime()] = tick;
        console.log(phases);
        chartAtpInstance.config.options.scales.xAxes[2].ticks.callback();
        chartAtpInstance.update(0);
    }

    callback() {
        let now = this.dataset.data[this.par.index].x;
        console.log(moment.duration(now.diff(now.day(0))));
    }

    //Get an class of {points: [{x, y},], type: event.type} clicked or touched
    getEventPoints(event) {
        let retval = {
            point: [],
            type: event.type
        };
        //Get x,y of mouse point or touch event
        if (event.type.startsWith("touch")) {
            //Return x,y of one or more touches
            //Note 'changedTouches' has missing iterators and can not be iterated with forEach
            for (let i = 0; i < event.changedTouches.length; i++) {
                let touch = event.changedTouches.item(i);
                retval.point.push({
                    x: touch.clientX,
                    y: touch.clientY
                })
            }
        } else if (event.type.startsWith("mouse")) {
            //Return x,y of mouse event
            retval.point.push({
                x: event.layerX,
                y: event.layerY
            })
        }
        return retval;
    }

}