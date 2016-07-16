<?php
/**
 * @package     Ads Elite
 * @subpackage  plg_ads_starter_elite
 * @copyright   Copyright (C) 2013 Elite Developers All rights reserved.
 * @license   	GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgSystemAdsStarterElite extends JPlugin {

	public function __construct( &$subject , $config )
	{
		parent::__construct( $subject , $config );
	}

	public function onAfterRender( ) {

		$body = JResponse::getBody( );
		$arr = ( explode( '<div class="eliadunit' , $body ) );
		$e = 0 ;
		foreach ($arr as &$value) {
			$value = $e ? '<div class="eliadunit' . $e . $value : $value ;
			$e++ ;
		}
		$body = implode( '' , $arr );
		$arr = ( explode( '</div class="eliadunit' , $body ) );
		$e = 0 ;
		foreach ($arr as &$value) {
			$value = $e ? '</div class="eliadunit' . $e . $value : $value ;
			$e++ ;
		}
		$body = implode( '' , $arr );
		if ( $e > 3 ) {
			for ( $j = 4 ; $j <= $e ; $j++ ) {
				$startTag = '<div class="eliadunit' . $j . '"' ;
				$endTag = '</div class="eliadunit' . $j . '">' ;
				$body = $this->delete ( $startTag , $endTag , $body );
			}
		}
		
		$arr = ( explode( '<div class="eliadlink' , $body ) );
		$i = 0 ;
		foreach ($arr as &$value) {
			$value = $i ? '<div class="eliadlink' . $i . $value : $value ;
			$i++ ;
		}
		$body = implode( '' , $arr );
		$arr = ( explode( '</div class="eliadlink' , $body ) );
		$i = 0 ;
		foreach ($arr as &$value) {
			$value = $i ? '</div class="eliadlink' . $i . $value : $value ;
			$i++ ;
		}
		$body = implode( '' , $arr );
		if ( $i > 3 ) {
			for ( $j = 4 ; $j <= $i ; $j++ ) {
				$startTag = '<div class="eliadlink' . $j . '"' ;
				$endTag = '</div class="eliadlink' . $j . '">' ;
				$body = $this->delete ( $startTag , $endTag , $body );
			}
		}
		for ( $k = 1 ; $k <= $e ; $k++ ) {
			$body = str_replace(  ' class="eliadunit' . $k . '"' , '' , $body );
		}
		for ( $k = 1 ; $k <= $i ; $k++ ) {
			$body = str_replace(  ' class="eliadlink' . $k . '"' , '' , $body );
		}
		$remove = '<script async="async" src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>' ;
		$script = "\r\n<script async=\"async\" src=\"http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n" ;
		$body = $this->addAsyncCode( $script , $remove , $body );
		$body = preg_replace('%<(div.*?:?!clear)[^>]*>\\s*</\\1>%', '', $body);
		JResponse::setBody( $body );
	}

	protected function addAsyncCode( $script , $remove , $buffer ) {
	
		$buffer = str_replace( $remove , "\r\n" , $buffer );
		if ( preg_match( "/window.adsbygoogle/i" , $buffer ) ) {
			if ( preg_match( "/<\/HEAD>/" , $buffer ) ) {
				$buffer = preg_replace( "/<\/HEAD>/" , $script . "\r\n</HEAD>" , $buffer );
			}
			if ( preg_match( "/<\/head>/" , $buffer ) ) {
				$buffer = preg_replace( "/<\/head>/" , $script . "\r\n</head>" , $buffer );
			}		
		}
        return $buffer ;		
	}

	protected function delete ( $beginning , $end , $string ) {
		$beginningPos = strpos($string, $beginning);
		$endPos = strpos($string, $end);
		if (!$beginningPos || !$endPos) {
			return $string;
		}

		$textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

		return str_replace($textToDelete, '', $string);
	}
	
}

?>