/**
 * @package xbAzHead
 * @filesource /media/mod_xbazhead/js/playerctl.js
 * @version 0.0.1.4 9th March 2026
 * @desc functions to start and stop player. Trigger with buttonclick
 * @author Roger C-O
 * @copyright Copyright (c) Roger Creagh-Osborne, 2026
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html 
 * 
**/
//if (!window.Joomla) {
//  throw new Error('Joomla API was not properly initialised');
//}

var nowPlayingTimeout;
var nowPlaying;
let headId = "0";


function loadNowPlaying() {
	var azapi = document.getElementById('hdctrls').getAttribute('azapi');
   $.ajax({
        cache: false,
        dataType: "json",
        url: azapi + '/nowplaying/wreckersradio',
        success: function(np) {
            // Do we have a change of track
			if (np.now_playing.song.id != headId) {
				//console.log('update '+headId);
				let songs = document.querySelectorAll('.xbsong.animated');
				for (const song of songs) {
					if (np.now_playing.song.title == '') {
						song.style.display = "none"; 
					} else {
						song.style.display = "block"; 
						song.querySelector('.xbsongtitle').innerText = np.now_playing.song.title;					
					}				    
				}
				let pics = document.querySelectorAll('.xbcoverpic');
				for (const pic of pics) {	
					pic.src = np.now_playing.song.art;
				}
				let artists = document.querySelectorAll('.xbartist.animated');
				for (const artist of artists) {
					if (np.now_playing.song.artist == '') {
						artist.style.display = "none"; 
					} else {
						artist.style.display = "block"; 
						artist.querySelector('.xbartistname').innerText = np.now_playing.song.artist;					
					}				    
				}
				let albums = document.querySelectorAll('.xbalbum.animated');
				for (const album of albums) {
					if (np.now_playing.song.album == '') {
						album.style.display = "none"; 
					} else {
						album.style.display = "block"; 
						album.querySelector('.xbalbumtitle').innerText = np.now_playing.song.album;					
					}
				    
				}
				//update track id
				headId = np.now_playing.song.id;
				// animate any text that is overflowing
				let parents = document.querySelectorAll('.animated');
				for (const parent of parents) {
				  	let content = parent.querySelector('.marquee');
				  	if (content.scrollWidth > content.offsetWidth) {
				    	if (!parent.classList.contains('animate-overflow')) {
				    		parent.classList.add('animate-overflow');
				  		}
				  	} else {
						parent.classList.remove('animate-overflow');
					}
					
				}
				
				let progbars = document.querySelectorAll('.xbprogressbar');
				for (const progbar of progbars) {
					progbar.max =  np.now_playing.duration;			          					
				}
			}
			if (np.now_playing.elapsed) {
				let progress = document.querySelectorAll('.xbprogressbar');
				const mins = Math.floor(np.now_playing.duration / 60);
				const secs = np.now_playing.duration % 60;
				for (const prog of progress) {
					prog.value =  np.now_playing.elapsed;			          					
				}
				let durs = document.querySelectorAll('.xbplaydur');
				for (const dur of durs) {
					dur.innerText = `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;	
				}          			
			}
            nowPlayingTimeout = setTimeout(loadNowPlaying, 9000);
        }
    }).fail(function() {
        nowPlayingTimeout = setTimeout(loadNowPlaying, 30000);
    });
}

$(function() {
	var hdtrackok = document.getElementById('hdtrackok');
	var hdartistok = document.getElementById('hdartistok');
	var hdalbumok = document.getElementById('hdalbumok');
    loadNowPlaying();
});