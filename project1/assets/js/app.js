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
// require('materialize-js');
// require('materialize-css');
// require('materialize');
require('../css/scss/materialize.scss');
require('./materialize_init');
require('icheck/icheck');
require('icheck/skins/polaris/polaris.css');
require('icheck/skins/futurico/futurico.css');
require('icheck/skins/line/_all.css');
require('icheck/skins/flat/_all.css');
require('./checkers.js');
//let instance = M.Collapsible.getInstance(elem);
