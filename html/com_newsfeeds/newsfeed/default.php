<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

	$lang = &JFactory::getLanguage();
	$myrtl =$this->newsfeed->rtl;
	if ($lang->isRTL() && $myrtl == 0) {
		$direction = " redirect-rtl";
	} elseif ($lang->isRTL() && $myrtl == 1) {
		$direction = " redirect-ltr";
	} elseif ($lang->isRTL() && $myrtl == 2) {
		$direction = " redirect-rtl";
	} elseif ($myrtl == 0) {
		$direction = " redirect-ltr";
	} elseif ($myrtl == 1) {
		$direction = " redirect-ltr";
	} elseif ($myrtl == 2) {
		$direction = " redirect-rtl";
	}
?><section class="newsfeed<?php echo htmlspecialchars($this->params->get('pageclass_sfx')); ?><?php echo $direction; ?>">

	<?php if ( $this->params->get( 'show_page_title', 1 ) ) : ?>
		<header>
			<h2 class="<?php echo $direction; ?>">
				<?php echo htmlspecialchars($this->params->get('page_title')); ?>
			</h2>
		</header>
	<?php endif; ?>

	<h3 class="<?php echo $direction; ?>">
		<a href="<?php echo $this->newsfeed->channel['link']; ?>">
			<?php echo str_replace('&apos;', "'", $this->escape($this->newsfeed->channel['title'])); ?></a>
	</h3>

	<?php if ( $this->params->get( 'show_feed_description' ) )  : ?>
		<p class="feed-description">
			<?php echo str_replace('&apos;', "'", $this->newsfeed->channel['description']); ?>
		</p>
	<?php endif; ?>

	<?php if ( isset( $this->newsfeed->image['url'] ) && isset( $this->newsfeed->image['title'] ) && $this->params->get( 'show_feed_image' ) ) : ?>
		<img src="<?php echo htmlspecialchars($this->newsfeed->image['url']); ?>" alt="<?php echo htmlspecialchars($this->newsfeed->image['title']); ?>">
	<?php endif; ?>

	<?php if ( count( $this->newsfeed->items ) ) : ?>
	<ol>
		<?php foreach ( $this->newsfeed->items as $item ) : ?>
		<li>
			<?php if ( !is_null( $item->get_link() ) ) : ?>
				<a href="<?php echo htmlspecialchars($item->get_link()); ?>">
					<?php echo htmlspecialchars($item->get_title()); ?>
				</a>
			<?php endif; ?>

			<?php if ( $this->params->get( 'show_item_description' ) && $item->get_description() ) : ?>
				<p class="feed-item-description">
					<?php $text = $this->limitText( $item->get_description(), $this->params->get( 'feed_word_count' ) ); ?>
					<?php echo str_replace('&apos;', "'", $text); ?>
				</p>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
	</ol>
	<?php endif; ?>
</section>