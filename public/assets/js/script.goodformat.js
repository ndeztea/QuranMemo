var QuranJS = {
	siteUrl : '',
	totalAyatSpaces : [''],
	totalAyat : 0,
	headSurah : 0,
	loadingText : ['"Hai orang-orang yang beriman. Bersabarlah kamu, dan kuatkanlah kesabaranmu dan tetaplah bersiaga-siaga (diperbatasan negrimu) dan bertaqwalah kepada Allah supaya kamu beruntung." (Ali-Imran 200).','"Tetapi orang yang bersabar dan memaafkan sesungguhnya (perbuatan) yang demikian itu termasuk hal-hal yang diutamakan" (Asy-Syuura 43)','"Sesungguhnya kesabaran itu hanyalah pada pukulan yang pertama dari bala" (Hadist Muttafaq\'alaih)'],

	modalLoading : function(){
		randomInt = Math.floor(Math.random() * (3 - 1)) + 1;

		$('.modal-title').html('<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>');

		$('.modal-body').html(this.loadingText[randomInt]);
		$('.modal-header button,.modal-footer').hide();
	},

	modalLoadingBlock : function(){
		$('.modal-body').html('loading');
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

		$.getJSON(this.siteUrl+'/register',{},function(response){
			$('.modal-title').html(response.modal_title);
			$('.modal-body').html(response.modal_body);
			$('.modal-footer').html(response.modal_footer);

			$('.modal-header button').show();
			clientId = jQuery('#clientId_tmp').val();
			jQuery('#register_device_id').val(clientId);
		});
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
		// Allah mark
		jQuery('.trans').highlight('Allah','highlight-red', { wordsOnly: true });
        jQuery('.arabic').highlight('للَّهِ','highlight-red');
        jQuery('.arabic').highlight('ٱللَّهُ','highlight-red');
        jQuery('.arabic').highlight('ٱللَّهَ','highlight-red');
        jQuery('.arabic').highlight('لِلَّهِ','highlight-red');
        jQuery('.arabic').highlight('اللَّهُ','highlight-red');
        jQuery('.arabic').highlight('اللَّهَ','highlight-red');


        // mark stop
        $('.arabic').highlight('ۛ','highlight-red pause-marks');
        $('.arabic').highlight('ۘ','highlight-red');
        $('.arabic').highlight('ۗ','highlight-red pause-marks');
        $('.arabic').highlight('ۚ','highlight-red pause-marks');

        $('.arabic').highlight('ۖ','highlight-orange');

        $('.arabic').highlight('ۙ','highlight-green pause-marks');
    },

    /**
    * @todo satukan huruf
    *
    */
    tajwidHighlight: function(){
    	//tajwid mark (Ikhfa)
        var arrIkhfa = ['ت','د','ذ','ز','ث','ج','س','ش','ص','ض','ط','ظ','ف','ق','ك'];
        for (i = 0; i < arrIkhfa.length; i++) {
        	// nun-mati
        	jQuery('.arabic').highlight('نْ'+arrIkhfa[i],'highlight-orange tajwid');
			$('.arabic').highlight('نْ '+arrIkhfa[i],'highlight-orange tajwid');

        	// tanwin
        	$('.arabic').highlight('ً '+arrIkhfa[i],'highlight-orange tajwid tanwin1');
        	$('.arabic').highlight('ً'+arrIkhfa[i],'highlight-orange tajwid tanwin1');
        	$('.arabic').highlight('ٌ '+arrIkhfa[i],'highlight-orange tajwid tanwin1');
        	$('.arabic').highlight('ٌ'+arrIkhfa[i],'highlight-orange tajwid tanwin1');
        	$('.arabic').highlight('ٍ '+arrIkhfa[i],'highlight-orange tajwid tanwin2');
        	$('.arabic').highlight('ٍ'+arrIkhfa[i],'highlight-orange tajwid tanwin2');

        	//

		}

		// idhgam
		var arrIdgham = ['ي','ن','م','و','ل','ر'];
		for (i = 0; i < arrIdgham.length; i++) {
        	// nun-mati
        	$('.arabic').highlight('نْ'+arrIdgham[i],'highlight-blue tajwid');
			$('.arabic').highlight('نْ '+arrIdgham[i],'highlight-blue tajwid');

        	// tanwin
        	$('.arabic').highlight('ً '+arrIdgham[i],'highlight-blue tajwid tanwin1');
        	$('.arabic').highlight('ً'+arrIdgham[i],'highlight-blue tajwid tanwin1');
        	$('.arabic').highlight('ٌ '+arrIdgham[i],'highlight-blue tajwid tanwin1');
        	$('.arabic').highlight('ٌ'+arrIdgham[i],'highlight-blue tajwid tanwin1');
        	$('.arabic').highlight('ٍ '+arrIdgham[i],'highlight-blue tajwid tanwin2');
        	$('.arabic').highlight('ٍ'+arrIdgham[i],'highlight-blue tajwid tanwin2');

        	//

		}

		// iqlab
		var arrIqlab = ['ب'];
		for (i = 0; i < arrIqlab.length; i++) {
        	// nun-mati
        	$('.arabic').highlight('نْ'+arrIqlab[i],'highlight-green tajwid');
			$('.arabic').highlight('نْ '+arrIqlab[i],'highlight-green tajwid');

        	// tanwin
        	$('.arabic').highlight('ً '+arrIqlab[i],'highlight-green tajwid tanwin1');
        	$('.arabic').highlight('ً'+arrIqlab[i],'highlight-green tajwid tanwin1');
        	$('.arabic').highlight('ٌ '+arrIqlab[i],'highlight-green tajwid tanwin1');
        	$('.arabic').highlight('ٌ'+arrIqlab[i],'highlight-green tajwid tanwin1');
        	$('.arabic').highlight('ٍ '+arrIqlab[i],'highlight-green tajwid tanwin2');
        	$('.arabic').highlight('ٍ'+arrIqlab[i],'highlight-green tajwid tanwin2');

        	//

		}

		// qalqalah
		/*var arrIqlab = ['د','ج','','ب','ط','ق'];
		for (i = 0; i < arrIqlab.length; i++) {
        	// nun-mati
        	//$('.arabic').highlight(arrIqlab[i]+'ْ','highlight-gray tajwid');
			//$('.arabic').highlight(arrIqlab[i]+'ْ ','highlight-gray tajwid');
		}*/
		$.fn.nthEverything();

		$( ".tajwid" ).each(function( index ) {
			$(this).html("&zwj;"+$(this).html()+"&zwj;");
		});


		$('.tajwid').val('true');
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
		document.cookie = 'coo_footer_action='+show+';visited=true;path=/;';
	},

	configMuratal : function (val,level){
		// check level subs
		if(val=='Al_Afasy'){
			this.refreshMuratal(val);
			return true;
		}else if(val=='Ali_Jaber' || val=='As_Sudais' || val=='Ghamadi' || val=='Husary' || val=='Menshawi'){
			if(level<1){
				this.callModal('subscription');
				return true;
			}
			this.refreshMuratal(val);
			return true;
		}else if(val=='Warsh_AlDosary' || val=='Warsh_AbdulBasit' || val=='Warsh_Yassin_AlJazaery'){
			if(level<2){
				this.callModal('subscription');
				return true;
			}
			this.refreshMuratal(val);
			return true;
		}
		return true;
	},

	refreshMuratal : function(val){
		//alert(val);
		//location.href=siteUrl+'/mushaf/set_muratal/'+val;
		$('.muratal').val(val);
		document.cookie = 'coo_sound='+val+';visited=true;path=/;';
		$('.muratal_modified').show();
	},

	showMushaf : function (mushaf){

		jQuery('.mushaf').removeClass('mushaf_arabic_trans');
		jQuery('.mushaf').removeClass('mushaf_arabic');
		jQuery('.mushaf').removeClass('mushaf_trans');

		if(mushaf=='mushaf_arabic_trans'){
			//jQuery('.trans').removeClass('puff').removeClass('go');
			//jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.trans').show();
			jQuery('.arabic').show();
		}else if(mushaf=='mushaf_arabic'){
			//jQuery('.trans').addClass('puff').removeClass('go');
			//jQuery('.arabic').removeClass('puff').addClass('go');
			jQuery('.arabic').show();
			jQuery('.trans').hide();

		}else if(mushaf=='mushaf_trans'){
			//jQuery('.trans').removeClass('puff').addClass('go');
			//jQuery('.arabic').removeClass('go').addClass('puff');
			jQuery('.trans').show();
			jQuery('.arabic').hide();
		}

		jQuery('.mushaf_layout').val(mushaf);
		jQuery('.mushaf').addClass(mushaf);
		jQuery('.mushaf_display a').removeClass('active');
		jQuery('.'+mushaf).addClass('active');

		document.cookie = 'coo_mushaf_layout='+mushaf+';visited=true;path=/;';
	},

	showTajwid : function(tajwid){
		if(tajwid=='true'){
			document.cookie = 'coo_tajwid='+tajwid+';visited=true;path=/;';
		}else{
			document.cookie = 'coo_tajwid=;visited=true;path=/;';
		}

		$('.tajwid_modified').show();
	},


	autoPlay : function (val){
		$('.automated_play').val(val);
		document.cookie = 'coo_automated_play='+val+';visited=true;path=/;';
	},

	memozList : function(){
		$('#QuranModal').modal('show');
		this.modalLoading();
		this.removeModalClass();
		$.getJSON(this.siteUrl+'/memoz/list',{},function(response){
			$('.modal-title').html(response.modal_title);
			$('.modal-body').html(response.modal_body);
			if(response.modal_footer!=''){
				$('.modal-footer').show();
				$('.modal-footer').html(response.modal_footer);
			}

			$('#QuranModal').addClass(response.modal_class);
			$('.modal-header button').show();

			// show default listing memoz
			jQuery('.memoz-loading').show();
			$.post(response.site_url+'/memoz/list_ajax',{
				filter : '0'
			},function(response){
				jQuery('.memoz-list').html(response.html);
				jQuery('.memoz-loading').hide();
			});
		})
	},

	correctionList : function (next,idMemo){
		jQuery('.btn-loadmore').show();
		if(next!=''){
			jQuery('.btn-loadmore').html('Loading...');
		}else{
			jQuery('#QuranModal').modal('show');
			this.modalLoading();
			this.removeModalClass();

			jQuery('.memoz-list').hide();
			jQuery('.memoz-list').html('');
			jQuery('.memoz-loading').show();
		}

		var count = $( ".memoz-item" ).length;
		$.post(this.siteUrl+'/memoz/correction/list',{
			start : count,
			idMemo : idMemo
		},function(response){
			if(response.modal_footer!=''){
				jQuery('.modal-footer').show();
				jQuery('.modal-footer').html(response.modal_footer);
			}

			if(response.start=='0'){
				jQuery('.modal-title').html(response.modal_title);
				jQuery('.modal-body').html(response.modal_body);
			}else{
				jQuery('.btn-loadmore').before(response.modal_body);
			}

			jQuery('.memoz-list').show();
			jQuery('.memoz-loading').hide();
			if(response.count!=0){
				jQuery('.btn-loadmore').html('Selanjutnya');
			}else{
				jQuery('.btn-loadmore').hide();
			}
			jQuery('.close').show();

		});
	},

	memozFilter : function(filter,next){
		jQuery('.btn-loadmore').show();
		if(next!=''){
			jQuery('.btn-loadmore').html('Loading...');
		}else{
			jQuery('.memoz-list').hide();
			jQuery('.memoz-list').html('');
			jQuery('.memoz-loading').show();
		}

		var count = $( ".memoz-item" ).length;
		$.post(this.siteUrl+'/memoz/list_ajax',{
			filter : filter,
			start : count
		},function(response){
			if(response.start=='0'){
				jQuery('.memoz-list').html(response.html);
			}else{
				jQuery('.btn-loadmore').before(response.html);
			}

			jQuery('.memoz-list').show();
			jQuery('.memoz-loading').hide();
			if(response.count!=0){
				jQuery('.btn-loadmore').html('Selanjutnya');
			}else{
				jQuery('.btn-loadmore').hide();
			}

		});
	},

	memozOthers : function(filter,next){
		jQuery('.btn-loadmore').show();
		if(next!=''){
			jQuery('.btn-loadmore').html('Loading...');
		}else{
			jQuery('#QuranModal').modal('show');
			this.modalLoading();
			jQuery('.memoz-list').hide();
			jQuery('.memoz-list').html('');
			jQuery('.memoz-loading').show();
		}

		var count = $( ".memoz_filter_others .correction-list-item" ).length;
		$.post(this.siteUrl+'/memoz/list_others_ajax',{
			filter : filter,
			start : count
		},function(response){
			if(response.start=='0'){
				jQuery('.modal-body').html(response.html);
				jQuery('.modal-footer').html('<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>');
				jQuery('.modal-title').html('Hafalan lain');
				jQuery('.modal-footer,.close').show();

			}else{
				jQuery('.btn-loadmore').before(response.html);
			}

			jQuery('.memoz-loading').hide();
			if(response.count>0){
				jQuery('.btn-loadmore').html('Selanjutnya');
			}else{
				jQuery('.btn-loadmore').hide();
			}

		});
	},

	needCorrections : function(next){
		jQuery('.btn-loadmore').show();
		if(next!=''){
			jQuery('.btn-loadmore').html('Loading...');
		}else{
			jQuery('#QuranModal').modal('show');
			this.modalLoading();
			jQuery('.memoz-list').hide();
			jQuery('.memoz-list').html('');
			jQuery('.memoz-loading').show();
		}

		var count = $( ".corrections_filter_others .correction-list-item" ).length;
		$.post(this.siteUrl+'/memoz/list_need_corrections_ajax',{
			start : count
		},function(response){
			if(response.start=='0'){
				jQuery('.modal-body').html(response.html);
				jQuery('.modal-footer').html('<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>');
				jQuery('.modal-title').html('Butuh koreksi');
				jQuery('.modal-footer,.close').show();

			}else{
				jQuery('.btn-loadmore').before(response.html);
			}

			jQuery('.memoz-loading').hide();

			if(response.count>0){
				jQuery('.btn-loadmore').html('Selanjutnya');
			}else{
				jQuery('.btn-loadmore').hide();
			}

			// hide button lainnya
			//console.log(response.html.indexOf("correction-list-item"));
			/*if(response.html.indexOf("correction-list-item")!=-1){
				jQuery('.btn-loadmore').show();
			}else{
				jQuery('.btn-loadmore').hide();
			}*/

		});
	},

	showInfoMemoz : function (){
		QuranJS.callModal('info_memoz');
		$('#QuranModal').modal('show');
		$('.modal-title').html('Panduan menghafal');

	},

	stepMemoz : function(steps,elm){
		// active tabs
		//console.log(elm.length);
		if(typeof(elm.length)=='undefined'){
			jQuery('.memoz-filter li').removeClass('active');
			jQuery(elm).parent().addClass('active');
		}

		jQuery('.mushaf-hafalan').removeClass('step-1');
		jQuery('.mushaf-hafalan').removeClass('step-2');
		jQuery('.mushaf-hafalan').removeClass('step-3');
		jQuery('.mushaf-hafalan').removeClass('step-4');
		jQuery('.mushaf-hafalan').removeClass('step-5');
		jQuery('.mushaf-hafalan').addClass('step-'+steps);
		if(steps=='correction'){
			jQuery('.mushaf-hafalan').addClass('step-4');
		}
		jQuery('.ayat_arabic_memoz').removeClass('blur-ayat');
		// hide recorder
		jQuery('.quran_recorder,.steps,.action-footer,.quran_player').hide();
		if(steps==1){
			jQuery('.steps,.action-footer,.quran_player').show();
			//jQuery('.trans').removeClass('puff').removeClass('go');
			//jQuery('.arabic').removeClass('puff').removeClass('go');
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
			jQuery('.steps,.action-footer,.quran_player').show();
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Hafalkan dengan teliti target hafalan arabic');
			jQuery('.jp-stop').click();
			jQuery('.memozed,.memoz_nav').hide();
			jQuery('*','.mushaf').removeClass('playing');
			jQuery('.puzzle').hide();

			jQuery('.ayat_arabic_memoz').removeClass('puzzle_q');
			jQuery('.ayat_arabic_memoz').removeClass('active');
			jQuery('.content_ayat .puzzle_border').addClass('puzzle_no_border');

			jQuery('.trans').hide();
			jQuery('.arabic,.steps').show();
		}else if(steps==3){
			jQuery('.steps,.action-footer,.quran_player').show();
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Fokuskan hafalan terjemahannya dan pelajari tafsir ayatnya');
			jQuery('.jp-stop').click();
			jQuery('.memoz_nav').hide();
			jQuery('.puzzle').hide();

			jQuery('.ayat_arabic_memoz').removeClass('puzzle_q');
			jQuery('.ayat_arabic_memoz').removeClass('active');
			jQuery('.content_ayat .puzzle_border').addClass('puzzle_no_border');
			//jQuery('.quran_player,.toggle-player,.action-footer,.memoz_player,.memozed').hide();

			jQuery('.trans,.steps').show();
			jQuery('.arabic').hide();
		}else if(steps==4 || steps=='correction'){
			//jQuery('.trans').removeClass('puff').removeClass('go');
			//jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> Bacakan setiap kata yang dihilangkan. Jika sudah hafal mulai merekam untuk test hafalan, rekaman akan dikoreksi oleh penghafal lain tau oleh ustadz pilihan QuranMemo.');
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

			// show recorder
			jQuery('.trans').show();
			jQuery('.arabic').show();
			jQuery('.quran_player').hide();
			jQuery('.quran_recorder').show();

		}else if(steps==5){
			//jQuery('.trans').addClass('puff').removeClass('go');
			//jQuery('.arabic').removeClass('puff').removeClass('go');
			jQuery('.steps_desc p').html('<i class="fa fa-info-circle"></i> PUZZLE...!! Cocokan kata yang hilang secara berurutan');
			jQuery('.jp-stop').click();
			jQuery('.memoz_player,.memozed,.puzzle').show();
			jQuery('.memoz_nav').hide();
			// puzzle logic
			jQuery('.ayat_arabic_memoz').addClass('puzzle_q');
			jQuery('*','.mushaf').removeClass('playing');
			$('.puzzle' + Math.ceil(Math.random() * 2)).show();

			jQuery('.trans').hide();
			jQuery('.arabic').show();

			// suffle element
			for(a=0;a<=this.totalAyat;a++){
				var parent = jQuery(".puzzle.puzzle_"+a+' .content_ayat');
			    var divs = parent.children();
			    while (divs.length) {
			        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
			    }
			}


			// first element
			var puzzle_word = jQuery('#puzzle_word').val();
			if(puzzle_word==''){
				jQuery('#puzzle_ayat').val(this.headSurah);
				jQuery('#puzzle_word').val('1');
				jQuery('.arabic_'+this.headSurah+' .content_ayat .puzzle_border').first().removeClass('puzzle_no_border');
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
			//console.log(jQuery( '.puzzle_'+puzzle_ayat+' .arabic-puzzle a' ).length);
			if(jQuery( '.puzzle_'+puzzle_ayat+' .arabic-puzzle a' ).length==0){
				jQuery('.puzzle_'+puzzle_ayat).remove();
				puzzle_ayat+=1;
				jQuery('#puzzle_ayat').val(puzzle_ayat);
				jQuery('#puzzle_word').val('1');
				//console.log('.arabic_'+puzzle_ayat+' .per_words_1');
				jQuery('.arabic_'+puzzle_ayat+' .per_words_1').parent().removeClass('puzzle_no_border');
			}
		}else{
			vex.dialog.alert('salah');
		}

	},

	updateCounter : function(elm){
		currVal = parseInt($('.'+elm+' .counter').html());
		$('.'+elm+' .counter').html(currVal + 1);
	},

	showAyat : function (show){
		jQuery('.ayat_arabic_memoz').removeClass('blur-ayat');
		jQuery('.memoz_nav .btn').removeClass('active');
		a=1;
		jQuery('.btn-'+show).addClass('active');
		for(o=0;o<=this.totalAyatSpaces.length;o++){
			if(show=='start'){
				min = this.totalAyatSpaces[o]>=10?3:2;
				for(b=min;b<=this.totalAyatSpaces[o];b++){
					jQuery('.arabic_'+o+' .per_words_'+b).addClass('blur-ayat');
				}
			}else if(show=='end'){
				max = this.totalAyatSpaces[o]>=10?this.totalAyatSpaces[o] - 1:this.totalAyatSpaces[o];
				//console.log(max);
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
		var htmlSelectSurah = $('.select-surah').html();
		$('.modal-body').html(htmlSelectSurah);
		$('.select2-container').remove();
		$('.selectpicker').select2();

		$('.modal-footer').html('<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>');

	},

	hidePlayer : function() {
		$('.quran_player').hide();
		$('.player-show').show();
		$('.player-hide').hide();
	},

	showPlayer : function() {
		$('.quran_player').show();
		$('.player-show').hide();
		$('.player-hide').show();
	},

	createMemoModal : function(){
		this.formMemoModal('');
		/*$('.modal-body').html('');
		$('#QuranModal').modal('show');
		$('.modal-title').html('Hafalan Baru');
		//$('.select-surah').detach().appendTo('.modal-body');
		var htmlSelectSurah = $('.select-surah').html();
		$('.modal-body').html(htmlSelectSurah);
		$('.select2-container').remove();
		$('.selectpicker').select2();

		$('.modal-footer').html('<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>');*/
	},

	formMemoCorrectionShow : function (id){
		/*$('.label-loading').show();
		$('#QuranModal').modal('show');
		$('.modal-title').html('Kirim Koreksi');
		$.post(this.siteUrl+'/memoz/formCorrection',{
					id : id,
				}, function (response){
					$('.label-loading').hide();
					$('.modal-title').html(response.modal_title);
					$('.modal-body').html(response.modal_body);
					$('.modal-footer').html(response.modal_footer);
				}
			);*/
		$('.note').hide();
		$('.btn-close').show();
		$('.action-footer').slideToggle();
	},

	formMemoCorrectionClose : function (){
		$('.note').show();
		$('.btn-close').hide();
		$('.action-footer').slideToggle();
	},

	saveMemozCorrection : function(){
		$('.label-loading').show();
		id = $('#id').val();
		var correction = '';
		$( ' .wrong' ).each(function( index ) {
			  correction += $( this ).data('css')+'|';
			});
		$.post(this.siteUrl+'/memoz/saveCorrection',{
					id_memo_target : id,
					note : $('#note').val(),
					record_file : $('#record_file').val(),
					correction : correction,
				}, function (response){
					$('.label-loading').hide();
					$('#QuranModal').modal('hide');
					vex.dialog.alert('Koreksi sudah dikirim');
				}
			);
	},

	formMemoModal : function (id){
		this.modalLoading();
		$('#QuranModal').modal('show');
		$('.modal-title').html('Simpan Hafalan');
		$.post(this.siteUrl+'/memoz/form',{
					surah_start : $('.surah_start_temp').val(),
					ayat_start : $('.ayat_start_temp').val(),
					ayat_end : $('.ayat_end_temp').val(),
					id : id,
				}, function (response){
					$('.modal-title').html(response.modal_title);
					$('.modal-body').html(response.modal_body);
					$('.modal-footer').html(response.modal_footer);

					$('.modal-header button').show();
					$('.input-daterange').datepicker({
			            format: "yyyy-mm-dd",
			            clearBtn: true,
			            autoclose: true,
			            todayHighlight: true
			        });
				}
			);
	},

	saveMemoz : function (id){
		$('.label-loading').show();
		$('.label-save').hide();
		$.post(this.siteUrl+'/memoz/save',{
					id : id,
					surah_start : $('#surah_start').val(),
					ayat_start : $('#ayat_start').val(),
					ayat_end : $('#ayat_end').val(),
					date_start : $('#date_start').val(),
					date_end : $('#date_end').val(),
					note : $('#note').val(),
				}, function (response){
					vex.dialog.alert(response.message);
					$('.label-loading').hide();
					$('.label-save').show();
					$('#id').val(response.id);
					if(response.status==true){
						location.href = response.siteUrl+'/memoz/surah/'+response.surah_start+'/'+response.ayat_start+'-'+response.ayat_end+'/'+response.id;
						//$('.btn-save-memoz').attr('onclick','QuranJS.saveMemoz('+response.id+');return false;');
						//$('.btn-form-memoz').attr('onclick','QuranJS.formMemoModal('+response.id+');return false;');
					}
				}
			);
	},

	updateStatusMemoz : function (id,status,text){
		var id = id;
		var status = status;
		var text = text;
		var siteUrl = this.siteUrl;

		vex.dialog.confirm({
		    message: text,
		    callback: function (value) {
		    	if(value==true){
		        	$('.label-status-loading').show();
					$('.label-status-save').hide();
					$.post(siteUrl+'/memoz/updateStatus',{
							id : id,
							status : status
						}, function (response){
							//alert(response.message);
							$('.label-status-loading').hide();
							$('.label-status-save').show();
							if(response.status==true){
								$('.btn-status-save').attr('onclick','QuranJS.updateStatusMemoz(\''+response.id+'\',\''+response.status_memoz+'\',\''+response.text_confirm+'\');return false;');
								if(response.status_memoz==0){
									$('.memoz-1').show();
									$('.memoz-0').hide();
								}else{
									$('.memoz-1').hide();
									$('.memoz-0').show();
								}

								// update on list memoz
								$('.memoz-item.memoz-'+response.id).slideUp();

							}
						}
					);
				}
		    }
		})


	},

	deleteMemoz : function (id){
		var id = id;
		var siteUrl = this.siteUrl;
		vex.dialog.confirm({
		    message: "Yakin hafalan ini di hapus?!",
		    callback: function (value) {
		    	if(value==true){
		        	$('.label-status-loading').show();
					//$('.label-loading').show();
					$('.label-save').hide();
					$.post(siteUrl+'/memoz/remove',{
							id : id,
						}, function (response){
							$('.label-status-loading').hide();
							//$('.label-loading').hide();
							$('.label-save').show();
							if(response.status==true){
								$('.memoz-'+response.id).slideUp();
							}else{
								vex.dialog.alert(response.message);
							}
						}
					);
				}
		    }
		})

	},

	correctionMemoz : function (line,id){
		if($('.mushaf-hafalan').hasClass('step-4')){
			if(!$('.arabic_'+line+' .per_words_'+id).hasClass('wrong')){
				$('.arabic_'+line+' .per_words_'+id).addClass('wrong');
			}else{
				$('.arabic_'+line+' .per_words_'+id).removeClass('wrong');
			}
			//$('#btn-correction').hide();
			$( ' .wrong' ).each(function( index ) {
			  console.log( index + ": " + $( this ).data('css') );
			  $('#btn-correction').show();
			});
		}

	},

	setBookmark : function(title, url){
		var hasClass = jQuery('#bookmark').hasClass('fa-bookmark-o');
		if(hasClass==true){
			document.cookie = 'coo_mushaf_bookmark_title='+title+';visited=true;path=/;';
			document.cookie = 'coo_mushaf_bookmark_url='+url+';visited=true;path=/;';
			jQuery('#bookmark').removeClass('fa-bookmark-o');
			jQuery('#bookmark').addClass('fa-bookmark');
			$('.bookmark-sign').slideDown()
			//vex.dialog.alert(title+' - telah di tandai halaman terakhir dibaca');
		}else{
			document.cookie = 'coo_mushaf_bookmark_title=;visited=true;path=/;';
			document.cookie = 'coo_mushaf_bookmark_url=;visited=true;path=/;';
			jQuery('#bookmark').removeClass('fa-bookmark');
			jQuery('#bookmark').addClass('fa-bookmark-o');
			//vex.dialog.alert('Halaman terakhir dibaca dihapus');
			$('.bookmark-sign').slideUp()
		}

	},

	bookmarkModal : function (title,url){
		var mushafUrl = this.siteUrl+'/mushaf/page/1';
		if(title==''){
			location.href=mushafUrl;
			return false;
		}
		var body = '<div class="center">';
		body += '<h4>Lanjut baca '+title+'<h4>';
		body += '<button class="btn btn-green-small" onclick="location.href=\''+url+'\'">Ya</button> ';
		body += '<button class="btn btn-green-small"  onclick="location.href=\''+mushafUrl+'\'">Tidak</button>';
		//body += '<br><br><button class="btn btn-red">Hapus bookmark</button>';
		body += '</div>';

		$('.modal-title').html('Halaman terakhir dibaca');
		$('.modal-body').html(body);
		$('.modal-footer').show();
		$('.modal-footer').html('<button class="btn btn-green-small" data-dismiss="modal">Tutup</button>');
		$('.modal-header button').show();
		$('#QuranModal').modal('show');
	},

	authProcess : function(){
		$('.label-loading').show();
		$('.label-masuk').hide();
		$.post(this.siteUrl+'/auth/loginAction',{
					email : $('#login_email').val(),
					password : $('#login_password').val(),
				}, function (response){
					if(response.login==true){
						document.cookie = 'coo_quranmemo_email='+response.coo_quranmemo_email+';visited=true;path=/;';
						document.cookie = 'coo_quranmemo_password='+response.coo_quranmemo_password+';visited=true;path=/;';
						location.href=response.redirect;
					}else{
						vex.dialog.alert(response.errorMessage);
					}

					$('.label-masuk').show();
					$('.label-loading').hide();
				}
			);
	},

	forgetProcess : function(){
		$('.label-loading').show();
		$('.label-masuk').hide();
		$.post(this.siteUrl+'/auth/forgetProcess',{
					email : $('#login_email').val(),
				}, function (response){
					if(response.return==true){
						vex.dialog.alert('Password sudah dikirim ke email, silahkan cek Inbox email, jika tidak ada cek SPAM folder.');
					}else{
						vex.dialog.alert('Email tidak terdaftar, silahkan daftar terlebih dahulu');
					}
					$('.label-masuk').show();
					$('.label-loading').hide();
				}
			);
	},

	uploadAvatar : function(){
		$('#btn-upload').val('Uploading...');
		$('#btn-upload').prop("disabled",true);

		var formData = new FormData();
		formData.append('avatar', $('#avatar')[0].files[0]);

		$.ajax({
			url: this.siteUrl+'/profile/uploadAvatar', // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data:  formData, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				if(data=='false'){
					vex.dialog.alert('Upload avatar gagal');
				}else{
					vex.dialog.alert('Upload avatar sukses');
					$('#img_avatar').attr('src',data);
				}
				$('#btn-upload').val('Upload');
				$('#btn-upload').removeAttr("disabled");
			}
		});
	},

	updateInProgress:function(id){
		$('.label-status-loading').show();
		$.post(this.siteUrl+'/memoz/inProgress',{
					id : id,
				}, function (response){
					if(response.status==1){
						$('.memoz-item.memoz-'+response.id).detach().prependTo('.memoz_filter_0').hide().slideDown();
						$('.memoz-item i.fa-star').removeClass('fa-star').addClass('fa-star-o');
						$('.memoz-item.memoz-'+response.id+' i.fa-star-o').addClass('fa-star').removeClass('fa-star-o');
						vex.dialog.alert('Berhasil di update');
					}else{
						vex.dialog.alert('Gagal di update');
					}
					$('.label-status-loading').hide();
				}
			);
	},

	submitMemoz : function(level){
		surah = $('#surah_start').val();
		if(surah==1 || surah>=78){
			jQuery('.form-inline').submit();
			return true;
		}else{
			if(level>=1){
				jQuery('.form-inline').submit();
				return true;
			}
		}

		this.callModal('subscription');
		return true;

	}





}
