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
 var city = "Corse";

 $.getJSON("http://api.openweathermap.org/data/2.5/weather?q=" + city + "&units=metric&appid=b494c2618576c2d414c7c03aabeff46b",
  function(data){
     console.log(data);
 
     var icon = "https://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
     var temp = data.main.temp;
     var weather = data.weather[0].main;
     var speed = data.wind.speed;
     $('.icon').attr('src', icon);
     $('.weather').append(weather); 
     $('.temp').append(temp);
     $('.speed').append(speed);
  }
 
 );
 
 $.getJSON("https://api.windy.com/api/webcams/v2/list/country=FR?show=webcams:image,location,player&key=VaG5dg3tbtb1LZVzoRR7PDRG0ET2jaFz",
     function(data){
         console.log(data);
         var webcam =  data.result.webcams[3].player.lifetime.embed;
         $('.webcamfr').attr('src', webcam);
     }
 );
