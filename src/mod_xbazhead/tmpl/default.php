<?php
/*******
 * @package xbAzHead
 * @filesource mod_xbazhead/tmpl/default.php
 * @version 0.0.1.4 9th March 2026
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 ******/

defined('_JEXEC') or die;

//use Crosborne\Module\XbAzHead\Site\Helper\XbAzHeadHelper;

$document = $this->app->getDocument();
$wa = $document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_xbazhead');
$wa->useScript('mod_xbazhead.azplayctl');
$wa->useScript('mod_xbazhead.azheadctl');
$wa->useStyle('xbazhead.styles');

$playid = 'play'.$this->module->id;
// Pass the options down to js
//$document->addScriptOptions('mod_xbazhead.vars', ['azurl' => $azurl]);
$covwid = ($showprogress) ? 180 : 205 ;

?>
<script>
    function popPlayer() {
    	window.open ("<?php echo $popouturl; ?>", "playerwindow", config="height=560,width=370,popup");
	}
</script>

<div class="modxbazhead">
    <?php if($subtitle !='') :?>
    	<div class="xbsubtitle"><?php echo $subtitle; ?></div>
    <?php endif; ?>
    <?php if($showpopout) :?>
    	<div style="float:right;"><span class="fa fa-arrow-up-right-from-square" onclick="popPlayer();"></span></div>
    <?php endif; ?>
	<?php if($showsong) :?>
		<div class="xbsong animated">
        	<div class="xbsongtitle marquee">track</div>
	    </div>
	<?php else : ?>
		<div class="xbsong">&nbsp;</div>   
	<?php endif; ?>
    <?php if ($showcover) : ?>
    	<div style="margin:0 auto; width:<?php echo $covwid; ?>px;">
    		<img class="xbcoverpic" src="/media/mod_xbazhead/images/wrdefaultcover.jpg" />
    	</div>
    <?php endif; ?>
	<audio id="<?php echo $playid; ?>" style="height:30px;border-radius:12px;"
		src="">
			<i>Your browser does not support the audio tag.</i>
	</audio> 
	<div>
		<div id="hdctrls" class="xbplayctrls" azapi="<?php echo $azapi; ?>">
    		<button id="<?php echo $playid; ?>start" onclick="playStart('<?php echo $playid; ?>','<?php echo $azurl; ?>');">&#9654;</button>      		
    		<button id="<?php echo $playid; ?>stop" onclick="playStop('<?php echo $playid; ?>');" style="display:none;">&#9632;</button>  
    	</div>
		<div class="xbartistalbum" <?php if(!$showartist || !$showalbum) echo 'style="padding-top:10px;" '; ?>>
            <?php if($showartist) : ?>
	        	<div class="xbartist animated">
                	<div class="xbartistname marquee">artist</div>
    	        </div>
            <?php endif; ?>
                <?php if($showalbum) : ?>
    	    	<div class="xbalbum animated">
                	<div class="marquee xbalbumtitle">album</div>
	        	</div>
            <?php endif; ?>
		</div>  
	<!-- 	<div class="clearfix"></div> -->  		
	</div>
    <?php if($showprogress) : ?>
    	<div class="xbprogress">
    		<progress class="xbprogressbar value="32" max="100"></progress>
        	<span class="xbplaydur"></span>
    	</div>
    <?php endif; ?>
</div>
