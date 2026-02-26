<?php
/*******
 * @package xbAzPlayer
 * @filesource mod_xbazplayer/tmpl/default.php
 * @version 0.0.1.3 26th February 2026
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
<?php if($subtitle !='') :?>
	<span class="xbimgsubtitle"><?php echo $subtitle; ?></span><br/>
<?php endif; ?>
	<div class="animated">
        <?php if($showtrack) :?>
        	<div id="nowtrack" class="marquee" style="margin:10px auto;">track</div>
        <?php endif; ?>
    </div>
<?php if ($showcover) : ?>
	<img id="nowcover" src="/media/mod_xbimagecarousel/images/WreckersCircleLogo-500x500.png" />
    <div class="clearfix"></div>
<?php endif; ?>
	<div class="animated">
        <?php if($showartist) : ?>
        	<span id="nowartist" class="marquee">artist</span>
        <?php endif; ?>
    </div>
	<div class="animated">
        <?php if($showalbum) : ?>
        	<i>Album</i>: <span id="nowalbum" class="marquee">album</span>
        <?php endif; ?>
	</div>

		<div class="pull-right">
			<audio id="<?php echo $playerid; ?>" style="height:30px;border-radius:12px;"
				src="">
					<i>Your browser does not support the audio tag.</i>
			</audio> 
			<button id="startplay" onclick="playStart('<?php echo $playerid; ?>','https://az.wreckersradio.uk/listen/wreckersradio/radio.mp3');" >Play</button>      		
			<button id="stopplay" onclick="playStop('<?php echo $playerid; ?>');" style="display:none;">Stop</button>      		
            <div id="playertitle" class="pull-left" style="margin:5px 20px 0 0;"></div>
            <?php if($showprogress) : ?>
            	<div id="nowprogress" class="pull-left">prog</div>
            <?php endif; ?>
        </div>

</div>