<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><section class="weblink-category<?php echo htmlspecialchars($this->params->get('pageclass_sfx')); ?>">
	<?php if ($this->params->get('show_page_title', 1)) : ?>
	<header>
		<h2>
			<?php echo htmlspecialchars($this->params->get('page_title')); ?>
		</h2>
	</header>
	<?php endif; ?>

	<?php if ( $this->category->image || $this->category->description) : ?>
		<div class="category-desc">
			<?php if ($this->category->image) : ?>
				<?php echo $this->category->image; ?>
			<?php endif; ?>
			<p class="category-desc-text">
				<?php echo $this->category->description; ?>
			</p>
		</div>
	<?php endif; ?>
	<?php echo $this->loadTemplate('items'); ?>

</section>
