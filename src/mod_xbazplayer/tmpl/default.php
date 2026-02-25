<?php
/*******
 * @package xbAzPlayer
 * @filesource mod_xbazplayer/tmpl/default.php
 * @version 0.0.1.1 24th February 2026
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 ******/

defined('_JEXEC') or die;

use Crosborne\Module\XbAzPlayer\Site\Helper\XbAzPlayerHelper;

$document = $this->app->getDocument();
$wa = $document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_xbazplayer');
$wa->useScript('mod_xbazplayer.playerctl');
$wa->useStyle('xbazplayer.styles');

$playerid = 'player'.$this->module->id;
// Pass the options down to js
//$document->addScriptOptions('mod_xbimagecarousel.vars', ['covers' => $covers,'imgdelay' => $imgdelay, 'albuminfo' => $albuminfo, 'imgsource' => $imgsource, 'showyear' => $showyear]);

?>
<div class="modxbazplayer">
 <p>Hello <span class="mystyle"><?php echo XbAzPlayerHelper::getLoggedonUsername('nobody'); ?></span></p>

		<div class="pull-right">
			<audio id="<?php echo $playerid; ?>" style="height:30px;border-radius:12px;"
				src="">
					<i>Your browser does not support the audio tag.</i>
			</audio> 
			<button id="startplay" onclick="playStart('<?php echo $playerid; ?>','https://az.wreckersradio.uk/listen/wreckersradio/radio.mp3');" >Play</button>      		
			<button id="stopplay" onclick="playStop('<?php echo $playerid; ?>');" >Stop</button>      		
            <div id="playertitle" class="pull-left" style="margin:5px 20px 0 0;"></div>
        </div>
        <p>url:<?php echo $azurl; ?></p>

</div>