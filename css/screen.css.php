<?php 
/*------------------------------------------------------------------------
# author	your name or company
# copyright Copyright � 2011 example.com. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.example.com
-------------------------------------------------------------------------*/

/* initialize ob_gzhandler to send and compress data */
ob_start ("ob_gzhandler");
/* initialize compress function for whitespace removal */
ob_start("compress");
/* required header info and character set */
header("Content-type: text/css;charset: UTF-8");
/* cache control to process */
header("Cache-Control: must-revalidate");
/* duration of cached content (1 hour) */
$offset = 60 * 60 * 24 * 365;
/* expiration header format */
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s",time() + $offset) . " GMT";
/* send cache expiration header to browser */
header($ExpStr);
/* Begin function compress */
function compress($buffer) {
	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* remove tabs, spaces, new lines, etc. */
	$buffer = str_replace(array("\r\n","\r","\n","\t",'  ','	','	'),'',$buffer);
	/* remove unnecessary spaces */
	$buffer = str_replace('{ ', '{', $buffer);
	$buffer = str_replace(' }', '}', $buffer);
	$buffer = str_replace('; ', ';', $buffer);
	$buffer = str_replace(', ', ',', $buffer);
	$buffer = str_replace(' {', '{', $buffer);
	$buffer = str_replace('} ', '}', $buffer);
	$buffer = str_replace(': ', ':', $buffer);
	$buffer = str_replace(' ,', ',', $buffer);
	$buffer = str_replace(' ;', ';', $buffer);
	$buffer = str_replace(';}', '}', $buffer);
	
	return $buffer;
}

require('screen.css');
require('grids/construct.css');
require('custom.css');

// Random Style Generator

/*
// http://www.jonasjohn.de/snippets/php/random-color.htm
function random_color() {
	mt_srand((double)microtime()*1000000);
	$c = '';
	while(strlen($c)<6){
		$c .= sprintf("%02X", mt_rand(0, 255));
	}
	return $c;
}

echo 'body {
	font-size:' . rand (50, 95) . '%;
	max-width:'. rand (50, 95) . 'em;
	margin:0 auto;
	background-color:#' . random_color() . ';}
	#header {
	background-color: #' . random_color() . ';
	background-image: -webkit-gradient(linear, left top, left bottom, from(#' . random_color() . '), to(#' . random_color() . '));
	background-image: -webkit-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:	-moz-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:	 -ms-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:	  -o-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:		 linear-gradient(to bottom, #' . random_color() . ', #' . random_color() . ');}
	#footer {
	background-color: #' . random_color() . ';
	background-image: -webkit-gradient(linear, left top, left bottom, from(#' . random_color() . '), to(#' . random_color() . '));
	background-image: -webkit-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:	-moz-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:	 -ms-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:	  -o-linear-gradient(top, #' . random_color() . ', #' . random_color() . ');
	background-image:		 linear-gradient(to bottom, #' . random_color() . ', #' . random_color() . ');}';
*/
?>