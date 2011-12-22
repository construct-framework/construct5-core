<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><form id="jForm" class="archive<?php echo $this->escape($this->params->get('pageclass_sfx')); ?> action="<?php JRoute::_('index.php')?>" method="post">
        <?php if ($this->params->get('show_page_title', 1)) : ?>
            <h2 class="componentheading">
                <?php echo $this->escape($this->params->get('page_title')); ?>
            </h2>
        <?php endif; ?>
        <fieldset>
	        <?php if ($this->params->get('filter')) : ?>
	            <?php echo JText::_('Filter').'&nbsp;'; ?>
	            <input type="text" name="filter" value="<?php echo $this->escape($this->filter); ?>" class="inputbox" onchange="document.jForm.submit();" />
	        <?php endif; ?>
	        
	        <?php echo $this->form->monthField; ?>
	        <?php echo $this->form->yearField; ?>
	        <?php echo $this->form->limitField; ?>
	        <button type="submit" class="button"><?php echo JText::_('Filter'); ?></button>      
            <input type="hidden" name="view" value="archive" />
            <input type="hidden" name="option" value="com_content" />
            <input type="hidden" name="viewcache" value="0" />
        <fieldset>
        <?php echo $this->loadTemplate('items'); ?>
    </form>