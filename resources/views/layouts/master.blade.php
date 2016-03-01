<html>
    <head>
        <title>QuranMemo - <?php echo isset($header_title)?$header_title:''?></title>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:url" content="<?php echo Request::url()?>" />
        <meta property="og:type"          content="website" />
        <meta property="og:title"         content="QuranNote - <?php echo $header_title?$header_title:''?>" />
        <meta property="og:description"   content="<?php echo isset($header_description)?$header_description:'QuranMote, mushaf, Al-Quran'?>" />
        <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />


        <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap.min.css')?>">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap-theme.min.css')?>">
        <link rel="stylesheet" href="<?php echo url('assets/css/animate.min.css')?>">
        <link rel="stylesheet" href="<?php echo url('assets/css/style.css')?>">
        <link rel="stylesheet" href="<?php echo url('assets/css/custom.css')?>">

        
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo url('assets/js/jquery-1.11.3.min.js')?>"></script>
        <script src="<?php echo url('assets/js/jquery-ui.js')?>"></script>
        <script src="<?php echo url('assets/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo url('assets/js/script.js')?>"></script>
        <script type="text/javascript">
            QuranJS.siteUrl = '<?php echo url()?>';
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
        <link href="<?php echo url('assets/jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css')?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo url('assets/jplayer/lib/jquery.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('assets/jplayer/dist/jplayer/jquery.jplayer.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('assets/jplayer/dist/add-on/jplayer.playlist.min.js')?>"></script>
    </head>
    <body>
        @section('sidebar')
           <!-- This is the master sidebar. -->
        @show

        <div class="toggle-player">
            <a href="#" class="btn btn-toggle-player btn-hide-player" id="btn-toggle-player" data-toggle="tooltip" data-placement="top" title="Show / Hide Player"><i class="fa fa-play-circle"></i></a>
        </div>
        <!-- /toggle-player -->
        
        <div id="main-nav">
            <ul>
                <li><a href="<?php echo url('mushaf')?>"><?php echo trans('trans.mushaf')?></a></li>
                <li><a href="<?php echo url('note')?>"><?php echo trans('trans.note')?></a></li>
                <li><a href="<?php echo url('memoz')?>"><?php echo trans('trans.memo')?></a></li>
            </ul>

        </div>

        <nav class="navbar navbar-default">
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
                        <li class="<?php echo Request::segment(1)=='mushaf' || Request::segment(1)==''?'active':''?>"><a href="<?php echo url('mushaf')?>"><?php echo trans('trans.mushaf')?></a></li>
                        <li><a href="<?php echo url('note')?>"><?php echo trans('trans.note')?></a></li>
                        <li class="<?php echo Request::segment(1)=='memoz'?'active':''?>"><a href="<?php echo url('memoz')?>"><?php echo trans('trans.memo')?></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="wrap">
            @yield('content')
        </div>

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
    </body>
</html>