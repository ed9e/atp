/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');
require('font-awesome/css/font-awesome.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

import '@polymer/paper-checkbox/paper-checkbox';
import '@polymer/paper-dropdown-menu/paper-dropdown-menu';
import '@polymer/paper-item/paper-item';
import '@polymer/paper-listbox/paper-listbox';
import '@polymer/paper-input/paper-input';
import 'web-animations-js/web-animations-next-lite.min';

require('../css/scss/materialize.scss');

require('icheck/icheck');
require('icheck/skins/all.css');

require('ion-checkradio/js/ion.checkRadio');
require('ion-checkradio/css/ion.checkRadio.green.css');
require('./_main');
//require('./checkers.js');
//let instance = M.Collapsible.getInstance(elem);
$(document).ready(function () {
    setTimeout(function () {
        $('.lds-ripple').css({"opacity": 0});
        setTimeout(function () {
            $('.curtain__wrapper').css({"opacity": 1});
            $('.lds-ripple').css({'display': 'none'});
        }, 1450);
    }, 300);
});
