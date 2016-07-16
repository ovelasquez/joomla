<?php
/**
 * @package		Ads Elite
 * @subpackage	mod_ads_elite
 * @copyright	Copyright (C) 2013 Elite Developers All rights reserved.
 * @license		GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
 */

defined('_JEXEC') or die( 'Restricted access' );

class modAdsEliteHelper {

	public static function getCode(&$params) {

		global $adsnub ;
		if ( isset( $adsnub ) ) {
			$adsnub ++ ;
		} else {
			$adsnub = 1 ;
		}	
		$ssl = $params->get( 'ssl' );
		if ( $ssl ) {
			if( isset( $_SERVER[ 'HTTPS' ] ) ) { 
				if ( empty( $_SERVER['HTTPS'] ) ) {
					return ;
				}
			}
		}
		$adsalg = $params->get( 'adsalg' );
		$acss =  trim( $params->get( 'acss' ) );
		$adsalg = ( ( $adsalg == 'css' ) ? $acss : $adsalg );
		$adscode = ( $adsalg ? "\r\n<div style=\"" . $adsalg . "\">\r\n" : "\r\n" );
		$cdtyp = $params->get( 'cdtyp' );
		$minwidth = $params->get( 'minwidth' );	
		$responsive = $params->get( 'responsive' );
		$adscd = strtolower( trim( $params->get( 'adscd' ) ) );
		$pid = $slt = $wdh = $hgt = $cmt = $adscl = $anltc = $sltc = $form = $frm = $resp = "" ;
		$adscdt = preg_split( '/[\r\n]+/', $adscd, -1, PREG_SPLIT_NO_EMPTY );
		if ( strstr( $adscd , '<ins class="adsbygoogle' ) ) {
			foreach ( $adscdt as $ln ) {
				$pid = ( preg_match( "/data-ad-client/i" , $ln ) ? trim( $ln , '\-=_datclienubp"; 	' ) : $pid );
				$slt = ( preg_match( "/data-ad-slot/i" , $ln ) ? trim( $ln , '\/<>-=_datsloin"; 	' ) : $slt );
				$form = ( preg_match( "/display:inline-block;/i" , $ln ) ? explode( ';' , $ln ) : $form );
				if ( is_array( $form ) ) {
					foreach ( $form as $lin ) {
						$wdh = ( preg_match( "/width/i" , $lin ) ? trim( $lin , '\=_widthpx":; 	' ) : $wdh );
						$hgt = ( preg_match( "/height/i" , $lin ) ? trim( $lin , '\=_heightpx":; 	' ) : $hgt );
					}
				}
				$anltc = ( preg_match( "/data-analytics-uacct/i" , $ln ) ? trim( $ln , '\=_datnlyicsuUA"; 	' ) : $anltc );
				$cmt = ( strstr( $ln , '<!--' ) ? trim( $ln , '<!-->' ) : $cmt );
			}
			$resp = ( ( !$wdh && !$hgt ) ? 1 : '' ) ;
		} else {
			foreach ( $adscdt as $ln ) {
				$pid = ( preg_match( "/google_ad_client/i" , $ln) ? trim( $ln , '\-=_goleadcintpub"; 	' ) : $pid );
				$slt = ( preg_match( "/google_ad_slot/i" , $ln ) ? trim( $ln , '\=_goleadst"; 	' ) : $slt );
				$wdh = ( preg_match( "/google_ad_width/i" , $ln ) ? trim( $ln , '\=_goleadwith"; 	' ) : $wdh );
				$hgt = ( preg_match( "/google_ad_height/i" , $ln ) ? trim( $ln , '\=_goleadhit"; 	' ) : $hgt );
				$anltc = ( preg_match( "/google_analytics_uacct/i" , $ln ) ? trim( $ln , '\=_goleanycsuitUA"; 	' ) : $anltc );
				$cmt = ( strstr( $ln , '*' ) ? trim( $ln , '/*' ) : $cmt );
			}			
		}
		$adstp = $params->get( 'adstp' );
		$clborder = strtoupper ( trim( $params->get( 'clborder' ) , '#' ) );
		$clbg = strtoupper ( trim( $params->get( 'clbg' ) , '#' ) );
		$cllink = strtoupper ( trim( $params->get( 'cllink' ) , '#' ) );
		$cltext = strtoupper ( trim( $params->get( 'cltext' ) , '#' ) );
		$clurl = strtoupper ( trim( $params->get( 'clurl' ) , '#' ) );
		$gacl = strtoupper ( trim( $params->get( 'gacl' ) , '#' ) );
		$ips = array( $params->get( 'ipb1' ), $params->get( 'ipb2' ), $params->get( 'ipb3' ), $params->get( 'ipb4' ), $params->get( 'ipb5' ) );
		$ipranges = array( $params->get( 'iprb1' ), $params->get( 'iprb2' ), $params->get( 'iprb3' ), $params->get( 'iprb4' ), $params->get( 'iprb5' ) );
		$altct = trim( $params->get( 'altct' ) );
		$adsblk = $params->get( 'adsblk' );
		$adchnl = trim( $params->get( 'adchnl' ) );
		$aduift = $params->get( 'aduift' );
		$adgff = $params->get( 'adgff' );
		$adgfs = $params->get( 'adgfs' );
		$mod = $params->get( 'module' );
		$adfrmt = $params->get( 'adfrmt' );
		$lnk = 'unit' ;
		if ( $adfrmt == "" ) { 
			$adscode .= "<div style='color:#ff0000;'><h5>Please select a VALID Ad Sizes in AdSense Elite Module options.</h5></div>\r\n\n";
			if ( $adsalg != '') {
				$adscode .= "</div>";
			}
			return $adscode;
		}
		$format = explode( "-" , $adfrmt );
		$width = explode( "x" , $format[0] );
		$height = explode( "_" , $width[1] );
		$adsizes = $params->get( 'adsizes' ) ;
		$helper = $params->get( 'fields' );
		$helper ? require $helper : '' ;
		$gaul = trim( $params->get( 'gaul' ) );
		$bkud = $params->get( 'bkud' );
		$ipb = 1 ;
		$adtx = array ( '320x50_as' , '234x60_as' , '120x240_as' , '180x150_as' , '125x125_as' , '728x15_0ads_al' , '468x15_0ads_al' , '120x90_0ads_al' , '160x90_0ads_al' , '180x90_0ads_al' , '200x90_0ads_al' );
		$adlk = array ( '728x15_0ads_al' , '468x15_0ads_al' , '120x90_0ads_al' , '160x90_0ads_al' , '180x90_0ads_al' , '200x90_0ads_al' );
		foreach( $adtx as $vals ) {
			$nfor = explode( "_" , $vals );
			if ( ( $nfor[0] ) == ( $wdh . 'x' . $hgt ) ) {
				$adstp = 'text';
			}
		}
		if( $adsblk == 1 ) {
			foreach( $ips as $val ) {
				if ( is_valid_ipm( $val ) ) {
					if ( $_SERVER["REMOTE_ADDR"] == trim( $val ) ) {
						$ipb = 0 ;
					}
				}
			}
		}
		if( $adsblk == 2 ) {
			foreach( $ipranges as $valr ) {
				if( $valr ) {
					list( $begin, $end ) = explode( '-' , trim( $valr ) );
					if ( is_valid_ipm( $begin ) && is_valid_ipm( $end ) ) {
						if ( ip_checker_rangem( $begin , $end , $_SERVER["REMOTE_ADDR"] ) ) {
							$ipb = 0 ;
						}
					}
				}
			}
		}	
		if ( $ipb == 1 ) {
			if ( ( $adscd == '') || ( strpos( $adscd , 'google_ad_client' ) === false ) || ( strpos( $adscd , 'google_ad_width' ) === false ) || ( strpos( $adscd , 'google_ad_height' ) === false ) ) {
				if ( ( strpos( $adscd , 'data-ad-client' ) === false ) || ( strpos( $adscd , 'data-ad-slot' ) === false ) ) {
					$adscode .= "\r\n<div style='color:#ff0000;'><h5>Please paste a VALID AdSense code in AdSense Elite Module options before activating it.</h5></div>\r\n\n";
					if ( $adsalg != '') {
						$adscode .= "</div>";
					}
					return $adscode ;
				}
			} 
			if ( $resp && !$responsive ) {
				$wdh = 728 ;
				$hgt = 90 ;
			}
			if ( $responsive ) {
				$wdh = 320 ;
				$hgt = 50 ;				
			}
			$adstp = ( ( $minwidth <= 180 ) && $responsive && ( $adstp == 'image' ) ) ? 'text_image' : $adstp ;
			$slta = $slt ;
			if ( $adsizes == 1 ) {
				$adstp = ( !$responsive &&  in_array( $adfrmt , $adtx ) ? 'text' : $adstp );
				$gaul = ( ( ( filter_var( $gaul , FILTER_VALIDATE_URL ) ) && ( $bkud == 'url' ) ) ? $gaul : '' );
				$gacl = ( ( ( $gacl ) && ( $bkud == 'color' ) ) ? $gacl : '' );
				$wdh = $width[0] ;
				$hgt = $height[0] ;
				$frm = $format[0] ; 		
				$sltc = true ;
				$slta = ( in_array( $frm , $adlk ) ? '' : $slt );
				$lnk = ( !$responsive &&  in_array( $frm , $adlk ) ? 'link' : $lnk );
				$adchnl = ( ( ( $adchnl ) && is_numeric( $adchnl ) && !$slta && ( $slt || $cmt ) ) ? $adchnl : '' );
			} else {
				foreach( $adlk as $vals ) {
					$nfor = explode( "_" , $vals );
					if ( ( $nfor[0] ) == ( $wdh . 'x' . $hgt ) ) {
						$lnk = 'link';
						$frm = ( !$slt ? $vals : '' );
					}
				}				
				$gaul = '' ;
				$gacl = '' ;
				$adchnl = '' ;	
			}
			if ( $adstp != "image" ) {
				$adgff = ( ( $adgff != "d" ) ? $adgff : '' ) ;
				$adgfs = ( ( $adgfs != "d" ) ? $adgfs : '' ) ;
				$aduift = ( ( $aduift != "d" ) ? $aduift : '' ) ;
			} else {
				$clborder = '' ; 
				$clbg = '' ;
				$cllink = '' ;
				$cltext = '' ; 
				$clurl = '' ; 				
				$adgff = '' ;
				$adgfs = '' ;
				$aduift = '' ;
			}
			$adscodew = ( $pid ? "\r\ngoogle_ad_client = \"ca-pub-" . $pid . '";' : '' ) 
					. ( $cmt ? "\r\n/*" . $cmt . "*/": '' ) 
					. ( $sltc && $slt  ? "/*\r\ngoogle_ad_slot = \"" . $slt ."\";*/ " : '' )
					. ( !$sltc && $slt ? "\r\ngoogle_ad_slot = \"" . $slt ."\"; "	: '' )
					. ( $gaul ? "\r\ngoogle_alternate_ad_url = \"" . $gaul . '";' : '' )
					. ( $gacl ? "\r\ngoogle_alternate_ad_color = \"" . $gacl . '";' : '' )
					. ( $adchnl ? "\r\ngoogle_ad_channel = \"" . $adchnl . '";' : '' )
					. ( $wdh ? "\r\ngoogle_ad_width = " . $wdh . ";" : '' )
					. ( $hgt ? "\r\ngoogle_ad_height = " . $hgt . ";" : '' )
					. ( ( !$slta && ( $lnk == 'link' ) && $frm )? "\r\ngoogle_ad_format = \"" . $frm . '";' : '' )
					. ( $adstp ? "\r\ngoogle_ad_type = \"" . $adstp . '";' : '' )
					. ( $clborder ? "\r\ngoogle_color_border = \"" . $clborder . '";' : '' )
					. ( $clbg ? "\r\ngoogle_color_bg = \"" . $clbg . '";' : '' )
					. ( $cllink ? "\r\ngoogle_color_link = \"" . $cllink . '";' : '' )
					. ( $cltext ? "\r\ngoogle_color_text = \"" . $cltext . '";' : '' )
					. ( $clurl ? "\r\ngoogle_color_url = \"" . $clurl . '";' : '' )
					. ( $adgff ? "\r\ngoogle_font_face = \"" . $adgff . '";' : '' )
					. ( $adgfs ? "\r\ngoogle_font_size = \"" . $adgfs . '";' : '' )
					. ( $aduift ? "\r\ngoogle_ui_features = \"" . $aduift . '";' : '' )
					. ( $anltc ? "\r\ngoogle_analytics_uacct = \"UA-" . $anltc . '";' : '' );
			$adscodesyn = ( $adscodew ? "<script type=\"text/javascript\"><!--" . $adscodew . "\r\n//--> \r\n</script>\r\n<script type=\"text/javascript\"  \r\nsrc=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n</script>\r\n" : '' );
			
			$adscodea =  ( !$responsive ? ( ( $wdh && $hgt ) ? "\r\n\tstyle=\"display:inline-block;width:" . $wdh . "px;height:" . $hgt . "px\"" : '' ) : ( ( $wdh && $hgt ) ? "\r\n\tstyle=\"display:inline-block;\"" : '' ) )
					. ( $pid ? "\r\n\tdata-ad-client=\"ca-pub-" . $pid . '"' : '' )						
					. ( $slta ? "\r\n\tdata-ad-slot=\"" . $slt .'"' : '' )
					. ( !$slta && $slt ? "\r\n\tdata-adslot=\"" . $slt .'"' : '' )
					. ( $gaul ? "\r\n\tdata-alternate-ad-url=\"" . $gaul . '"' : '' )
					. ( $gacl ? "\r\n\tdata-alternate-ad-color=\"" . $gacl . '"' : '' )
					. ( $adchnl ? "\r\n\tdata-ad-channel=\"" . $adchnl . '"' : '' )
					. ( !$slta && ( $lnk == 'link' ) &&  $frm ? "\r\n\tdata-ad-format=\"" . $frm . '"' : '' )
					. ( $adstp ? "\r\n\tdata-ad-type=\"" . $adstp . '"' : '' )
					. ( $clborder ? "\r\n\tdata-color-border=\"" . $clborder . '"' : '' )
					. ( $clbg ? "\r\n\tdata-color-bg=\"" . $clbg . '"' : '' )
					. ( $cllink ? "\r\n\tdata-color-link=\"" . $cllink . '"' : '' )
					. ( $cltext ? "\r\n\tdata-color-text=\"" . $cltext . '"' : '' )
					. ( $clurl ? "\r\n\tdata-color-url=\"" . $clurl . '"' : '' )
					. ( $adgff ? "\r\n\tdata-font-face=\"" . $adgff . '"' : '' )
					. ( $adgfs ? "\r\n\tdata-font-size=\"" . $adgfs . '"' : '' )
					. ( $aduift ? "\r\n\tdata-ui-features=\"" . $aduift . '"' : '' )
					. ( $anltc ? "\r\n\tdata-analytics-uacct=\"UA-" . $anltc . '"' : '' );
			if ( $responsive ) {							
					$styleresp = ( "\r\n\t.adslot_" . $adsnub . " { width: " . $wdh . "px; height: " . $hgt . "px; }" )
								. ( $minwidth >= 125 ? "\r\n\t@media(min-width: 225px) { .adslot_" . $adsnub . " { width: 125px; height: 125px; } }" : '' )
								. ( $minwidth >= 180 ? "\r\n\t@media(min-width: 260px) { .adslot_" . $adsnub . " { width: 180px; height: 150px; } }" : '' )			
								. ( $minwidth >= 200 ? "\r\n\t@media(min-width: 300px) { .adslot_" . $adsnub . " { width: 200px; height: 200px; } }" : '' )
								. ( $minwidth >= 250 ? "\r\n\t@media(min-width: 350px) { .adslot_" . $adsnub . " { width: 250px; height: 250px; } }" : '' )
								. ( $minwidth >= 300 ? "\r\n\t@media(min-width: 380px) { .adslot_" . $adsnub . " { width: 300px; height: 250px; } }" : '' )
								. ( $minwidth >= 336 ? "\r\n\t@media(min-width: 460px) { .adslot_" . $adsnub . " { width: 336px; height: 280px; } }" : '' )
								. ( $minwidth >= 468 ? "\r\n\t@media(min-width: 500px) { .adslot_" . $adsnub . " { width: 468px; height: 60px; } }" : '' )
								. ( $minwidth >= 728 ? "\r\n\t@media(min-width: 800px) { .adslot_" . $adsnub . " { width: 728px; height: 90px; } }" : '' );
					$document = JFactory::getDocument() ;
					$document->addStyleDeclaration( $styleresp );				
							
				$adscodeasy = ( $adscodea ? ( $cmt ? "\r\n<!--" . $cmt . "-->\r\n" : '' ) . "<ins class=\"adsbygoogle adslot_" . $adsnub . "\"" . $adscodea . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
				$cdtyp = 1 ;
			} else {
				$adscodeasy = ( $adscodea ? ( $cmt ? '<!--' . $cmt . "-->\r\n" : '' ) . '<ins class="adsbygoogle"' . $adscodea . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
			}
			$script = "<script async=\"async\" src=\"http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n" ;
			$adscode = ( ( $cdtyp == 1 ) ? $script . $adscodeasy : $adscodesyn );
		} else { 
			$adscode = $altct ;
		}
		$adscode = ( $adsalg ? "\r\n<div class=\"eliad" . $lnk . "\" style=\"" . $adsalg . "\">\r\n" . $adscode . "</div class=\"eliad" . $lnk . "\">" : "\r\n" . $adscode . "\r\n" );		
		echo "";
		return $adscode ;	
	}

}