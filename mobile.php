<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// Check for Mobile Extended Template Layout Override and load it if it exists
$mobileResults = $mobileLayoutOverride->getIncludeFile ();

if ($mobileResults) {
	$alternateIndexFile = $mobileResults;
	include_once $alternateIndexFile;
} else {
?>
<!DOCTYPE html>
<html class="no-js">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/mobile.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.css" />
		<?php //Load Mobile Extended Template Style Overrides
		$mobileCssFile = $mobileStyleOverride->getIncludeFile ();
		if ($mobileCssFile) : ?>
		<link rel="stylesheet" href="<?php echo $this->baseurl.$mobileCssFile ?>" type="text/css" media="screen" />
		<?php endif ?>
		<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script>(function($) {$(document).bind("mobileinit", function() {$.mobile.ajaxEnabled = false;});})(jQuery);</script>
		<script src="http://code.jquery.com/mobile/1.0/jquery.mobile-1.0.min.js"></script>
		<script>(function($) {$(document).ready(function() {$('html').removeClass("no-js");});})(jQuery);</script>
	</head>

<body>
	<div data-role="page" data-theme="b">
		<header id="header" data-role="header">
			<h1><a href="<?php echo $this->baseurl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo $app->getCfg('sitename') ?></a></h1>
		</header>

		<nav id="nav" data-role="navigation">
			<jdoc:include type="modules" name="nav" style="raw" />
		</nav>

		<section id="content-container" data-role="main">
			<?php if ($messageQueue) : ?>
					<jdoc:include type="message" />
			<?php endif ?>
			<jdoc:include type="component" />
		</section>

		<footer id="footer" data-role="footer">
			<a class="view-desktop" href="<?php echo JURI::current() ?>?viewDesktop=true">View Desktop Version</a>
			<?php if ($this->countModules('footer')) : ?>
				<jdoc:include type="modules" name="footer" style="xhtml" />
			<?php endif ?>
		</footer>
	</div>

	<?php if ($this->countModules('analytics')) : ?>
		<jdoc:include type="modules" name="analytics" />
	<?php endif ?>

</body>
</html>
<?php }

