var QuranJS = {
	siteUrl : '',
	changePage : function (elm){
		page = $(elm).data('value');
		if(typeof page=='undefined'){
			page = $(elm).val();
		}

		// @todo : use ajax
		location.href=this.siteUrl+'/mushaf/page/'+page;
		
	},

	changeSurah : function (surah){
		// @todo : use ajax
		location.href=this.siteUrl+'/mushaf/surah/'+$(surah).val();
	},

	fillAyatEnd : function(ayatEnd){
		if(jQuery('#fill_ayat_end').is(':checked')){
			$('#ayat_end').show();
		}else{
			$('#ayat_end').hide();
		}
		
	}
} 

