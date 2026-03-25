<?php
/*******
 * @package xbAzPlayer - Head Module xbAzHead
 * @filesource mod_xbazhead/src/Dispathcer/Dispatcher.php
 * @version 0.0.1.4 9th March 2026
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 ******/

namespace Crosborne\Module\XbAzHead\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\Dispatcher as JoomlaDispatcher;
//use Joomla\CMS\Dispatcher\DispatcherInterface;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;
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
        $language->load('mod_xbazhead', JPATH_BASE . '/modules/mod_xbazhead');
        // The default Joomla Factory classes set the Database object within the Helper class,
        // but not within the Dispatcher class, and we need the dbo for passing to the Table
        $helper = $this->getHelperFactory()->getHelper('XbAzHeadHelper');
        //        $helper->doBasicTableOperations($this->module->id, $this->input);
        //        $helper->doAdvancedTableOperations($this->module->id, $this->input);
        
        $params = new Registry($this->module->params);
        $azurl = $params->get('azurl','hello');
        $azapi = $params->get('azapi','goodbye');
        $azapi = rtrim($azapi, "/");
        $subtitle = $params->get('subtitle','');
        $showpopout = $params->get('showpopout','1');
        $popouturl = $params->get('popouturl', '/modules/mod_xbazhead/player');
        
        $dispopts = $params->get('display',[]);
        $dispopts = array_flip($dispopts);        
        $showcover = array_key_exists('image',$dispopts);
        $showartist = array_key_exists('artist',$dispopts);
        $showalbum = array_key_exists('album',$dispopts);
        $showsong = array_key_exists('song',$dispopts);
        $showprogress = array_key_exists('prog',$dispopts);

        require ModuleHelper::getLayoutPath('mod_xbazhead');
    }
   
}
