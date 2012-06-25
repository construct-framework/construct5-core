<?php defined('_JEXEC') or die;
/**
 * @package        Unified HTML5 Template Framework for Joomla!+
 * @author        Cristina Solana http://nightshiftcreative.com
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

// Load Joomla filesystem package
jimport('joomla.filesystem.file');

// To get an application object
$app = JFactory::getApplication();
// Returns a reference to the global document object
$doc = JFactory::getDocument();
// Get the offline status of the website
$offLine = $app->getCfg('offline');
// Define relative path to the  current template directory
$template = 'templates/' . $this->template;
// Get language and direction
$this->language = $doc->language;
$this->direction = $doc->direction;

// Send the user to the home page if the website is offline
if ($offLine) {
    $app->redirect($this->baseurl);
}

// Manually define layout and module counts
$columnLayout = 'alpha-1-main-beta-1';
$headerAboveClass = 'count-1';
$headerBelowClass = 'count-6';
$navBelowClass = 'count-4';
$contentAboveClass = 'count-1';
$contentBelowClass = '';
$columnGroupAlphaClass = 'count-1';
$columnGroupBetaClass = '';
$footerAboveClass = 'count-1';

// Access template parameters
$params = JFactory::getApplication()->getTemplate(true)->params;

$customStyleSheet      = $params->get('customStyleSheet');
$detectTablets         = $params->get('detectTablets');
$enableSwitcher        = $params->get('enableSwitcher');
$fluidMedia            = $params->get('fluidMedia');
$fullWidth             = $params->get('fullWidth');
$googleWebFont         = $params->get('googleWebFont');
$googleWebFontTargets  = $params->get('googleWebFontTargets');
$googleWebFont2        = $params->get('googleWebFont2');
$googleWebFontTargets2 = $params->get('googleWebFontTargets2');
$googleWebFont3        = $params->get('googleWebFont3');
$googleWebFontTargets3 = $params->get('googleWebFontTargets3');
$gridSystem            = $params->get('gridSystem');
$IECSS3                = $params->get('IECSS3');
$IECSS3Targets         = $params->get('IECSS3Targets');
$IE6TransFix           = $params->get('IE6TransFix');
$IE6TransFixTargets    = $params->get('IE6TransFixTargets');
$inheritLayout         = $params->get('inheritLayout');
$inheritStyle          = $params->get('inheritStyle');
$loadMoo               = $params->get('loadMoo');
$loadModal             = $params->get('loadModal');
$loadjQuery            = $params->get('loadjQuery');
$mContentDataTheme     = $params->get('mContentDataTheme');
$mdetect               = $params->get('mdetect');
$mFooterDataTheme      = $params->get('mFooterDataTheme');
$mHeaderDataTheme      = $params->get('mHeaderDataTheme');
$mNavPosition          = $params->get('mNavPosition');
$mNavDataTheme         = $params->get('mNavDataTheme');
$mPageDataTheme        = $params->get('mPageDataTheme');
$setGeneratorTag       = $params->get('setGeneratorTag');
$showDiagnostics       = $params->get('showDiagnostics');
$siteWidth             = $params->get('siteWidth');
$siteWidthType         = $params->get('siteWidthType');
$siteWidthUnit         = $params->get('siteWidthUnit');
$stickyFooterHeight    = $params->get('stickyFooterHeight');
$useStickyFooter       = $params->get('useStickyFooter');

// Render module positions
$renderer = $doc->loadRenderer('modules');
$raw = array('style' => 'raw');
$xhtml = array('style' => 'xhtml');
$jexhtml = array('style' => 'jexhtml');

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <![endif]-->
<!--[if gt IE 8]> <!--> <html class="no-js" lang="<?php echo substr($this->language, 0, 2) ?>" dir="<?php echo $this->direction ?>"> <!--<![endif]-->
<head>
    <meta name="copyright" content="<?php echo $app->getCfg('sitename') ?>" />
    <link rel="shortcut icon" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/favicon.png" type="image/png" />
    <link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/screen.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/grids/construct.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/css/custom.css" type="text/css" media="screen" />
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>

<body class="<?php echo $columnLayout ?> error">
<div id="footer-push">
<?php if ($headerAboveClass) : ?>
<div id="header-above" class="clearfix">
    <div id="header-above-1" class="<?php echo $headerAboveClass ?>">
        <?php echo $renderer->render('header-above-1', $jexhtml, null) ?>
    </div>
    <div id="header-above-2" class="<?php echo $headerAboveClass ?>">
        <?php echo $renderer->render('header-above-2', $jexhtml, null) ?>
    </div>
    <div id="header-above-3" class="<?php echo $headerAboveClass ?>">
        <?php echo $renderer->render('header-above-3', $jexhtml, null) ?>
    </div>
    <div id="header-above-4" class="<?php echo $headerAboveClass ?>">
        <?php echo $renderer->render('header-above-4', $jexhtml, null) ?>
    </div>
    <div id="header-above-5" class="<?php echo $headerAboveClass ?>">
        <?php echo $renderer->render('header-above-5', $jexhtml, null) ?>
    </div>
    <div id="header-above-6" class="<?php echo $headerAboveClass ?>">
        <?php echo $renderer->render('header-above-6', $jexhtml, null) ?>
    </div>
</div>
    <?php endif ?>

<header id="header" class="clear clearfix">
    <div class="gutter">

        <h1 id="logo">
            <a href="<?php echo $this->baseurl ?>/" title="<?php echo htmlspecialchars($app->getCfg('sitename')) ?>"><?php echo $this->baseurl ?></a>
        </h1>

        <?php echo $renderer->render('header', $jexhtml, null) ?>

    </div>
</header>

<section id="body-container">
    <?php if ($headerBelowClass) : ?>
    <div id="header-below" class="clearfix">
        <div id="header-below-1" class="<?php echo $headerBelowClass ?>">
            <?php echo $renderer->render('header-below-1', $jexhtml, null) ?>
        </div>
        <div id="header-below-2" class="<?php echo $headerBelowClass ?>">
            <?php echo $renderer->render('header-below-2', $jexhtml, null) ?>
        </div>
        <div id="header-below-3" class="<?php echo $headerBelowClass ?>">
            <?php echo $renderer->render('header-below-3', $jexhtml, null) ?>
        </div>
        <div id="header-below-4" class="<?php echo $headerBelowClass ?>">
            <?php echo $renderer->render('header-below-4', $jexhtml, null) ?>
        </div>
        <div id="header-below-5" class="<?php echo $headerBelowClass ?>">
            <?php echo $renderer->render('header-below-5', $jexhtml, null) ?>
        </div>
        <div id="header-below-6" class="<?php echo $headerBelowClass ?>">
            <?php echo $renderer->render('header-below-6', $jexhtml, null) ?>
        </div>
    </div>
    <?php endif ?>

    <?php echo $renderer->render('breadcrumbs', $raw, null) ?>

    <nav id="nav" class="clear">
        <?php echo $renderer->render('nav', $raw, null) ?>
    </nav>

    <div id="content-container" class="clear clearfix">
        <?php if ($navBelowClass) : ?>
        <div id="nav-below" class="clearfix">
            <div id="nav-below-1" class="<?php echo $navBelowClass ?>">
                <?php echo $renderer->render('nav-below-1', $jexhtml, null) ?>
            </div>
            <div id="nav-below-2" class="<?php echo $navBelowClass ?>">
                <?php echo $renderer->render('nav-below-2', $jexhtml, null) ?>
            </div>
            <div id="nav-below-3" class="<?php echo $navBelowClass ?>">
                <?php echo $renderer->render('nav-below-3', $jexhtml, null) ?>
            </div>
            <div id="nav-below-4" class="<?php echo $navBelowClass ?>">
                <?php echo $renderer->render('nav-below-4', $jexhtml, null) ?>
            </div>
            <div id="nav-below-5" class="<?php echo $navBelowClass ?>">
                <?php echo $renderer->render('nav-below-5', $jexhtml, null) ?>
            </div>
            <div id="nav-below-6" class="<?php echo $navBelowClass ?>">
                <?php echo $renderer->render('nav-below-6', $jexhtml, null) ?>
            </div>
        </div>
        <?php endif ?>

        <div id="load-first" class="clearfix">
            <div id="content-main">
                <div class="gutter">
                    <?php if ($contentAboveClass) : ?>
                    <div id="content-above" class="clearfix">
                        <div id="content-above" class="<?php echo $contentAboveClass ?>">
                            <?php echo $renderer->render('content-above-1', $jexhtml, null) ?>
                        </div>
                        <div id="content-above-2" class="<?php echo $contentAboveClass ?>">
                            <?php echo $renderer->render('content-above-2', $jexhtml, null) ?>
                        </div>
                        <div id="content-above-3" class="<?php echo $contentAboveClass ?>">
                            <?php echo $renderer->render('content-above-3', $jexhtml, null) ?>
                        </div>
                        <div id="content-above-4" class="<?php echo $contentAboveClass ?>">
                            <?php echo $renderer->render('content-above-4', $jexhtml, null) ?>
                        </div>
                        <div id="content-above-5" class="<?php echo $contentAboveClass ?>">
                            <?php echo $renderer->render('content-above-5', $jexhtml, null) ?>
                        </div>
                        <div id="content-above-6" class="<?php echo $contentAboveClass ?>">
                            <?php echo $renderer->render('content-above-6', $jexhtml, null) ?>
                        </div>
                    </div>
                    <?php endif ?>

                    <div id="error-message">
                        <?php echo $this->error->getCode() ?> - <?php echo $this->error->getMessage() ?>
                        <p><strong><?php echo JText::_('You may not be able to visit this page because of:') ?></strong>
                        </p>
                        <ol>
                            <li><?php echo JText::_('An out-of-date bookmark/favourite') ?></li>
                            <li><?php echo JText::_('A search engine that has an out-of-date listing for this site') ?></li>
                            <li><?php echo JText::_('A mis-typed address') ?></li>
                            <li><?php echo JText::_('You have no access to this page') ?></li>
                            <li><?php echo JText::_('The requested resource was not found') ?></li>
                            <li><?php echo JText::_('An error has occurred while processing your request.') ?></li>
                        </ol>
                        <p><strong><?php echo JText::_('Please try one of the following pages:') ?></strong></p>
                        <ul>
                            <li>
                                <a href="<?php echo $this->baseurl ?>/" title="<?php echo JText::_('Go to the home page') ?>"><?php echo JText::_('Home Page') ?></a>
                            </li>
                        </ul>
                        <p><?php echo JText::_('If difficulties persist, please contact the system administrator of this site.') ?></p>

                        <p><?php echo $this->error->getMessage() ?></p>

                        <p>
                            <?php if ($this->debug) :
                            echo $this->renderBacktrace();
                        endif ?>
                        </p>
                    </div>
                    <?php if ($contentBelowClass) : ?>
                    <div id="content-below" class="clearfix">
                        <div id="content-below-1" class="<?php echo $contentBelowClass ?>">
                            <?php echo $renderer->render('content-below-1', $jexhtml, null) ?>
                        </div>
                        <div id="content-below-2" class="<?php echo $contentBelowClass ?>">
                            <?php echo $renderer->render('content-below-2', $jexhtml, null) ?>
                        </div>
                        <div id="content-below-3" class="<?php echo $contentBelowClass ?>">
                            <?php echo $renderer->render('content-below-3', $jexhtml, null) ?>
                        </div>
                        <div id="content-below-4" class="<?php echo $contentBelowClass ?>">
                            <?php echo $renderer->render('content-below-4', $jexhtml, null) ?>
                        </div>
                        <div id="content-below-5" class="<?php echo $contentBelowClass ?>">
                            <?php echo $renderer->render('content-below-5', $jexhtml, null) ?>
                        </div>
                        <div id="content-below-6" class="<?php echo $contentBelowClass ?>">
                            <?php echo $renderer->render('content-below-6', $jexhtml, null) ?>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
            </div>
            <?php if ($columnGroupAlphaClass) : ?>
            <div id="column-group-alpha">
                <div class="gutter clearfix">
                    <div id="column-1" class="<?php echo $columnGroupAlphaClass ?>">
                        <?php echo $renderer->render('column-1', $jexhtml, null) ?>
                    </div>
                    <div id="column-2" class="<?php echo $columnGroupAlphaClass ?>">
                        <?php echo $renderer->render('column-2', $jexhtml, null) ?>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>

        <?php if ($columnGroupBetaClass) : ?>
        <div id="column-group-beta">
            <div class="gutter clearfix">
                <div id="column-3" class="<?php echo $columnGroupBetaClass ?>">
                    <?php echo $renderer->render('column-3', $jexhtml, null) ?>
                </div>
                <div id="column-4" class="<?php echo $columnGroupBetaClass ?>">
                    <?php echo $renderer->render('column-4', $jexhtml, null) ?>
                </div>
            </div>
        </div>
        <?php endif ?>

        <?php if ($footerAboveClass) : ?>
        <div id="footer-above" class="clearfix">
            <div id="footer-above-1" class="<?php echo $footerAboveClass ?>">
                <?php echo $renderer->render('footer-above-1', $jexhtml, null) ?>
            </div>
            <div id="footer-above-2" class="<?php echo $footerAboveClass ?>">
                <?php echo $renderer->render('footer-above-2', $jexhtml, null) ?>
            </div>
            <div id="footer-above-3" class="<?php echo $footerAboveClass ?>">
                <?php echo $renderer->render('footer-above-3', $jexhtml, null) ?>
            </div>
            <div id="footer-above-4" class="<?php echo $footerAboveClass ?>">
                <?php echo $renderer->render('footer-above-4', $jexhtml, null) ?>
            </div>
            <div id="footer-above-5" class="<?php echo $footerAboveClass ?>">
                <?php echo $renderer->render('footer-above-5', $jexhtml, null) ?>
            </div>
            <div id="footer-above-6" class="<?php echo $footerAboveClass ?>">
                <?php echo $renderer->render('footer-above-6', $jexhtml, null) ?>
            </div>
        </div>
        <?php endif ?>
    </div>
</section>
</div>

<footer id="footer" class="clear clearfix">
    <div class="gutter clearfix">
        <a id="to-page-top" href="<?php echo $this->baseurl ?>/index.php#page-top">Back to Top</a>
        <?php echo $renderer->render('syndicate', $jexhtml, null) ?>
        <?php echo $renderer->render('footer', $jexhtml, null) ?>
    </div>
</footer>

<?php echo $renderer->render('analytics', $raw, null) ?>

</body>
</html>

