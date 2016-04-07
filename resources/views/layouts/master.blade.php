<html>
    <head>
        <meta name="google-site-verification" content="hXTmvIk3V_yZywNDwJlIFWrS1DQOcNV7UDLCBQUEUv0" />
        <title>QuranMemo - {{ isset($header_title)?$header_title:''}}</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <meta property="og:url" content="{{Request::url()}}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="QuranMemo - {{isset($header_title)?$header_title:''}}" />
        <meta property="og:description"   content="{{ isset($header_description)?$header_description:'Membaca Al-Quran Online, menghafal Al-Quran Mandiri, Tafsir Al-Quran, Berbagi catatan Al-Quran dan Hadist-Hadist pilihan'}}" />
        <meta property="og:tag"   content="Quran, Al-Quran, Memo, Al-Quran Memo, menghafal Al-Quran mandiri, menghafal Quran, menghafal Al-Quran,tafsir Al-Quran, Al-Quran Online, Membaca Al-Quran, Membaca, Online, menghafal online, hadist, arbain, hadist Muslim, hadist al-bukhari" />
        <meta property="og:image"         content="http://www.quranmemo.id/public/assets/images/cover.jpg" />
        <link rel="icon" type="image/png" href="{{url('assets/images/favicon.ico')}}">

        <meta property="description"   content="{{isset($header_description)?$header_description:'Membaca Al-Quran Online, menghafal Al-Quran Mandiri, Tafsir Al-Quran, Berbargi Mencatat Al-Quran dan Hadist-Hadist pilihan'}}" />
        <meta property="tag"   content="Quran, Al-Quran, Memo, Al-Quran Memo, menghafal Al-Quran mandiri, menghafal Quran, menghafal Al-Quran,tafsir Al-Quran, Al-Quran Online, Membaca Al-Quran, Membaca, Online, menghafal online, hadist, arbain, hadist Muslim, hadist al-bukhari" />
        <meta name="theme-color" content="#4DB578" />
        <meta name="msapplication-navbutton-color" content="#4DB578">
        <meta name="apple-mobile-web-app-status-bar-style" content="#4DB578">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">


        <link href='https://fonts.googleapis.com/css?family=Fira+Sans' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lateef&subset=arabic,latin' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">

        <!-- Optional theme -->
        <link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/bootstrap-theme.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/animate.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/responsive-media.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/custom.css')}}">

        <!--script src="//da189i1jfloii.cloudfront.net/js/kinvey-html5-1.6.8.min.js"></script-->

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{url('assets/js/script.js')}}"></script>
        
        <script type="text/javascript">
            QuranJS.siteUrl = '{{url()}}';
        </script>

        @if(session('searchSurah'))
        <script>
            $(document).ready(function(){
                location.href='#head_surah_{{ session('searchSurah') }}';
                //$('.head_surah_{{ session('searchSurah') }}').css('background-color','#8DB34F');
                //$('.head_surah_{{ session('searchSurah') }}').animate({backgroundColor: "#ff0000" });
                //$('.head_surah_{{ session('searchSurah') }}').animate({backgroundColor: '#FF0000'});
            });
        </script>
        @endif
        <!-- JPlayer-->
        <link href="{{url('assets/jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css')}}" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="{{url('assets/jplayer/lib/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/jplayer/dist/jplayer/jquery.jplayer.min.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/jplayer/dist/add-on/jplayer.playlist.min.js')}}"></script>
    </head>
    <body class="@if(isset($body_class)) {{$body_class}} @endif">

        <!-- pre loader-->
        <div id="preloader">
            <!--img src="{{url('assets/images/loading.gif')}}"-->
            <div class="loading">Mohon tunggu...<br>
            <img src="{{url('assets/images/loading.svg')}}?>" /></div>
        </div>
        @section('sidebar')
           <!-- This is the master sidebar. -->
        @show

        <div class="toggle-player">
            <a href="#" class="btn btn-toggle-player btn-hide-player" id="btn-toggle-player" data-toggle="tooltip" data-placement="top" title="Show / Hide Player"><i class="fa fa-play-circle"></i></a>
        </div>
        <!-- /toggle-player -->
        
        <div id="main-nav">
            <ul>
                <li><a href="<?php echo url('mushaf')?>">{{trans('trans.mushaf')}}</a></li>
                <!--li><a href="<?php echo url('note')?>">{{trans('trans.note')}}</a></li-->
                <li><a href="<?php echo url('memoz')?>">{{trans('trans.memo')}}</a></li>
            </ul>

            
        </div>

        <nav class="navbar navbar-default qm-navbar">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">QuranMemo</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="{{Request::segment(1)=='mushaf' || Request::segment(1)==''?'active':''}}"><a href="{{url('mushaf')}}">{{trans('trans.mushaf')}}</a></li>
                        <!--li><a href="<?php echo url('note')?>"><?php echo trans('trans.note')?></a></li-->
                        <li class="{{Request::segment(1)=='memoz'?'active':''}}"><a href="{{url('memoz')}}">{{trans('trans.memo')}}</a></li>
                    </ul>
                    <div class="navbar-nav navbar-right">
                        <form class="navbar-form" role="search" method="get" action="{{url('mushaf/searchKeyword')}}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari kata" name="keyword">
                                <div class="input-group-btn">
                                    <button class="btn btn-green btn-search" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="wrap">
            @yield('content')
        </div>

        <div class="footer">
            <ul>
                <li><span>Copyright &copy; 2016</span></li>
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#QuranModal" onclick="QuranJS.callModal('about')" >Tentang QuranMemo</a></li>
                <li><a href="javascript:void(0)" data-toggle="modal" data-target="#QuranModal" onclick="QuranJS.callModal('contact')" >Hubungi Kami</a></li>
            </ul>
        </div>
        <!-- /footer -->
        
        <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="QuranModal" tabindex="-1" role="dialog" aria-labelledby="QuranModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="QuranModalTitle"></h4>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer"> </div>
        </div>
      </div>
    </div>

    <script src="{{url('assets/js/jquery-ui.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/jquery.highlight.js')}}"></script>

    <script type="text/javascript">
          $(document).ready(function(){
                $('#preloader').hide();
                QuranJS.redHightlight();

                /*var promise = Kinvey.init({
                    appKey    : 'af86c6c58e514a45acfa7b0a56ff642b',
                    appSecret : '2786e39b23f444e6b42506925d78a098'
                });
                promise.then(function(activeUser) {
                    console.log('ok');
                }, function(error) {
                    console.log('error');
                });

                var promise = Kinvey.ping();
                promise.then(function(response) {
                    console.log('Kinvey Ping Success. Kinvey Service is alive, version: ' + response.version + ', response: ' + response.kinvey);
                }, function(error) {
                    console.log('Kinvey Ping Failed. Response: ' + error.description);
                });*/
            });
            $(window).bind('beforeunload', function(){
              $('#preloader').show();
            });

        </script>
         
    </script>
    @include('layouts.analytics')  
    
    </body>
</html>