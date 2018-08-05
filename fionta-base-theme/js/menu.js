(function ($) {

  Drupal.behaviors.fionta_menu_hamb = {
    attach: function (context, settings) {
      settings.responsive_menus = settings.responsive_menus || {};
      var $windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
      $.each($('.sidr'), function(ind, iteration) {

				var $the_menu = $(this).find('.sidr-class-content').children('ul');
				$the_menu.children().each(function(){
						if ($(this).find('li.sidr-class-active').length) {
							$(this).addClass('active');
						}
				});

      });
    }
  };
}(jQuery));