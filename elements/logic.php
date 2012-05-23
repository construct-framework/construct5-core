<?php defined('_JEXEC') or die;
/**
 * @package        Unified HTML5 Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// Call the Construct Template Helper Class
if (JFile::exists(dirname(__FILE__) . '/helper.php')) {
	include dirname(__FILE__) . '/helper.php';
}

// To get an application object
$app = JFactory::getApplication();
// Returns a reference to the global document object
$doc = JFactory::getDocument();
// Checks for any system messages
$messageQueue = $app->getMessageQueue();
// Define relative path to the  current template directory
$template = 'templates/' . $this->template;
// Define absolute path to the template directory
$templateDir = JPATH_THEMES . '/' . $this->template;
// Get the current URL
$url = clone(JURI::getInstance());
// To access the current user object
$user = JFactory::getUser();
// Get the current view
$view = JRequest::getCmd('view');

// Define absolute paths to files
$mdetectFile = $templateDir . '/elements/mdetect.php';
$mTemplate = $templateDir . '/mobile.php';
$alternatemTemplate = $templateDir . '/layouts/mobile.php';

// Change generator tag
$this->setGenerator('Construct Framework | http;//construct-framework.com');

// Enable Mootols
JHtml::_('behavior.framework', true);

// Enable modal pop-ups
JHtml::_('behavior.modal');

// Remove MooTools. Careful, 3PD extensions may rely on MooTools.
/*
// Joomla 2.5
unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-core.js']);
unset($doc->_scripts[$this->baseurl . '/media/system/js/mootools-more.js']);
unset($doc->_scripts[$this->baseurl . '/media/system/js/core.js']);
unset($doc->_scripts[$this->baseurl . '/media/system/js/caption.js']);
unset($doc->_scripts[$this->baseurl . '/media/system/js/modal.js']);
$this->_script['text/javascript'] = preg_replace('%window\.addEvent\(\'load\',\s*function\(\)\s*{\s*new\s*JCaption\(\'img.caption\'\);\s*}\);\s*%', '', $this->_script['text/javascript']);
$this->_script['text/javascript'] = preg_replace('%window\.addEvent\(\'domready\',\s*function\(\)\s*{\s*SqueezeBox.initialize\({}\);\s*SqueezeBox\.assign\(\$\$\(\'a.modal\'\)\,\s*{\s*parse:\s*\'rel\'\s*}\);\s*}\);\s*%', '',$this->_script['text/javascript']);
*/

#----------------------------- Moldule Counts -----------------------------#
// from http://groups.google.com/group/joomla-dev-general/browse_thread/thread/b54f3f131dd173d

$headerAboveCount1 = (int)($this->countModules('header-above-1') > 0);
$headerAboveCount2 = (int)($this->countModules('header-above-2') > 0);
$headerAboveCount3 = (int)($this->countModules('header-above-3') > 0);
$headerAboveCount4 = (int)($this->countModules('header-above-4') > 0);
$headerAboveCount5 = (int)($this->countModules('header-above-5') > 0);
$headerAboveCount6 = (int)($this->countModules('header-above-6') > 0);

$headerAboveCount = $headerAboveCount1 + $headerAboveCount2 + $headerAboveCount3 + $headerAboveCount4 + $headerAboveCount5 + $headerAboveCount6;

if ($headerAboveCount) : $headerAboveClass = 'count-' . $headerAboveCount; endif;

#--------------------------------------------------------------------------#

$headerBelowCount1 = (int)($this->countModules('header-below-1') > 0);
$headerBelowCount2 = (int)($this->countModules('header-below-2') > 0);
$headerBelowCount3 = (int)($this->countModules('header-below-3') > 0);
$headerBelowCount4 = (int)($this->countModules('header-below-4') > 0);
$headerBelowCount5 = (int)($this->countModules('header-below-5') > 0);
$headerBelowCount6 = (int)($this->countModules('header-below-6') > 0);

$headerBelowCount = $headerBelowCount1 + $headerBelowCount2 + $headerBelowCount3 + $headerBelowCount4 + $headerBelowCount5 + $headerBelowCount6;

if ($headerBelowCount) : $headerBelowClass = 'count-' . $headerBelowCount; endif;

#--------------------------------------------------------------------------#

