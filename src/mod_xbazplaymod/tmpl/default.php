<?php
/*******
 * @package xbAzPlayMod
 * @filesource mod_xbazplaymod/tmpl/default.php
 * @version 0.0.1.3 2nd March 2026
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 ******/

defined('_JEXEC') or die;

//use Crosborne\Module\XbAzPlayMod\Site\Helper\XbAzPlayModHelper;

$document = $this->app->getDocument();
$wa = $document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_xbazplaymod');
$wa->useScript('mod_xbazplaymod.playerctl');
$wa->useStyle('xbazplaymod.styles');

$playerid = 'player'.$this->module->id;
// Pass the options down to js
//$document->addScriptOptions('mod_xbazplaymod.vars', ['azurl' => $azurl]);

?>
<div class="modxbazplaymod">
<?php if($subtitle !='') :?>
	<div class="xbimgsubtitle"><?php echo $subtitle; ?></div>
<?php endif; ?>
	<div id="trackok" class="animated">
        <?php if($showtrack) :?>
        	<div id="nowtrack" class="marquee">track</div>
        <?php endif; ?>
    </div>
<?php if ($showcover) : ?>
	<img id="nowcover" src="/media/mod_xbazplaymod/images/wrdefaultcover.jpg" />
    <div class="clearfix"></div>
<?php endif; ?>
	<audio id="<?php echo $playerid; ?>" style="height:30px;border-radius:12px;"
		src="">
			<i>Your browser does not support the audio tag.</i>
	</audio> 
	<div>
		<div id="playerctrls" class="pull-left" azapi="<?php echo $azapi; ?>">
    		<button id="startplay" onclick="playStart('<?php echo $playerid; ?>','<?php echo $azurl; ?>');">&#9654;</button>      		
    		<button id="stopplay" onclick="playStop('<?php echo $playerid; ?>');" style="display:none;">&#9632;</button>  
    	</div>
		<div id="artistalbum" class="pull-left">
        	<div id="artistok" class="animated">
                <?php if($showartist) : ?>
                	<span id="nowartist" class="marquee">artist</span>
                <?php endif; ?>
            </div>
        	<div id="albumok" class="animated">
                <?php if($showalbum) : ?>
                	<span id="nowalbum" class="marquee">album</span>
                <?php endif; ?>
        	</div>
		</div>  
		<div class="clearfix"></div>  		
	</div>
    <?php if($showprogress) : ?>
    	<div id="nowprogress">
    		<progress id="progbar" value="32" max="100" style="width:80%"></progress>
        	<span id="nowduration"></span>
    	</div>
    <?php endif; ?>
</div>
