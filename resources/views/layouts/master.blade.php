<!DOCTYPE html>
<html>
    <head>
        <meta name="google-site-verification" content="hXTmvIk3V_yZywNDwJlIFWrS1DQOcNV7UDLCBQUEUv0" />
        <title>{{ isset($header_title)?$header_title:''}} - QuranMemo</title>

        <meta charset="utf-8">
        <meta http-equiv="Content-Security-Policy" content="default-src *; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">

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
        <link rel="stylesheet" href="{{url('assets/css/vendors/circle-menu.min.css')}}">

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

        <!-- <link rel="stylesheet" href="{{url('assets/css/custom_1.7.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/custom_1.8.min.css')}}"> -->
        <link rel="stylesheet" href="{{url('assets/css/custom_1.9.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/todo.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/vendors/bootstrap-datepicker.min.css')}}">

        <!--script src="//da189i1jfloii.cloudfront.net/js/kinvey-html5-1.6.8.min.js"></script-->

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{url('assets/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{url('assets/js/script.min.js')}}"></script>
        <script type="text/javascript">
            QuranJS.siteUrl = '{{url('')}}';
            /*loadingText = ['Subhanallah','Alhamdulillah','Lailahaillalah','Allahuakbar','La hawla wala quwwata illa billah',' Hasbunallah Wanikmal Wakil'];
            randomInt = Math.floor(Math.random() * loadingText.length);
            $('.loading > span').html(loadingText[randomInt]);
            alert(loadingText[randomInt]);*/
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

       <!-- Facebook Pixel Code -->
        <script>
          !function(f,b,e,v,n,t,s)
          {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
          n.callMethod.apply(n,arguments):n.queue.push(arguments)};
          if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
          n.queue=[];t=b.createElement(e);t.async=!0;
          t.src=v;s=b.getElementsByTagName(e)[0];
          s.parentNode.insertBefore(t,s)}(window, document,'script',
          'https://connect.facebook.net/en_US/fbevents.js');
          fbq('init', '112999465995364');
          //fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
          src="https://www.facebook.com/tr?id=112999465995364&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->

         @if(Request::segment(1)=='memoz')
        <script>
          fbq('track', '{{$header_title}}');
        </script>
        @endif
    </head>
    <body class="@if(isset($body_class)) {{$body_class}} @endif" style="overflow:hidden">

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
            <div class="loading">
                <div class="loading-inner">
                <img src="{{url('assets/images/loading.svg')}}" alt="loading" width="50"/><br><br>
                <div class="dzikir-loading" style="color:#2b2b2b">
                <p>Sambil nunggu baca dzikir yuk :</p>
                <p class="dzikir" style="font-size:24px">Subhanallah Walhamdulillah Lailahaillalah Allahuakbar...</p>
                </div>
            </div>
        <!--span>Mohon tunggu...</span=-->
      </div>
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
                                        <button class="btn btn-search" type="submit" onclick="fbq('track', 'clickSearch')"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="login-nav">
                            <div class="btn-group" role="group" aria-label="...">
                                @if(empty(session('sess_id')))
                                      <a class="btn btn-login login-trigger" href="javascript:;" onclick="QuranJS.callModal('auth/login')"><i class="mdi mdi-lock"></i> Login </a>
                                      <a  class="btn btn-register" href="{{url('register')}}">Register <i class="mdi mdi-account"></i>  </a>
                                </div>
                                @else
                                    <a class="btn btn-login"  href="{{url('auth/logout')}}"><i class="mdi mdi-lock-open"></i> Logout </a>
                                      <a  class="btn btn-register" href="{{url('profile/edit')}}">Edit Profile <i class="mdi mdi-account-edit"></i>  </a>
                                @endif
                        </div>
                    </div>
                    <!--/navmenu-overlay-->
                </div>
                <!--/navmenu-header-->

                <ul class="nav navmenu-nav">

                    <li class="{{Request::segment(1)=='dashboard'?'active':''}}"><a href="{{url('dashboard?promo=hide')}}" onclick="fbq('track', 'clickDashboard')"><i class="mdi mdi-bank"></i> Dashboard</a></li>
                    <li class="{{Request::segment(1)=='memoz' && Request::segment(2)!='correction_ihsan'?'active':''}}"><a href="{{url('memoz')}}" onclick="fbq('track', 'clickMenghafal')"><i class="mdi mdi-library"></i> Menghafal</a></li>
                    <li class="{{Request::segment(1)=='mushaf' || Request::segment(1)==''?'active':''}}">
                    <a href="<?php echo url('mushaf')?>"><i class="mdi mdi-book-open-variant" onclick="fbq('track', 'clickBaca')"></i> Baca Al-Qur'an</a>
                    </li>
                    <li class="{{Request::segment(1)=='subscription'?'active':''}}"><a href="javascript:void(0)" onclick="fbq('track', 'clickBerlangganan');QuranJS.callModal('subscription')" id="cart"><i class="mdi mdi-cart"></i> Berlangganan <label class="label label-danger" display="none" id="cartCounter" style="display: none">0</label></a> </li>
                    @if(session('sess_role')==1 || session('sess_role')==2)
                    <li class="{{Request::segment(2)=='correction_ihsan'?'active':''}}"><a href="{{url('memoz/correction_ihsan')}}"><i class="mdi mdi-arrow-up-box"></i> Koreksi Ihsan</a></li>
                    @endif
                    @if(session('sess_role')==1 || session('sess_role')==2)
                    <li class="{{Request::segment(1)=='profile' && Request::segment(2)=='list'?'active':''}}">
                        <a href="<?php echo url('profile/list')?>"><i class="mdi mdi-file-document" ></i> Laporan</a>
                    @endif
                    <!--li><a href="{{url('profile/top_user')}}" class="{{Request::segment(2)=='top_user'?'active':''" onclick="fbq('track', 'clickTopSantri');"><i class="mdi mdi-account-network"></i> Top Santri</a></li>
                    <li><a href="javascript:;" onclick="QuranJS.callModal('buku')" onclick="fbq('track', 'clickFAQ')"><i class="mdi mdi-book-open"></i> Gratis Buku <label class="label label-danger">New</label></a> </li>


                    <!--li><a href="javascript:;" onclick="fbq('track', 'clickPromoTShirtWomb');QuranJS.callModal('promo');"><i class="mdi mdi-alert-decagram"></i> Promo <label class="label label-danger">New</label></a></li>
                    </li-->
                    <!--li><a href="<?php echo url('content_learning')?>"><i class="mdi mdi-folder-lock" onclick="fbq('track', 'clickBaca')"></i> Konten Belajar Quran</a></li>
                    </li>
                    <li class="{{Request::segment(1)=='subscription'?'active':''}}"><a href="javascript:void(0)" onclick="fbq('track', 'clickBerlangganan');QuranJS.callModal('subscription')" id="cart"><i class="mdi mdi-cart"></i> Berlangganan <label class="label label-danger" display="none" id="cartCounter" style="display: none">0</label></a> </li>
                    <!--li><a href="javascript:;" onclick="QuranJS.callModal('info')" onclick="fbq('track', 'clickInfo')"><i class="mdi mdi-information"></i> Info</a></li-->
                    <li></li>
                    <li></li>
                    <li></li>
                    <li><a href="javascript:;" onclick="QuranJS.callModal('faq')" onclick="fbq('track', 'clickFAQ')"><i class="mdi mdi-help-circle"></i> FAQ</a></li>
                    <li><a href="javascript:;" onclick="QuranJS.callModal('contact')" onclick="fbq('track', 'clickContact')"><i class="mdi mdi-email"></i> Kontak</a></li>
                    <!--!li><a href="https://ubkplus.org" onclick="fbq('track', 'clickUBKPlus')"><i class="mdi mdi-domain"></i> Pasantren UBKPlus</a></li-->
                    <li><a href="javascript:;" onclick="QuranJS.callModal('partners');fbq('track', 'clickPartners')"><i class="mdi mdi-group"></i> Partners</a></li>
                </ul>
                <!--/navmenu-nav-->



        </nav>
        <!--/navmenu-->

        <div class="qm-nav navbar navbar-default navbar-fixed-top navi-down">
            <!--a class="navbar-brand" href="{{url('')}}"><img class='hires' width="200" src="{{url('assets/images/main_logo.png')}}" alt="Logo QuranMemo"></a-->
            @if(Request::segment(1)!='dashboard')
            <a class="navbar-brand nav-back"  href="javascript:void(0)" onclick="history.back()"><i class="mdi mdi-arrow-left"></i></a>
            @endif
            <a class="navbar-brand title"  href="{{url('')}}"><h1>{{$header_top_title}}</h1></a>
            <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target="#qm-navbar" data-canvas="body">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <button type="button" class="navbar-toggle notif"data-target="#qm-navbar" data-canvas="body"
            onclick="fbq('track', 'clickKoreksi');@if(!empty(session('sess_id'))) QuranJS.correctionList('','') @else QuranJS.callModal('auth/login') @endif">
                <i class="mdi mdi-bell-ring"></i>
                <sup class="text-white label label-danger">{{session('sess_counter_correction')>0?session('sess_counter_correction'):''}}</sup>
            </button>
            <button type="button" class="navbar-toggle search"
            onclick="fbq('track', 'clickCari');QuranJS.showSearchForm();">
                <i class="mdi mdi-magnify"></i>
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
    <script src="{{url('assets/js/circleMenu.js')}}"></script>



    <script type="text/javascript">
          $(document).ready(function(){
                $('#preloader').hide();
                QuranJS.redHightlight();
                $('body').attr('style','');
                $('.selectpicker').select2();

                $("#preloader").on("show", function () {
                    $("body").addClass("modal-open");
                }).on("hidden", function () {
                    $("body").removeClass("modal-open")
                });

            });

            function hideLoginStuff(){
                 $('.login-brand,.modal-footer').hide();
               }
            function showLoginStuff(){
                $('.login-brand,.modal-footer').show();
               }

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
                    $('.bookmark-sign').addClass('bookmark-sticky');
                } else {
                    // Scroll Up
                    if(st + $(window).height() < $(document).height()) {
                        $('.qm-nav').removeClass('navi-up').addClass('navi-down');
                    }
                    if(st==0){
                      $('.bookmark-sign').removeClass('bookmark-sticky');
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
           $('body').attr('style','overlay:hidden');
         });
        /* if('{{Request::segment(3)}}'=='593'){
             QuranJS.callModal('buku');
            }*/

         @if(!empty($_SERVER['HTTP_REFERER']))
            //alert("{{parse_url($_SERVER['HTTP_REFERER'])['host']}}");
            if("{{parse_url($_SERVER['HTTP_REFERER'])['host']}}"=="www.quranmemo.id" || "{{parse_url($_SERVER['HTTP_REFERER'])['host']}}"=="quranmemo.id"){
                vex.dialog.alert({ unsafeMessage: '<h4>Download versi "QuranMemo Community"!</h4> <p>Antum masih menggunakan aplikasi "QuranMemo" lama dan akan kami non-aktifkan dalam waktu dekat ini, maka silahkan cari dan download versi terbaru lewat playstore "QuranMemo Community" atau <a href="https://play.google.com/store/apps/details?id=com.ndeztea.quranmemocommunity">click disni untuk install</a> untuk mendapatkan fitur-fitur terbaru menghafal Al-Quran, seperti merekam, koreksi, update avatar, dll.</p> <p>Dan dapatkan T-shirt Gratis dari kami, dengan design Tematik Al-Quran</p><br>Syukron' });
            }
            @endif

         var d = new Date();
         var isFriday = d.getDay();

         if('{{session('sess_id')}}'!='' && '{{Request::segment(1)}}'=='dashboard'){
            // promo 212
            //QuranJS.callModal('promo');
            //vex.dialog.alert({unsafeMessage: '<h3 class="center" style="margin:0px 0px 10px 0px">Promo</h3><img src="{{url('assets/images/171217.jpg')}}" width="100%"><br><button class="btn btn-green" id="actionPromo" style="font-size: 16px;margin-top: 10px;" onclick="fbq(\'track\', \'clickBerlanggananPromo\');QuranJS.callModal(\'subscription\')">Berlangganan sekarang!</button></div>'})

            if(isFriday==5){
                QuranJS.callModal('alkahfi');
            }

            //vex.dialog.alert({ unsafeMessage: '<h4>Puasa Sunnah Yuk..!</h4><a href="{{url('assets/images/puasa_muharram.jpeg')}}"><img src="{{url('assets/images/puasa_muharram.jpeg')}}" style="width:100%"/></a>' });


            if('{{@$_COOKIE['coo_mushaf_bookmark_title']}}'!='' && '{{@$_COOKIE['coo_muratal_desc']}}'!=''){
               QuranJS.bookmarkModal('{{@$_COOKIE['coo_mushaf_bookmark_title']}}','{{@$_COOKIE['coo_mushaf_bookmark_url']}}')
            }
         }

         // get subscription information
         $.getJSON('{{url('subscription/counter')}}',{},function(response){
           if(response.counter>0){
                @if(session('sess_role')==1)
                $('#cart').attr('onclick','location.href="{{url('subscription/listing?status=approval')}}"');
                @else
                $('#cart').attr('onclick','location.href="{{url('subscription/listing')}}"');
                @endif
                $('#cartCounter').html(response.counter);
                $('#cartCounter').show();
                $('#actionPromo').attr('onclick','');
                $('#actionPromo').attr('onclick',"fbq('track', 'clickBerlanggananPromo');location.href='{{url('subscription/listing')}}'");

                @if(Request::segment(1)=='dashboard')
                <?php
                    $approvalLink = '';
                    if(session('sess_role')==1){
                        $approvalLink = '?status=approval';
                    }
                ?>
                  @if(session('sess_role')!=1)
                  vex.dialog.alert({ unsafeMessage: 'Bismillah, <br> <p>Anda punya <strong>'+response.counter+' tagihan </strong> berlangganan QuranMemo, silahkan <a href="{{url('subscription/listing')}}{{$approvalLink}}">klik disni</a> untuk melanjutkan pembayaran atau membatalkan tagihan</p>Syukron' });
                  @endif
                @endif
           }
        });

        @if(Request::get('action')=='berlangganan')
        vex.dialog.alert('Menghafal juz 1 sampai juz 29 harus berlangganan terlebih dahulu.');
        QuranJS.callModal('subscription');
        @endif

        function purchase(productId){
            window.parent.postMessage("purchase|"+productId, "*");

        }
        function checkPurchase(productId){
            window.parent.postMessage("checkPurchase|"+productId, "*");

        }
        $( ".jp-video-play-icon" ).click(function() {
          location.reload();
        });

        </script>
    @include('layouts.analytics')

    </body>
</html>
