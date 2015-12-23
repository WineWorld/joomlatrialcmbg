<?php
/**
 * @version		1.0.0
 * @copyright	Copyright (C) 2014 Valentín García - http://www.htmgarcia.com - All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.plugin.plugin');

class plgSystemMyShortcodes extends JPlugin {


	public function __construct( &$subject, $params ) {
		
		parent::__construct( $subject, $params );

		$app = JFactory::getApplication();

		//run only on front end
		$this->shouldrun = !$app->isAdmin();

	}
	
	
	
	// replace the 'replacements' using onAfterRender event
	public function onAfterRender() {

		if ($this->shouldrun) {

			$body = JResponse::getBody();
			
			//shortcodes
			$bbcode = array(
				'|{youtube}(.*){\/youtube}|e' => '$this->embedYoutube("\1")', //Youtube
				'|{vimeo}(.*){\/vimeo}|e' => '$this->embedVimeo("\1")', //Vimeo
                '|{soundcloud}(.*){\/soundcloud}|e' => '$this->embedSoundcloud("\1")', //Soundcloud
                '|{slide}(.*){\/slide}|e' => '$this->embedSlide("\1")' //Slide
			);
			
			$body = preg_replace(array_keys($bbcode), array_values($bbcode), $body);
			
			JResponse::setBody($body);
			
		}
			
	}
	
	//Youtube html output
	protected function embedYoutube($youtubeCode){
		return '<figure class="alignnone video-holder">
            <iframe class="frame" src="//www.youtube.com/embed/' . $youtubeCode . '" width="612" height="343" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </figure>';
	}
	
	//Vimeo html output
	protected function embedVimeo($vimeoCode){
		return '<figure class="alignnone video-holder">
            <iframe class="frame" src="http://player.vimeo.com/video/' . $vimeoCode . '?title=0&amp;byline=0&amp;portrait=0" width="612" height="343" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
        </figure>';
	}
    
    //Soundcloud html output
	protected function embedSoundcloud($soundcloudCode){
		return '<figure class="alignnone audio-holder">
            <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/' . $soundcloudCode . '&amp;auto_play=false&amp;hide_related=false&amp;show_artwork=true"></iframe>
        </figure>';
	}
    
    //Slide html output
	protected function embedSlide($slideCode){
        
        $output = '<div class="owl-carousel owl-theme owl-slider thumbnail">';
            //images
            $directorio = $slideCode;
			$handle = opendir($directorio);
			while ($file = readdir($handle)) {
				if($file!= "." && $file != ".." && $file!="Thumbs.db"){
                    $validar = explode('.',$file);//Que sólo sean imagenes
					if($validar[1] == 'jpg' || $validar[1] == 'gif' || $validar[1] == 'png'){ 
						$output .= '<div class="item"><img src="' . JURI::base() . $directorio . $file . '" alt="" title="" /></div>';
					}
				}
			}
        $output .= '</div>';
        
		return $output;
	}

}


