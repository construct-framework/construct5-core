<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><!DOCTYPE html>
<html class="no-js">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="<?php echo $this->baseurl.'templates/'.$this->template; ?>/css/mobile.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
		<?php //Load Mobile Extended Template Style Overrides
		$mobileCssFile = $mobileStyleOverride->getIncludeFile ();
		if ($mobileCssFile) : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl.$mobileCssFile; ?>" type="text/css" media="screen" />
		<?php endif; ?>
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script>(function($) {$(document).bind("mobileinit", function() {$.mobile.ajaxEnabled = false;});})(jQuery);</script>
		<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
		<script>(function($) {$(document).ready(function() {$('html').removeClass("no-js");});})(jQuery);</script>
	</head>

<body>
	<div data-role="page" data-theme="b">
		<header id="header" data-role="header">
			<h1><a href="<?php echo $this->baseurl; ?>/" title="<?php echo $app->getCfg('sitename'); ?>"><?php echo $app->getCfg('sitename'); ?></a></h1>
		</header>
		
		<nav id="nav" data-role="navuigation">
			<jdoc:include type="modules" name="nav" style="raw" />
		</nav>

		<section id="content-container" data-role="main">
			<?php if ($this->getBuffer('message')) : ?>
					<jdoc:include type="message" />
			<?php endif; ?>
			<jdoc:include type="component" />
		</section>

		<footer id="footer" data-role="footer">
			<?php if ($this->countModules('footer')) : ?>
				<jdoc:include type="modules" name="footer" style="xhtml" />
			<?php endif; ?>
		</footer>
	</div>
	  
</body>
</html>
