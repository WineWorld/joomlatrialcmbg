jQuery( function() {
  
	var $container = jQuery('.lastworks_isotope .isotope');
	$container.isotope({
		itemSelector: '.element-item',
		layoutMode: 'fitRows'
	});
	jQuery('#filters button').click(function() {
		jQuery('#filters button').removeClass('is-checked');
		jQuery(this).addClass('is-checked');
		var selector = jQuery(this).attr('data-filter');
		$container.isotope({
			filter: selector
		});
		return false;
	});
  
});