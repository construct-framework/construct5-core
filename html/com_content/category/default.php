<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

$cparams = JComponentHelper::getParams ('com_media');
?><section class="category-list<?php echo htmlspecialchars($this->params->get('pageclass_sfx')); ?>">
		<?php if ($this->params->get('show_page_title',1)) : ?>
		<h1>
			<?php echo htmlspecialchars($this->params->get('page_title')); ?>
		</h1>
		<?php endif; ?>
		
		<?php if ($this->params->def('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
		<section class="category-desc clearfix">	
			<?php if ($this->params->get('show_description_image') && $this->category->image) : ?>
				<img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/' . $this->category->image; ?>" class="image_<?php echo $this->category->image_position; ?>" />
			<?php endif; ?>
			<p class="category-desc-text">					
				<?php if ($this->params->get('show_description') && $this->category->description) : ?>
					<?php echo $this->category->description; ?>
				<?php endif; ?>		
			</p>	
		</section>
		<?php endif; ?>
		
		<section class="cat-items">	
			<?php $this->items =& $this->getItems(); ?>
			<?php echo $this->loadTemplate('items'); ?>
		</section>
		
	</section>
