<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><form id="search-form" action="<?php echo JRoute::_( 'index.php?option=com_search#content' ) ?>" method="post">

	<div><?php echo JText::_('search_again'); ?></div>

	<fieldset class="word">
		<label for="search-searchword">
			<?php echo JText::_('Search Keyword') ?>
			<input type="search" name="searchword" id="search-searchword"  maxlength="20" value="<?php echo htmlspecialchars($this->searchword) ?>" class="inputbox">
		</label>
		<button name="Search" onclick="this.form.submit()" class="button">
			<?php echo JText::_( 'Search' );?>
		</button>		
	</fieldset>
	
	<?php if (!empty($this->searchword)) : ?>
		<div class="searchintro">
				<?php echo JText::_('Search Keyword') ?> <?php echo htmlspecialchars($this->searchword) ?>
				<?php echo $this->result ?>
		</div>
	<?php endif; ?>
	
	<fieldset class="phrases">
		<legend>
			<?php echo JText::_('Search Parameters') ?>
		</legend>
		<div class="phrases-box">
			<?php echo $this->lists['searchphrase']; ?>
		</div>
		<div class="ordering-box">
			<label for="ordering" class="ordering">
				<?php echo JText::_('Ordering') ?>:
			</label>
			<?php echo $this->lists['ordering']; ?>
		</div>
	</fieldset>

	<?php if ($this->params->get('search_areas', 1)) : ?>
	<fieldset class="only">
		<legend>
			<?php echo JText::_('Search Only') ?>:
		</legend>
		<?php foreach ($this->searchareas['search'] as $val => $txt) : ?>
			<?php $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="true"' : ''; ?>
			<label for="area-<?php echo $val ?>">
			<input type="checkbox" name="areas[]" value="<?php echo $val ?>" id="area-<?php echo $val ?>" <?php echo $checked ?>>
				<?php echo JText::_($txt); ?>
			</label>
		<?php endforeach; ?>
	</fieldset>
	<?php endif; ?>
	
	<?php if (count($this->results)) : ?>
		<fieldset>
			<div class="form-limit">
				<label for="limit">
					<?php echo JText :: _('Display Num') ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
			<p class="counter">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</p>
		</fieldset>
	<?php endif; ?>
	<input type="hidden" name="task" value="search">
</form>
