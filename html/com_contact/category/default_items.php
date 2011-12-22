<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><?php foreach ($this->items as $item) : ?>
	<tr>
		<td class="item-count">
			<?php echo (int)$item->count + 1; ?>
		</td>

		<?php if ($this->params->get('show_position')) : ?>
		<td class="item-position">
			<?php echo $this->escape($item->con_position); ?>
		</td>
		<?php endif; ?>

		<td class="item-name">
			<a href="<?php echo $item->link; ?>">
				<?php echo $this->escape($item->name); ?></a>
		</td>

		<?php if ($this->params->get('show_email')) : ?>
		<td class="item-email">
			<?php echo $item->email_to; ?>
		</td>
		<?php endif; ?>

		<?php if ($this->params->get('show_telephone')) : ?>
		<td class="item-phone">
			<?php echo $this->escape($item->telephone); ?>
		</td>
		<?php endif; ?>

		<?php if ($this->params->get('show_mobile')) : ?>
		<td class="item-mobile">
			<?php echo $this->escape($item->mobile); ?>
		</td>
		<?php endif; ?>

		<?php if ($this->params->get('show_fax')) : ?>
		<td class="item-fax">
			<?php echo $this->escape($item->fax); ?>
		</td>
		<?php endif; ?>
	</tr>
<?php endforeach;
