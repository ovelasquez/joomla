<?php
defined('_JEXEC') or die;
JHtml::_('behavior.framework', true);
/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();
$document = & $this;
$templateUrl = $document->baseurl . '/templates/' . $document->template;
echo "<pre>";
var_dump($app); 
echo "<pre/>";
?>
<?php echo '<?'; ?>xml version="1.0" encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<!-- La siguiente linea carga el contenido del header y la informacion basica. -->
<jdoc:include type="head" />
<!-- La siguiente linea carga el codigo css del template. -->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/reseter.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/screen.css" type="text/css" />
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/coin-slider.js"></script>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/functions.js"></script>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script>
$(document).ready(function(){
  $(".menu li").each(function(i){
    var sep = (i<$(".menu li").length-1)?"|":"";
    $("#menu_footer").append($(this).html()+sep);   
  });
  $(".menu li:first a").addClass("ico_home");
  $(".menu li:first a").html("");
  if ($("#wrap_sup").children().length==0)
    $("#adv_sup").hide();    
});
</script>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css' />
<![endif]--></head>

<body>
<div id="adv_sup">
  <div id="wrap_sup">
    <jdoc:include type="modules" name="position-11" style="none"/>
    <jdoc:include type="modules" name="position-12" style="none"/>
  </div>
</div>
<div id="wrap">
  <header>
    <h1><span>IUSDATA - Información Juridica en Venezuela</span><a href="<?php echo $this->baseurl ?>"></a></h1>
    <div id="wrap_login">
      <jdoc:include type="modules" name="position-2" style="none"/>
    </div>
    <nav>
      <jdoc:include type="modules" name="position-3" style="none"/>
      <jdoc:include type="modules" name="position-1" style="none"/>
    </nav>
  </header>
  <section id="home">
    <jdoc:include type="modules" name="position-4" style="none"/>
    
    <jdoc:include type="modules" name="position-5" style="none"/>
      
    <aside>
      <jdoc:include type="modules" name="position-10" style="none"/>
      <jdoc:include type="modules" name="position-13" style="none"/>
    </aside>
    <div class="content">
      <jdoc:include type="modules" name="position-6" style="none"/>
      <jdoc:include type="modules" name="position-7" style="none"/>
      <jdoc:include type="modules" name="position-8" style="none"/>
      <jdoc:include type="modules" name="position-9" style="none"/>
    </div>
    <div class="clear"></div>
  </section>
  <footer>
    <p id="menu_footer"></p>
    <p id="copyright">Copyright &copy; 2012 - IUSDATA&reg; RIF J-00000000-0. Todos los derechos reservados. Desarrollado por Pixtura Studio C.A.</p>
  </footer>
</div>
</body>
</html>