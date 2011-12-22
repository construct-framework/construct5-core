<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

$cparams = JComponentHelper::getParams ('com_media');
?><div class="categories-list<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

	<?php if ($this->params->get('show_page_title',1)) : ?>
	<header>
		<h2>
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</h2>
	</header>
	<?php endif; ?>
	
	<?php if ($this->params->def( 'show_comp_description', 1 ) || $this->params->get( 'image', -1 ) != -1) : ?>
		<div class="category-desc base-desc">
			<?php if ($this->params->get( 'image', -1 ) != -1) : ?>
				<img src="<?php echo $this->baseurl . '/' . $this->escape($cparams->get('image_path')).'/'.$this->escape($this->params->get('image')); ?>" class="image_<?php echo $this->escape($this->params->get( 'image_align' )); ?>">
			<?php endif; ?>
			<?php echo $this->params->get( 'comp_description' ); ?>
		</div>
	<?php endif; ?>
	
	<?php if ( count( $this->categories ) ) : ?>
	<ul>
		<?php foreach ( $this->categories as $category ) : ?>
		<li>
			<h3 class="item-title"><a href="<?php echo $category->link; ?>">
				<?php echo $this->escape($category->title); ?></a>
			</h3>
			<?php if ( $this->params->def( 'show_cat_description', 1 ) && $category->description) : ?>
				<p class="category-desc">
					<?php echo $category->description; ?>
				</p>
			<?php endif; ?>		
			<?php if ( $this->params->get( 'show_cat_items' ) ) : ?>
				<dl class="newsfeed-count">
					<dt>
						<?php echo JText::_( 'Number of Items' ); ?>:
					</dt>
					<dd>
						<?php echo (int)$category->numlinks; ?>
					</dd>
				</dl>
			<?php endif; ?>	
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>
