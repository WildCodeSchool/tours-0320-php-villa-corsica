/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../scss/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');
// weather API 
const city = 'Corse';
let temp;
let weather;
$.getJSON("http://api.openweathermap.org/data/2.5/weather?q=" + city + "&units=metric&appid=b494c2618576c2d414c7c03aabeff46b",
    function(data) {
        console.log(data);
        temp = data.main.temp;
        weather = data.weather[0].main;
        $('.weather').append(weather); 
        $('.temp').append(temp);
    }
)
;
 