<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><script type="text/javascript">
function iFrameHeight() {
	var h = 0;
	if ( !document.all ) {
		h = document.getElementById('blockrandom').contentDocument.height;
		document.getElementById('blockrandom').style.height = h + 60 + 'px';
	} else if( document.all ) {
		h = document.frames('blockrandom').document.body.scrollHeight;
		document.all.blockrandom.style.height = h + 20 + 'px';
	}
}
</script>
<section class="contentpane<?php echo htmlspecialchars($this->params->get('pageclass_sfx')); ?>">
	<?php if ( $this->params->get( 'show_page_title', 1 ) ) : ?>
		<h2>
			<?php echo htmlspecialchars($this->params->get( 'page_title' )); ?>
		</h2>
	<?php endif; ?>
	<iframe <?php echo $this->wrapper->load; ?>
		id="blockrandom"
		name="iframe"
		src="<?php echo $this->wrapper->url; ?>"
		width="<?php echo $this->params->get( 'width' ); ?>"
		height="<?php echo $this->params->get( 'height' ); ?>"
		scrolling="<?php echo $this->params->get( 'scrolling' ); ?>"
		align="top"
		frameborder="0"
		class="wrapper">
		<?php echo JText::_( 'NO_IFRAMES' ); ?>
	</iframe>
</section>