let convertValues = {
    'distance': function (m) {
        return (m / 1000).toFixed(3) + ' km '
    },
    'duration': function (s) {
        // let date = new Date(null);
        // date.setSeconds(99999999);
        // return date.toISOString()

        let hours = Math.floor(s / 3600);
        s %= 3600;
        let minutes = Math.floor(s / 60);
        let seconds = s % 60;
        return hours.pad() + ":" + minutes.pad() + ":" + Math.round(seconds).pad()
    },
    'averageSpeed': {
        'convert': function (v, params) {

            switch (params.activityTypeId) {
                case 1:
                case 6:
                case 3:
                    let peaceFloat = (16.67 / v).toString();
                    let peaceMinutes = peaceFloat.split(".")[0];
                    let modulo = parseFloat(0 + '.' + (16.67 / v).toString().split(".")[1]);
                    let peaceSeconds = Math.round(60 * modulo);
                    return peaceMinutes + ":" + peaceSeconds.pad() + "min/km";
                //return convert(v).from('m/s').to('km/h');
                //return convert.speed(v).ms().to.minkm() + ' min/km';
                case 2:
                default:
                    return Math.round(convert(v).from('m/s').to('km/h') * 100) / 100 + "km/h";
                //return Math.round(convert.speed(v).ms().to.kmh(), 1) + ' km/h';
            }
        },
        'parameters': ['activityTypeId']
    },
    'averageRunCadence': function (c) {
        return c;
    },
    'lactateThresholdSpeed': {
        'convert': function (v, params) {

            switch (params.activityTypeId) {
                case 1:
                case 6:
                case 3:
                    let peaceFloat = (16.67 / v).toString();
                    let peaceMinutes = peaceFloat.split(".")[0];
                    let modulo = parseFloat(0 + '.' + (16.67 / v).toString().split(".")[1]);
                    let peaceSeconds = Math.round(60 * modulo);
                    return peaceMinutes + ":" + peaceSeconds.pad() + "min/km";
                //return convert(v).from('m/s').to('km/h');
                //return convert.speed(v).ms().to.minkm() + ' min/km';
                case 2:
                default:
                    return Math.round(convert(v).from('m/s').to('km/h') * 100) / 100 + "km/h";
                //return Math.round(convert.speed(v).ms().to.kmh(), 1) + ' km/h';
            }
        },
        'parameters': ['activityTypeId']
    },
    startTimeLocal: {
        'convert': (t) => {
            let date = new Date(Date.parse(t.date));
            return date.toString();
        }
    }

};
let defineColumns = {
    activityName: {},
    activityTypeKey: {},
    averageHR: {},
    averageRunCadence: {},
    averageSpeed: {},
    //averageTemperature: {},
    avgGroundContactBalance: {},
    //calories: {},
    distance: {},
    duration: {},
    elevationGain: {},
    elevationLoss: {},
    groundContactTime: {},
    //lactateThresholdSpeed: {},
    //maxHR: {},
    ownerFullName: {},
    startTimeLocal: {},
    strideLength: {},
    trainingEffect: {},
    userDisplayName: {},
    vO2MaxValue: {},
    verticalOscillation: {},
    //verticalRatio: {}

};
export class ZingGrid {

    dataLoad (){
        $.ajax({
            url: apiUrlConfig.hrefDataTable(),
            context: document.body
        }).done(function (json) {

            for (let i = 0, ien = json.data.length; i < ien; i++) {
                let _data = {};
                Object.keys(json.data[i]).forEach(function (key) {
                    if (!(json.data[i][key] instanceof Object)) {
                        //convert
                        if (convertValues.hasOwnProperty(key)) {
                            if (typeof convertValues[key] === 'function') {
                                json.data[i][key] = convertValues[key](json.data[i][key]);
                            }
                            if (typeof convertValues[key] === 'object') {

                                if (convertValues[key].hasOwnProperty('parameters')) {
                                    let parameter = {};
                                    for (let n = 0, nen = convertValues[key].parameters.length; n < nen; n++) {
                                        let param = convertValues[key].parameters[n];
                                        parameter[param] = json.data[i][param];
                                    }

                                    json.data[i][key] = convertValues[key].convert(json.data[i][key], parameter);
                                }
                            }
                        }
                        //define
                        if(defineColumns.hasOwnProperty(key)) {
                            _data[key] = json.data[i][key];
                        }
                    }

                });
                json.data[i] = _data;
            }

            const $gridRef = $('#myGrid');
            $gridRef.attr('data', JSON.stringify(json.data));

        });
    }
}
global.zingGrid = new ZingGrid();
$(document).ready(function () {
    zingGrid.dataLoad();
});