$navBelowCount1 = (int)($this->countModules('nav-below-1') > 0);
$navBelowCount2 = (int)($this->countModules('nav-below-2') > 0);
$navBelowCount3 = (int)($this->countModules('nav-below-3') > 0);
$navBelowCount4 = (int)($this->countModules('nav-below-4') > 0);
$navBelowCount5 = (int)($this->countModules('nav-below-5') > 0);
$navBelowCount6 = (int)($this->countModules('nav-below-6') > 0);

$navBelowCount = $navBelowCount1 + $navBelowCount2 + $navBelowCount3 + $navBelowCount4 + $navBelowCount5 + $navBelowCount6;

if ($navBelowCount) : $navBelowClass = 'count-' . $navBelowCount; endif;

#--------------------------------------------------------------------------#

$contentAboveCount1 = (int)($this->countModules('content-above-1') > 0);
$contentAboveCount2 = (int)($this->countModules('content-above-2') > 0);
$contentAboveCount3 = (int)($this->countModules('content-above-3') > 0);
$contentAboveCount4 = (int)($this->countModules('content-above-4') > 0);
$contentAboveCount5 = (int)($this->countModules('content-above-5') > 0);
$contentAboveCount6 = (int)($this->countModules('content-above-6') > 0);

$contentAboveCount = $contentAboveCount1 + $contentAboveCount2 + $contentAboveCount3 + $contentAboveCount4 + $contentAboveCount5 + $contentAboveCount6;

if ($contentAboveCount) : $contentAboveClass = 'count-' . $contentAboveCount; endif;

#--------------------------------------------------------------------------#

$contentBelowCount1 = (int)($this->countModules('content-below-1') > 0);
$contentBelowCount2 = (int)($this->countModules('content-below-2') > 0);
$contentBelowCount3 = (int)($this->countModules('content-below-3') > 0);
$contentBelowCount4 = (int)($this->countModules('content-below-4') > 0);
$contentBelowCount5 = (int)($this->countModules('content-below-5') > 0);
$contentBelowCount6 = (int)($this->countModules('content-below-6') > 0);

$contentBelowCount = $contentBelowCount1 + $contentBelowCount2 + $contentBelowCount3 + $contentBelowCount4 + $contentBelowCount5 + $contentBelowCount6;

if ($contentBelowCount) : $contentBelowClass = 'count-' . $contentBelowCount; endif;

#--------------------------------------------------------------------------#

$footerAboveCount1 = (int)($this->countModules('footer-above-1') > 0);
$footerAboveCount2 = (int)($this->countModules('footer-above-2') > 0);
$footerAboveCount3 = (int)($this->countModules('footer-above-3') > 0);
$footerAboveCount4 = (int)($this->countModules('footer-above-4') > 0);
$footerAboveCount5 = (int)($this->countModules('footer-above-5') > 0);
$footerAboveCount6 = (int)($this->countModules('footer-above-6') > 0);

$footerAboveCount = $footerAboveCount1 + $footerAboveCount2 + $footerAboveCount3 + $footerAboveCount4 + $footerAboveCount5 + $footerAboveCount6;

if ($footerAboveCount) : $footerAboveClass = 'count-' . $footerAboveCount; endif;

#------------------------------ Column Layout -----------------------------#

$column1Count = (int)($this->countModules('column-1') > 0);
$column2Count = (int)($this->countModules('column-2') > 0);

$columnGroupAlphaCount = $column1Count + $column2Count;

if ($columnGroupAlphaCount) : $columnGroupAlphaClass = 'count-' . $columnGroupAlphaCount; endif;

$column3Count = (int)($this->countModules('column-3') > 0);
$column4Count = (int)($this->countModules('column-4') > 0);

$columnGroupBetaCount = $column3Count + $column4Count;
if ($columnGroupBetaCount) : $columnGroupBetaClass = 'count-' . $columnGroupBetaCount; endif;

$columnLayout = 'main-only';

if (($columnGroupAlphaCount > 0) && ($columnGroupBetaCount == 0)) :
	$columnLayout = 'alpha-' . $columnGroupAlphaCount . '-main';
elseif (($columnGroupAlphaCount > 0) && ($columnGroupBetaCount > 0)) :
	$columnLayout = 'alpha-' . $columnGroupAlphaCount . '-main-beta-' . $columnGroupBetaCount;
elseif (($columnGroupAlphaCount == 0) && ($columnGroupBetaCount > 0)) :
	$columnLayout = 'main-beta-' . $columnGroupBetaCount;
endif;

