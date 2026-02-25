<?php
/*******
 * @package xbMusic
 * @filesource mod_xbimagecarousel/services/provider.php
 * @version 0.0.1.0 23rd February 2026
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 ******/

namespace Crosborne\Module\XbAzPlayer\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\Dispatcher as JoomlaDispatcher;
//use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;
//use Crosborne\Module\XbimageCarousel\Site\Helper\XbimageCarouselHelper;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Factory;

//class Dispatcher implements DispatcherInterface
class Dispatcher extends JoomlaDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;
    protected $module;
    
    protected $app;
    
    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        parent::__construct($app, $input);
        $this->module = $module;
        $this->app = $app;
    }
    
    public function dispatch()
    {
        $language = Factory::getApplication()->getLanguage();
        $language->load('mod_xbimagecarousel', JPATH_BASE . '/modules/mod_xbazplayer');
        // The default Joomla Factory classes set the Database object within the Helper class,
        // but not within the Dispatcher class, and we need the dbo for passing to the Table
        $helper = $this->getHelperFactory()->getHelper('XbAzPlayerHelper');
        //        $helper->doBasicTableOperations($this->module->id, $this->input);
        //        $helper->doAdvancedTableOperations($this->module->id, $this->input);
        
        $params = new Registry($this->module->params);
        $azurl = $params->get('azutl','');
        
        require ModuleHelper::getLayoutPath('mod_xbazplayer');
    }
   
}
