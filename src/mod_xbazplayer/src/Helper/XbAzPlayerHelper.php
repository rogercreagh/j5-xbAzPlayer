<?php
/*******
 * @package xbMusic
 * @filesource mod_xbazplayer/src/Helper/XbAzPlayerHelper.php
 * @version 0.0.1.0 23rd February 2026
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 ******/

namespace Crosborne\Module\XbAzPlayer\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Changelog\Changelog;
//use Joomla\Database\DatabaseInterface;
//use RecursiveDirectoryIterator;
//use RecursiveIteratorIterator;

class XbAzPlayerHelper
{
    public static function getLoggedonUsername(string $default)
    {
        $user = Factory::getApplication()->getIdentity();
        if ($user->id !== 0)  // found a logged-on user
        {
            return $user->username;
        }
        else
        {
            return $default;
        }
    }
    
    public static function dummy() {
        $clog = new Changelog();
        $clog->setVersion('0.0.1.0');
        $clog->loadFromXml('http://j5.localhost/updateserver/changelog_xbazplayer.xml');
        $props = $clog->getProperties(false);
        Factory::getApplication()->enqueueMessage(print_r($props,true));
        
    }
    
}