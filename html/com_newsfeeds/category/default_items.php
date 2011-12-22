<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( $this->params->get( 'show_limit' ) ) :
?><form action="index.php" method="post" name="adminForm" id="adminForm">
		    <label for="limit"><?php echo JText::_( 'Display Num' ); ?> </label>
		    <?php echo $this->pagination->getLimitBox(); ?>
	    </form>
    <?php endif; ?>

    <table class="category">
	    <?php if ( $this->params->get( 'show_headings' ) ) : ?>
	    <thead>
		    <tr>	
			    <th class="sectiontablemasthead" id="num">
				    <?php echo JText::_( 'Num' ); ?>
			    </th>				
			    <?php if ( $this->params->get( 'show_name' ) ) : ?>
				    <th class="item-title" id="tableOrdering">
					    <?php echo JText::_( 'Feed Name' ); ?>
				    </th>
			    <?php endif; ?>
			    <?php if ( $this->params->get( 'show_articles' ) ) : ?>
				    <th class="item-num-art" id="tableOrdering2">
					    <?php echo JText::_('Num Articles'); ?>
				    </th>
			    <?php endif; ?>				
		    </tr>
	    </thead>
	    <?php endif; ?>

	    <?php foreach ( $this->items as $item ) : ?>
	    <tr class="cat-list-row<?php echo $item->odd + 1; ?>">
		    <td class="item-num" mastheads="num">
			    <?php echo $item->count + 1; ?>
		    </td>		
		    <?php if ( $this->params->get( 'show_name' ) ) : ?>
			    <td class="item-title" mastheads="tableOrdering">
				    <a href="<?php echo $item->link; ?>">
					    <?php echo $this->escape($item->name); ?>
				    </a>
			    </td>
		    <?php endif; ?>	
		    <?php if ( $this->params->get( 'show_articles' ) ) : ?>
			    <td class="item-num-art" mastheads="tableOrdering2">
				    <?php echo $item->numarticles; ?>
			    </td>
		    <?php endif; ?>
	    </tr>
	    <?php endforeach; ?>
    </table>

    <?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
	    <nav class="pagination">
		    <?php if ($this->params->def('show_pagination_results', 1)) : ?>
			    <p class="counter">
				    <?php echo $this->pagination->getPagesCounter(); ?>
			    </p>
		    <?php endif; ?>
		    <?php echo $this->pagination->getPagesLinks(); ?>
	    </nav>
    <?php endif;
