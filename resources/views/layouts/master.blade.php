<!DOCTYPE html>
<html>
    <head>
        <meta name="google-site-verification" content="hXTmvIk3V_yZywNDwJlIFWrS1DQOcNV7UDLCBQUEUv0" />
        <title>{{ isset($header_title)?$header_title:''}} - QuranMemo</title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta property="description"   content="{{ isset($header_description)?$header_description:'Membaca Al-Quran Online, menghafal Al-Quran Mandiri, Tafsir Al-Quran, Berbagi catatan Al-Quran dan Hadist-Hadist pilihan, Quran Memo, Quran memorize application. Quran App'}}" />
        <meta name="description" content="{{ isset($header_description)?$header_description:'Membaca Al-Quran Online, menghafal Al-Quran Mandiri, Tafsir Al-Quran, Berbagi catatan Al-Quran dan Hadist-Hadist pilihan, Quran Memo, Quran memorize application. Quran App'}}">
        <meta property="keywords"   content="Quran, Al-Quran, Memo, Al-Quran Memo, menghafal Al-Quran mandiri, menghafal Quran, menghafal Al-Quran,tafsir Al-Quran, Al-Quran Online, Membaca Al-Quran, Membaca, , Quran Memo, Quran memorize application. Quran App, Online, menghafal online, hadist, arbain, hadist Muslim, hadist al-bukhari, Tajwid berwarna, Aplikasi tajwid berwarna" />
        <meta name="keywords"   content="Quran, Al-Quran, Memo, Al-Quran Memo, menghafal Al-Quran mandiri, menghafal Quran, menghafal Al-Quran,tafsir Al-Quran, Al-Quran Online, Membaca Al-Quran, Membaca, , Quran Memo, Quran memorize application. Quran App, Online, menghafal online, hadist, arbain, hadist Muslim, hadist al-bukhari" />
        <meta property="title"         content="QuranMemo - {{isset($header_title)?$header_title:''}}" />
        <meta property="og:url" content="{{Request::url()}}" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="QuranMemo - {{isset($header_title)?$header_title:''}}" />
        <meta property="og:description"   content="{{ isset($header_description)?$header_description:'Membaca Al-Quran Online, menghafal Al-Quran Mandiri, Tafsir Al-Quran, Berbagi catatan Al-Quran dan Hadist-Hadist pilihan, Quran Memo, Quran memorize application. Quran App'}}" />
        <meta property="og:tag"   content="Quran, Al-Quran, Memo, Al-Quran Memo, menghafal Al-Quran mandiri, menghafal Quran, menghafal Al-Quran,tafsir Al-Quran, Al-Quran Online, Membaca Al-Quran, Membaca, , Quran Memo, Quran memorize application. Quran App, Online, menghafal online, hadist, arbain, hadist Muslim, hadist al-bukhari" />
        <meta property="og:image"         content="https://www.quranmemo.com/public/assets/images/cover.jpg" />
        
        <link rel="apple-touch-icon" sizes="57x57" href="{{url('assets/images/ico/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{url('assets/images/ico/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{url('assets/images/ico/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{url('assets/images/ico/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{url('assets/images/ico/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{url('assets/images/ico/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{url('assets/images/ico/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{url('assets/images/ico/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{url('assets/images/ico/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{url('assets/images/ico/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('assets/images/ico/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{url('assets/images/ico/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('assets/images/ico/favicon-16x16.png')}}">
        <link rel="manifest" href="{{url('assets/images/ico/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{url('assets/images/ico/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">

        <meta property="description"   content="{{ isset($header_description)?$header_description:'Membaca Al-Quran Online, menghafal Al-Quran Mandiri, Tafsir Al-Quran, Berbagi catatan Al-Quran dan Hadist-Hadist pilihan, Quran Memo, Quran memorize application. Quran App'}}" />
        <meta property="tag"   content="Quran, Al-Quran, Memo, Al-Quran Memo, menghafal Al-Quran mandiri, menghafal Quran, menghafal Al-Quran,tafsir Al-Quran, Al-Quran Online, Membaca Al-Quran, Membaca, , Quran Memo, Quran memorize application. Quran App, Online, menghafal online, hadist, arbain, hadist Muslim, hadist al-bukhari" />
        <meta name="theme-color" content="#00978A" />
        <meta name="msapplication-navbutton-color" content="#00978A">
        <meta name="apple-mobile-web-app-status-bar-style" content="#00978A">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

        <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Lateef&subset=arabic,latin' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Scheherazade:400,700&subset=latin,arabic' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="{{url('assets/css/vendors/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/jasny-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/select2.min.css')}}">

        <style>
        .tanwin1:nth-letter(1){
            position: relative;
            top:-15px;
            left: 2px;
        }
        .tanwin2:nth-letter(1){
            position: relative;
            top:1px;
            left: 2px;
        }
        </style>

        <!-- Optional theme -->
        <link rel="stylesheet" href="{{url('assets/css/vendors/vex.css')}}" />
        <link rel="stylesheet" href="{{url('assets/css/vendors/vex-theme-os.css')}}" />
        <link rel="stylesheet" href="{{url('assets/css/vendors/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/bootstrap-theme.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/animate.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/style.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/responsive-media.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/custom.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/bootstrap-datepicker.min.css')}}">

        <!--script src="//da189i1jfloii.cloudfront.net/js/kinvey-html5-1.6.8.min.js"></script-->
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{url('assets/js/script.min.js')}}"></script>
        <script type="text/javascript">
            QuranJS.siteUrl = '{{url('')}}';
        </script>

        <script src="{{url('assets/js/vex.combined.min.js')}}"></script>
        <script>vex.defaultOptions.className = 'vex-theme-os'</script>

        <!--script type="text/javascript" src="{{url('assets/js/jquery.mobile-1.4.5.min.js')}}"></script-->
        <script type="text/javascript" src="{{url('assets/js/jquery.touchSwipe.min.js')}}"></script>
        
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
        <script type="text/javascript" src="{{url('assets/jplayer/dist/jplayer/jquery.jplayer.min.js')}}"></script>
        <script type="text/javascript" src="{{url('assets/jplayer/dist/add-on/jplayer.playlist.min.js')}}"></script>
    </head>
    <body class="@if(isset($body_class)) {{$body_class}} @endif">

        <!--div id='splash-body' class='splash-body'>
            <div id='splash' class='splash-inner'>
               <div class='splash'>
                 <div class='holder'>
                    <span class='splash-text animated fadeIn'><img src="{{url('assets/images/logo2.png')}}"></span>
                    <button class='start animated fadeIn'>
                        Get Started
                    </button>
                </div>
               </div>
            </div>
        </div-->
        <!-- /splash-body -->

        <!-- pre loader-->
        <div id="preloader">
            <!--img src="{{url('assets/images/loading.gif')}}"-->
            <div class="loading">Mohon tunggu...<br>
            <img src="{{url('assets/images/loading.svg')}}" alt="loading"/></div>
        </div>
        @section('sidebar')
           <!-- This is the master sidebar. -->
        @show

       <!--  <div class="toggle-player">
            <a href="#" class="btn btn-toggle-player btn-hide-player" id="btn-toggle-player" data-toggle="tooltip" data-placement="top" title="Show / Hide Player"><i class="fa fa-play-circle"></i></a>
        </div> -->
        <!-- /toggle-player -->
        
        <div id="main-nav">
            <ul>
                <li><a href="<?php echo url('mushaf')?>">{{trans('trans.mushaf')}}</a></li>
                <!--li><a href="<?php echo url('note')?>">{{trans('trans.note')}}</a></li-->
                <li><a href="<?php echo url('memoz')?>">{{trans('trans.memo')}}</a></li>
            </ul>

            
        </div>

        <nav class="navmenu navmenu-default offcanvas navmenu-fixed-left qm-navbar" id="qm-navbar" role="navigation">
            
                <div class="navmenu-header">
                    <div class="navmenu-overlay"> 
                        <a class="qm-brand" href="{{url('')}}">
                            <img class='hires qmc-logo' src="{{url('assets/images/qmc-logo.png')}}" alt="Logo QuranMemo">
                            <img class='hires qmc-title' src="{{url('assets/images/qmc-title.png')}}" alt="Logo QuranMemo">
                        </a>

                        <a href="#" class="close-navi" data-toggle="offcanvas" data-target="#qm-navbar" data-canvas="body"><i class="ion-close-round"></i></a>

                        <div class="navbar-nav qm-cari-kata">
                            <form class="navbar-form" role="search" method="get" action="{{url('mushaf/searchKeyword')}}">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari kata" name="keyword">
                                    <div class="input-group-btn">
                                        <button class="btn btn-search" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/navmenu-overlay-->
                </div>
                <!--/navmenu-header-->

                <ul class="nav navmenu-nav">
                    <li class="{{Request::segment(1)=='dashboard'?'active':''}}"><a href="{{url('dashboard')}}"><i class="mdi mdi-bank"></i> Dashboard</a></li>
                    <li class="{{Request::segment(1)=='memoz'?'active':''}}"><a href="{{url('memoz')}}"><i class="mdi mdi-library"></i> Menghafal</a></li>
                    <li class="{{Request::segment(1)=='mushaf' || Request::segment(1)==''?'active':''}}">
                    <a href="<?php echo url('mushaf')?>"><i class="mdi mdi-book-open-variant"></i> Baca</a>
                    </li>
                    <li><a href="javascript:;" onclick="QuranJS.callModal('info')"><i class="mdi mdi-information"></i> Info</a></li>
                    @if(empty(session('sess_id')))
                    <li><a class='login-trigger' href="javascript:;" onclick="QuranJS.callModal('auth/login')"><i class="mdi mdi-lock"></i>  Login</a></li>
                    @else
                    <li><a href="{{url('profile/edit')}}"><i class="mdi mdi-account-edit"></i> Edit Profile</a></li>
                    <li><a href="{{url('auth/logout')}}"><i class="mdi mdi-lock-open"></i> Logout</a></li>
                    @endif
                </ul>
                <!--/navmenu-nav-->

            

        </nav>
        <!--/navmenu-->

        <div class="qm-nav navbar navbar-default navbar-fixed-top navi-down">
            <!--a class="navbar-brand" href="{{url('')}}"><img class='hires' width="200" src="{{url('assets/images/main_logo.png')}}" alt="Logo QuranMemo"></a-->
            <a class="navbar-brand title"  href="{{url('')}}"><h1>{{$header_top_title}}</h1></a>
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#qm-navbar" data-canvas="body">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="wrap">
            @yield('content')
        </div>

        <!--div class="footer">
            <br>
            <ul>
                <li><span>Copyright &copy; 2016 <a href="http://www.ubkplus.org">www.ubkplus.org</a></span></li>
            </ul>
            <ul>
                <li><a href="javascript:void(0)" onclick="QuranJS.callModal('about')" >Tentang Quran Memo</a></li>
                <li><a href="javascript:void(0)" onclick="QuranJS.callModal('contact')" >Hubungi Kami</a></li>
            </ul>
          <br><br>
        </div-->
        <!-- /footer -->

        @if(!empty($ayats))
        <div class="quran-player">
            @include('players')
        </div>
        @endif
        
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

    <script src="{{url('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/jasny-bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/jquery.highlight.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap-datepicker.en-GB.min.js')}}"></script>
    <script src="{{url('assets/js/jQuery.nthEverything.min.js')}}"></script>
    <script src="{{url('assets/js/select2.min.js')}}"></script>  

    <script type="text/javascript">
          $(document).ready(function(){
                $('#preloader').hide();
                QuranJS.redHightlight();

                $('.selectpicker').select2();
            });

            $('.navmenu').offcanvas({autohide: false,toggle:false});

            // Hide Header on on scroll down
            var didScroll;
            var lastScrollTop = 0;
            var delta = 5;
            var navbarHeight = $('.qm-nav').outerHeight();

            $(window).scroll(function(event){
                didScroll = true;
            });

            setInterval(function() {
                if (didScroll) {
                    hasScrolled();
                    didScroll = false;
                }
            }, 250);

            function hasScrolled() {
                var st = $(this).scrollTop();
                
                // Make sure they scroll more than delta
                if(Math.abs(lastScrollTop - st) <= delta)
                    return;
                
                // If they scrolled down and are past the navbar, add class .nav-up.
                // This is necessary so you never see what is "behind" the navbar.
                if (st > lastScrollTop && st > navbarHeight){
                    // Scroll Down
                    $('.qm-nav').removeClass('navi-down').addClass('navi-up');
                } else {
                    // Scroll Up
                    if(st + $(window).height() < $(document).height()) {
                        $('.qm-nav').removeClass('navi-up').addClass('navi-down');
                    }
                }
                
                lastScrollTop = st;
            }

            //var vph = $(window).height();
            //$('body').css('height',vph/2).css('overflow','hidden');
            //$('.splash-body').css('height',vph);

            function changeBg(){
                var mainColor = 'rgba(77,181,120,1)';
                $('.splash-body').css('background',mainColor);
                $('.splash-inner').css('opacity','1').css('animation-delay','2s');

            }

            function removeMe(){
                $('.splash-body').css('display','none');
            }

            setTimeout(changeBg,1500);

            $('.start').click(function () {
                $('.splash-text').removeClass('fadeIn').addClass('fadeOutUp').css('animation-delay','.1s');
                $('.start').removeClass('fadeIn').addClass('fadeOutUp').css('animation-delay','.1s');
                $('.splash-body').css('height','0').css('animation-delay','.2s');
                $('body').css('height','100%').css('overflow','auto');
                setTimeout(removeMe,2000);
            });

            $(function () {

            if (window.devicePixelRatio == 2) {

                  var images = $("img.hires");

                  // loop through the images and make them hi-res
                  for(var i = 0; i < images.length; i++) {

                    // create new image name
                    var imageType = images[i].src.substr(-4);
                    var imageName = images[i].src.substr(0, images[i].src.length - 4);
                    imageName += "@2x" + imageType;

                    //rename image
                    images[i].src = imageName;
                  }
             }

        });

        function setModalMaxHeight(element) {
            this.$element     = $(element);  
            this.$content     = this.$element.find('.modal-content');
            var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
            var dialogMargin  = $(window).width() < 768 ? 20 : 60;
            var contentHeight = $(window).height() - (dialogMargin + borderWidth);
            var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
            var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
            var maxHeight     = contentHeight - (headerHeight + footerHeight);

            this.$content.css({
                'overflow': 'hidden'
            });
            
            this.$element
                .find('.modal-body').css({
                'max-height': maxHeight,
                'overflow-y': 'auto'
            });
            }

            $('.modal').on('show.bs.modal', function() {
            $(this).show();
            setModalMaxHeight(this);
            });

            $(window).resize(function() {
            if ($('.modal.in').length != 0) {
                setModalMaxHeight($('.modal.in'));
            }
        });


         $(window).bind('beforeunload', function(){
           $('#preloader').show();
         });
        /* if('{{Request::segment(3)}}'=='593'){
             QuranJS.callModal('buku');
            }*/

         if('{{Request::segment(2)}}'=='' && '{{Request::segment(1)}}'=='mushaf'){
            if('{{@$_COOKIE['coo_promo_3_tafsir']}}'==''){
                //QuranJS.callModal('buku');
            }

            /*if('{{@$_COOKIE['coo_promo']}}'==''){
                QuranJS.callModal('promo');
            }*/

            /*if('{{@$_COOKIE['coo_muratal_new']}}'==''){
                QuranJS.callModal('muratal');
            }*/

            
            if('{{@$_COOKIE['coo_mushaf_bookmark_title']}}'!='' && '{{@$_COOKIE['coo_muratal_desc']}}'!=''){
               QuranJS.bookmarkModal('{{@$_COOKIE['coo_mushaf_bookmark_title']}}','{{@$_COOKIE['coo_mushaf_bookmark_url']}}')
            }
         }

        </script>
         
    </script>
    @include('layouts.analytics') 

    </body>
</html>