#-------------------------------- Item ID ---------------------------------#

$itemId = JRequest::getInt('Itemid', 0);

#------------------------------- Article ID -------------------------------#

if ($view == 'article')
	$articleId = JRequest::getInt('id');
else ($articleId = NULL);

#------------------------------ Category ID -------------------------------#

function getCategory($id)
{
	$database = JFactory::getDBO();
	if (JRequest::getCmd('view', 0) == "section") {
		return null;
	}
	elseif ((JRequest::getCmd('view', 0) == "category") || (JRequest::getCmd('view', 0) == "categories")) {
		return $id;
	}
	elseif (JRequest::getCmd('view', 0) == "article") {
		$temp = explode(":", $id);
		$sql = "SELECT catid FROM #__content WHERE id = " . $temp[0];
		$database->setQuery($sql);
		return $database->loadResult();
	}
}

$catId = getCategory(JRequest::getInt('id'));

#------------------------- Ancestor Category IDs --------------------------#

function getParentCategory($id)
{
	$database = JFactory::getDBO();
	$sql = "SELECT parent_id
		FROM #__categories
		WHERE id = $id";
	$database->setQuery($sql);
	return $database->loadResult();
}

$parentCategory = getParentCategory($catId);

function getAncestorCategories($id)
{
	$database = JFactory::getDBO();
	$sql = "SELECT b.id, b.title
		FROM #__categories a,
		#__categories b
		WHERE a.id = $id
		AND a.lft > b.lft
		AND a.rgt < b.rgt
		AND a.id <> b.id
		AND b.lft > 0";
	$database->setQuery($sql);
	return $database->loadObjectList();
}

#--------------------------------- Alias ----------------------------------#

if ($itemId) {
	$currentAlias = $app->getMenu()->getActive()->alias;
}

#----------------------------- Component Name -----------------------------#

$currentComponent = JRequest::getCmd('option');

#------------------Extended Template Style Overrides------------------------#

$styleOverride = new ConstructTemplateHelper ();

$styleOverride->includeFile = array();

$styleOverride->includeFile[] = $template . '/css/article/article-' . $articleId . '.css';
$styleOverride->includeFile[] = $template . '/css/article/article.css';
$styleOverride->includeFile[] = $template . '/css/item/item-' . $itemId . '.css';
$styleOverride->includeFile[] = $template . '/css/category/category-' . $catId . '.css';
$styleOverride->includeFile[] = $template . '/css/category/category-' . $parentCategory . '.css';
$results = getAncestorCategories($catId);
if (count($results) > 0) {
	foreach ($results as $result) {
		$styleOverride->includeFile[] = $template . '/css/category/category-' . $result->id . '.css';
	}
}
if ($view == 'category') {
	$styleOverride->includeFile[] = $template . '/css/category/category.css';
}
if ($view == 'categories') {
	$styleOverride->includeFile[] = $template . '/css/category/categories.css';
}
$styleOverride->includeFile[] = $template . '/css/component/' . $currentComponent . '.css';

#---------------Mobile Extended Template Style Overrides---------------------#

$mobileStyleOverride = new ConstructTemplateHelper ();

$mobileStyleOverride->includeFile = array();

$mobileStyleOverride->includeFile[] = $template . '/css/article/article-' . $articleId . '-mobile.css';
$mobileStyleOverride->includeFile[] = $template . '/css/item/item-' . $itemId . '-mobile.css';
$mobileStyleOverride->includeFile[] = $template . '/css/category/category-' . $catId . '-mobile.css';
$mobileStyleOverride->includeFile[] = $template . '/css/component/' . $currentComponent . '-mobile.css';

#-------------------Extended Template Layout Overrides-----------------------#

$layoutOverride = new ConstructTemplateHelper ();

$layoutOverride->includeFile = array();

$layoutOverride->includeFile[] = $template . '/layouts/article/article-' . $articleId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/article/article.php';
$layoutOverride->includeFile[] = $template . '/layouts/item/item-' . $itemId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/category/category-' . $parentCategory . '.php';

$results = getAncestorCategories($catId);
if (count($results) > 0) {
	foreach ($results as $result) {
		$layoutOverride->includeFile[] = $template . '/layouts/category/category-' . $result->id . '.php';
	}
}

