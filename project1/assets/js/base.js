require('../css/base.scss');

require('font-awesome/css/font-awesome.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
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


