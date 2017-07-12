// Must pass through WebPack Javascript process before extracting SCSS occurs
require('../sass/style.scss');

// Import Functions and Variables from various ES6 Modules
import * as helpers from './helpers';
// use the imported helper object
helpers.statement('PAIRODIME Lab Results - ES6 Modules Loaded')

/*Drupal.behaviors.union1718 = function (context) {
    var pathToTheme = Drupal.settings.basePath + "sites/all/themes/" + Drupal.settings.ajaxPageState.theme;
};*/

// To instantiate FastClick on the body, which is the recommended method of use:
if ('addEventListener' in document) {
    document.addEventListener('DOMContentLoaded', function() {
        FastClick.attach(document.body);
        console.log('Fastclick loaded.')
    }, false);
}

window.onload = () => {

    let domReady = setTimeout(() => {
        if (document.readyState === 'complete') {
            console.log('dom ready')
            clearInterval(domReady)
            
            //scroll to 400 pixels down from the top
            TweenLite.to(window, 2, {scrollTo:400});

            // Swiper
            var mySwiper = new Swiper ('.swiper-container', {
                // Optional parameters
                direction: 'vertical',
                loop: true,
                
                // If we need pagination
                pagination: '.swiper-pagination',
                
                // Navigation arrows
                nextButton: '.swiper-button-next',
                prevButton: '.swiper-button-prev',
                
                // And if we need scrollbar
                scrollbar: '.swiper-scrollbar',
              })

            // GEO IP - Get Visitor IP Geoloaction -> then...
            axios.get('https://freegeoip.net/json/')
                .then(function(response) {
                    let country = response.data.country_code

                    sessionStorage.setItem('location', country)

                    // Debug Info
                    console.log('Your Country = ' + country)
                });
        }

    }, 500)

    // Window Resizing
    let $onResizeTimer; // wait until after resize has finished or this repeats like a dog in heat
    window.onresize = function() {
        clearTimeout($onResizeTimer);
        $onResizeTimer = setTimeout(function(){
           
        }, 300);
    };

}