if ($view == 'category') {
	$layoutOverride->includeFile[] = $template . '/layouts/category/category.php';
}
if ($view == 'categories') {
	$layoutOverride->includeFile[] = $template . '/layouts/category/categories.php';
}
$layoutOverride->includeFile[] = $template . '/layouts/component/' . $currentComponent . '.php';
$layoutOverride->includeFile[] = $template . '/layouts/index.php';

#---------------Mobile Extended Template Layout Overrides--------------------#

$mobileLayoutOverride = new ConstructTemplateHelper ();

$mobileLayoutOverride->includeFile = array();

$mobileLayoutOverride->includeFile[] = $template . '/layouts/article/article-' . $articleId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/item/item-' . $itemId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/category/category-' . $catId . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/component/' . $currentComponent . '-mobile.php';
$mobileLayoutOverride->includeFile[] = $template . '/layouts/mobile.php';

#---------------------------- Head Elements --------------------------------#

// Always force latest IE rendering engine (even in intranet) & Chrome Frame
$doc->addCustomTag('<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">');
// Set initial scale of mobile viewport to 100% - see http://bit.ly/sK7Zty
$doc->addCustomTag(' <meta name="viewport" content="width=device-width, initial-scale=1.0">');

$doc->addCustomTag('<meta name="copyright" content="' . htmlspecialchars($app->getCfg('sitename')) . '" />');

// Site icons
$doc->addFavicon($template . '/favicon.png', 'image/png', 'shortcut icon');
$doc->addFavicon($template . '/apple-touch-icon.png', 'image/png', 'apple-touch-icon');

// Style sheet combination and minification
// $doc->addStyleSheet($template.'/css/screen.css.php','text/css','screen');

// Style sheets
$doc->addStyleSheet($template . '/css/screen.css', 'text/css', 'screen');
$doc->addStyleSheet($template . '/css/grids/construct.css', 'text/css', 'screen');
$doc->addStyleSheet($template . '/css/custom.css', 'text/css', 'screen');

if ($this->direction == 'rtl') {
	$doc->addStyleSheet($template . '/css/rtl.css', 'text/css', 'screen');
}
// Override style sheet returned from our template helper
$cssFile = $styleOverride->getIncludeFile();
if ($cssFile) {
	$doc->addStyleSheet($cssFile, 'text/css', 'screen');
}
// Quick port of Modernizer's method of replacing "no-js" HTML class with "js" - NOTE: removes all other classes added to HTML element
$doc->addCustomTag('<script type="text/javascript">docElement = document.documentElement;docElement.className = docElement.className.replace(/\bno-js\b/, \'js\');</script>');
// Smooth in-page link (i.e. back to top) scrolling
$doc->addCustomTag('<script type="text/javascript">window.addEvent(\'domready\',function(){new SmoothScroll({duration:1200},window);});</script>');

// Internet Explorer Fixes
$doc->addCustomTag('<!--[if lt IE 9]>');
$doc->addCustomTag('<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>');
// Targeted CSS3 Support
// $doc->addCustomTag('<style type="text/css"> /* list elements here */  {behavior:url("'. $this->baseurl . '/templates/'. $this->template .'/js/PIE.htc")}</style>');

$doc->addCustomTag('<![endif]-->');

// Internet Explorer 6 Fixes
$doc->addCustomTag('<!--[if lt IE 7]>');
$doc->addCustomTag('<link rel="stylesheet" href="' . $template . '/css/ie6.css" type="text/css" media="screen" />');
$doc->addCustomTag('<style type="text/css">');
$doc->addCustomTag('body {text-align:center;}');
$doc->addCustomTag('#body-container {text-align:left;}');
$doc->addCustomTag('body.sticky-footer #footer-push {display:table;height:100%;}');

// full width header/footer
$doc->addCustomTag('#body-container, #header-above, #header, #footer {width: expression( document.body.clientWidth >80 ? "80.5em" : "auto" );margin:0 auto;}');
// not full width header/footer
// $doc->addCustomTag('#body-container, #header-above {width: expression( document.body.clientWidth >80 ? "80.5em" : "auto" );margin:0 auto;}');

$doc->addCustomTag('</style>');
// PNG Transparency Fix - add comma separated list of elements after h1 a in second line
$doc->addCustomTag('<script type="text/javascript" src="' . $template . '/js/DD_belatedPNG_0.0.8a-min.js"></script>');
$doc->addCustomTag('<script type="text/javascript">DD_belatedPNG.fix(\'h1 a\');</script>');
$doc->addCustomTag('<![endif]-->');

