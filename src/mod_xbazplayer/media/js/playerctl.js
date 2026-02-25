/**
 * @package xbAzPlayer
 * @filesource /media/mod_xbazplayer/js/playerctl.js
 * @version 0.0.1.1 24th February 2026
 * @desc functions to start and stop player. Trigger with buttonclick
 * @author Roger C-O
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html 
 * 
**/
//if (!window.Joomla) {
//  throw new Error('Joomla API was not properly initialised');
//}

function playStart(playerid,streamUrl) {
	var player = document.getElementById(playerid);
	player.src = streamUrl;
	player.load();
	player.play();
	
}

function playStop(playerid) {
	var player = document.getElementById(playerid);
	player.pause();
	player.src = ""; // or "about:blank" or "javascript:void(0)"
	player.load();

}