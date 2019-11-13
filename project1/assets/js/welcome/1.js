require('font-awesome/css/font-awesome.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
require('../../css/scss/materialize.scss'); //nie można bo atp.css tam jest , a tu nie jest potrzebny
$(document).ready(function () {
    require('materialize-js');
    $('select').material_select();
    $('.select-wrapper .caret').text('');
});
require('../../css/welcome/1.scss');

import AOS from 'aos/dist/aos';

// let rellax = new Rellax('.container-pad div > div', {
//     speed: 7,
//     center: true,
//     wrapper: 'body'
// });

require('aos/dist/aos.css');

AOS.init({
    mirror: true,
    offset: 120,
    delay: 10,
});

$(() => {
    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
    });
});


