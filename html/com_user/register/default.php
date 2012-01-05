<?php
/*
* @package		AJAX Register
* @copyright	Copyright (C) 2009-2010 Emir Sakic, http://www.sakic.net. All rights reserved.
* @license		GNU/GPL, see LICENSE.TXT
*
* This program is free software; you can redistribute it and/or modify it
* under the terms of the GNU General Public License as published by the
* Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
* 
* This header must not be removed. Additional contributions/changes
* may be added to this header as long as no information is deleted.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<script type="text/javascript">
/* <![CDATA[ */
window.addEvent('domready', function(){
	var params = {
		ajax: <?php echo $this->ajax; ?>,
		msg_type:  '<?php echo $this->msg_type; ?>'
	};
	var strings = {
		wait: '<?php echo JText::_( 'AJAXREG_PLEASE_WAIT' ); ?>',
		checking: '<?php echo JText::_( 'AJAXREG_CHECKING' ); ?>',
		username_taken: '<?php echo JText::_( 'AJAXREG_USERNAME_TAKEN' ); ?>',
		username_illegal: '<?php echo JText::_( 'AJAXREG_USERNAME_ILLEGAL' ); ?>',
		username_short: '<?php echo JText::_( 'AJAXREG_USERNAME_SHORT' ); ?>',
		username_empty: '<?php echo JText::_( 'AJAXREG_USERNAME_EMPTY' ); ?>',
		email_taken: '<?php echo JText::_( 'AJAXREG_EMAIL_TAKEN' ); ?>',
		email_illegal: '<?php echo JText::_( 'AJAXREG_EMAIL_ILLEGAL' ); ?>',
		password_short: '<?php echo JText::_( 'AJAXREG_PASSWORD_SHORT' ); ?>',
		passwords_different: '<?php echo JText::_( 'AJAXREG_PASSWORDS_DIFFERENT' ); ?>',
		required: '<?php echo JText::_( 'AJAXREG_REQUIRED' ); ?>',
		warning: '<?php echo JText::_( 'AJAXREG_WARNING' ); ?>',
		register: '<?php echo JText::_('Register'); ?>',
<?php
	if (!empty($this->password_strength)) {
?>
		weak: '<?php echo JText::_( 'AJAXREG_WEAK' ); ?>',
		fair: '<?php echo JText::_( 'AJAXREG_FAIR' ); ?>',
		good: '<?php echo JText::_( 'AJAXREG_GOOD' ); ?>',
		strong: '<?php echo JText::_( 'AJAXREG_STRONG' ); ?>',
<?php
	}
?>
		captcha_wrong: '<?php echo JText::_( 'AJAXREG_CAPTCHA_WRONG' ); ?>',
		captcha_failed: '<?php echo JText::_( 'AJAXREG_CAPTCHA_FAILED' ); ?>'
	};
	var myFormValidation = new Validate('josForm', {url: '<?php echo JURI::root().'index.php?option=com_user&task=ajax&tmpl=component'; ?>', params: params, strings: strings});
});
/* ]]> */
</script>

<?php
	if(isset($this->message)){
		$this->display('message');
	}
?>

<form action="<?php echo JRoute::_( 'index.php?option=com_user' ); ?>" method="post" id="josForm" name="josForm" class="form-validate">

<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>"><?php echo $this->escape($this->params->get('page_title')); ?></div>
<?php endif; ?>

