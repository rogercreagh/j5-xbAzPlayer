/**
 * @package xbAzHead
 * @filesource /media/mod_xbazhead/js/azplayctl.js
 * @version 0.0.1.1 3rd March 2026
 * @desc functions to start and stop player. Trigger with buttonclick
 * @author Roger C-O
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html 
 * 
**/

function playStart(playerid, streamUrl) {
	var player = document.getElementById(playerid);
	player.src = streamUrl;
	player.load();
	player.play();
	document.getElementById(playerid+"start").style.display = "none";
	document.getElementById(playerid+"stop").style.display = "unset";
}

function playStop(playerid) {
	var player = document.getElementById(playerid);
	player.pause();
	player.src = ""; // or "about:blank" or "javascript:void(0)"
	player.load();
	document.getElementById(playerid+"start").style.display = "unset";
	document.getElementById(playerid+"stop").style.display = "none";
}
