import {ApiUrlConfig} from "../dashboard/ApiUrlConfig";

global.apiUrlConfig = new ApiUrlConfig('atp/fetch');
require('../atp');


$(() => {
    let startPos = global.chartAtpInstance.config.options.scales.yAxes[0].ticks.max;
    let slider = document.getElementById('test-slider');
    noUiSlider.create(slider, {
        start: [300],
        connect: true,
        step: 1,
        orientation: 'vertical', // 'horizontal' or 'vertical'
        range: {
            'min': 100,
            'max': 1700
        },
        // format: wNumb({
        //     decimals: 0
        // })
    });
    slider.noUiSlider.on('slide', function (values) {

        global.chartAtpInstance.config.options.scales.yAxes[0].ticks.max = parseInt(values[0]);
        global.chartAtpInstance.update(0);
    });
});