<div class="ar_container">
	<div class="ar_left">
		<label class="ar_middle" id="namemsg" for="name">
			<?php echo JText::_( 'Name' ); ?>:
		</label>
	</div>
	<div class="ar_right">
  		<input type="text" name="name" id="name" size="40" value="<?php echo $this->user->get( 'name' );?>" class="inputbox required" maxlength="50" tabindex="1" /> *
	</div>
	
	<div class="ar_spacer"></div>
	
	<div class="ar_left">
		<label class="ar_middle" id="usernamemsg" for="username">
			<?php echo JText::_( 'Username' ); ?>:
		</label>
	</div>
	<div class="ar_right">
		<input type="text" id="username" name="username" size="40" value="<?php echo $this->user->get( 'username' );?>" class="inputbox required validate-username" maxlength="25" tabindex="2" /> *
	</div>
	
	<div class="ar_spacer"></div>

	<div class="ar_left">
		<label class="ar_middle" id="emailmsg" for="email">
			<?php echo JText::_( 'Email' ); ?>:
		</label>
	</div>
	<div class="ar_right">
		<input type="text" id="email" name="email" size="40" value="<?php echo $this->user->get( 'email' );?>" class="inputbox required validate-email" maxlength="100" tabindex="3" /> *
	</div>
	
	<div class="ar_spacer"></div>

	<div class="ar_left">
		<label class="ar_middle" id="pwmsg" for="password">
			<?php echo JText::_( 'Password' ); ?>:
		</label>
	</div>
	<div class="ar_right">
  		<input class="inputbox required validate-password" type="password" id="password" name="password" size="40" value="" tabindex="4" /> *
<?php
	if (!empty($this->password_strength)) {
?>
		<div class="ar_password_strength">
			<div class="ar_password_bar_container">
				<div id="password_bar" class="ar_password_bar"></div>
			</div>
			<div id="password_text" class="ar_password_text"></div>
		</div>
<?php
	}
?>
	</div>
	
	<div class="ar_spacer"></div>

	<div class="ar_left">
		<label class="ar_middle" id="pw2msg" for="password2">
			<?php echo JText::_( 'Verify Password' ); ?>:
		</label>
	</div>
	<div class="ar_right">
		<input class="inputbox required validate-passverify" type="password" id="password2" name="password2" size="40" value="" tabindex="5" /> *
	</div>
	
	<div class="ar_spacer"></div>
	
<?php
	if (!empty($this->display_disclaimer)) {
?>
	<div class="ar_right disclaimer">
		
<?php
	if (!empty($this->display_disclaimer_checkbox)) {
?>
		<div class="ar_spacer"></div>
		<input class="inputbox required" id="accept" type="checkbox" value="yes" name="accept" tabindex="6" />
		<?php echo JText::_( 'AJAXREG_ACCEPT' ); ?> the <a class="modal" href="index.php?option=com_content&view=article&id=25&tmpl=modal" rel="{handler: 'iframe', size: {x: 640, y: 480}}">Terms and Conditions</a>*
<?php
	}
?><div class="ar_spacer"></div>
	</div>

	<div class="ar_spacer"></div>
<?php
	}
?>

<?php
	if (!empty($this->recaptcha)) {
?>
	<div class="captcha">
		<script>
		var RecaptchaOptions = {
		   theme : '<?php echo $this->recaptcha_theme; ?>',
		   tabindex : 7,
		   lang : '<?php echo $this->recaptcha_lang; ?>'
		};
		</script>
		<?php echo $this->recaptcha; ?>
	</div>
	
	<div class="ar_spacer"></div>
<?php
	} else if (!empty($this->captcha)) {
?>
	<div class="ar_left">
		<label class="ar_middle" id="captcha" for="captcha">
			<img src="<?php echo $this->baseurl; ?>/tmp/<?php echo $this->captcha['file'];?>" alt="" id="captcha_img" />
		</label>
	</div>
	<div class="ar_right captcha">
		<input type="text" id="captcha" name="<?php echo $this->captcha['id']; ?>" class="inputbox required" size="10" tabindex="7" /> *
		<?php echo JText::_('AJAXREG_CAPTCHA'); ?>
	</div>
	
	<div class="ar_spacer"></div>
<?php
	}
?>

	<div class="ar_right">
		<?php echo JText::_( 'REGISTER_REQUIRED' ); ?>
	</div>
	
	<div class="ar_spacer"></div>

	<div>
		<button class="button validate" type="submit" tabindex="7"><?php echo JText::_('Register'); ?></button>
<?php
	if (!empty($this->clear)) {
?>
		&nbsp;<button class="button reset" type="reset" tabindex="8"><?php echo JText::_('AJAXREG_CLEAR'); ?></button>
<?php
	}
?>
	</div>
	
	<div class="ar_spacer"></div>

</div>

	<input type="hidden" name="task" value="register_save" />
	<input type="hidden" name="id" value="0" />
	<input type="hidden" name="gid" value="0" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>