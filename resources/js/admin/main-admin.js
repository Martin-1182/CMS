import Isotope from "isotope-layout";
import imagesLoaded from "imagesloaded";

// external js: isotope.pkgd.js, imagesloaded.pkgd.js

var grid = document.querySelector('.grid') ;
var iso;
if ( grid != null ) {
    imagesLoaded( grid, function() {
// init Isotope after all images have loaded
 iso = new Isotope( grid, {
    itemSelector: '.grid-item',
    percentPosition: true,
    masonry: {
      columnWidth: '.grid-sizer'
    }
  });
});

} else {
    grid = '';
}