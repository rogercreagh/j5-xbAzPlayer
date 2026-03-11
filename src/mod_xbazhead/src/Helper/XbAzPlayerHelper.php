<?php
/*******
 * @package xbMusic
 * @filesource mod_xbazhead/src/Helper/XbAzHeadHelper.php
 * @version 0.0.1.2 25th February 2026
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 ******/

namespace Crosborne\Module\XbAzHead\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Changelog\Changelog;
//use Joomla\Database\DatabaseInterface;
//use RecursiveDirectoryIterator;
//use RecursiveIteratorIterator;

class XbAzHeadHelper
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
        
}