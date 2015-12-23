<?php
/**
 * @autor       Valentin Garcia
 * @website     www.htmgarcia.com
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2014 Valentin Garcia. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

echo '<div class="lastworks_blocks ' . $moduleclass_sfx . '">
    <section class="featured-section parallax-bg" data-stellar-ratio="2" data-stellar-background-ratio="0.5">
        <div class="row">';
    
            if(count($articles)): //<-- A1.
            
                foreach($articles as $article):
            
                    echo '<div class="col-sm-6 col-md-3">' . $article->introtext . '</div>';	
             
                endforeach;
        
            else: // .A1
	
                echo '<p class="vg-alert">There are no articles for this module.</p>';
	
            endif; // .A1 -->
    
        echo '</div>
    </section>
</div>';
?>