/*
	Class: FormCheck
		Performs different tests on forms and indicates errors.

	Usage:
		Works with these types of fields :
		- input (text, radio, checkbox)
		- textarea
		- select

		You just need to add a specific class to each fields you want to check.
		For example, if you add the class
			(code)
			validate['required','length[4, -1]','differs:email','digit']
			(end code)
		the value's field must be set (required) with a minimum length of four chars (4, -1),
		must differs of the input named email (differs:email), and must be digit.

		You can perform check during the datas entry or on the submit action, shows errors as tips or in a div before or after the field,
		show errors one by one or all together, show a list of all errors at the top of the form, localize error messages, add new regex check, ...

		The layout is design only with css. Now I added a hack to use transparent png with IE6, so you can use png images in formcheck.css (works only for theme, so the file must be named formcheck.css). It can also works with multiple forms on a single html page.
		The class supports now internationalization. To use it, simply specify a new <script> element in your html head, like this : <script type="text/javascript" src="formcheck/lang/fr.js"></script>.

		If you add the class
			(code)
			validate['submit']
			(end code)
		to an element like an anchor (or anything else), this element will act as a submit button.

		N.B. : you must load the language script before the formcheck and this method overpass the old way. You can create new languages following existing ones. You can otherwise still specifiy the alerts' strings when you initialize the Class, with options.
		If you don't use a language script, the alert will be displayed in english.

	Test type:
		You can perform various test on fields by adding them to the validate class. Be careful to *not use space chars*. Here is the list of them.

		required 					- The field becomes required. This is a regex, you can change it with class options.
		alpha 						- The value is restricted to alphabetic chars. This is a regex, you can change it with class options.
		alphanum 					- The value is restricted to alphanumeric characters only. This is a regex, you can change it with class options.
		nodigit 					- The field doesn't accept digit chars. This is a regex, you can change it with class options.
		digit 						- The value is restricted to digit (no floating point number) chars, you can pass two arguments (f.e. digit[21,65]) to limit the number between them. Use -1 as second argument to set no maximum.
		number 						- The value is restricted to number, including floating point number. This is a regex, you can change it with class options.
		email 						- The value is restricted to valid email. This is a regex, you can change it with class options.
		image						- The value is restricted to images (jpg, jpeg, png, gif, bmp). This is a regex, you can change it with class options.
		phone 						- The value is restricted to phone chars. This is a regex, you can change it with class options.
		phone_inter					- The value is restricted to international phone number. This is a regex, you can change it with class options.
		url: 						- The value is restricted to url. This is a regex, you can change it with class options.
		confirm 					- The value has to be the same as the specified. f.e. confirm:password.
		differs 					- The value has to be diferent as the one specifies. f.e. differs:user.
		length 						- The value length is restricted by argument (f.e. length[6,10]). Use -1 as second argument to set no maximum.
		group						- Use to validate several checkboxes as a group. Requires 2 arguments, the second one being optional (1 by default): the group id and the minimum amount of boxes to check. The second argument may be set on any or all items of the group. See example below.
		words						- The words number is limited by arguments. f.e. words[1,13]. Use -1 as second argument to don't have a max limit.
		target						- It's not really a validation test, but it allows you to attach the error message to an other element, usefull if the input you validate is hidden. You must specifiy target id, f.e. target:myDiv.

		You can also use a custom function to check a field. For example, if you have a field with class
			(code)
			validate['required','%customCheck']
			(end code)
		the function customCheck(el) will be called to validate the field. '%customcheck' works with other validate(s) together, and '~customcheck' works if the element pass the other validate(s).
		Here is an example of what customCheck could look :
			(code)
			function customCheck(el){
				if (!el.value.test(/^[A-Z]/)) {
					el.errors.push("Username should begin with an uppercase letter");
					return false;
				} else {
					return true;
				}
			}
			(end code)

		To validate checkoxes group, you could make something like :
			(code)
				<input type="checkbox" name="dog" class="validate['group[1,2]']">
				<input type="checkbox" name="cat" class="validate['group[1]']">
				<input type="checkbox" name="mouse" class="validate['group[1]']">
			(end code)
		For checkboxes from group 1, you will need to check at least 2 boxes.

		It is now possible to register new fields after a new FormCheck call by using <FormCheck::register> (see <FormCheck::dispose> too). You need first to add the validate class to the element you want to register ( $('myInput').addClass("validate['required']") ).

	Parameters:
		When you initialize the class with addEvent, you can set some options. If you want to modify regex, you must do it in a hash, like for display or alert. You can also add new regex check method by adding the regex and an alert with the same name.

		Required:

			form_id - The id of the formular. This is required.

		Optional:

			submit					- If you turn this option to false, the FormCheck will only perform a validation, without submitting the form, even on success. You can use validateSuccess event to execute some code.

			ajaxSubmit 			- you can set this to true if you want to submit your form with ajax. You should use provided events to handle the ajax request (see below). By default it is false.
			ajaxResponseDiv 		- id of element to inject ajax response into (can also use onAjaxSuccess). By default it is false.
			ajaxEvalScripts 		- use evalScripts in the Request response. Can be true or false, by default it is false.
			onAjaxRequest 			- Function to fire when the Request event starts.
			onAjaxComplete 			- Function to fire when the Request event completes regardless of and prior to Success or Failure.
			onAjaxSuccess 			- Function to fire when the Request receives .  Args: response [the request response] - see Mootools docs for Request.onSuccess.
			onAjaxFailure 			- Function to fire if the Request fails.

			onSubmit				- Function to fire when form is submited (so before validation)
			onValidateSuccess 		- Function to fire when validation pass (you should prevent form submission with option submit:false to use this)
			onValidateFailure		- Function to fire when validation fails

			tipsClass 				- The class to apply to tipboxes' errors. By default it is 'fc-tbx'.
			errorClass 				- The class to apply to alertbox (not tips). By default it is 'fc-error'.
			fieldErrorClass 		- The class to apply to fields with errors, except for radios. You should also turn on  options.addClassErrorToField. By default it is 'fc-field-error'

			trimValue				- If set to true, strip whitespace (or other characters) from the beginning and end of values. By default it is false.
			validateDisabled		- If set to true, disabled input will be validated too, otherwise not.

		Display:
			This is a hash of display settings. in here you can modify.

			showErrors 				- 0 : onSubmit, 1 : onSubmit & onBlur, by default it is 0.
			titlesInsteadNames		- 0 : When you do a check using differs or confirm, it takes the field name for the alert. If it's set to 1, it will use the title instead of the name.
			errorsLocation 			- 1 : tips, 2 : before, 3 : after, by default it is 1.
			indicateErrors 			- 0 : none, 1 : one by one, 2 : all, by default it is 1.
			indicateErrorsInit		- 0 : determine if the form must be checked on initialize. Could be usefull to force the user to update fields that don't validate.
			keepFocusOnError 		- 0 : normal behaviour, 1 : the current field keep the focus as it remain errors. By default it is 0.
			checkValueIfEmpty 		- 0 : When you leave a field and you have set the showErrors option to 1, the value is tested only if a value has been set. 1 : The value is tested  in any case.  By default it is 1.
			addClassErrorToField 	- 0 : no class is added to the field, 1 : the options.fieldErrorClass is added to the field with an error (except for radio). By default it is 0.
			removeClassErrorOnTipClosure - 0 : Error class is kept when the tip is closed, 1 : Error class is removed when the tip is closed

			replaceTipsEffect 		- 0 : No effect on tips replace when we resize the broswer, 1: tween transition on browser resize;
			closeTipsButton 		- 0 : the close button of the tipbox is hidden, 1 : the close button of the tipbox is visible. By default it is 1.
			flashTips 				- 0 : normal behaviour, 1 : the tipbox "flash" (disappear and reappear) if errors remain when the form is submitted. By default it is 0.
			tipsPosition 			- 'right' : the tips box is placed on the right part of the field, 'left' to place it on the left part. By default it is 'right'.
			tipsOffsetX 			- Horizontal position of the tips box (margin-left), , by default it is 100 (px).
			tipsOffsetY				- Vertical position of the tips box (margin-bottom), , by default it is -10 (px).

			listErrorsAtTop 		- List all errors at the top of the form, , by default it is false.
			scrollToFirst 			- Smooth scroll the page to first error and focus on it, by default it is true.
			fadeDuration 			- Transition duration (in ms), by default it is 300.

		Alerts:
			This is a hash of alerts settings. in here you can modify strings to localize or wathever else. %0 and %1 represent the argument.

			required 				- "This field is required."
			alpha 					- "This field accepts alphabetic characters only."
			alphanum 				- "This field accepts alphanumeric characters only."
			nodigit 				- "No digits are accepted."
			digit 					- "Please enter a valid integer."
			digitmin 				- "The number must be at least %0"
			digitltd 				- "The value must be between %0 and %1"
			number 					- "Please enter a valid number."
			email 					- "Please enter a valid email: <br /><span>E.g. yourname@domain.com</span>"
			phone 					- "Please enter a valid phone."
			phone_inter 			- "Please enter a valid international phone number."
			url 					- "Please enter a valid url: <br /><span>E.g. http://www.domain.com</span>"
			image					- "This field should only contain image types"
			confirm 				- "This field is different from %0"
			differs 				- "This value must be different of %0"
			length_str 				- "The length is incorrect, it must be between %0 and %1"
			length_fix 				- "The length is incorrect, it must be exactly %0 characters"
			lengthmax 				- "The length is incorrect, it must be at max %0"
			lengthmin 				- "The length is incorrect, it must be at least %0"
			words_min				- "This field must concain at least %0 words, now it has %1 words"
			words_range				- "This field must contain between %0 and %1 words, now it has %2 words"
			words_max				- "This field must contain at max %0 words, now it has %1 words"
			checkbox 				- "Please check the box"
			checkboxes_group		- "Please check at least %0 box(es)"
			radios 					- "Please select a radio"
			select 					- "Please choose a value"

	Example:
		You can initialize a formcheck (no scroll, custom classes and alert) by adding for example this in your html head this code :

		(code)
		<script type="text/javascript">
			window.addEvent('domready', function() {
				var myCheck = new FormCheck('form_id', {
					tipsClass : 'tips_box',
					display : {
						scrollToFirst : false
					},
					alerts : {
						required : 'This field is ablolutely required! Please enter a value'
					}
				})
			});
		</script>
		(end code)

	About:
		formcheck.js v.1.6 for mootools v1.2 - 01 / 2010

		by Mootools.Floor (http://mootools.floor.ch) MIT-style license

		Created by Luca Pillonel (luca-at-nolocation.org),
		Last modified by Luca Pillonel

	Credits:
		This class was inspired by fValidator by Fabio Zendhi Nagao (http://zend.lojcomm.com.br)

		Thanks to all contributors from groups.google.com/group/moofloor (and others as well!) providing ideas, translations, fixes and motivation!
*/


