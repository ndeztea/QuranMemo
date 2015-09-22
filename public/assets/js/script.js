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
	}
} 

