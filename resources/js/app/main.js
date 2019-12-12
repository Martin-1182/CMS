////////////////////////////////////////
//
// Helpers
//
////////////////////////////////////////
// Mobile detection
////////////////////////////////////////
var isMobile = false;
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    isMobile = true;
}

////////////////////////////////////////
// OS detector
////////////////////////////////////////
var phone, touch, ltie9, dh, ar, fonts, ieMobile;

var ua = navigator.userAgent;
var winLoc = window.location.toString();

var is_webkit       = ua.match(/webkit/i);
var is_firefox      = ua.match(/gecko/i);
var is_newer_ie     = ua.match(/msie (9|([1-9][0-9]))/i);
var is_older_ie     = ua.match(/msie/i) && !is_newer_ie;
var is_ancient_ie   = ua.match(/msie 6/i);
var is_ie           = is_ancient_ie || is_older_ie || is_newer_ie;
var is_mobile_ie    = navigator.userAgent.indexOf('IEMobile') !== -1;
var is_mobile       = ua.match(/mobile/i);
var is_OSX          = ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false;
var iOS             = getIOSVersion(ua);
var is_EDGE         = ua.match(/Edge/i);
var puppeteer       = ua.match(/puppeteer/i);

function getIOSVersion(ua) {
    ua = ua || navigator.userAgent;
    return parseFloat(
            ('' + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(ua) || [0,''])[1])
                .replace('undefined', '3_2').replace('_', '.').replace('_', '')
        ) || false;
}

////////////////////////////////////////
// Browser Ditector
////////////////////////////////////////
$(document).ready(function(){
    var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    var isFirefox = typeof InstallTrigger !== 'undefined';
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    var isEdge = !isIE && !!window.StyleMedia;
    var isChrome = !!window.chrome && !!window.chrome.webstore;
    var isBlink = (isChrome || isOpera) && !!window.CSS;

    if(isOpera) $('html').addClass("opera");
    if(is_OSX) $('html').addClass("osx");
    if(isFirefox) $('html').addClass("firefox");
    if(isSafari) $('html').addClass("safari");
    if(isIE) $('html').addClass("ie");
    if(isEdge) $('html').addClass("edge");
    if(isChrome) $('html').addClass("chrome");
    if(isBlink) $('html').addClass("blink");

})
import AOS from "aos";
AOS.init({
    startEvent: " DOMContentLoaded "
});

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
