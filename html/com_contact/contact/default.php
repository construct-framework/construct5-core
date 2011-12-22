<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><section class="contact<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">

		<?php if ($this->params->get('show_page_title',1) && $this->params->get('page_title') != $this->contact->name) : ?>
			<h1>
				<?php echo $this->escape($this->params->get('page_title')); ?>
			</h1>
		<?php endif; ?>

		<?php if ($this->contact->name && $this->contact->params->get('show_name')) : ?>
			<h2>
				<?php echo $this->escape($this->contact->name); ?>
			</h2>
		<?php endif; ?>

		<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
			<form method="post" name="selectForm" id="selectForm">
				<fieldset>
					<?php echo JText::_('Select Contact'); ?>
					<br />
					<?php echo JHTML::_('select.genericlist', $this->contacts, 'contact_id', 'class="inputbox" onchange="this.form.submit()"', 'id', 'name', $this->contact->id); ?>
				</fieldset>
				<input type="hidden" name="option" value="com_contact" />		
			</form>
		<?php endif; ?>

		<?php if ($this->contact->con_position && $this->contact->params->get('show_position')) : ?>
			<p class="contact-position"><?php echo $this->escape($this->contact->con_position); ?></p>
		<?php endif; ?>

		<?php if ($this->contact->image && $this->contact->params->get('show_image')) : ?>
			<div class="contact-image">
				<?php echo JHTML::_('image', 'images/stories' . '/'.$this->escape($this->contact->image), JText::_( 'Contact' )); ?>
			</div>
		<?php endif; ?>

		<?php echo $this->loadTemplate('address'); ?>

		<?php if ( $this->contact->params->get('allow_vcard')) : ?>
			<p class="contact-vcard">
				<?php echo JText::_('Download information as a'); ?>
				<a href="index.php?option=com_contact&amp;task=vcard&amp;contact_id=<?php echo (int)$this->contact->id; ?>&amp;format=raw">
					<?php echo JText::_('VCard'); ?></a>
			</p>
		<?php endif; ?>

		<?php if ($this->contact->params->get('show_email_form')) :
			echo $this->loadTemplate('form');
		endif; ?>
	</section>