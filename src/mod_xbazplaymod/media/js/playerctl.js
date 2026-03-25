/**
 * @package xbAzPlayMod
 * @filesource /media/mod_xbazplaymod/js/playerctl.js
 * @version 0.0.1.3 2nd March 2026
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
	var azapi = document.getElementById('playerctrls').getAttribute('azapi');
   $.ajax({
        cache: false,
        dataType: "json",
        url: azapi + '/nowplaying/wreckersradio',
        success: function(np) {
            // Do we have a change of track
			if (np.now_playing.song.id != nowId) {
				//console.log('update '+nowId);
				if (np.now_playing.song.title == '') {
					trackok.style.display = "none"; 
				} else {
					trackok.style.display = "block"; 
					document.getElementById('nowtrack').innerText = np.now_playing.song.title;					
				}
				document.getElementById('nowcover').src = np.now_playing.song.art;
				if (np.now_playing.song.artist == '') {
					artistok.style.display = "none"; 
				} else {
					artistok.style.display = "block"; 
					document.getElementById('nowartist').innerText = np.now_playing.song.artist;					
				}
				if (np.now_playing.song.album == '') {
					albumok.style.display = "none"; 
				} else {
					albumok.style.display = "block"; 
					document.getElementById('nowalbum').innerText = np.now_playing.song.album;					
				}
				//update track id
				nowId = np.now_playing.song.id;
				// animate any text that is overflowing
				document.querySelectorAll('.animated').forEach(container => {
				  	const content = container.querySelector('.marquee');
				  	if (content.scrollWidth > content.offsetWidth) {
				    	if (!container.classList.contains('animate-overflow')) {
				    		container.classList.add('animate-overflow');
				  		}
				  	} else {
						container.classList.remove('animate-overflow');
					}
				});
				document.getElementById('progbar').max =  np.now_playing.duration;			          
			}
			if (np.now_playing.elapsed) {
				document.getElementById('progbar').value =  np.now_playing.elapsed;		
				const mins = Math.floor(np.now_playing.duration / 60);
				const secs = np.now_playing.duration % 60;
				document.getElementById('nowduration').innerText = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;	          			
			}
            nowPlayingTimeout = setTimeout(loadNowPlaying, 9000);
        }
    }).fail(function() {
        nowPlayingTimeout = setTimeout(loadNowPlaying, 30000);
    });
}

$(function() {
	var trackok = document.getElementById('trackok');
	var artistok = document.getElementById('artistok');
	var albumok = document.getElementById('albumok');
    loadNowPlaying();
});