var QuranJS = {
	siteUrl : '',
	totalAyatSpaces : [''],
	totalAyat : 0,
	loadingText : ['"Hai orang-orang yang beriman. Bersabarlah kamu, dan kuatkanlah kesabaranmu dan tetaplah bersiaga-siaga (diperbatasan negrimu) dan bertaqwalah kepada Allah supaya kamu beruntung." (Ali-Imran 200).','"Tetapi orang yang bersabar dan memaafkan sesungguhnya (perbuatan) yang demikian itu termasuk hal-hal yang diutamakan" (Asy-Syuura 43)','"Sesengguhnya kesabaran itu hanyalah pada pukulan yang pertama dari bala" (Hadist Muttafaq\'alaih)'],

	modalLoading : function(){
		randomInt = Math.floor(Math.random() * (3 - 1)) + 1;

		$('.modal-title').html('<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>');
		
		$('.modal-body').html(this.loadingText[randomInt]);
		$('.modal-header button').hide();
	},

	modalLoadingBlock : function(){

	},

	removeModalClass : function(){
		$('#QuranModal').removeClass('login-mode');
		$('#QuranModal').removeClass('register-mode');
		$('#QuranModal').removeClass('share-mode');
		$('#QuranModal').removeClass('content-mode');
	},

	changePage : function (elm){
		page = $(elm).data('value');
		if(typeof page=='undefined'){
			page = $('.'+elm).val();
		}
		if(page!=''){
			// @todo : use ajax
			$('#preloader').css('height','2000px');
			$('#preloader').show();
			location.href=this.siteUrl+'/mushaf/page/'+page;
		}
		
	},

	changeSurah : function (surah){
		// @todo : use ajax
		location.href=this.siteUrl+'/mushaf/surah/'+$(surah).val();
	},

	fillAyatEnd : function(ayatEnd){
		if(jQuery('#fill_ayat_end').is(':checked')){
			$('.ayat_end').show();
		}else{
			$('.ayat_end').hide();
		}
		
	},

	callModal : function(url){
		$('#QuranModal').modal('show');
		this.modalLoading();
		this.removeModalClass();
		$.getJSON(this.siteUrl+'/'+url,{},function(response){
			$('.modal-title').html(response.modal_title);
			$('.modal-body').html(response.modal_body);
			if(response.modal_footer!=''){
				$('.modal-footer').show();
				$('.modal-footer').html(response.modal_footer);
			}
			
			
			$('#QuranModal').addClass(response.modal_class);
			$('.modal-header button').show();
		})

		//$('.modal-title').html('Title');
		//$('.modal-body').html('body');
		//$('.modal-footer').html('footer');
	},

	createMemoz : function(url){
		this.modalLoading();

		$.getJSON(this.siteUrl+'/'+url,{},function(response){
			$('.modal-title').html(response.modal_title);
			$('.modal-body').html(response.modal_body);
			$('.modal-footer').html(response.modal_footer);

			$('.modal-header button').show();
		})

	},


	/** AUTH code**/
	showRegister  : function(){
		this.removeModalClass();
		$('.modal-title').html('Daftar');
		$('.login_form').hide();
		$('.register_form').show();
		$('#QuranModal').addClass('register-mode');
	},
	registerProcess : function(){
		this.modalLoadingBlock();

		name = $('#name').val();
		email = $('#email').val();
		password = $('#password').val();

		$.post(this.siteUrl+'/auth/registerProcess',{
					name : name,
					email : email,
					password : password
				}, function (reponse){
					console.log(reponse);
				}
			);
	},

	showLogin  : function(){
		this.removeModalClass();
		$('.modal-title').html('Masuk Dahulu');
		$('.login_form').show();
		$('.register_form').hide();
		$('#QuranModal').addClass('login-mode');
	},

	// show & hide player
	// togglePlayer : function (){

	// 	$('.openThis').hide();

	// 		$('.btn-toggle-player').click(function() {

	// 		    $('.quran_player').slideToggle( function() {

	// 		    	$('.openThis').show();
						
	// 			});

	// 		});

	// },

	generateTransHeight : function (importantTag){
		$( ".trans").each(function( index,element ) {
				className = '.'+$(element).attr('class').split(' ').join('.');
				height = $(className).outerHeight();
				$(className).attr('style', 'height:'+height+'px');
				//$(className).css('height','100%');     
			});
	},

	generateArHeight : function  (importantTag){
			$( ".arabic" ).each(function( index,element ) {
				className = '.'+$(element).attr('class').split(' ').join('.');
				height = $(className).outerHeight();
				$(className).attr('style', 'height:'+height+'px');
				//$(className).css('height','100%');     
			});
	},

	redHightlight:function (){
		$('.trans').highlight('Allah','highlight-red', { wordsOnly: true });
        $('.arabic').highlight('للَّهِ','highlight-red');
        $('.arabic').highlight('ٱللَّهُ','highlight-red');
        $('.arabic').highlight('ٱللَّهَ','highlight-red');
        $('.arabic').highlight('لِلَّهِ','highlight-red');
        
	},

	memorized:function(ayat) {
		$('.'+ayat).addClass('memorized');
		$('.'+ayat+' .action-footer').remove();
	},

	showMushafAction : function(show) {
		$('.footer_action').val(show);
		if(show=='true'){
			$('.action-footer').show();
		}else{
			$('.action-footer').hide();
		}
		document.cookie = 'coo_footer_action='+show+';';
	},
	showMushaf : function (mushaf){

		jQuery('.mushaf').removeClass('mushaf_arabic_trans');
		jQuery('.mushaf').removeClass('mushaf_arabic');
		jQuery('.mushaf').removeClass('mushaf_trans');

		if(mushaf=='mushaf_arabic_trans'){
			jQuery('.trans').removeClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.trans').show();
			jQuery('.arabic').show();
		}else if(mushaf=='mushaf_arabic'){
			jQuery('.trans').addClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').addClass('go');
			jQuery('.arabic').show();
			jQuery('.trans').hide();
			
		}else if(mushaf=='mushaf_trans'){
			jQuery('.trans').removeClass('puff').addClass('go');
			jQuery('.arabic').removeClass('go').addClass('puff');
			jQuery('.trans').show();
			jQuery('.arabic').hide();
		}

		jQuery('.mushaf_layout').val(mushaf);
		jQuery('.mushaf').addClass(mushaf);
		jQuery('.mushaf_display a').removeClass('active');
		jQuery('.'+mushaf).addClass('active');
		document.cookie = 'coo_mushaf_layout='+mushaf+';';
	},

	autoPlay : function (val){
		$('.automated_play').val(val);
		document.cookie = 'coo_automated_play='+val+';';
	},

	showInfoMemoz : function (){
		$('#QuranModal').modal('show');
		$('.modal-title').html('Panduan menghafal');
		$('.modal-body').html('<p>Dalam proses hafalan terdapat 5 tahapan, yaitu: </p><br><ul><li>Menghafal target hafalan arabic dan terjemahannya, jalankan dan dengarkan qori dengan teliti. Proses ini jangan terlalu lama dan lanjut ke tahap selanjutnya</li><li>Menghafal target hafalan arabic dan terjemahanya, perhatikan terjemahan dari setiap kata arabic-nya</li><li>Menghafal target hafalan arabic nya saja, perhatikan tajwid nya dan tata letak hurufnya, dan bayangkan setiap gambaran hurufnya</li><li>Menghafal target hafalan terjemahanya, dalam tahap ini antum harus setidaknya hafal banyak arabic-nya, dan kuat kan hafalan dengan terjemahannya</li><li>Menghafal target hafalan arabic dan terjemahannya, jalankan dan dengarkan qori dengan teliti, ulangi sampai berulang-ulang sampai hafal, dan yang perhatikan makhrajul huruf-nya</li></ul><br><p>Jangan lupa untuk berdo\'a kepada Allah Ta\'ala untuk di mudahkan dalam penghafalan dan pemahaman terhadap target hafalan antum.</p><p>Kunci untuk mengafal adalah <strong>ulangi dan terus ulangi</strong> membaca dan mendengarkan muratal.');
		$('.modal-footer').html('<span class="cont_hide_memoz_info"> <input type="checkbox" name="hide_memoz_info" onclick="hideInfo()" value="1"> Jangan tampilkan lagi <br></span><button  data-dismiss="modal" class="btn btn-green-small info">Bismillah mulai menghafal</button></div>');
	},

	stepMemoz : function(steps){
		jQuery('.ayat_arabic_memoz').removeClass('blur-ayat');
		if(steps==1){
			jQuery('.trans').removeClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target hafalan arabic dan terjemahannya, ulangi muratal sebanyak-banyaknya sampai hafal');
			jQuery('.jp-stop').click();
			jQuery('.memozed,.memoz_nav').hide();
			jQuery('*','.mushaf').removeClass('playing');
			jQuery('.puzzle').hide();

			jQuery('.ayat_arabic_memoz').removeClass('puzzle_q');
			jQuery('.ayat_arabic_memoz').removeClass('active');
			jQuery('.content_ayat .puzzle_border').addClass('puzzle_no_border');

			jQuery('.trans').show();
			jQuery('.arabic').show();
		}else if(steps==2){
			jQuery('.trans').addClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').addClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target hafalan arabic');
			jQuery('.jp-stop').click();
			jQuery('.memozed,.memoz_nav').hide();
			jQuery('*','.mushaf').removeClass('playing');
			jQuery('.puzzle').hide();

			jQuery('.ayat_arabic_memoz').removeClass('puzzle_q');
			jQuery('.ayat_arabic_memoz').removeClass('active');
			jQuery('.content_ayat .puzzle_border').addClass('puzzle_no_border');

			jQuery('.trans').hide();
			jQuery('.arabic').show();
		}else if(steps==3){
			jQuery('.trans').removeClass('puff').addClass('go');
			jQuery('.arabic').removeClass('go').addClass('puff');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Fokuskan hafalan terjemahannya saja');
			jQuery('.jp-stop').click();
			jQuery('.memoz_nav').hide();
			jQuery('.puzzle').hide();

			jQuery('.ayat_arabic_memoz').removeClass('puzzle_q');
			jQuery('.ayat_arabic_memoz').removeClass('active');
			jQuery('.content_ayat .puzzle_border').addClass('puzzle_no_border');
			//jQuery('.quran_player,.toggle-player,.action-footer,.memoz_player,.memozed').hide();

			jQuery('.trans').show();
			jQuery('.arabic').hide();
		}else if(steps==4){
			jQuery('.trans').removeClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> TEST...!! Bacakan setiap kata yang di hilangkan.');
			jQuery('.jp-stop').click();
			jQuery('.memoz_player,.memozed').show();
			jQuery('.memoz_nav').show();
			jQuery('*','.mushaf').removeClass('playing');
			jQuery('.puzzle').hide();

			jQuery('.ayat_arabic_memoz').removeClass('puzzle_q');
			jQuery('.ayat_arabic_memoz').removeClass('active');
			jQuery('.content_ayat .puzzle_border').addClass('puzzle_no_border');

			jQuery('.trans').show();
			jQuery('.arabic').show();

		}else if(steps==5){
			jQuery('.trans').addClass('puff').removeClass('go');
			jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> PUZZLE...!! Cocokan kata yang hilang secara berurutan');
			jQuery('.jp-stop').click();
			jQuery('.memoz_player,.memozed,.puzzle').show();
			jQuery('.memoz_nav').hide();
			// puzzle logic
			jQuery('.ayat_arabic_memoz').addClass('puzzle_q');
			jQuery('*','.mushaf').removeClass('playing');
			$('.puzzle' + Math.ceil(Math.random() * 2)).show();

			// suffle element 
			for(a=0;a<=this.totalAyat;a++){
				var parent = jQuery(".puzzle.puzzle_"+a);
			    var divs = parent.children();
			    while (divs.length) {
			        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
			    }
			}
			

			// first element
			var puzzle_word = jQuery('#puzzle_word').val();
			if(puzzle_word==''){
				jQuery('#puzzle_ayat').val('0');
				jQuery('#puzzle_word').val('1');
				jQuery('.arabic_0 .content_ayat .puzzle_border').first().removeClass('puzzle_no_border');
			}


		}

		jQuery('.steps a').removeClass('selected');
		jQuery('.steps_'+steps).addClass('selected');
	},

	puzzleAnswer : function(elm){
		var puzzle_ayat = jQuery('#puzzle_ayat').val();
		var puzzle_word = jQuery('#puzzle_word').val();
		var puzzle_active = '.arabic_'+puzzle_ayat+' .per_words_'+puzzle_word;

		var puzzle_a = jQuery(elm).data('css');
		puzzle_ayat = parseInt(puzzle_ayat);
		puzzle_word = parseInt(puzzle_word);

		if(puzzle_active==puzzle_a){
			jQuery(puzzle_active).css('visibility','visible');
			jQuery(puzzle_active).parent().addClass('puzzle_no_border');
			jQuery(puzzle_active).parent().next().removeClass('puzzle_no_border');
			jQuery(puzzle_active).parent().next().removeClass('puzzle_no_border');

			puzzle_active = jQuery(puzzle_active).parent().next().children().data('css');

			jQuery('#puzzle_active').val(puzzle_active);
			
			jQuery(elm).remove();

			// go to next word
			puzzle_word +=1;
			jQuery('#puzzle_word').val(puzzle_word);

			// check if ayat already finish
			console.log(jQuery( '.puzzle_'+puzzle_ayat+' .arabic a' ).length);
			if(jQuery( '.puzzle_'+puzzle_ayat+' .arabic a' ).length==0){
				jQuery('.puzzle_'+puzzle_ayat).remove();
				puzzle_ayat+=1;
				jQuery('#puzzle_ayat').val(puzzle_ayat);
				jQuery('#puzzle_word').val('1');
				console.log('.arabic_'+puzzle_ayat+' .per_words_1');
				jQuery('.arabic_'+puzzle_ayat+' .per_words_1').parent().removeClass('puzzle_no_border');
			}
		}else{
			alert('salah');
		}
		
	},

	showAyat : function (show){
		jQuery('.ayat_arabic_memoz').removeClass('blur-ayat');

		a=1;
		for(o=0;o<=this.totalAyatSpaces.length;o++){
			if(show=='start'){
				min = this.totalAyatSpaces[o]>=10?3:2;
				for(b=min;b<=this.totalAyatSpaces[o];b++){
					jQuery('.arabic_'+o+' .per_words_'+b).addClass('blur-ayat');
				}
			}else if(show=='end'){
				max = this.totalAyatSpaces[o]>=10?this.totalAyatSpaces[o] - 1:this.totalAyatSpaces[o];
				console.log(max);
				for(b=1;b<=this.totalAyatSpaces[o];b++){
					if(b<max){
						jQuery('.arabic_'+o+' .per_words_'+b).addClass('blur-ayat');
					}
				}
			}else if(show=='mix'){
				min = this.totalAyatSpaces[o]>=10?3:2;
				max = this.totalAyatSpaces[o]>=10?this.totalAyatSpaces[o] - 1:this.totalAyatSpaces[o];
				for(b=min;b<=this.totalAyatSpaces[o];b++){
					if(b<max){
						jQuery('.arabic_'+o+' .per_words_'+b).addClass('blur-ayat');
					}
				}
			}else if(show=='middle'){
				min = this.totalAyatSpaces[o]>=10?4:2;
				max = this.totalAyatSpaces[o]>=10?this.totalAyatSpaces[o] - 3:this.totalAyatSpaces[o];
				for(b=1;b<=this.totalAyatSpaces[o];b++){
					if(b<=min){
						jQuery('.arabic_'+o+' .per_words_'+b).addClass('blur-ayat');
					}
					if(b>=max){
						jQuery('.arabic_'+o+' .per_words_'+b).addClass('blur-ayat');
					}
				}
			}else if(show=='random'){
				for(b=1;b<=this.totalAyatSpaces[o];b++){
					if(b%2==0){
						jQuery('.arabic_'+o+' .per_words_'+b).addClass('blur-ayat');
					}
				}
			}
			

		}
	},

	showSearch : function(){
		$('#QuranModal').modal('show');
		$('.modal-title').html('Pencarian');
		htmlSearchSurah = jQuery('.select-surah').html();
		$('.modal-body').html(htmlSearchSurah);
		$('.modal-footer').hide();
	},

	createMemoModal : function(){
		$('#QuranModal').modal('show');
		$('.modal-title').html('Hafalan Baru');
		htmlSearchSurah = jQuery('.select-surah').html();
		$('.modal-body').html(htmlSearchSurah);
		$('.modal-footer').hide();
	},

	

} 

