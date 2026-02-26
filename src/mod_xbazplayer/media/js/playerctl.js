/**
 * @package xbAzPlayer
 * @filesource /media/mod_xbazplayer/js/playerctl.js
 * @version 0.0.1.3 26th February 2026
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
	document.getElementById("startplay").style.display = "none";
	document.getElementById("stopplay").style.display = "unset";
}

function playStop(playerid) {
	var player = document.getElementById(playerid);
	player.pause();
	player.src = ""; // or "about:blank" or "javascript:void(0)"
	player.load();
	document.getElementById("startplay").style.display = "unset";
	document.getElementById("stopplay").style.display = "none";
}

var nowPlayingTimeout;
var nowPlaying;
let nowId = "0";

function loadNowPlaying() {
    $.ajax({
        cache: false,
        dataType: "json",
        url: 'http://az.wreckersradio.uk/api/nowplaying/wreckersradio',
        success: function(np) {
            // Do we have a change of track
			if (np.now_playing.song.id != nowId) {
				//console.log('update '+nowId);
				document.getElementById('nowcover').src = np.now_playing.song.art;
				document.getElementById('nowartist').innerText = np.now_playing.song.artist;
				document.getElementById('nowalbum').innerText = np.now_playing.song.album;
				document.getElementById('nowtrack').innerText = np.now_playing.song.title;
				//update track id
				nowId = np.now_playing.song.id;
				// animate any text that is overflowing
				document.querySelectorAll('.animated').forEach(container => {
				  	const content = container.querySelector('.marquee');
				  	if (content.scrollWidth > content.offsetWidth) {
				    	if (!container.classList.contains('animate-overflow')) {
				    		container.classList.add('animate-overflow');
				  		}
				  	}
				}); 			          
			}
            nowPlayingTimeout = setTimeout(loadNowPlaying, 9000);
        }
    }).fail(function() {
        nowPlayingTimeout = setTimeout(loadNowPlaying, 30000);
    });
}

$(function() {
    loadNowPlaying();
});