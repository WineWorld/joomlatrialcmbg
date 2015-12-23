<?php
/**
 * @autor       Valent�n Garc�a
 * @website     www.htmgarcia.com
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2012 Valent�n Garc�a. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

class modLastWorksHelper
{
	
	//Get articles @since 1.0.0
	public static function getArticlesLW( $categories, $filter, $orderingtype, $ordering, $limit ){
		
		$db = JFactory::getDBO();
		$query = 'SELECT * FROM #__content';
		$query .= ' WHERE state = 1';
		
		//categories - @since 1.0.4 (only the if sentence)
		if( $categories ){
			$query .= ' AND catid IN(' . join( ',', $categories ) . ')';
		}
		
		//filter - featured?
		switch( $filter ){
		
			case 'any':
				$query .= '';
			break;
			
			case 'no_feat':
				$query .= ' AND featured = 0';
			break;
			
			case 'feat':
				$query .= ' AND featured = 1';
			break;
			
		}
		
		//ordering type
		$query .= ' ORDER BY ' . $orderingtype;
		
		//ordering
		$query .= ' ' . $ordering;
		
		//limit
		$query .= ' LIMIT 0, '. $limit .'';
		
		//echo $query; //just for test
		
		$db->setQuery( $query );
		$results = $db->loadObjectList(); 
		
		return $results;
		
	}
	
	//Get categories @since 1.0.0
	public static function getCategoriesLW( $categories ){
		
		$db = JFactory::getDBO();
		$query = 'SELECT * FROM #__categories';
		$query .= ' WHERE published = 1';
		
		//categories
		$query .= ' AND id IN(' . join( ',', $categories ) . ')';
		
		//echo $query; //just for test
		
		$db->setQuery( $query );
		$results = $db->loadObjectList(); 
		
		return $results;
		
	}
	
	//Get category @since 1.0.0
	public static function getCategoryLW( $id ){
		
		$db = JFactory::getDBO();
		$query = 'SELECT title FROM #__categories';
		$query .= ' WHERE published = 1';
		
		//categories
		$query .= ' AND id = "' . $id . '" LIMIT 0,1';
		
		//echo $query; //just for test
		
		$db->setQuery( $query );
		$results = $db->loadResult();
		
		return $results;
		
	}
	
	//Get images from html @since 1.0.0
	public static function getImageLW( $html ){
	
		preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches ); 
		$result = $matches[ 1 ][ 0 ];
		
		return $result;
	
	}
	
	//Get category params @since 1.0.3
	public static function getCategoryParamsLW( $id ){
		
		$db = JFactory::getDBO();
		$query = 'SELECT params FROM #__categories';
		$query .= ' WHERE published = 1';
		
		//categories
		$query .= ' AND id = ' . $id;
		
		//echo $query; //just for test
		
		$db->setQuery( $query );
		$results = $db->loadResult(); 
		
		return $results;
	
	}
	
	//Get category description @since 1.0.5
	public static function getCategoryDescriptionLW( $id ){
		
		$db = JFactory::getDBO();
		$query = 'SELECT description FROM #__categories';
		$query .= ' WHERE published = 1';
		
		//categories
		$query .= ' AND id = "' . $id . '" LIMIT 0,1';
		
		//echo $query; //just for test
		
		$db->setQuery( $query );
		$results = $db->loadResult();
		
		return $results;
		
	}
	
	//Get category note @since 1.0.6
	public static function getCategoryNoteLW( $id ){
		
		$db = JFactory::getDBO();
		$query = 'SELECT note FROM #__categories';
		$query .= ' WHERE published = 1';
		
		//categories
		$query .= ' AND id = "' . $id . '" LIMIT 0,1';
		
		//echo $query; //just for test
		
		$db->setQuery( $query );
		$results = $db->loadResult();
		
		return $results;
		
	}
	
}
