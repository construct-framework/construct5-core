<?php defined('_JEXEC') or die;
/**
 * @package        Template Framework for Joomla!
 * @author        Matt Thomas http://construct-framework.com | http://betweenbrain.com
 * @copyright    Copyright (C) 2009 - 2012 Matt Thomas. All rights reserved.
 * @license        GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

class JFormFieldUpgradecheck extends JFormField
{

    var $_name = 'Upgradecheck';

    protected function getInput()
    {
        return ' ';
    }

    protected function getLabel()
    {
        //check for cURL support before we do anything else.
        if (!function_exists("curl_init")) return 'cURL is not supported by your server. Please contact your hosting provider to enable this capability.';
        //If cURL is supported, check the current version available.
        else
            $version = 11;
        $target = 'http://construct-framework.com/upgradecheck/construct5-core-2-5';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $target);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $str = curl_exec($curl);
        curl_close($curl);

        $message = '<label style="max-width:100%">You are using Construct5 Core, version 2.5.' . $version . '. ';

        //If the current version is out of date, notify the user and provide a download link.
        if ($version < $str)
            $message = $message . '<a href="http://construct-framework.com" target="_blank">Version 2.5.' . $str . ' is now available.</a></label>';
        //If the current version is up to date, notify the user.
        elseif (($version == $str) || ($version > $str))
            $message = $message . 'There are no updates available at this time.</label>';
        return $message;
    }
}

