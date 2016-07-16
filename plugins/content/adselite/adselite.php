<?php
/**
 * @package     Ads Elite
 * @subpackage  plg_ads_elite
 * @copyright   Copyright (C) 2013 Elite Developers All rights reserved.
 * @license   	GNU/GPL v3 http://www.gnu.org/licenses/gpl.html
 */

error_reporting (E_ALL) ;
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgContentAdsElite extends JPlugin {

	public function __construct( &$subject , $config ) {
			parent::__construct( $subject , $config );
			$this->loadLanguage();
		
	}

	function onContentPrepare( $context , &$article, &$params , $page = 0 ) {
	
		if ( isset( $executed ) ) {
			return ;
		}		
		global $adsnub ;
		if ( !isset( $adsnub ) ) {
			$adsnub = 1 ;
		} else {
			$adsnub ++ ;
		}
		global $styleresp ;		
		$ssl = $this->params->get( 'ssl' );
		if ( $ssl ) {
			if( isset( $_SERVER[ 'HTTPS' ] ) ) { 
				if ( empty( $_SERVER['HTTPS'] ) ) {
					return ;
				}
			}
		}
		$app = JFactory::getApplication();
        if ( $context == 'mod_custom.content' ) {
			return ;
		}
		
		$show = $this->params->get( 'show' );
		if ( $show ) {
			if ( !is_array( $show ) ) {
				$shows[] = $show ;
			} else {
				$shows = $show ;
			}
			foreach ( $shows as $va ) {
				if ( $va == 'other' ) {
					if ( strpos ( $context , 'com_content' ) ) {
						return ;
					}
				} else {
					if ( ( JRequest :: getVar( 'view' ) ) == $va ) {
						return ;
					}
					if ( $va == 'frontpage' ) {
						$app = JFactory::getApplication();
						$menu = $app->getMenu();
						if ($menu->getActive() == $menu->getDefault()) {
							return ;
						}
					}
				}
			}
		}
		if ( isset( $article->id ) ) {			
			if ( $this->params->get( 'adsblkac5' ) == 1 ) {
				if ( $this->exclude( 'exartd' , $article->id ) ) {
					return ; 
				}
				if ( $this->excludec( 'excatd' , $article->catid ) ) {
					return ; 
				}
			} 
		}
		$user = JFactory::getUser();
		$db = JFactory::getDBO();
		$user_id = $user->get( 'id' );
		$query = 'SELECT * FROM #__users as u LEFT JOIN #__user_usergroup_map as ug on u.id = ug.user_id WHERE u.id=' . $user_id ;
		$db->setQuery( $query );
		$user_group = ( $articles = $db->loadObject() ) ? $articles->group_id : 0 ;
		$ips = array( $this->params->get( 'ipb1' ) , $this->params->get('ipb2') , $this->params->get('ipb3') , $this->params->get('ipb4') , $this->params->get('ipb5') );
		$ipranges = array( $this->params->get( 'iprb1' ), $this->params->get( 'iprb2' ), $this->params->get( 'iprb3' ), $this->params->get( 'iprb4' ), $this->params->get( 'iprb5' ) );
		$adscode = $adscode1 = $adscode2 = $adscode3 = '' ;
		$altct = trim( $this->params->get( 'altct' ) );
		$adsblk = $this->params->get( 'adsblk' );
		$adsalg1 = $this->params->get( 'adsalg1' );
		$adsalg2 = $this->params->get( 'adsalg2' );
		$adsalg3 = $this->params->get( 'adsalg3' );
		$acss1 =  trim( $this->params->get( 'acss1' ) );
		$acss2 =  trim( $this->params->get( 'acss2' ) );
		$acss3 =  trim( $this->params->get( 'acss3' ) );
		$cdtyp =  trim( $this->params->get( 'cdtyp' ) );
		$adsalg1 = ( ( $adsalg1 == 'css' ) ? $acss1 : $adsalg1 );
		$adsalg2 = ( ( $adsalg2 == 'css' ) ? $acss2 : $adsalg2 );
		$adsalg3 = ( ( $adsalg3 == 'css' ) ? $acss3 : $adsalg3 );
		$adscl1 = $adscl2 = $adscl3 = $pid = $slt = $wdh = $hgt = $cmt = $anltc = $form = $resp = "" ;
		$minwidth = $this->params->get( 'minwidth' );	
		$responsive = $this->params->get( 'responsive' );
		$adscd = strtolower( trim( $this->params->get( 'adscd' ) ) );
		$adscdt = preg_split( '/[\r\n]+/' , $adscd , -1 , PREG_SPLIT_NO_EMPTY );
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
			foreach ( $adscdt as $ln ){
				$pid = ( preg_match( "/google_ad_client/i" , $ln) ? trim( $ln , '\-=_goleadcintpub"; 	' ) : $pid );
				$slt = ( preg_match( "/google_ad_slot/i" , $ln ) ? trim( $ln , '\=_goleadst"; 	' ) : $slt );
				$wdh = ( preg_match( "/google_ad_width/i" , $ln ) ? trim( $ln , '\=_goleadwith"; 	' ) : $wdh );
				$hgt = ( preg_match( "/google_ad_height/i" , $ln ) ? trim( $ln , '\=_goleadhit"; 	' ) : $hgt );
				$anltc = ( preg_match( "/google_analytics_uacct/i" , $ln ) ? trim( $ln , '\=_goleanycsuitUA"; 	' ) : $anltc );
				$cmt = ( strstr( $ln , '*' ) ? trim( $ln , '/*' ) : $cmt );
			}
		}
		$adstp1 = $this->params->get( 'adstp1' );		
		$adstp2 = $this->params->get( 'adstp2' );		
		$adstp3 = $this->params->get( 'adstp3' );		
		$adun1 = $this->params->get( 'adun1' );		
		$adun2 = $this->params->get( 'adun2' );		
		$adun3 = $this->params->get( 'adun3' );		
		$clborder1 = strtoupper ( trim( $this->params->get( 'clborder1' ) , '#' ) );
		$clborder2 = strtoupper ( trim( $this->params->get( 'clborder2' ) , '#' ) );
		$clborder3 = strtoupper ( trim( $this->params->get( 'clborder3' ) , '#' ) );
		$clbg1 = strtoupper ( trim( $this->params->get( 'clbg1' ) , '#' ) );
		$clbg2 = strtoupper ( trim( $this->params->get( 'clbg2' ) , '#' ) );
		$clbg3 = strtoupper ( trim( $this->params->get( 'clbg3' ) , '#' ) );
		$cllink1 = strtoupper ( trim( $this->params->get( 'cllink1' ) , '#' ) );
		$cllink2 = strtoupper ( trim( $this->params->get( 'cllink2' ) , '#' ) );
		$cllink3 = strtoupper ( trim( $this->params->get( 'cllink3' ) , '#' ) );
		$cltext1 = strtoupper ( trim( $this->params->get( 'cltext1' ) , '#' ) );
		$cltext2 = strtoupper ( trim( $this->params->get( 'cltext2' ) , '#' ) );
		$cltext3 = strtoupper ( trim( $this->params->get( 'cltext3' ) , '#' ) );
		$clurl1 = strtoupper ( trim( $this->params->get( 'clurl1' ) , '#' ) );
		$clurl2 = strtoupper ( trim( $this->params->get( 'clurl2' ) , '#' ) );
		$clurl3 = strtoupper ( trim( $this->params->get( 'clurl3' ) , '#' ) );
		$gacl1 = strtoupper ( trim( $this->params->get( 'gacl1' ) , '#' ) );
		$gacl2 = strtoupper ( trim( $this->params->get( 'gacl2' ) , '#' ) );
		$gacl3 = strtoupper ( trim( $this->params->get( 'gacl3' ) , '#' ) );
		$adchnl1 = trim( $this->params->get( 'adchnl1' ) );
		$adchnl2 = trim( $this->params->get( 'adchnl2' ) );
		$adchnl3 = trim( $this->params->get( 'adchnl3' ) );
		$aduift1 = $this->params->get( 'aduift1' );
		$aduift2 = $this->params->get( 'aduift2' );
		$aduift3 = $this->params->get( 'aduift3' );
		$adgff1 = $this->params->get( 'adgff1' );
		$adgff2 = $this->params->get( 'adgff2' );
		$adgff3 = $this->params->get( 'adgff3' );
		$adgfs1 = $this->params->get( 'adgfs1' );
		$adgfs2 = $this->params->get( 'adgfs2' );
		$adgfs3 = $this->params->get( 'adgfs3' );
		$plg = $this->params->get( 'plugin' );
		$adfrmt1 = $this->params->get( 'adfrmt1' );
		$adfrmt2 = $this->params->get( 'adfrmt2' );
		$adfrmt3 = $this->params->get( 'adfrmt3' );
		$lnk1 = $lnk2 = $lnk3 = 'unit' ;
		if ( $adfrmt1 ) { 
			$format1 = explode( "-" , $adfrmt1 );		
			$width1 = explode( "x" , $format1[0] );		
			$height1 = explode( "_" , $width1[1] );
			$adscodez1 = "" ;
		} else {
			$adscodez1 = "\r\n<div style='color:#ff0000;'><h5>Select a VALID Ad Sizes in Ads Elite Plugin options (Top Ad Unit).</h5></div>\r\n\n";
		}
		if ( $adfrmt2 ) { 
			$format2 = explode( "-" , $adfrmt2 );		
			$width2 = explode( "x" , $format2[0] );		
			$height2 = explode( "_" , $width2[1] );	
			$adscodez2 = "" ;			
		} else {
			$adscodez2 = "\r\n<div style='color:#ff0000;'><h5>Select a VALID Ad Sizes in Ads Elite Plugin options (Inside Ad Unit).</h5></div>\r\n\n";
		}
		if ( $adfrmt3 ) { 
			$format3 = explode( "-" , $adfrmt3 );		
			$width3 = explode( "x" , $format3[0] );		
			$height3 = explode( "_" , $width3[1] );
			$adscodez3 = "" ;			
		} else {
			$adscodez3 = "\r\n<div style='color:#ff0000;'><h5>Select a VALID Ad Sizes in Ads Elite Plugin options (Bottom Ad Unit).</h5></div>\r\n\n";
			return $adscode;
		}		
		$adsizes1 = $this->params->get( 'adsizes1' );
		$adsizes2 = $this->params->get( 'adsizes2' );
		$adsizes3 = $this->params->get( 'adsizes3' );
		$bkud1 = $this->params->get( 'bkud1' );
		$bkud2 = $this->params->get( 'bkud2' );
		$bkud3 = $this->params->get( 'bkud3' );
		$usrl = $this->params->get( 'usrl' );
		$gaul1 = trim( $this->params->get( 'gaul1' ) );
		$gaul2 = trim( $this->params->get( 'gaul2' ) );
		$gaul3 = trim( $this->params->get( 'gaul3' ) );
		$helper = $this->params->get( 'fields' );
		$deli = $this->params->get( 'deli' );
		$helper ? require $helper : '';
		$sltc1 = $sltc2 = $sltc3 = false ;
		$slta1 = $slta2 = $slta3 = $slt ;
		$slt1 = $slt2 = $slt3 = $slt ;
		$wdh1 = $wdh2 = $wdh3 = $wdh ;
		$hgt1 = $hgt2 = $hgt3 = $hgt ;
		$frm1 = $frm2 = $frm3 = "" ;
		$ipb = 1 ;

		$adtx = array ( '320x50_as' , '234x60_as' , '120x240_as' , '180x150_as' , '125x125_as' , '728x15_0ads_al' , '468x15_0ads_al' , '120x90_0ads_al' , '160x90_0ads_al' , '180x90_0ads_al' , '200x90_0ads_al' );
		$adlk = array ( '728x15_0ads_al' , '468x15_0ads_al' , '120x90_0ads_al' , '160x90_0ads_al' , '180x90_0ads_al' , '200x90_0ads_al' );
		
		foreach( $adtx as $vals ) {
			$nfor = explode( "_" , $vals );
			if ( ( $nfor[0] ) == ( $wdh . 'x' . $hgt ) ) {
				$adstp1 = $adstp2 = $adstp3 = 'text_image';
			}
		}

		if( $adsblk == 1 ) {
			foreach( $ips as $val ) {
				if ( is_valid_ipp( $val ) ) {
					if ( $_SERVER["REMOTE_ADDR"] == trim( $val ) ) {
						$ipb = 0 ;
					}
				}
			}
		}

		if( $adsblk == 2 ) {
			foreach( $ipranges as $valr ) {
				if ( $valr ) {
					list( $begin, $end ) = explode( '-' , trim( $valr ) );
					if ( is_valid_ipp( $begin ) && is_valid_ipp( $end ) ) {
						if ( ip_checker_rangep( $begin , $end , $_SERVER["REMOTE_ADDR"] ) ) {
							$ipb = 0 ;
						}
					}
				}
			}
		}

		$bdcd = 0 ;
		if ( $ipb == 1 ) {

			if ( ( $adscd === '' ) || ( strpos( $adscd , 'google_ad_client' ) === false ) || ( strpos( $adscd , 'google_ad_width' ) === false ) || ( strpos( $adscd , 'google_ad_height' ) === false ) ) { 
				if ( ( strpos( $adscd , 'data-ad-client' ) === false ) || ( strpos( $adscd , 'data-ad-slot' ) === false ) ) {
					$adscode .= "\r\n<div style='color:#ff0000;'><h5>Paste a VALID AdSense code in Ads Elite Plugin options before activating it.</h5></div>\r\n\n" ; 
					$bdcd = 1 ;
				}
			}
			if ( $resp && !$responsive ) {
				$wdh1 = 300 ;
				$hgt1 = 250 ;
			}
			if ( $responsive ) {
				$wdh1 = $wdh2 = $wdh3 = 320 ;
				$hgt1 = $hgt2 = $hgt3 = 50 ;				
			}
			$adstp1 = ( ( $minwidth <= 180 ) && $responsive && ( $adstp1 == 'image' ) ) ? 'text_image' : $adstp1 ;
			if ( $adsizes1 == 1 ) {
				$adstp1 = ( !$responsive &&  in_array( $adfrmt1 , $adtx ) ? 'text_image' : $adstp1 );
				$gaul1 = ( ( ( filter_var( $gaul1 , FILTER_VALIDATE_URL ) ) && ( $bkud1 == 'url' ) ) ? $gaul1 : '' );
				$gacl1 = ( ( ( $gacl1 ) && ( $bkud1 == 'color' ) ) ? $gacl1 : '' );
				$wdh1 = $width1[0] ;
				$hgt1 = $height1[0] ;
				$frm1 = $format1[0] ; 		
				$sltc1 = true ;
				$slta1 = ( in_array( $frm1 , $adlk ) ? '' : $slt );
				$lnk1 = ( !$responsive &&  in_array( $frm1 , $adlk ) ? 'link' : $lnk1 );
				$adchnl1 = ( ( ( $adchnl1 ) && is_numeric( $adchnl1 ) && !$slta1 && ( $slt || $cmt ) ) ? $adchnl1 : '' );
			} else {
				foreach( $adlk as $vals ) {
					$nfor = explode( "_" , $vals );
					if ( ( $nfor[0] ) == ( $wdh1 . 'x' . $hgt1 ) ) {
						$lnk1 = 'link';
						$frm1 = ( !$slt ? $vals : '' );
					}
				}				
				$gaul1 = '' ;
				$gacl1 = '' ;
				$adchnl1 = '' ;	
			}

			if ( $adstp1 != "image" ) {
				$adgff1 = ( ( $adgff1 != "d" ) ? $adgff1 : '' ) ;
				$adgfs1 = ( ( $adgfs1 != "d" ) ? $adgfs1 : '' ) ;
				$aduift1 = ( ( $aduift1 != "d" ) ? $aduift1 : '' ) ;
			} else {
				$clborder1 = '' ; 
				$clbg1 = '' ;
				$cllink1 = '' ;
				$cltext1 = '' ; 
				$clurl1 = '' ; 				
				$adgff1 = '' ;
				$adgfs1 = '' ;
				$aduift1 = '' ;
			}

			$adscodew1 = ( $pid ? "\r\ngoogle_ad_client = \"ca-pub-" . $pid . '";' : '' ) 
					. ( $cmt ? "\r\n/*" . $cmt . "*/": '' ) 
					. ( $sltc1 && $slt1  ? "/*\r\ngoogle_ad_slot = \"" . $slt ."\";*/ " : '' )
					. ( !$sltc1 && $slt1 ? "\r\ngoogle_ad_slot = \"" . $slt ."\"; "	: '' )
					. ( $gaul1 ? "\r\ngoogle_alternate_ad_url = \"" . $gaul1 . '";' : '' )
					. ( $gacl1 ? "\r\ngoogle_alternate_ad_color = \"" . $gacl1 . '";' : '' )
					. ( $adchnl1 ? "\r\ngoogle_ad_channel = \"" . $adchnl1 . '";' : '' )
					. ( $wdh1 ? "\r\ngoogle_ad_width = " . $wdh1 . ";" : '' )
					. ( $hgt1 ? "\r\ngoogle_ad_height = " . $hgt1 . ";" : '' )
					. ( ( !$slta1 && ( $lnk1 == 'link' ) && $frm1 )? "\r\ngoogle_ad_format = \"" . $frm1 . '";' : '' )
					. ( $adstp1 ? "\r\ngoogle_ad_type = \"" . $adstp1 . '";' : '' )
					. ( $clborder1 ? "\r\ngoogle_color_border = \"" . $clborder1 . '";' : '' )
					. ( $clbg1 ? "\r\ngoogle_color_bg = \"" . $clbg1 . '";' : '' )
					. ( $cllink1 ? "\r\ngoogle_color_link = \"" . $cllink1 . '";' : '' )
					. ( $cltext1 ? "\r\ngoogle_color_text = \"" . $cltext1 . '";' : '' )
					. ( $clurl1 ? "\r\ngoogle_color_url = \"" . $clurl1 . '";' : '' )
					. ( $adgff1 ? "\r\ngoogle_font_face = \"" . $adgff1 . '";' : '' )
					. ( $adgfs1 ? "\r\ngoogle_font_size = \"" . $adgfs1 . '";' : '' )
					. ( $aduift1 ? "\r\ngoogle_ui_features = \"" . $aduift1 . '";' : '' )
					. ( $anltc ? "\r\ngoogle_analytics_uacct = \"UA-" . $anltc . '";' : '' );
			$adscodesyn1 = ( $adscodew1 ? "<script type=\"text/javascript\"><!--" . $adscodew1 . "\r\n//--> \r\n</script>\r\n<script type=\"text/javascript\"  \r\nsrc=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n</script>\r\n" : '' );

			$adscodea1 = ( !$responsive ? ( ( $wdh1 && $hgt1 ) ? "\r\n\tstyle=\"display:inline-block;width:" . $wdh1 . "px;height:" . $hgt1 . "px\"" : '' ) : ( ( $wdh1 && $hgt1 ) ? "\r\n\tstyle=\"display:inline-block;\"" : '' ) )
					. ( $pid ? "\r\n\tdata-ad-client=\"ca-pub-" . $pid . '"' : '' )						
					. ( $slta1 ? "\r\n\tdata-ad-slot=\"" . $slt .'"' : '' )
					. ( !$slta1 && $slt ? "\r\n\tdata-adslot=\"" . $slt .'"' : '' )
					. ( $gaul1 ? "\r\n\tdata-alternate-ad-url=\"" . $gaul1 . '"' : '' )
					. ( $gacl1 ? "\r\n\tdata-alternate-ad-color=\"" . $gacl1 . '"' : '' )
					. ( $adchnl1 ? "\r\n\tdata-ad-channel=\"" . $adchnl1 . '"' : '' )
					. ( !$slta1 && ( $lnk1 == 'link' ) &&  !$responsive &&  $frm1 ? "\r\n\tdata-ad-format=\"" . $frm1 . '"' : '' )
					. ( $adstp1 ? "\r\n\tdata-ad-type=\"" . $adstp1 . '"' : '' )
					. ( $clborder1 ? "\r\n\tdata-color-border=\"" . $clborder1 . '"' : '' )
					. ( $clbg1 ? "\r\n\tdata-color-bg=\"" . $clbg1 . '"' : '' )
					. ( $cllink1 ? "\r\n\tdata-color-link=\"" . $cllink1 . '"' : '' )
					. ( $cltext1 ? "\r\n\tdata-color-text=\"" . $cltext1 . '"' : '' )
					. ( $clurl1 ? "\r\n\tdata-color-url=\"" . $clurl1 . '"' : '' )
					. ( $adgff1 ? "\r\n\tdata-font-face=\"" . $adgff1 . '"' : '' )
					. ( $adgfs1 ? "\r\n\tdata-font-size=\"" . $adgfs1 . '"' : '' )
					. ( $aduift1 ? "\r\n\tdata-ui-features=\"" . $aduift1 . '"' : '' )
					. ( $anltc ? "\r\n\tdata-analytics-uacct=\"UA-" . $anltc . '"' : '' );
			if ( $responsive ) {
				if ( !isset( $styleresp ) ) {
					$styleresp = ( "\t.adslot_" . $adsnub . " { width: " . $wdh1 . "px; height: " . $hgt1 . "px; }" )
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
				} 
				$adscodeasy1 = ( $adscodea1 ? ( $cmt ? "\r\n<!--" . $cmt . "-->\r\n" : '' ) . "<ins class=\"adsbygoogle adslot_" . $adsnub . "\"" . $adscodea1 . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
				$cdtyp = 1 ;
			} else {
				$adscodeasy1 = ( $adscodea1 ? ( $cmt ? '<!--' . $cmt . "-->\r\n" : '' ) . '<ins class="adsbygoogle"' . $adscodea1 . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
			}			
			$adscode1 = ( ( $cdtyp == 1 ) ? $adscodeasy1 : $adscodesyn1 );
			
			if ( $resp && !$responsive ) {
				$wdh2 = 300 ;
				$hgt2 = 250 ;
			}
			if ( ( $minwidth <= 180 ) && $responsive && ( $adstp2 == 'image' ) ) {
				$adstp2 = 'text_image' ;		
			}

			$adstp2 = ( ( $minwidth <= 180 ) && $responsive && ( $adstp2 == 'image' ) ) ? 'text_image' : $adstp2 ;
			if ( $adsizes2 == 1 ) {
				$adstp2 = ( !$responsive &&  in_array( $adfrmt2 , $adtx ) ? 'text' : $adstp2 );
				$gaul2 = ( ( ( filter_var( $gaul2 , FILTER_VALIDATE_URL ) ) && ( $bkud2 == 'url' ) ) ? $gaul2 : '' );
				$gacl2 = ( ( ( $gacl2 ) && ( $bkud2 == 'color' ) ) ? $gacl2 : '' );
				$wdh2 = $width2[0] ;
				$hgt2 = $height2[0] ;
				$frm2 = $format2[0] ; 		
				$sltc2 = true ;
				$slta2 = ( in_array( $frm2 , $adlk ) ? '' : $slt );
				$lnk2 = ( !$responsive &&  in_array( $frm2 , $adlk ) ? 'link' : $lnk2 );
				$adchnl2 = ( ( ( $adchnl2 ) && is_numeric( $adchnl2 ) && !$slta2 && ( $slt || $cmt ) ) ? $adchnl2 : '' );
			} else {
				foreach( $adlk as $vals ) {
					$nfor = explode( "_" , $vals );
					if ( ( $nfor[0] ) == ( $wdh2 . 'x' . $hgt2 ) ) {
						$lnk2 = 'link';
						$frm2 = ( !$slt ? $vals : '' );
					}
				}				
				$gaul2 = '' ;
				$gacl2 = '' ;
				$adchnl2 = '' ;	
			}

			if ( $adstp2 != "image" ) {
				$adgff2 = ( ( $adgff2 != "d" ) ? $adgff2 : '' ) ;
				$adgfs2 = ( ( $adgfs2 != "d" ) ? $adgfs2 : '' ) ;
				$aduift2 = ( ( $aduift2 != "d" ) ? $aduift2 : '' ) ;
			} else {
				$clborder2 = '' ; 
				$clbg2 = '' ;
				$cllink2 = '' ;
				$cltext2 = '' ; 
				$clurl2 = '' ; 				
				$adgff2 = '' ;
				$adgfs2 = '' ;
				$aduift2 = '' ;
			}

			$adscodew2 = ( $pid ? "\r\ngoogle_ad_client = \"ca-pub-" . $pid . '";' : '' ) 
					. ( $cmt ? "\r\n/*" . $cmt . "*/": '' ) 
					. ( $sltc2 && $slt  ? "/*\r\ngoogle_ad_slot = \"" . $slt ."\";*/ " : '' )
					. ( !$sltc2 && $slt ? "\r\ngoogle_ad_slot = \"" . $slt ."\"; "	: '' )
					. ( $gaul2 ? "\r\ngoogle_alternate_ad_url = \"" . $gaul2 . '";' : '' )
					. ( $gacl2 ? "\r\ngoogle_alternate_ad_color = \"" . $gacl2 . '";' : '' )
					. ( $adchnl2 ? "\r\ngoogle_ad_channel = \"" . $adchnl2 . '";' : '' )
					. ( $wdh2 ? "\r\ngoogle_ad_width = " . $wdh2 . ";" : '' )
					. ( $hgt2 ? "\r\ngoogle_ad_height = " . $hgt2 . ";" : '' )
					. ( ( !$slta2 && ( $lnk2 == 'link' ) && $frm2 )? "\r\ngoogle_ad_format = \"" . $frm2 . '";' : '' )
					. ( $adstp2 ? "\r\ngoogle_ad_type = \"" . $adstp2 . '";' : '' )
					. ( $clborder2 ? "\r\ngoogle_color_border = \"" . $clborder2 . '";' : '' )
					. ( $clbg2 ? "\r\ngoogle_color_bg = \"" . $clbg2 . '";' : '' )
					. ( $cllink2 ? "\r\ngoogle_color_link = \"" . $cllink2 . '";' : '' )
					. ( $cltext2 ? "\r\ngoogle_color_text = \"" . $cltext2 . '";' : '' )
					. ( $clurl2 ? "\r\ngoogle_color_url = \"" . $clurl2 . '";' : '' )
					. ( $adgff2 ? "\r\ngoogle_font_face = \"" . $adgff2 . '";' : '' )
					. ( $adgfs2 ? "\r\ngoogle_font_size = \"" . $adgfs2 . '";' : '' )
					. ( $aduift2 ? "\r\ngoogle_ui_features = \"" . $aduift2 . '";' : '' )
					. ( $anltc ? "\r\ngoogle_analytics_uacct = \"UA-" . $anltc . '";' : '' );
			$adscodesyn2 = ( $adscodew2 ? "<script type=\"text/javascript\"><!--" . $adscodew2 . "\r\n//--> \r\n</script>\r\n<script type=\"text/javascript\"  \r\nsrc=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n</script>\r\n" : '' );

			$adscodea2 = ( !$responsive ? ( ( $wdh2 && $hgt2 ) ? "\r\n\tstyle=\"display:inline-block;width:" . $wdh2 . "px;height:" . $hgt2 . "px\"" : '' ) : ( ( $wdh2 && $hgt2 ) ? "\r\n\tstyle=\"display:inline-block;\"" : '' ) )
					. ( $pid ? "\r\n\tdata-ad-client=\"ca-pub-" . $pid . '"' : '' )						
					. ( $slta2 ? "\r\n\tdata-ad-slot=\"" . $slt .'"' : '' )
					. ( !$slta2 && $slt ? "\r\n\tdata-adslot=\"" . $slt .'"' : '' )
					. ( $gaul2 ? "\r\n\tdata-alternate-ad-url=\"" . $gaul2 . '"' : '' )
					. ( $gacl2 ? "\r\n\tdata-alternate-ad-color=\"" . $gacl2 . '"' : '' )
					. ( $adchnl2 ? "\r\n\tdata-ad-channel=\"" . $adchnl2 . '"' : '' )
					. ( !$slta2 && ( $lnk2 == 'link' ) &&  !$responsive &&  $frm2 ? "\r\n\tdata-ad-format=\"" . $frm2 . '"' : '' )
					. ( $adstp2 ? "\r\n\tdata-ad-type=\"" . $adstp2 . '"' : '' )
					. ( $clborder2 ? "\r\n\tdata-color-border=\"" . $clborder2 . '"' : '' )
					. ( $clbg2 ? "\r\n\tdata-color-bg=\"" . $clbg2 . '"' : '' )
					. ( $cllink2 ? "\r\n\tdata-color-link=\"" . $cllink2 . '"' : '' )
					. ( $cltext2 ? "\r\n\tdata-color-text=\"" . $cltext2 . '"' : '' )
					. ( $clurl2 ? "\r\n\tdata-color-url=\"" . $clurl2 . '"' : '' )
					. ( $adgff2 ? "\r\n\tdata-font-face=\"" . $adgff2 . '"' : '' )
					. ( $adgfs2 ? "\r\n\tdata-font-size=\"" . $adgfs2 . '"' : '' )
					. ( $aduift2 ? "\r\n\tdata-ui-features=\"" . $aduift2 . '"' : '' )
					. ( $anltc ? "\r\n\tdata-analytics-uacct=\"UA-" . $anltc . '"' : '' );			
			if ( $responsive ) {
				$adscodeasy2 = ( $adscodea2 ? ( $cmt ? "\r\n<!--" . $cmt . "-->\r\n" : '' ) . "<ins class=\"adsbygoogle adslot_" . $adsnub . "\"" . $adscodea2 . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
				$cdtyp = 1 ;
			} else {
				$adscodeasy2 = ( $adscodea2 ? ( $cmt ? '<!--' . $cmt . "-->\r\n" : '' ) . '<ins class="adsbygoogle"' . $adscodea2 . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
			}
			$adscode2 = ( ( $cdtyp == 1 ) ? $adscodeasy2 : $adscodesyn2 );
			
			if ( $resp && !$responsive ) {
				$wdh3 = 300 ;
				$hgt3 = 250 ;
			}
			if ( ( $minwidth <= 180 ) && $responsive && ( $adstp3 == 'image' ) ) {
				$adstp3 = 'text_image' ;		
			}

			$adstp3 = ( ( $minwidth <= 180 ) && $responsive && ( $adstp3 == 'image' ) ) ? 'text_image' : $adstp3 ;
			if ( $adsizes3 == 1 ) {
				$adstp3 = ( !$responsive &&  in_array( $adfrmt3 , $adtx ) ? 'text' : $adstp3 );
				$gaul3 = ( ( ( filter_var( $gaul3 , FILTER_VALIDATE_URL ) ) && ( $bkud3 == 'url' ) ) ? $gaul3 : '' );
				$gacl3 = ( ( ( $gacl3 ) && ( $bkud3 == 'color' ) ) ? $gacl3 : '' );
				$wdh3 = $width3[0] ;
				$hgt3 = $height3[0] ;
				$frm3 = $format3[0] ; 		
				$sltc3 = true ;
				$slta3 = ( in_array( $frm3 , $adlk ) ? '' : $slt );
				$lnk3 = ( !$responsive &&  in_array( $frm3 , $adlk ) ? 'link' : $lnk3 );
				$adchnl3 = ( ( ( $adchnl3 ) && is_numeric( $adchnl3 ) && !$slta3 && ( $slt || $cmt ) ) ? $adchnl3 : '' );
			} else {
				foreach( $adlk as $vals ) {
					$nfor = explode( "_" , $vals );
					if ( ( $nfor[0] ) == ( $wdh3 . 'x' . $hgt3 ) ) {
						$lnk3 = 'link';
						$frm3 = ( !$slt ? $vals : '' );
					}
				}				
				$gaul3 = '' ;
				$gacl3 = '' ;
				$adchnl3 = '' ;	
			}

			if ( $adstp3 != "image" ) {
				$adgff3 = ( ( $adgff3 != "d" ) ? $adgff3 : '' ) ;
				$adgfs3 = ( ( $adgfs3 != "d" ) ? $adgfs3 : '' ) ;
				$aduift3 = ( ( $aduift3 != "d" ) ? $aduift3 : '' ) ;
			} else {
				$clborder3 = '' ; 
				$clbg3 = '' ;
				$cllink3 = '' ;
				$cltext3 = '' ; 
				$clurl3 = '' ; 				
				$adgff3 = '' ;
				$adgfs3 = '' ;
				$aduift3 = '' ;
			}

			$adscodew3 = ( $pid ? "\r\ngoogle_ad_client = \"ca-pub-" . $pid . '";' : '' ) 
					. ( $cmt ? "\r\n/*" . $cmt . "*/": '' ) 
					. ( $sltc3 && $slt  ? "/*\r\ngoogle_ad_slot = \"" . $slt ."\";*/ " : '' )
					. ( !$sltc3 && $slt ? "\r\ngoogle_ad_slot = \"" . $slt ."\"; "	: '' )
					. ( $gaul3 ? "\r\ngoogle_alternate_ad_url = \"" . $gaul3 . '";' : '' )
					. ( $gacl3 ? "\r\ngoogle_alternate_ad_color = \"" . $gacl3 . '";' : '' )
					. ( $adchnl3 ? "\r\ngoogle_ad_channel = \"" . $adchnl3 . '";' : '' )
					. ( $wdh3 ? "\r\ngoogle_ad_width = " . $wdh3 . ";" : '' )
					. ( $hgt3 ? "\r\ngoogle_ad_height = " . $hgt3 . ";" : '' )
					. ( ( !$slta3 && ( $lnk3 == 'link' ) && $frm3 )? "\r\ngoogle_ad_format = \"" . $frm3 . '";' : '' )
					. ( $adstp3 ? "\r\ngoogle_ad_type = \"" . $adstp3 . '";' : '' )
					. ( $clborder3 ? "\r\ngoogle_color_border = \"" . $clborder3 . '";' : '' )
					. ( $clbg3 ? "\r\ngoogle_color_bg = \"" . $clbg3 . '";' : '' )
					. ( $cllink3 ? "\r\ngoogle_color_link = \"" . $cllink3 . '";' : '' )
					. ( $cltext3 ? "\r\ngoogle_color_text = \"" . $cltext3 . '";' : '' )
					. ( $clurl3 ? "\r\ngoogle_color_url = \"" . $clurl3 . '";' : '' )
					. ( $adgff3 ? "\r\ngoogle_font_face = \"" . $adgff3 . '";' : '' )
					. ( $adgfs3 ? "\r\ngoogle_font_size = \"" . $adgfs3 . '";' : '' )
					. ( $aduift3 ? "\r\ngoogle_ui_features = \"" . $aduift3 . '";' : '' )
					. ( $anltc ? "\r\ngoogle_analytics_uacct = \"UA-" . $anltc . '";' : '' );
			$adscodesyn3 = ( $adscodew3 ? "<script type=\"text/javascript\"><!--" . $adscodew3 . "\r\n//--> \r\n</script>\r\n<script type=\"text/javascript\"  \r\nsrc=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n</script>\r\n" : '' );

			$adscodea3 = ( !$responsive ? ( ( $wdh3 && $hgt3 ) ? "\r\n\tstyle=\"display:inline-block;width:" . $wdh3 . "px;height:" . $hgt3 . "px\"" : '' ) : ( ( $wdh3 && $hgt3 ) ? "\r\n\tstyle=\"display:inline-block;\"" : '' ) )
					. ( $pid ? "\r\n\tdata-ad-client=\"ca-pub-" . $pid . '"' : '' )						
					. ( $slta3 ? "\r\n\tdata-ad-slot=\"" . $slt .'"' : '' )
					. ( !$slta3 && $slt ? "\r\n\tdata-adslot=\"" . $slt .'"' : '' )
					. ( $gaul3 ? "\r\n\tdata-alternate-ad-url=\"" . $gaul3 . '"' : '' )
					. ( $gacl3 ? "\r\n\tdata-alternate-ad-color=\"" . $gacl3 . '"' : '' )
					. ( $adchnl3 ? "\r\n\tdata-ad-channel=\"" . $adchnl3 . '"' : '' )
					. ( !$slta3 && ( $lnk3 == 'link' ) && !$responsive &&  $frm3 ? "\r\n\tdata-ad-format=\"" . $frm3 . '"' : '' )
					. ( $adstp3 ? "\r\n\tdata-ad-type=\"" . $adstp3 . '"' : '' )
					. ( $clborder3 ? "\r\n\tdata-color-border=\"" . $clborder3 . '"' : '' )
					. ( $clbg3 ? "\r\n\tdata-color-bg=\"" . $clbg3 . '"' : '' )
					. ( $cllink3 ? "\r\n\tdata-color-link=\"" . $cllink3 . '"' : '' )
					. ( $cltext3 ? "\r\n\tdata-color-text=\"" . $cltext3 . '"' : '' )
					. ( $clurl3 ? "\r\n\tdata-color-url=\"" . $clurl3 . '"' : '' )
					. ( $adgff3 ? "\r\n\tdata-font-face=\"" . $adgff3 . '"' : '' )
					. ( $adgfs3 ? "\r\n\tdata-font-size=\"" . $adgfs3 . '"' : '' )
					. ( $aduift3 ? "\r\n\tdata-ui-features=\"" . $aduift3 . '"' : '' )
					. ( $anltc ? "\r\n\tdata-analytics-uacct=\"UA-" . $anltc . '"' : '' );			
			if ( $responsive ) {
				$adscodeasy3 = ( $adscodea3 ? ( $cmt ? "\r\n<!--" . $cmt . "-->\r\n" : '' ) . "<ins class=\"adsbygoogle adslot_" . $adsnub . "\"" . $adscodea3 . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
				$cdtyp = 1 ;
			} else {
				$adscodeasy3 = ( $adscodea3 ? ( $cmt ? '<!--' . $cmt . "-->\r\n" : '' ) . '<ins class="adsbygoogle"' . $adscodea3 . "></ins>\r\n<script>\r\n(adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>\r\n" : '' );
			}
			$adscode3 = ( ( $cdtyp == 1 ) ? $adscodeasy3 : $adscodesyn3 );
			
		} else {
			$adscode1 .= $altct1 ;
			$adscode2 .= $altct2 ;
			$adscode3 .= $altct3 ;
		}
		
		$adscode1 = ( $adscodez1 ? $adscodez1 : $adscode1 );
		$adscode2 = ( $adscodez2 ? $adscodez2 : $adscode2 );
		$adscode3 = ( $adscodez3 ? $adscodez3 : $adscode3 );
		
		if ( $bdcd == 1 ) { 
			$adscode1 = $adscode ; 
			$adscode2 = $adscode ; 
			$adscode3 = $adscode ; 
			$lnk1 = $lnk2 = $lnk3 = '' ;
		}

		$adscode1 = ( $adsalg1 ? "\r\n<div class=\"eliad" . $lnk1 . "\" style=\"" . $adsalg1 . "\">\r\n" . $adscode1 . "</div class=\"eliad" . $lnk1 . "\">" : "\r\n" . $adscode1 . "\r\n" );
		$adscode2 = ( $adsalg2 ? "\r\n<div class=\"eliad" . $lnk2 . "\" style=\"" . $adsalg2 . "\">\r\n" . $adscode2 . "</div class=\"eliad" . $lnk2 . "\">" : "\r\n" . $adscode2 . "\r\n" );
		$adscode3 = ( $adsalg3 ? "\r\n<div class=\"eliad" . $lnk3 . "\" style=\"" . $adsalg3 . "\">\r\n" . $adscode3 . "</div class=\"eliad" . $lnk3 . "\">" : "\r\n" . $adscode3 . "\r\n" );
		if ( isset( $article->id ) ) {			
			if ( $this->params->get( 'adsblkac5' ) == 2 ) {
				if ( $this->params->get( 'adsblkac1' ) == 1 ) {
					if ( $this->exclude( 'exartd1' , $article->id ) ) {
						$adscode1 = "" ; 
					} 
					if ( $this->excludec( 'excatd1' , $article->catid ) ) { 
						$adscode1 = "" ; 
					}
				}
				if ( $this->params->get( 'adsblkac2' ) == 1 ) { 
					if ( $this->exclude( 'exartd2' , $article->id ) ) { 
						$adscode2 = "" ; 
					} 
					if ( $this->excludec( 'excatd2' , $article->catid ) ) { 
						$adscode2 = "" ; 
					}
				} if ( $this->params->get( 'adsblkac3' ) == 1 ) { 
					if ( $this->exclude( 'exartd3' , $article->id ) ) { 
						$adscode3 = "" ; 
					} 
					if ( $this->excludec( 'excatd3' , $article->catid ) ) { 
						$adscode3 = "" ; 
					}
				}
			}
		}
		if ( $adun1 != 1 ) {
			$adscode1 = "" ; 
		}
		if ( $adun2 != 1 ) {
			$adscode2 = "" ; 
		}
		if ( $adun3 != 1 ) {
			$adscode3 = "" ; 
		}

		$script = ( ( ( $adscode1 || $adscode2 || $adscode3 ) && ( $cdtyp == 1 ) ) ? "\r\n<script async=\"async\" src=\"http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>\r\n" : "" ) ;
		
		$article->video = '' ;	
		$artad = '' ;

		if ( $deli == 'p' ) {
			$prgary = explode( '</p>' , $article->text ) ;
			$pos = round( ( count( $prgary ) -1 ) / 2 ) ;
			if ( count( $prgary ) <= 2 ) {
				$adscode2 = "" ;
			}	
			$artad = '' ; 
			if ( ( JRequest :: getVar( 'view' ) ) == 'item' ) {
				array_splice( $prgary , -1 ) ;
				if ($prgary) {
					$prgary[] = " " ;
				}
			}
			if ( $adscode2 ) {
				$adscode2 = "<p>" . $adscode2 ;
			}
			array_splice( $prgary , $pos , 0 , $adscode2 ) ; 
			$artad = implode( "</p>", $prgary) ;
			if ( ( JRequest :: getVar( 'view' ) ) == 'item' ) {
				$adscode3 .=	"\r\n\n{K2Splitter}" ;
			}
		} else {
		
			$prgary = ( !strpos( $article->text , '<br />' ) ? explode( '<br>' , $article->text ) : explode( '<br />' , $article->text ) );
			$pos = round( count( $prgary ) / 2 ) ;
			if ( count( $prgary ) <= 2 ) {
				$adscode2 = "" ;
			}	
			$artad = '' ; 
			if ( ( JRequest :: getVar( 'view' ) ) == 'item' ) {
				array_splice( $prgary , -1 ) ;
				if ($prgary) {
					$prgary[] = " " ;
				}
			}
			$ar1 = array_slice( $prgary , 0 , $pos );
			$ar2 = array_slice( $prgary , $pos );  
			$par1 = implode( "<br />", $ar1) ;
			$par2 = implode( "<br />", $ar2) ;
			$artad = $par1 . "\r\n" . $adscode2 . $par2 ;
			
			if ( ( JRequest :: getVar( 'view' ) ) == 'item' ) {
				$adscode3 .=	"\r\n\n{K2Splitter}" ;
			}
		}		

		$artad = $script . $adscode1 . $artad . $adscode3 ;
		
		switch ( $usrl ) {
			case 'au' : 
				$article->text = $artad ;
				break ;
			case 'nu' : 
				if (!$user_group) { 
					$article->text = $artad ;
				} 
				break ;
			case 'ru': 
				if ($user_group) { 
					$article->text = $artad ;
				} 
				break ;
		}

		return ;
	}
	function exclude( $paramName , $value , $tointeger = true ) {
		$excludearray = explode( ',' , trim( $this->params->def( $paramName ) ) );
		$tointeger ? JArrayHelper::toInteger( $excludearray ) : '' ; 
		if ( isset( $value ) && in_array( $value , $excludearray , false ) ) { 
			return true ;
		} else { 
			return false ;
		}
	}
	function excludec( $paramNamec , $valuec , $tointegerc = true ) {
		$excludearrayc = $this->params->def( $paramNamec );
		$tointegerc ? JArrayHelper::toInteger( $excludearrayc ) : '' ; 
		if ( isset( $valuec ) && in_array( $valuec , $excludearrayc , false ) ) { 
			return true ;
		} else { 
			return false ;
		}
	}
}
?>