var FormCheck = new Class({

	Implements: [Options, Events],

	options : {

		tipsClass : 'fc-tbx',				//tips error class
		errorClass : 'fc-error',			//div error class
		fieldErrorClass : 'fc-field-error',	//error class for elements

		submit : true,						//false : just validate the form and do nothing else. Use onValidateSuccess event to execute some code
		submitAction: false,				//Action page used to submit the form data to.
		submitMethod: false,				//Method used to submit the form, valid options : 'post' or 'get'

		trimValue : false,					//trim (remove whitespaces before and after) the value
		validateDisabled : false,			//skip validation on disabled input if set to false.

		ajaxSubmit : false,					//(mixed) true, 'HTML', 'JSON', 'JSONP', or 'Queue' : submit by ajax
		ajaxOptions: {},					//Options for default MooTools Request properties

		onSubmit		  : $empty,			//Function to fire when user submit the form
		onValidateSuccess : $empty,			//Function to fire when validation pass
		onValidateFailure : $empty,			//Function to fire when validation fails

		validate: {},

		display : {
			showErrors : 0,
			titlesInsteadNames : 0,
			errorsLocation : 1,
			indicateErrors : 1,
			indicateErrorsInit : 0,
			keepFocusOnError : 0,
			checkValueIfEmpty : 1,
			addClassErrorToField : 0,
			removeClassErrorOnTipClosure : 0,
			replaceTipsEffect : 1,
			flashTips : 0,
			closeTipsButton : 1,
			tipsPosition : "right",
			tipsOffsetX : -45,
			tipsOffsetY : 0,
			listErrorsAtTop : false,
			scrollToFirst : true,
			fadeDuration : 300
		},

		"alerts" : {
			"required" : "This field is required.",
			"alpha" : "This field accepts alphabetic characters only.",
			"alphanum" : "This field accepts alphanumeric characters only.",
			"nodigit" : "No digits are accepted.",
			"digit" : "Please enter a valid integer.",
			"digitltd" : "The value must be between %0 and %1",
			"number" : "Please enter a valid number.",
			"email" : "Please enter a valid email.",
			"image" : "This field should only contain image types",
			"phone" : "Please enter a valid phone.",
			"phone2": "Please enter a valid phone.",
			"phone3" : "Please enter a valid phone.",
			"phone_inter" : "Please enter a valid international phone number.",
			"url" : "Please enter a valid url.",
			"confirm" : "This field is different from %0",
			"differs" : "This value must be different of %0",
			"length_str" : "The length is incorrect, it must be between %0 and %1",
			"length_fix" : "The length is incorrect, it must be exactly %0 characters",
			"lengthmax" : "The length is incorrect, it must be at max %0",
			"lengthmin" : "The length is incorrect, it must be at least %0",
			"words_min" : "This field must concain at least %0 words, currently: %1 words",
			"words_range" : "This field must contain %0-%1 words, currently: %2 words",
			"words_max" : "This field must contain at max %0 words, currently: %1 words",
			"checkbox" : "Please check the box",
			"checkboxes_group" : "Please check at least %0 box(es)",
			"radios" : "Please select a radio",
			"select" : "Please choose a value",
			"select_multiple" : "Please choose at least one value",
			"date": "Please enter a valid date"
		},

		regexp : {
			required : /[^.*]/,
			alpha : /^[a-z ._-]+$/i,
			alphanum : /^[a-z0-9 ._-]+$/i,
			digit : /^[-+]?[0-9]+$/,
			nodigit : /^[^0-9]+$/,
			number : /^[-+]?\d*\.?\d+$/,
			email : /^([a-zA-Z0-9_\.\-\+%])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
			image : /.(jpg|jpeg|png|gif|bmp)$/i,
			phone : /^\+{0,1}[0-9 \(\)\.\-]+$/,
			phone2 : /^[\d\s ().-]+$/,
			phone3 : /^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/,
			phone_inter : /^\+{0,1}[0-9 \(\)\.\-]+$/,
			url : /^(http|https|ftp)\:\/\/[a-z0-9\-\.]+\.[a-z]{2,3}(:[a-z0-9]*)?\/?([a-z0-9\-\._\?\,\'\/\\\+&amp;%\$#\=~])*$/i,
			date: /(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d/
		}
	},

	/*
	Constructor: initialize
		Constructor

		Add event on formular and perform some stuff, you now, like settings, ...
	*/
	initialize : function(form, options) {
		if ((this.form = $(form))) {
			var own = this;
			own.form.isValid = true;
			own.regex = ['length'];
			own.groups = {};

			own.setOptions(options);
			var opts = own.options;

			 this.UI = (FormCheck.UI)&&
				 new FormCheck.UI(this, this.options);

			 if (typeof(formcheckLanguage) != 'undefined')
				 this.options.alerts = $merge(this.options.alerts, formcheckLanguage);

			this.Locale = (FormCheck.Locale && typeof(formcheckLanguage) == 'undefined')?
				new FormCheck.Locale(this, this.options):
				this.options;

			own.form.setProperty('action',
				opts.submitAction || own.form.getProperty('action') || '');

			own.form.setProperty('method',
				opts.submitMethod || own.form.getProperty('method') || 'post');

			own.validations = [];
			own.alreadyIndicated = false;
			own.firstError = false;

			$H(opts.regexp).each(function(_, key) {
				own.regex.push(key);
			});

			own.addValidator(own.options.validate, false);

			own.form.getElements("*[class*=validate]").each(function(el) {
				own.register(el);
			});

			own.form.addEvents({
				"submit": own.onSubmit.bind(own)
			});

			if (own.options.display.indicateErrorsInit) {
				own.validations.each(function(el) {
					if(!own.manageError(el,'submit')) own.form.isValid = false;
				});
			}
		}
	},

	/*
	Private Method: cpuValidator

		Processes adding validation to an element
	*/
	cpuValidator: function(el, validators, register){
		if (typeof(validators) == 'string')
			validators = validators.split(/,(?!\s*-*\d])/);

		if (typeof(validators) == 'object'){
			for(var newValidator = "", i = 0, l=validators.length,v=validators; i < l; i++){
				var d = (l-1 > i)?"',":"'";
				newValidator += "'"+v[i].replace(' ', '')+d;
			}
			validators = newValidator;
		}
		if (validators){
			var validate = 'validate['+ validators +']';

			var classX = el.getProperty('class').replace(/\s?validate(\[.+\])/, '');
			el.setProperty('class', classX);
			el.addClass(validate);

			if (register){
				register = typeof(register) == 'number'?
					register:false;
				this.register(el, register);
			}
		}
	},

	/*
	Public Method: addValidator
		Allows you to register Element/s with formcheck and declare it's validation rules or overwrite the existing rules.
		It accepts object pairs of (string) element's id or CSS selector : (mixed) "validators" or [validators],
		Followed by (boolean) register or (number) position

	Example:
		(code)
		window.addEvent('domready', function() {
				formcheck = new FormCheck('form_id', {
						validate: {
								'element_id': [mixed],
								'input[type=checkbox]' : ['checkbox'],
								'fieldID' : "required, digit[1,3]"
						}
				});
				// ...some code...

				new Element('input', {
					id: "new-field",
					name: "new-field"
				}).inject('form_id');

				new Element('input', {
					id: "new-field2",
					name: "new-field2"
				}).inject('form_id');

				formcheck.addValidator({
					'new-field' : ['required','phone'],
					'new-field2' : ['required','url'],
				}, true);

				new Element('input', {
					id: "another-field",
					name: "another-field"
				}).inject('form_id', 'top'); //NOTE: is injected to the top of the form

				formcheck.addValidator({
					'another-field"' : "required,phone,digit(1|3)"
				}, 1); //Since it's at the top we want to move it's validation que to the top.
		});

	See also:
		<FormCheck::register>
		<FormCheck::dispose>
	*/
	addValidator: function(el, register){
		var own = this;
		$each(el, function(validators, el){
			if($chk($(el))){
				el = $(el);
				own.cpuValidator(el, validators, register);
			} else if($chk($$(el))){
					$$(el).each(function(el){
						own.cpuValidator(el, validators, register);
				});
			}
		});
	},

	/*
	Function: register
		Allows you to declare afterward new fields to the formcheck, to check dynamically loaded fields for example.
		By default it will be the last element to be validated as it's added after others inputs, but you can define a position with second parameter.

	Example:
		(code)
		<script type="text/javascript">
			window.addEvent('domready', function() {
				formcheck = new FormCheck('form_id');
			});

			// ...some code...

			var newField = new Element('input', {
				class	: "validate['required']",
				name	: "new-field"
			}).inject('form_id');
			formcheck.register(newField, 3);

			new Element('input', {
				class	: "validate['required']",
				name	: "another-field",
				id		: "another-field"
			}).inject('form_id');
			formcheck.register($('another-field'));
		</script>
		(end code)

	See also:
		<FormCheck::dispose>
	*/
	register : function(el, position) {
		var own = this, validators;
		el.validation = [];
		if(!(validators = eval(el.getProperty("class").match(/validate(\[.+\])/)[1])))
			return;
		
		var valid = true;
		validators.each(function(v) {
			el.validation.push(v);
			if (v.match(/^confirm:/)) {
				var field = v.match(/.+:(.+)$/)[1];
				if (own.form[field].validation.contains('required')) el.validation.push('required');
			}
			if (v.match(/^target:.+/))
				el.target = v.match(/^target:(.+)/)[1];
		});

		//we check if group is already registered
		el.isChild = own.isChildType(el, validators);
		if (el.isChild && el.type == 'radio') {
			own.validations.each(function(registeredEl){
				if (registeredEl.name == el.name) valid = false;
			});
		}
		if (el.isChild && el.type == 'checkbox') {
			own.validations.each(function(registeredEl){
				if (registeredEl.groupID == el.groupID) valid = false;
			});
		}

		if (position && position <= own.validations.length) {
			var newValidations = [];
			own.validations.each(function(valider, i){
				if (position == i+1 && valid) {
					newValidations.push(el);
					own.addListener(el);
				}
				newValidations.push(valider);
			});
			own.validations = newValidations;
		} else if (valid) {
			own.validations.push(el);
			own.addListener(el);
		}
	},

	/*
	Function: dispose
		Allows you to remove a declared field from formCheck

	Example:
		(code)
		<script type="text/javascript">
			window.addEvent('domready', function() {
				formcheck = new FormCheck('form_id');
			});

			// ...some code...

			formcheck.dispose($('obsolete-field'));
		</script>
		(end code)

	See also:
		<FormCheck::register>
	*/
	dispose : function(element) {
		this.validations.erase(element);
	},
	
	/*
	Function: checkChild
		Private method

		extends addListener
	*/
	checkChild: function(el){
		var own = this, opts = own.options;
		if (!el.isChild) {
			el.addEvent('blur', function() {
				if(!own.fxRunning && (el.element || opts.display.showErrors == 1) && (opts.display.checkValueIfEmpty || el.value))
					own.manageError(el, 'blur');
			});
		//We manage errors on radio
		} else if(el.isChild && el.type == 'radio') {
			//We get all radio from the same group and add a blur option
			var radioGroup = own.form.getElements('input[name="'+ el.getProperty("name") +'"]');
			radioGroup.each(function(radio){
				radio.addEvent('blur', function(){
					if(!own.fxRunning && (el.element || opts.display.showErrors == 1) && (opts.display.checkValueIfEmpty || el.value))
						own.manageError(el, 'click');
				});
			});
		}
	},

	/*
	Function: addListener
		Private method

		Add listener on fields
	*/
	addListener : function(el) {
		var own = this;
		el.errors = [];

		if (el.validation[0] == 'submit')
			return el.addEvent('click', function(e){
				if (own.onSubmit(e))
					own.form.submit();
			});

		return own.checkChild(el);
	},

	/*
	Function: manageError
		Private method

		Manage display of errors boxes
		TODO:
		Implement UI extension, or ??????
		UI extension will provide
	*/
	manageError : function(el, method) {
		var own = this, opts = own.options;
		var isValid = own.validate(el);
		if (method == 'testonly') return isValid;
		if ((!isValid && el.validation.contains('required')) || (el.value && !isValid)) {
			if(opts.display.listErrorsAtTop && method == 'submit') own.listErrorsAtTop(el);
			if (opts.display.indicateErrors == 2 ||own.alreadyIndicated == false || el == own.alreadyIndicated) {
				if(!own.firstError) own.firstError = el;
				own.alreadyIndicated = el;

				if (opts.display.keepFocusOnError && el == own.firstError)
					(function(){el.focus()}).delay(10);
				
				own.addError(el);
				return false;
			}
		} else if ((isValid || (!el.validation.contains('required') && !el.value))) {
			own.removeError(el);
			return true;
		}
		return true;
	},

	/*
	Function: validate
		Private method

		Dispatch check to other methods
	*/
	validate : function(el) {
		var own = this, opts = own.options;
		el.errors = [];
		el.isOk = true;

		//skip validation for disabled fields and trim if specified
		if (!opts.validateDisabled && el.get('disabled')) return true;
		if (opts.trimValue && el.value.length > 0) el.value = el.value.trim();

		el.validation.each(function(rule) {
			if(el.isChild) {
				if (!own.validateGroup(el)) el.isOk = false;
			} else {
				var ruleArgs = [];

				if(rule.match(/target:.+/)) return;
				var ruleMethod = rule;
				if(rule.match(/^.+\[/)) {
					ruleMethod = rule.split('[')[0];
					ruleArgs = eval(rule.match(/^.+(\[.+\])$/)[1].replace(/([A-Z0-9\._-]+)/i, "'$1'"));
				}

				if (own.regex.contains(ruleMethod) && el.get('tag') != "select") {
					if (own.validateRegex(el, ruleMethod, ruleArgs) == false) {
						el.isOk = false;
					}
				}
				if (rule.match(/confirm:.+/)) {
					ruleArgs = [rule.match(/.+:(.+)$/)[1]];
					if (own.validateConfirm(el, ruleArgs) == false) {
						el.isOk = false;
					}
				}
				if (rule.match(/differs:.+/)) {
					ruleArgs = [rule.match(/.+:(.+)$/)[1]];
					if (own.validateDiffers(el, ruleArgs) == false) {
						el.isOk = false;
					}
				}
				if (ruleMethod == 'words') {
					if (own.validateWords(el, ruleArgs) == false) {
						el.isOk = false;
					}
				}
				if (ruleMethod == 'required' && (el.get('tag') == "select" || el.type == "checkbox")) {
					if (own.simpleValidate(el) == false) {
						el.isOk = false;
					}
				}
				if(rule.match(/%[A-Z0-9\._-]+$/i) || (el.isOk && rule.match(/~[A-Z0-9\._-]+$/i))) {
					if(eval(rule.slice(1)+'(el)') == false) {
						el.isOk = false;
					}
				}
			}
		});
		return ( el.isOk ) ? true : false;
	},

	/*
	Function: simpleValidate
		Private method

		Perform simple check for select fields and checkboxes
	*/
	simpleValidate : function(el) {
		var alerts = this.Locale.alerts;
		if(el.get('tag') == 'select'){
			if(!el.multiple) {
				if(el.selectedIndex <= 0) {
					el.errors.push(alerts.select);
					return false;
				}
			} else {
				var selected = false;
				el.getChildren('option').each(function(el){
					if(el.selected) selected = true;
				});

				if(!selected){
					el.errors.push(alerts.select_multiple);
					return false;
				}
			}
		} else if (el.type == "checkbox" && el.checked == false) {
			el.errors.push(alerts.checkbox);
			return false;
		}
		return true;
	},

	/*
	Function: validateRegex
		Private method

		Perform regex validations
	*/
	validateRegex : function(el, ruleMethod, ruleArgs) {
		var opts = this.options;
		var alerts = this.Locale.alerts;
		var msg = "";
		if (ruleMethod == 'length' && ruleArgs[1]) {
			if (ruleArgs[1] == -1) {
				opts.regexp.length = new RegExp("^[\\s\\S]{"+ ruleArgs[0] +",}$");
				msg = alerts.lengthmin.replace("%0",ruleArgs[0]);
			} else if(ruleArgs[0] == ruleArgs[1]) {
				opts.regexp.length = new RegExp("^[\\s\\S]{"+ ruleArgs[0] +"}$");
				msg = alerts.length_fix.replace("%0",ruleArgs[0]);
			} else {
				opts.regexp.length = new RegExp("^[\\s\\S]{"+ ruleArgs[0] +","+ ruleArgs[1] +"}$");
				msg = alerts.length_str.replace("%0",ruleArgs[0]).replace("%1",ruleArgs[1]);
			}
		} else if (ruleArgs[0] && ruleMethod == 'length') {
			opts.regexp.length = new RegExp("^.{0,"+ ruleArgs[0] +"}$");
			msg = alerts.lengthmax.replace("%0",ruleArgs[0]);
		} else {
			msg = alerts[ruleMethod];
		}
		if ((ruleMethod == 'digit' || ruleMethod == 'number') && ruleArgs[1]) {
			var valueres, regres = true;
			if (!opts.regexp[ruleMethod].test(el.value)) {
				el.errors.push(alerts[ruleMethod]);
				regres = false;
			}
			if (ruleArgs[1] == -1) {
				valueres = ( el.value.toFloat() >= ruleArgs[0].toFloat() );
				msg = alerts.digitmin.replace("%0",ruleArgs[0]);
			} else {
				valueres = ( el.value.toFloat() >= ruleArgs[0].toFloat() && el.value.toFloat() <= ruleArgs[1].toFloat() );
				msg = alerts.digitltd.replace("%0",ruleArgs[0]).replace("%1",ruleArgs[1]);
			}
			if (regres == false || valueres == false) {
				el.errors.push(msg);
				return false;
			}
		} else if (opts.regexp[ruleMethod].test(el.value) == false)  {
			el.errors.push(msg);
			return false;
		}
		return true;
	},

	/*
	Function: validateConfirm
		Private method

		Perform confirm validations
	*/
	validateConfirm: function(el,ruleArgs) {
		var alerts = this.Locale.alerts;
		var confirm = ruleArgs[0];
		if(el.value != this.form[confirm].value){
			var msg = ( this.options.display.titlesInsteadNames ) ?
				alerts.confirm.replace("%0",this.form[confirm].getProperty('title')) :
				alerts.confirm.replace("%0",confirm);
			el.errors.push(msg);
			return false;
		}
		return true;
	},

	/*
	Function: validateDiffers
		Private method

		Perform differs validations
	*/
	validateDiffers: function(el,ruleArgs) {
		var alerts = this.Locale.alerts;
		var differs = ruleArgs[0];
		if(el.value == this.form[differs].value){
			var msg = ( this.options.display.titlesInsteadNames ) ?
				alerts.differs.replace("%0",this.form[differs].getProperty('title')) :
				alerts.differs.replace("%0",differs);
			el.errors.push(msg);
			return false;
		}
		return true;
	},

	/*
	Function: validateWords
		Private method

		Perform word count validation
	*/
	validateWords: function(el,ruleArgs) {
		var alerts = this.Locale.alerts;
		var min = ruleArgs[0];
		var max = ruleArgs[1];

		var words = el.value.replace(/[ \t\v\n\r\f\p]/m, ' ').replace(/[,.;:]/g, ' ').clean().split(' ');

		if(max == -1) {
			if(words.length < min) {
				el.errors.push(alerts.words_min.replace("%0", min).replace("%1", words.length));
				return false;
			}
		} else {
			if(min > 0)	{
				if(words.length < min || words.length > max) {
					el.errors.push(alerts.words_range.replace("%0", min).replace("%1", max).replace("%2", words.length));
					return false;
				}
			} else {
				if(words.length > max) {
					el.errors.push(alerts.words_max.replace("%0", max).replace("%1", words.length));
					return false;
				}
			}
		}
		return true;
	},


	/*
	Function: isFormValid
		public method

		Determine if the form is valid

		Return true or false
	*/
    isFormValid: function() {
		var own = this;
		own.form.isValid = true;
		own.validations.each(function(el) {
			var validation = own.manageError(el,'testonly');
			if(!validation) own.form.isValid = false;
		});
		return own.form.isValid;
	},

	/*
	Function: isChildType
		Private method

		Determine if the field is a group of radio, of checkboxes or not.
	*/
	isChildType: function(el, validators) {
		var validator;
		if($defined(el.type) && el.type == 'radio') {
			return true;
		} else if((validator = validators.join().match(/group(\[.*\])/))) {
			var group = eval(validator[1]);
			this.groups[group[0]] = this.groups[group[0]] || [];
			this.groups[group[0]][0] = this.groups[group[0]][0] || [];
			this.groups[group[0]][1] = group[1] || this.groups[group[0]][1] || 1;
			this.groups[group[0]][0].push(el);
			el.groupID = group[0];
			return true;
		}
		return false;
	},

	/*
	Function: validateGroup
		Private method

		Perform radios validations
	*/
	validateGroup : function(el) {
		var alerts = this.Locale.alerts;
		el.errors = [];
		if(el.type == 'radio') {
			var nlButtonGroup = this.form[el.getProperty("name")];
			el.group = nlButtonGroup;
			var cbCheckeds = false;

			for(var i = 0; i < nlButtonGroup.length; i++) {
				if(nlButtonGroup[i].checked)
					cbCheckeds = true;
			}
			if(cbCheckeds == false) {
				el.errors.push(alerts.radios);
				return false;
			} else {
				return true;
			}
		// we have group of checkboxes
		} else if(el.type == 'checkbox') {
			//we get length of checked elements
			var checked = 0;
			this.groups[el.groupID][0].each(function(groupEl){
				if(groupEl.checked) checked++;
			});
			if(checked >= this.groups[el.groupID][1]) {
				return true;
			} else {
				( this.groups[el.groupID][0].length > 1 ) ?
					el.errors.push(alerts.checkboxes_group.replace('%0', this.groups[el.groupID][1])) :
					el.errors.push(alerts.checkbox);
				return false;
			}
		// we have unmanaged type
		} else {
			return false;
		}
	},

	/*
	Function: listErrorsAtTop
		Private method

		Display errors
	*/
	listErrorsAtTop : function(obj) {
		if(!this.form.element) {
			 this.form.element = new Element('div', {'id' : 'errorlist', 'class' : this.options.errorClass}).inject(this.form, 'top');
		}
		if ($type(obj) == 'collection') {
			new Element('p').set('html',"<span>" + obj[0].name + " : </span>" + obj[0].errors[0]).inject(this.form.element);
		} else {
			if ((obj.validation.contains('required') && obj.errors.length > 0) || (obj.errors.length > 0 && obj.value && obj.validation.contains('required') == false)) {
				obj.errors.each(function(error) {
					new Element('p').set('html',"<span>" + obj.name + " : </span>" + error).inject(this.form.element);
				}, this);
			}
		}
		window.fireEvent('resize');
	},

	/*
	Function: addError
		Private method

		Add error message
	*/
	addError : function(obj) {
		var own = this, opts = own.options;
		//determine position
		var coord = obj.target ? $(obj.target).getCoordinates() : obj.getCoordinates();

		if(!obj.element && opts.display.indicateErrors != 0) {
			if (opts.display.errorsLocation == 1) {
				var pos = (opts.display.tipsPosition == 'left') ? coord.left : coord.right;
				var options = {
					'opacity' : 0,
					'position' : 'absolute',
					'float' : 'left',
					'left' : pos + opts.display.tipsOffsetX
				};
				obj.element = new Element('div', {'class' : opts.tipsClass, 'styles' : options}).inject(document.body);
				own.addPositionEvent(obj);
			} else if (opts.display.errorsLocation == 2){
				obj.element = new Element('div', {'class' : opts.errorClass, 'styles' : {'opacity' : 0}}).inject(obj, 'before');
			} else if (opts.display.errorsLocation == 3){
				obj.element = new Element('div', {'class' : opts.errorClass, 'styles' : {'opacity' : 0}});
				if ($type(obj.group) == 'object' || $type(obj.group) == 'collection')
					obj.element.inject(obj.group[obj.group.length-1], 'after');
				else
					obj.element.inject(obj, 'after');
			}
		}
		if (obj.element && obj.element != true) {
			obj.element.empty();
			if (opts.display.errorsLocation == 1) {
				var errors = [];
				obj.errors.each(function(error) {
					errors.push(new Element('p').set('html', error));
				});
				var tips = this.UI.makeTips(errors).inject(obj.element);
				if(opts.display.closeTipsButton) {
					tips.getElements('a.close').addEvent('mouseup', function(){
						own.removeError(obj, 'tip');
					});
				}
				obj.element.setStyle('top', coord.top - tips.getCoordinates().height + opts.display.tipsOffsetY);
			} else {
				obj.errors.each(function(error) {
					new Element('p').set('html',error).inject(obj.element);
				});
			}

			if (!opts.display.fadeDuration || Browser.Engine.trident && Browser.Engine.version == 5 && opts.display.errorsLocation < 2) {
				obj.element.setStyle('opacity', 1);
			} else {
				obj.fx = new Fx.Tween(obj.element, {
					duration : opts.display.fadeDuration,
					ignore : true,
					onStart : function(){
						own.fxRunning = true;
					},
					onComplete : function() {
						own.fxRunning = false;
						if (obj.element && obj.element.getStyle('opacity').toInt() == 0) {
							obj.element.destroy();
							obj.element = false;
						}
					}
				});
				if(obj.element.getStyle('opacity').toInt() != 1) obj.fx.start('opacity', 1);
			}
		}
		if (opts.display.addClassErrorToField && !obj.isChild){
			obj.addClass(opts.fieldErrorClass);
			obj.element = obj.element || true;
		}

	},

	/*
	Function: addPositionEvent

		Update tips position after a browser resize
	*/
	addPositionEvent : function(obj) {
		var opts = this.options;
		if(opts.display.replaceTipsEffect) {
			obj.event = function(){
				var coord = obj.target ? $(obj.target).getCoordinates() : obj.getCoordinates();
				new Fx.Morph(obj.element, {
					'duration' : opts.display.fadeDuration
				}).start({
					'left':[obj.element.getStyle('left'), coord.right + opts.display.tipsOffsetX],
					'top':[obj.element.getStyle('top'), coord.top - obj.element.getCoordinates().height + opts.display.tipsOffsetY]
				});
			};
		} else {
			obj.event = function(){
				var coord = obj.target ? $(obj.target).getCoordinates() : obj.getCoordinates();
				obj.element.setStyles({
					'left':coord.right + opts.display.tipsOffsetX,
					'top':coord.top - obj.element.getCoordinates().height + opts.display.tipsOffsetY
				});
			};
		}
		window.addEvent('resize', obj.event);
	},

	/*
	Function: removeError
		Private method

		Remove the error display
	*/
	removeError : function(obj, method) {
		var own = this;
		var opts = own.options;
		if ((opts.display.addClassErrorToField && !obj.isChild && opts.display.removeClassErrorOnTipClosure) || (opts.display.addClassErrorToField && !obj.isChild && !opts.display.removeClassErrorOnTipClosure && method != 'tip'))
			obj.removeClass(opts.fieldErrorClass);

		if (!obj.element) return;
		own.alreadyIndicated = false;
		obj.errors = [];
		obj.isOK = true;
		window.removeEvent('resize', obj.event);
		if (opts.display.errorsLocation >= 2 && obj.element) {
			new Fx.Tween(obj.element, {
				'duration': opts.display.fadeDuration
			}).start('height', 0);
		}
		if (!opts.display.fadeDuration || Browser.Engine.trident && Browser.Engine.version == 5 && opts.display.errorsLocation == 1 && obj.element) {
			own.fxRunning = true;
			obj.element.destroy();
			obj.element = false;
			(function(){own.fxRunning = false}).delay(200);
		} else if (obj.element && obj.element != true) {
			obj.fx.start('opacity', 0);
		}
	},

	/*
	Function: focusOnError
		Private method

		Create set the focus to the first field with an error if needed
	*/
	focusOnError : function (obj) {
		var own = this, opts = own.options;
		if (opts.display.scrollToFirst && !own.alreadyFocused && !own.isScrolling) {
			var objEl = obj.element && obj.element.getCoordinates().top;
			var dest = {1: objEl, 2: objEl-30, 3: obj.getCoordinates().top-30};
			dest = (opts.display.indicateErrors)&&
				dest[opts.display.errorsLocation || 3] || dest[3];
			if (window.getScroll().y != dest) {
				new Fx.Scroll(window, {
					onStart: function(){
						own.isScrolling = true;
					},
					onComplete : function() {
						own.isScrolling = false;
						if (obj.getProperty('type') != 'hidden')
							obj.focus();
					}
				}).start(0,dest);
			} else {
				own.isScrolling = false;
				obj.focus();
			}
			own.alreadyFocused = true;
		}
	},

	/*
	Function: reinitialize
		Reinitialize form before submit check. You can use this also to remove all tips from a form, passing the argument "forced" ( formcheck.reinitialize('forced'); )
	*/
	reinitialize: function(forced) {
		var own = this;
		own.validations.each(function(el) {
			if (el.element) {
				el.errors = [];
				el.isOK = true;
				if(own.options.display.flashTips == 1 || forced == 'forced') {
					el.element.destroy();
					el.element = false;
				}
			}
		});
		if (own.form.element) own.form.element.empty();
		own.alreadyFocused = false;
		own.firstError = false;
		own.elementToRemove = own.alreadyIndicated;
		own.alreadyIndicated = false;
		own.form.isValid = true;
	},

	/*
	Function: ajaxSubmit
		Private method

		Send the form by ajax, and replace the ajaxUpdate with response
	*/
	ajaxSubmit: function(ajaxOptions) {
		Request[this.options.ajaxSubmit]?
			new Request[this.options.ajaxSubmit](ajaxOptions).send():
			new Request(ajaxOptions).send();
		return false;
	},

	/*
	Function: ajaxOptions
		Private method

		sets the ajaxOptions for the user.
	*/
	ajaxOptions: function(){
		var ajaxOptions = $merge({
			url: this.form.action,
			method: this.form.method,
			data : this.form.toQueryString()
		}, this.options.ajaxOptions);
		return ajaxOptions;
	},

	/*
	Function: onSubmit
		Private method

		Perform check on submit action
	*/
	onSubmit: function() {
		var own = this;
		var opts = own.options;

		own.reinitialize();
		own.fireEvent('onSubmit');

		own.validations.each(function(el) {
			var validation = own.manageError(el,'submit');
			if(!validation) own.form.isValid = false;
		});
		
		if (own.form.isValid) {
			own.fireEvent('validateSuccess');
			return (opts.ajaxSubmit)? own.ajaxSubmit(own.ajaxOptions()):opts.submit;
		} else {
			if (own.elementToRemove && own.elementToRemove != own.firstError && opts.display.indicateErrors == 1) {
				own.removeError(own.elementToRemove);
			}
			own.focusOnError(own.firstError);
			own.fireEvent('validateFailure');
			return false;
		}
	}
});

/*
 * FormCheck UI -Incomplete
 * Extends FormCheck Core to enable UI interface, and manipulation
 * Currently only splits it from the main Core.
 */

FormCheck.UI = new Class({

	Implements: [Options, Events],
	Binds: ['hideHint'],
	options: {
		//extra options go here
		//these will overwrite existing options of FormCheck
		//Since FormCheck's options are already defined when
		//these options are set
		//which allows us to define Extra options!!!
		//As well as utilizing FormChecks defaults
		//EG:
		extendAlerts: $empty,		// allows us to call a custom function to extend alerts to another UI handler
		hintClass: 'fc-hint',
		hints:{						//new hints UI - Allows for adding conditional hints
			enabled: false,			//enable hints
			method: 'click',		//when to show the hint: 'focus', true or 'click', 'mouseover', false
			button: false,			//Use a button instead of the element to display hints, Accepts: true, 'before', 'after' or false to deactivate
			useTips: true,			//Use a graphical tip instead of the title, Accepts: true or 'before', 'after', and false
			titles: false,			//(boolean): display titles in the hints, the title is determined by titlesInsteadNames
			tipOffset:{				//Left + Top|Bottom offsets
				x: -45,
				y: 0
			},
			buttonOffset: {			//margin offset of hint button
				x: 0,
				y: 0
			},
			tips: {}				//Used to store tips in (string) pairs of id : message
		}
	},

	initialize: function(parent, options){
		this.parent = parent;
		this.setOptions(options);

		document.addEvent('mousewheel', function(){
			parent.isScrolling = false;
		});
	},

	/*
	Function: makeTips
		Private method

		Create tips boxes
	*/
	makeTips : function(txt) {
		var errBox = new Element('div', {'class': 'fc-tbx'});
		var tl = new Element('div', {'class': 'tl'});
		var tr  = new Element('div', {'class': 'tr'});
		var t = new Element('div', {'class': 't'});
		var l = new Element('div', {'class': 'l'});
		var close = new Element('a', {'class': 'close'});
		var r = new Element('div', {'class': 'r'});
		var c = new Element('div', {'class': 'c'});
		txt.each(function(error){error.inject(c);});
		var bl = new Element('div', {'class': 'bl'});
		var br = new Element('div', {'class': 'br'});
		var b = new Element('div', {'class': 'b'});
		return errBox.adopt(tl.adopt(tr.adopt(t)), l.adopt(close, r.adopt(c)), bl.adopt(br.adopt(b)));
	},

	/*
	Function: addHints
		Private method

		Add hints to Form
	*/
	addHints: function(){
		if (this.options.hints.enabled){
			if(this.options.hints.button === true)
				this.options.hints.button = 'after';
			if(this.options.hints.method === true)
				this.options.hints.method = this.options.hints.button?'mouseover':'click';
			if(this.options.hints.useTips === true)
				this.options.hints.useTips = 'before';
			/* TODO: make these resetable */
			if(this.parent.Locale.localeSet)
				this.parent.form.getElements("*[title*]").each(function(el){
					if(el.oTitle){
						el.set('title', el.oTitle);
						el.hint = null;
					}
				});
			this.parent.form.getElements("*[title*=hint]").each(function(el) {
				this.makeHints(el);
			}, this);
		}
	},

	/*
	Function: makeHints
		Private method

		Binds hints to the elements prototype
		and handle display type
	*/
	makeHints: function(el){
		var hint = $try(
			function(){
				var c = eval(el.getProperty("title").match(/hint(\[.+\])/)[1]);
				return c==''?el.get('id'):c;
			},
			function(){ return el.get('id'); }
		);
		el.oTitle = el.getProperty('title');
		el.setProperty('title', el.getProperty('title').replace(/\s?hint(\[.+\])/, '').trim()); //since this element has a hint remove it
		el.hint = this.parent.Locale.hints[hint]; //Get the hint's info from the Locale
		if(!el.hint || el.hint == '') return; //No hint found break from this element
		
		this.options.hints.button?
			this.makeHintButton(el):
			this.hintEvents(el, el);
	},

	/*
	Function: hintEvents
		Private method

		Determines if hintEvents are to be used or not.
	*/
	hintEvents: function(el, info){
		var hideHint = this.hideHint.bind(this);
		if (this.options.hints.method){
			info.addEvent(this.options.hints.method, function(){
				this.showHint(el, info);
			}.bind(this));
			this.parent.addEvent('onSubmit', hideHint);
		} else
			info.setProperty('title', el.hint);
	},

	/*
	Function: removeHintEvents
		Private method

		removes the hint tip hide events
	*/
	removeHintEvents: function(){
		this.HintEvent.removeEvents({'blur': this.boundhideHint, 'mouseout': this.boundhideHint});
	},

	/*
	Function: makeHintButton
		Private method

		Create hint buttons
	*/
	makeHintButton: function(el){
		if(el.hintBtn)
			el.hintBtn.dispose();
		el.hintBtn = new Element('div', {
			'class': this.options.hintClass +'-button',
			'styles':{
				'margin-left': this.options.hints.buttonOffset.x+'px',
				'margin-top': this.options.hints.buttonOffset.y+'px'
			}
		}).inject(el, this.options.hints.button);
		this.hintEvents(el, el.hintBtn);
	},

	/*
	 Function: createHintTip
		Private method

		Create the hint tip instance
	*/
	createHintTip: function(){
		this.hintTip = new Element('div', {'class': this.options.hintClass}).set('opacity', 0);
		return this.hintTip.adopt(new Element('div', {'class': 'title'}), new Element('div', {'class': 'content'}));
	},

	/*
	Function: showHint
		Private method

		Handles creating and showing of the tips
	*/
	showHint: function(el){
		if(!this.hintTip){
			this.createHintTip();
			return this.showHint(el);
		}else if(this.hintTip.isShown && this.hintTip.el != el){
			this.removeHintEvents();
			this.hintTip.isShown = false;
			this.hintTip.fade('hide');
			return this.showHint(el);
		}else{
			return this.drawHint(el).fade('in');
		}
	},

	/*
	Function: drawHint
		Private method

		actual drawing of the tip to the screen
	*/
	drawHint: function(el){
		this.boundhideHint = this.hideHint.bind(this);
		if(this.options.hints.method == 'mouseover'){
			this.HintEvent = el.hintBtn || el;
			this.HintEvent.addEvent('mouseout', this.boundhideHint);
		}else{
			this.HintEvent = el;
			el.focus();
			this.HintEvent.addEvent('blur', this.boundhideHint);
		}
		
		var showAt = el || el.hintBtn;
		var thisTitle = this.parent.options.display.titlesInsteadNames?el.title:el.get('name');
		if(this.options.hints.titles)
			this.hintTip.getElements('div.title').set('text', thisTitle);
		this.hintTip.getElements('div.content').set('html', el.hint);
		this.hintTip.inject(showAt, this.options.hints.useTips);
		this.hintTip.el = showAt;
		this.hintTip.isShown = true;
		this.BoundpositionHint = this.positionHint.bind(this);
		window.addEvent('resize', this.BoundpositionHint);
		return this.positionHint();
	},

	/*
	Function positionHint
		Private method

		Positions hints on window resize
	*/
	positionHint: function(){
		if(!this.hintTip.el)
			return false;

		var coord = this.hintTip.el.getCoordinates();
		var hintSize = this.hintTip.getCoordinates();
		var pos = {
			'before' : coord.top - hintSize.height,
			'after': coord.bottom
		};

		return this.hintTip.setStyles({
			'top' : pos[this.options.hints.useTips] - this.options.hints.tipOffset.y,
			'left': coord.right + this.options.hints.tipOffset.x
		});
	},
	
	/*
	Function: hideHint
		Private method

		Hide hint tip and remove it's events
	*/
	hideHint: function(){
		if(this.hintTip){
			window.removeEvent('resize', this.BoundpositionHint);
			this.removeHintEvents();
			this.hintTip.isShown = false;
			this.hintTip.fade('out');
		}
	}
});

/*
  Class: FormCheck.Locale
  Description: Exetends the FormCheck Core class,
 				Allows for dynamic loading of Locale Files,
 				Automatic Locale detection.
 				Supports Fail-Safes, JSON, and PHP generated JSON.
 	NOTE: Locales must be a VALID JSON format to load
 	Usage:
 	var fc = new FormCheck({
 		locale: {
 			url: 'path/to/lang',
 			'default': 'lang-REGION',
 			language: 'en-US', //Turns off auto detect, and forces en-US to load
 			cascade: false //Disables cascade support
 		}
 	})
 */
FormCheck.Locale = new Class({
	Implements: [Options, Events],
	data: {},

	options:{
		locale: {
			url: 'formcheck/lang',				// URI to Language Files
			'default': 'en-EN',					// fail-safe language to fall back to if loading a langugae fails
			language: false,					// false || (string) Forced language file eg: 'en-US'
			cascade: true						// true||false, Allow cascade support, EG: Auto->File->Cascade->File->Fail->Default->Fail-Safe->Internal
		}
	},

	initialize : function(parent, options){
		this.parent = parent;
		this.setOptions(options);

		if (!this.options.locale.language)
			this.options.locale.language = (navigator.language || navigator.userLanguage || navigator.browserLanguage || navigator.systemLanguage || this.options.locale['default'] );
		this.startLocale();
	},

	/*
	Function: startLocale
		Private method

		sets the scope for the locale
	*/
	startLocale: function(){
		var iri = this.options.locale.language.toString().split('-', 2);
		var langTag = iri[0];
		var regionTag = iri[1].toUpperCase();
		this.options.locale.language = langTag + "-" + regionTag;
		var lang = langTag + "-" + regionTag;
		this.getLocale(lang);
	},

	/*
	Function: getLocale
		Public method

		Retrieves and sets the required Locale via Ajax JSON.
		Clears out previously loaded Locale data when used publicly.
	Usage:
		var formCheck = new FormCheck('FormID');
		$('link').addEvent('click', function(){
			formCheck.Locale.getLocale('fr-FR');
		});
	*/
	getLocale: function(lang){
		if(this.localeSet && !this.isLoading)
			this.alerts = {}, this.data = {}, this.hints = {}, this.isLoading = true;

		var url = this.options.locale.url + '/' + lang + '.json';
		if(!Request.JSON)
			return this.setLocale();
		return new Request.JSON({
			url: url,
			noCache: false,
			secure: true,
			onSuccess: function(r){
				if(!this.data[lang])
					this.data[lang] = {};
				if ($chk(r)){
					if(r.definitions)
						this.data[lang] = r.definitions;
					if(r.hints)
						this.data[lang].hints = r.hints;
					if(r.cascade && this.options.locale.cascade && !this.isCascading){
						var cascade = r.cascade;
						if($type(r.cascade) == 'array'){
							if(r.cascade.length > 1){
								this.data[lang].cascades = cascade;
								this.isCascading = lang;
							}
							cascade = r.cascade[0];
						}
						return this.getLocale(cascade);
					}
					if(this.isCascading){
						this.data[this.isCascading].cascades.erase(lang);
						if((cascade = this.data[this.isCascading].cascades[0]))
							return this.getLocale(cascade);
						this.isCascading = null;
					}
				}
				return this.setLocale();
			}.bind(this),
			onFailure: function(){
				var isDefault = (lang == this.options.locale['default']);
				if (this.options.locale.cascade){
					if(this.isCascading){
						this.data[this.isCascading].cascades.erase(lang);
						if((cascade = this.data[this.isCascading].cascades[0]))
							return this.getLocale(cascade);
						
						lang = this.isCascading;
						this.isCascading = null;
					}
					if(isDefault)
						return this.setLocale();

					var iri = lang.toString().split('-', 2);
					var langTag = iri[0];
					var regionTag = iri[0].toUpperCase();
					var defaultLang = langTag + "-" + regionTag;
					var cascade = (lang != defaultLang && !isDefault)?
						defaultLang:
						this.options.locale['default'];
					return this.getLocale(cascade);
				}
				return this.setLocale();
			}.bind(this)
		}).get();
	},

	/*
	Function: setLocale
		Private method

		applies the data stored from getLocale or lack thereof
	*/
	setLocale: function(){
		var data = {};
		$each(this.data, function(v, k){
			data = $merge(v, data);
			data.cascades = null;
			delete data.cascades;
		});

		if(data.hints && this.parent.UI){
			this.hints = $merge(this.parent.UI.options.hints.tips, data.hints);
			this.parent.UI.addHints();
		}
		this.localeSet = true, this.isLoading = false;
		return this.alerts = $merge(this.options.alerts, data);
	}
});