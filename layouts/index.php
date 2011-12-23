<?php defined('_JEXEC') or die;
/**
* @package		Unified HTML5 Template Framework for Joomla!+
* @author		Cristina Solana http://nightshiftcreative.com
* @author		Matt Thomas http://construct-framework.com | http://betweenbrain.com
* @copyright	Copyright (C) 2009 - 2011 Matt Thomas. All rights reserved.
* @license		GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/
$doc->addCustomTag('<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700" rel="stylesheet" type="text/css">');
?><!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo substr($this->language, 0, 2); ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo substr($this->language, 0, 2); ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo substr($this->language, 0, 2); ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?php echo substr($this->language, 0, 2); ?>"> <!--<![endif]-->
<head>
<jdoc:include type="head" />
</head>

<body class="sticky-footer <?php echo $columnLayout; echo ' '.$currentComponent; if($articleId) echo ' article-'.$articleId; if ($itemId) echo ' item-'.$itemId; if($catId) echo ' category-'.$catId; ?>">

	<div id="footer-push">
		<a id="page-top" name="page-top"></a>

		<header id="header" class="clear clearfix">
			<div class="gutter clearfix">
				<div class="wrap">
                <nav class="clear clearfix" role="navigation">
                    <jdoc:include type="modules" name="nav" style="raw" />
                </nav>
                <h1 id="logo">
                    <a href="<?php echo $this->baseurl ?>/" title="<?php echo $app->getCfg('sitename');?>"><?php echo $app->getCfg('sitename');?></a>
                </h1>
				</div>
			</div><!--end gutter -->
		</header><!-- end header-->
		   
		<section id="body-container">

			<?php if ($headerBelowCount) : ?>
				<div id="header-below" class="clearfix">						
					<?php if ($this->countModules('header-below-1')) : ?>
						<div id="header-below-1" class="<?php echo $headerBelowClass ?>">
							<jdoc:include type="modules" name="header-below-1" style="div" module-class="gutter"/>
						</div><!-- end header-below-1 -->								
					<?php endif; ?>

					<?php if ($this->countModules('header-below-2')) : ?>
						<div id="header-below-2" class="<?php echo $headerBelowClass ?>">
							<jdoc:include type="modules" name="header-below-2" style="div" module-class="gutter"/>
						</div><!-- end header-below-2 -->
					<?php endif; ?>

					<?php if ($this->countModules('header-below-3')) : ?>
						<div id="header-below-3" class="<?php echo $headerBelowClass ?>">
							<jdoc:include type="modules" name="header-below-3" style="div" module-class="gutter"/>
						</div><!-- end header-below-3 -->
					<?php endif; ?>

					<?php if ($this->countModules('header-below-4')) : ?>
						<div id="header-below-4" class="<?php echo $headerBelowClass ?>">
							<jdoc:include type="modules" name="header-below-4" style="div" module-class="gutter"/>
						</div><!-- end header-below-4 -->
					<?php endif; ?>

					<?php if ($this->countModules('header-below-5')) : ?>
						<div id="header-below-5" class="<?php echo $headerBelowClass ?>">
							<jdoc:include type="modules" name="header-below-5" style="div" module-class="gutter"/>
						</div><!-- end header-below-5 -->
					<?php endif; ?>

					<?php if ($this->countModules('header-below-6')) : ?>
						<div id="header-below-6" class="<?php echo $headerBelowClass ?>">
							<jdoc:include type="modules" name="header-below-6" style="div" module-class="gutter"/>
						</div><!-- end header-below-6 -->
					<?php endif; ?>											
				</div><!-- end header-below -->
			<?php endif; ?>
		
			<?php if ($this->countModules('breadcrumbs')) : ?>						
				<jdoc:include type="module" name="breadcrumbs" />				
			<?php endif; ?>		
			


			<div id="content-container" class="clear clearfix">    

				<?php if ($navBelowCount) : ?>
					<nav id="nav-below" class="clearfix">						
						<?php if ($this->countModules('nav-below-1')) : ?>
							<div id="nav-below-1" class="<?php echo $navBelowClass ?>">
								<jdoc:include type="modules" name="nav-below-1" style="div" module-class="gutter" />
							</div><!-- end nav-below-1 -->								
						<?php endif; ?>

						<?php if ($this->countModules('nav-below-2')) : ?>
							<div id="nav-below-2" class="<?php echo $navBelowClass ?>">
								<jdoc:include type="modules" name="nav-below-2" style="div" module-class="gutter" />
							</div><!-- end nav-below-2 -->
						<?php endif; ?>

						<?php if ($this->countModules('nav-below-3')) : ?>
							<div id="nav-below-3" class="<?php echo $navBelowClass ?>">
								<jdoc:include type="modules" name="nav-below-3" style="div" module-class="gutter" />
							</div><!-- end nav-below-3 -->
						<?php endif; ?>

						<?php if ($this->countModules('nav-below-4')) : ?>
							<div id="nav-below-4" class="<?php echo $navBelowClass ?>">
								<jdoc:include type="modules" name="nav-below-4" style="div" module-class="gutter" />
							</div><!-- end nav-below-4 -->
						<?php endif; ?>

						<?php if ($this->countModules('nav-below-5')) : ?>
							<div id="nav-below-5" class="<?php echo $navBelowClass ?>">
								<jdoc:include type="modules" name="nav-below-5" style="div" module-class="gutter" />
							</div><!-- end nav-below-5 -->
						<?php endif; ?>

						<?php if ($this->countModules('nav-below-6')) : ?>
							<div id="nav-below-6" class="<?php echo $navBelowClass ?>">
								<jdoc:include type="modules" name="nav-below-6" style="div" module-class="gutter" />
							</div><!-- end nav-below-6 -->
						<?php endif; ?>													
					</nav><!-- end nav-below -->
				<?php endif; ?>
			
				<div id="load-first" class="clearfix">
					<a id="content" name="content"></a>     
					<div id="content-main">
						<div class="gutter">
							<ul id="style-switch">
								<li><a href="#" onclick="setActiveStyleSheet('light'); return false;" title="light">light</a></li>
								<li><a href="#" onclick="setActiveStyleSheet('dark'); return false;" title="dark">dark</a></li>
								<li><a href="#" onclick="setActiveStyleSheet('normal'); return false;" title="Normal">Normal Mode</a></li>
							</ul>
						
							<?php if ($contentAboveCount) : ?>
								<div id="content-above" class="clearfix">						
									<?php if ($this->countModules('content-above-1')) : ?>
										<div id="content-above-1" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-above-1" style="div" module-class="gutter" />
										</div><!-- end content-above-1 -->								
									<?php endif; ?>
							
									<?php if ($this->countModules('content-above-2')) : ?>
										<div id="content-above-2" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-above-2" style="div" module-class="gutter" />
										</div><!-- end content-above-2 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-above-3')) : ?>
										<div id="content-above-3" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-above-3" style="div" module-class="gutter" />
										</div><!-- end content-above-3 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-above-4')) : ?>
										<div id="content-above-4" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-above-4" style="div" module-class="gutter" />
										</div><!-- end content-above-4 -->
									<?php endif; ?>

									<?php if ($this->countModules('content-above-5')) : ?>
										<div id="content-above-5" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-above-5" style="div" module-class="gutter" />
										</div><!-- end content-above-5 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-above-6')) : ?>
										<div id="content-above-6" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-above-6" style="div" module-class="gutter" />
										</div><!-- end content-above-6 -->
									<?php endif; ?>									
								</div><!-- end content-above -->
							<?php endif; ?>
					  
							<?php if ($this->getBuffer('message')) : ?>
								<jdoc:include type="message" />
							<?php endif; ?>

							<jdoc:include type="component" />
								
							<?php if ($contentBelowCount) : ?>
								<div id="content-below" class="clearfix">						
									<?php if ($this->countModules('content-below-1')) : ?>
										<div id="content-below-1" class="<?php echo $contentBelowClass ?>">
											<jdoc:include type="modules" name="content-below-1" style="div" module-class="gutter" />
										</div><!-- end content-below-1 -->								
									<?php endif; ?>
						
									<?php if ($this->countModules('content-below-2')) : ?>
										<div id="content-below-2" class="<?php echo $contentBelowClass ?>">
											<jdoc:include type="modules" name="content-below-2" style="div" module-class="gutter" />
										</div><!-- end content-below-2 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-below-3')) : ?>
										<div id="content-below-3" class="<?php echo $contentBelowClass ?>">
											<jdoc:include type="modules" name="content-below-3" style="div" module-class="gutter" />
										</div><!-- end content-below-3 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-below-4')) : ?>
										<div id="content-below-4" class="<?php echo $contentBelowClass ?>">
											<jdoc:include type="modules" name="content-below-4" style="div" module-class="gutter" />
										</div><!-- end content-below-4 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-below-5')) : ?>
										<div id="content-below-5" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-below-5" style="div" module-class="gutter" />
										</div><!-- end content-below-5 -->
									<?php endif; ?>
									
									<?php if ($this->countModules('content-below-6')) : ?>
										<div id="content-below-6" class="<?php echo $contentAboveClass ?>">
											<jdoc:include type="modules" name="content-below-6" style="div" module-class="gutter" />
										</div><!-- end content-below-6 -->
									<?php endif; ?>									
								</div><!-- end content-below -->
							<?php endif; ?>
							
						</div><!--end gutter -->        
					</div><!-- end content-main -->
					
					<?php if ($columnGroupAlphaCount) : ?>
						<div id="column-group-alpha" class="clearfix">
							<?php if ($this->countModules('column-1')) : ?>
								<div id="column-1" class="<?php echo $columnGroupAlphaClass ?>">
									<div class="gutter clearfix">
										<jdoc:include type="modules" name="column-1" style="div" />
									</div><!--end gutter -->
								</div><!-- end column-1 -->
							<?php endif; ?>
							<?php if ($this->countModules('column-2')) : ?>
								<div id="column-2" class="<?php echo $columnGroupAlphaClass ?>">
									<div class="gutter clearfix">
										<jdoc:include type="modules" name="column-2" style="div" />
									</div><!--end gutter -->
								</div><!-- end column-2 -->
							<?php endif; ?>
						</div><!-- end column-group-alpha -->
					<?php endif; ?>

				</div><!-- end load-first -->
		
					<?php if ($columnGroupBetaCount) : ?>
						<div id="column-group-beta" class="clearfix">
							<?php if ($this->countModules('column-3')) : ?>
								<div id="column-3" class="<?php echo $columnGroupBetaClass ?>">
									<div class="gutter clearfix">
										<jdoc:include type="modules" name="column-3" style="div" />
									</div><!--end gutter -->
								</div><!-- end column-2 -->								
							<?php endif; ?>
							<?php if ($this->countModules('column-4')) : ?>
								<div id="column-4" class="<?php echo $columnGroupBetaClass ?>">
									<div class="gutter clearfix">
										<jdoc:include type="modules" name="column-4" style="div" />
									</div><!--end gutter -->
								</div><!-- end column-4 -->
							<?php endif; ?>
						</div><!-- end column-group-beta -->
					<?php endif; ?>
			
				<?php if ($footerAboveCount) : ?>
					<div id="footer-above" class="clearfix">						
						<?php if ($this->countModules('footer-above-1')) : ?>
							<div id="footer-above-1" class="<?php echo $footerAboveClass ?>">
								<jdoc:include type="modules" name="footer-above-1" style="div" module-class="gutter" />
							</div><!-- end footer-above-1 -->								
						<?php endif; ?>

						<?php if ($this->countModules('footer-above-2')) : ?>
							<div id="footer-above-2" class="<?php echo $footerAboveClass ?>">
								<jdoc:include type="modules" name="footer-above-2" style="div" module-class="gutter" />
							</div><!-- end footer-above-2 -->
						<?php endif; ?>

						<?php if ($this->countModules('footer-above-3')) : ?>
							<div id="footer-above-3" class="<?php echo $footerAboveClass ?>">
								<jdoc:include type="modules" name="footer-above-3" style="div" module-class="gutter" />
							</div><!-- end footer-above-3 -->
						<?php endif; ?>

						<?php if ($this->countModules('footer-above-4')) : ?>
							<div id="footer-above-4" class="<?php echo $footerAboveClass ?>">
								<jdoc:include type="modules" name="footer-above-4" style="div" module-class="gutter" />
							</div><!-- end footer-above-4 -->
						<?php endif; ?>

						<?php if ($this->countModules('footer-above-5')) : ?>
							<div id="footer-above-5" class="<?php echo $footerAboveClass ?>">
								<jdoc:include type="modules" name="footer-above-5" style="div" module-class="gutter" />
							</div><!-- end footer-above-5 -->
						<?php endif; ?>

						<?php if ($this->countModules('footer-above-6')) : ?>
							<div id="footer-above-6" class="<?php echo $footerAboveClass ?>">
								<jdoc:include type="modules" name="footer-above-6" style="div" module-class="gutter" />
							</div><!-- end footer-above-6 -->
						<?php endif; ?>											
					</div><!-- end footer-above -->
				<?php endif; ?>

			</div><!-- end content-container -->
		</section><!-- end body-container -->
	</div><!-- end footer-push -->
    
	<footer id="footer" class="clearfix">
		<div class="gutter clearfix">

			<a id="to-page-top" href="<?php $url->setFragment('page-top'); echo $url->toString();?>" class="to-additional">Back to Top</a>

			<?php if ($this->countModules('syndicate')) : ?>
			<div id="syndicate">
				<jdoc:include type="modules" name="syndicate" />
			</div>
			<?php endif; ?>

			<?php if ($this->countModules('footer')) : ?>
				<jdoc:include type="modules" name="footer" style="div" />
			<?php endif; ?>

		</div><!--end gutter -->
	</footer><!-- end footer -->

	<?php if ($this->countModules('debug')) : ?>
		<jdoc:include type="modules" name="debug" style="raw" />
	<?php endif; ?>	  
	
	<?php if ($this->countModules('analytics')) : ?>
		<jdoc:include type="modules" name="analytics" />
	<?php endif; ?>
	
	</body>
</html>
