<?php 
// define surah
// @todo define all surah
$surahMuratal[1] = 'Al-Fatiha';
$surahMuratal[2] = 'Al-Baqara';
$surahMuratal[3] = 'Aal-E-Imran';
$surahMuratal[4] = 'An-Nisa';
?>

<script type="text/javascript">
$(document).ready(function(){

	var muratalPlaylist = new jPlayerPlaylist({
		jPlayer: "#muratalPlaylist",
		cssSelectorAncestor: "#muratalPlaylistContainer",

	},
	[
		// file list
		<?php foreach($ayats as $ayat):?>
		{
			
			title:"section_<?php echo $ayat->page?>_<?php echo $ayat->surah?>_<?php echo $ayat->ayat?>",
			<?php 
				$halMuratal = $ayat->page + 1;
				$ayatMp3 = $surahMuratal[$ayat->surah].'.'.str_pad($ayat->ayat, 3, "0", STR_PAD_LEFT).'.mp3';
			?>
			mp3: "<?php echo url('sound/hal_'.$halMuratal.'/'.$ayatMp3)?>"
		},
		<?php endforeach?>
	],
	{
		play: function(event) { 
		 	
              var ayat_selector = (event.jPlayer.status.media.title) 
              
              $('*','.mushaf').css('background-color','');
              $('div.'+ayat_selector).css('background','#DDD'); 
              var tmpcurrentPlay = muratalPlaylist.current;
              var currentPlay = parseInt(tmpcurrentPlay) + 1;
              console.log(muratalPlaylist.playlist.length+"="+ currentPlay);
              console.log(ayat_selector);
              window.goNext = false;
              if(muratalPlaylist.playlist.length==currentPlay){
              	window.goNext = true;
              }

        }, 
        end: function(event){
        	console.log('a');
        	$('*','.view-quran').css('background-color','none');
        },
        ended: function(event){
        							        	//alert(muratalPlaylist.current);
        	//var endPlaylist = muratalPlaylist.current;
        	//alert(endPlaylist+'==23');
        	//var totalAyat = $('.flag-ayat').length;

        	// jqplayer cant check thelatest playlist, the result always -1
        	// use this code to fix this
        	//endPlaylist = endPlaylist+1;
        	//console.log(muratalPlaylist.timeupdate);
        	//console.log(muratalPlaylist.playlist.length+"="+endPlaylist);
        	if(window.goNext==true){
        		//location.href='http://semutmedia.com/qmt_class/alquran/mushaf_normal/295/autoplay';
        	}
        	
        },
		playlistOptions: { 
			//autoPlay: true 
		},
          
		swfPath: "http://jplayer.org/latest/js",
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
	});

	
	//$("#jplayer_inspector_1").jPlayerInspector({jPlayer:$("#jquery_jplayer_1")});
});
</script>
<div id="muratalPlaylistContainer" class="jp-video jp-video-270p" role="application" aria-label="media player">
	<div class="jp-type-playlist">
		<div id="muratalPlaylist" class="jp-jplayer"></div>
		<div class="jp-gui">
			<div class="jp-video-play">
				<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
			</div>
			<div class="jp-interface">
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-controls-holder">
					<div class="jp-controls">
						<button class="jp-previous" role="button" tabindex="0">previous</button>
						<button class="jp-play" role="button" tabindex="0">play</button>
						<button class="jp-next" id="playlist-pause" role="button" tabindex="0">next</button>
						<button class="jp-stop" role="button" tabindex="0">stop</button>
					</div>
					<div class="jp-volume-controls">
						<button class="jp-mute" role="button" tabindex="0">mute</button>
						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
					<div class="jp-toggles">
						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						<button class="jp-shuffle" role="button" tabindex="0">shuffle</button>
					</div>
				</div>
				<div class="jp-details">
					<div class="jp-title" aria-label="title">&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="jp-playlist" style="display:none">
			<ul>
				<!-- The method Playlist.displayPlaylist() uses this unordered list -->
				<li>&nbsp;</li>
			</ul>
		</div>
		<div class="jp-no-solution">
			<span>Update Required</span>
			To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		</div>
	</div>
</div>