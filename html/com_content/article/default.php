<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

?><article id="item-page<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
		<?php if ($this->params->get('show_page_title',1) && $this->params->get('page_title') != $this->article->title) : ?>
		<h1>
			<?php echo $this->escape($this->params->get('page_title')); ?>
		</h1>		
		<?php endif; ?>
	
		<?php if ($this->params->get('show_title')) : ?>
	    <h2>
		    <?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
		    <a href="<?php echo $this->article->readmore_link; ?>">
			    <?php echo $this->escape($this->article->title); ?></a>
		    <?php else :
			    echo $this->escape($this->article->title);
		    endif; ?>
	    </h2>
		<?php endif; ?>
	
		<?php if (($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) || ($this->params->get('show_pdf_icon')) || ($this->params->get('show_print_icon')) || ($this->params->get('show_email_icon'))): ?>
				
		<ul class="actions">
			<?php if (!$this->print) : ?>				
			<?php if ($this->params->get('show_pdf_icon')) : ?>
			    <li class="pdf-icon">	
				    <?php echo JHTML::_('icon.pdf', $this->article, $this->params, $this->access); ?>	
			    </li>	
			<?php endif; ?>
			<?php if ($this->params->get('show_print_icon')) : ?>
			    <li class="print-icon">
				    <?php echo JHTML::_('icon.print_popup', $this->article, $this->params, $this->access); ?>
			    </li>
			<?php endif; ?>
			<?php if ($this->params->get('show_email_icon')) : ?>
			    <li class="print-icon">
				    <?php echo JHTML::_('icon.email', $this->article, $this->params, $this->access); ?>
			    </li>
			<?php endif; ?>		
			<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all') || $this->user->authorize('com_content', 'edit', 'content', 'own')) : ?>
			    <li class="edit-icon">
				    <?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
			    </li>
			<?php endif; ?>
			<?php else : ?>
			    <li>
				    <?php echo JHTML::_('icon.print_screen', $this->article, $this->params, $this->access); ?>
			    </li>		
			<?php endif; ?>
		</ul>
		<?php endif; ?>
			
		<?php if (!$this->params->get('show_intro')) :
			echo $this->article->event->afterDisplayTitle;
		endif; ?>
	
		<?php echo $this->article->event->beforeDisplayContent; ?>
	
		<?php $useDefList = (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid) ||	(intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) || ($this->params->get('show_author') && ($this->article->author != "")) ||	($this->params->get('show_create_date'))); ?>
	    
	    <?php if ($useDefList) : ?>
			<header class="article-info">
			    <hgroup>
         <?php endif;?>			 
				    <?php if ($this->params->get('show_section') && $this->article->sectionid) : ?>
			        <h3 class="section-name">
				        <?php if ($this->params->get('link_section')) : ?>
					        <?php echo '<a href="'.JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid)).'">'; ?>
				        <?php endif; ?>
				        <?php echo $this->escape($this->article->section); ?>
				        <?php if ($this->params->get('link_section')) : ?>
					        <?php echo '</a>'; ?>
				        <?php endif; ?>
				        <?php if ($this->params->get('show_category')) : ?>
					        <?php echo ' -&nbsp;'; ?>
				        <?php endif; ?>
			        </h3>
				    <?php endif; ?>
				
				    <?php if ($this->params->get('show_category') && $this->article->catid) : ?>
			        <h4 class="category-name">
				        <?php if ($this->params->get('link_category')) : ?>
					        <?php echo '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)).'">'; ?>
				        <?php endif; ?>
				        <?php echo $this->escape($this->article->category); ?>
				        <?php if ($this->params->get('link_category')) : ?>
					        <?php echo '</a>'; ?>
				        <?php endif; ?>
			        </h4>
				    <?php endif; ?>
	        <?php if ($useDefList) : ?>				    
		        </hgroup>
            <?php endif; ?>
				<?php if (intval($this->article->modified) !=0 && $this->params->get('show_modify_date')) : ?>
			    <time class="modified">
				    <?php echo JText::sprintf('LAST_UPDATED2', JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2'))); ?>
			    </time>
				<?php endif; ?>
			
				<?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
			    <address class="createdby" rel="author"> 
				    <?php JText::printf('Written by', ($this->article->created_by_alias ? $this->escape($this->article->created_by_alias) : $this->escape($this->article->author))); ?>
			    </address>
				<?php endif; ?>
			
				<?php if ($this->params->get('show_create_date')) : ?>
			    <time class="create">
				    <?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')); ?>
			    </time>
				<?php endif; ?>
				<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
			    <span class="hits">
				    <a href="<?php echo $this->escape($this->article->urls); ?>">
					    <?php echo $this->escape($this->article->urls); ?></a>
			    </span>
				<?php endif; ?>
    	<?php if ($useDefList) : ?>
			</header>
		<?php endif; ?>	
	
		<?php if (isset ($this->article->toc)) :
			echo $this->article->toc;
		endif; ?>
	
		<?php echo JFilterOutput::ampReplace($this->article->text); ?>
	
		<?php echo $this->article->event->afterDisplayContent; ?>
	
	</article>