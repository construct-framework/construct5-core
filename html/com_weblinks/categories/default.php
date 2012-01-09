<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

$cparams = JComponentHelper::getParams ('com_media');
?><section class="categories-list<?php echo htmlspecialchars($this->params->get('pageclass_sfx')); ?>">

	<?php if ($this->params->get('show_page_title',1)) : ?>
			<h2>
				<?php echo htmlspecialchars($this->params->get('page_title')); ?>
			</h2>
	<?php endif; ?>

	<?php if ($this->params->def('show_comp_description', 1) || $this->params->def('image', -1) != -1) : ?>
		<p class="category-desc base-desc">
			<?php if ($this->params->def('image', -1) != -1) : ?>
				<img src="<?php echo $this->baseurl . $this->escape($cparams->get('image_path')).'/'.$this->escape($this->params->get('image')); ?>" alt="" class="image_<?php echo htmlspecialchars($this->params->get('image_align')); ?>">
			<?php endif; ?>
			<?php if ($this->params->get('show_comp_description')) : ?>
				<?php echo $this->params->get('comp_description'); ?>
			<?php endif; ?>
		</p>
	<?php endif; ?>

	<?php if (count($this->categories)) : ?>
		<ol>
			<?php foreach ($this->categories as $category) : ?>
			<li>
				<h3 class="item-title">
					<a href="<?php echo $category->link; ?>" class="category">
						<?php echo htmlspecialchars($category->title); ?>
					</a>
				</h3>
				<dl>
					<dt>
						<?php echo JText::_('Number of links'); ?>:
					</dt>
					<dd>
						<?php echo (int)$category->numlinks ?>
					</dd>
				</dl>
			</li>
			<?php endforeach; ?>
		</ol>
	<?php endif; ?>
</section>
