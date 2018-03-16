<?php
/*
 * @package     Joomla.Site
 * @subpackage  Templates.restaurante
 *
 * @copyright   Copyright (C) 2018 antoniojosetorres. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;   // linea de seguridad

// definiendo rutas:
// ruta sitio
$ruta_s=JURI::base();
// ruta plantilla
$ruta_p=$ruta_s."templates/".$this->template."/";

// recibiendo parametros plantilla
$app=JFactory::getApplication();
$params=$app->getParams();

// comprobando que esta en el inicio-pagina inicial
$menu=&JSite::getMenu();
$inicio=$menu->getActive()==$menu->getDefault();

// parametro logo
$logo=$this->params->get('logo');
// parametro telefono
$telefono=$this->params->get('telefono');
// parametro google
$google=$this->params->get('google');
// parametro twitter
$twitter=$this->params->get('twitter');
// parametro facebook
$facebook=$this->params->get('facebook');
// parametro bienvenido
$bienvenido=$this->params->get('bienvenido');
// parametro piepagina
$piepagina=$this->params->get('piepagina');

?>

<!DOCTYPE html>
<!--[if lt IE 7]>   <html class="no-js lt-ie9 lt-ie8 lt-ie7">   <![endif]-->
<!--[if IE 7]>   <html class="no-js lt-ie9 lt-ie8">   <![endif]-->
<!--[if IE 8]>   <html class="no-js lt-ie9">   <![endif]-->
<!--[if gt IE 8]>   <!-->   <html class="no-js">   <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- <title>Restaurante Maestro</title>   generado por Joomla -->
		<!-- <meta name="description" content="">   generado por Joomla -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0.5, maximum-scale=3">

		<!--[if lt IE 9]> 
			<script src="<?php echo $ruta_p; ?>js/html5shiv.min.js"></script>
		<![endif]-->
		<script src="<?php echo $ruta_p; ?>js/jquery.min.js"></script>
		<script src="<?php echo $ruta_p; ?>js/modernizr.min.js"></script>
		<jdoc:include type="head" />
		<link rel="stylesheet" href="<?php echo $ruta_p; ?>css/normalize.min.css">
		<link rel="stylesheet" href="<?php echo $ruta_p; ?>css/estilos.css">
		<link rel="stylesheet" href="<?php echo $ruta_p; ?>css/font-awesome.min.css">
	</head>
	<body>
		<header role="banner" class="encabezado">
			<div class="contenedor">
				<!-- enlace a inicio -->
				<a href="<?php echo $ruta_s; ?>" class="logo">
					<!-- elegir: -->
					<!-- o modulo logo -->
					<jdoc:include type="modules" name="logo" style="none" />
					<!-- o parametro logo -->
					<img src="<?php echo $logo; ?>" alt="logo">
				</a>
				<div class="barra-encabezado">
					<!-- parametro telefono -->
					<a href="tel:<?php echo $telefono;?>" class="telefono"><span class="fa fa-phone"></span><?php echo $telefono;?></a>
					<!-- modulo caja de busqueda -->
					<jdoc:include type="modules" name="buscar" style="none" />
					<ul class="redes-sociales">
						<!-- parametro google -->
						<li><a href="<?php echo $google; ?>" class="fa fa-google-plus"></a></li>
						<!-- parametro twitter -->
						<li><a href="<?php echo $twitter; ?>" class="fa fa-twitter"></a></li>
						<!-- parametro facebook -->
						<li><a href="<?php echo $facebook; ?>" class="fa fa-facebook"> </a></li>
					</ul>
				</div>
			</div>
		</header>   <!-- fin header -->

		<nav role="navigation" class="menu-principal">
			<div class="contenedor">
				<a href="#" id="menumovil">MENU</a>
				<!-- modulo menuprincipal -->
				<jdoc:include type="modules" name="menuprincipal" style="none" />
			</div>
		</nav> <!-- fin nav.menu-principal -->

		<section class="presentacion">
			<div class="contenedor">
				<!-- modulo presentacion -->
				<jdoc:include type="modules" name="presentacion" style="none" />
			</div>
		</section> <!-- fin section.presentacion -->

		<?php if($inicio) { ?>

		<section class="bienvenidos">
			<div class="contenedor">
				<?php echo $bienvenido; ?>
			</div>
		</section>   <!-- fin section.bienvenidos -->

		<?php } ?>

		<main role="main">
			<div class="contenedor">
				<article class="quienes-somos">
					<jdoc:include type="message" />
					<jdoc:include type="component" />
				</article>
				<article class="aqui-estamos">
					<jdoc:include type="modules" name="lateral" style="html5" />
				</article>
			</div>
		</main>   <!-- fin main -->

		<footer role="contentinfo" class="piedepagina">
			<small><?php echo $piepagina; ?></small>
		</footer>

		<script src="<?php echo $ruta_p; ?>js/responsive-img.min.js"></script>
		<script src="<?php echo $ruta_p; ?>js/menuresponsive.js"></script>
		<script src="<?php echo $ruta_p; ?>js/mis-script.js"></script>
	</body>
</html>
