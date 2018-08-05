// Add js for default theme to this file
// jQuery( function() {
// });

// jQuery(function () {  
//   var top = jQuery('#subhead').offset().top - parseFloat(jQuery('#subhead').css('margin-top').replace(/auto/, 0)); // math is there in case the element has margin-top and removes it
//   jQuery(window).scroll(function (event) {
//     // what the y position of the scroll is
//     var y = jQuery(this).scrollTop();    
//     // whether that's below the form
//     if (y >= top) {
//       // if so, add the fixed class
//       jQuery('#subhead').addClass('fixed');
//     } else {
//       // otherwise remove it
//       jQuery('#subhead').removeClass('fixed');
//     }
//   });
// });

// jQuery( function() {
//     jQuery( document ).tooltip();
// } );

// jQuery(function () {
//   jQuery('[data-toggle="tooltip"]').tooltip({ trigger: 'click'});
// });

function myTooltipFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}