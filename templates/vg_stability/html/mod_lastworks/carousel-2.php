<?php
/**
 * @autor       Valentín García
 * @website     www.htmgarcia.com
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2014 Valentín García. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

//CSS and JS
$app 		= JFactory::getApplication();
$document   = JFactory::getDocument();
/*$document->addStylesheet(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/owl-carousel/owl.carousel.css');
$document->addStylesheet(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/owl-carousel/owl.theme.css');
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/vendor/owl-carousel/owl.carousel.min.js');
$document->addScript(JURI::base() . 'templates/' . $app->getTemplate() . '/js/owl-carousel.js');*/

echo '<div class="lastworks_carousel ' . $moduleclass_sfx . '">';
	if(count($articles)) { //<-- A1.
		
		echo '<div class="prev-next-holder text-right">
			<a class="prev-btn owl-carousel-prev-' . $id_ . '" id="carousel-prev"><i class="fa fa-angle-left"></i></a>
			<a class="next-btn owl-carousel-next-' . $id_ . '" id="carousel-next"><i class="fa fa-angle-right"></i></a>
		</div>
		<div class="row">
			<div id="owl-carousel" class="owl-carousel owl-carousel__posts owl-carousel-' . $id_ . '">';
				
				foreach($articles as $article) {
					
					$images = json_decode($article->images);    
				
					echo '<div class="project-item">
						<div class="project-item-inner">
							<figure class="alignnone project-img">';
								
								if( $images->image_intro ){
									echo '<img src="' . JURI::base() . $images->image_intro . '" alt="" />';
								}else{
									echo '<img src="' . JURI::base() . 'templates/' . $app->getTemplate() . '/images/carousel_default.jpg" alt="" />';
								}
								
								echo '<div class="overlay">
									<a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '" class="dlink"><i class="fa fa-link"></i></a>';
									
								echo '</div>
							</figure>
							<div class="project-desc">
								<div class="meta">
									<span class="date">' . JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $article->publish_up, JText::_('DATE_FORMAT_LC2'))) . '</span>
								</div>
								<h4 class="title"><a href="' . ContentHelperRoute::getArticleRoute(  $article->id,  $article->catid ) . '">' . $article->title . '</a></h4>
							</div>
						</div>
					</div>';
					
				}
				
			echo '</div>
		</div>';
		
	}else{// .A1
	
		echo '<p class="vg-alert">There are no articles for this module.</p>';
	
	}// .A1 -->
echo '</div>';
?>
<script>
jQuery(function($){

    var owl = jQuery(".owl-carousel-<?php echo $id_; ?>");

    owl.owlCarousel({
        items : 4, //4 items above 1000px browser width
        itemsDesktop : [1000,4], //4 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // 4 items betweem 900px and 601px
        itemsTablet: [600,2], //2 items between 600 and 0;
        itemsMobile : [480,1], // itemsMobile disabled - inherit from itemsTablet option
        pagination : false
    });

    // Custom Navigation Events
    jQuery(".owl-carousel-next-<?php echo $id_; ?>").click(function(){
        owl.trigger('owl.next');
    });
    jQuery(".owl-carousel-prev-<?php echo $id_; ?>").click(function(){
        owl.trigger('owl.prev');
    });
    
});
</script>