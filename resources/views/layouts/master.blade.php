<html>
    <head>
        <title>QuranNote - @yield('title')</title>
        <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap.min.css')?>">

        <!-- Optional theme -->
        <link rel="stylesheet" href="<?php echo url('assets/css/bootstrap-theme.min.css')?>">
        <link rel="stylesheet" href="<?php echo url('assets/css/style.css')?>">

        
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo url('assets/js/jquery-1.11.3.min.js')?>"></script>
        <script src="<?php echo url('assets/js/bootstrap.min.js')?>"></script>
        <script src="<?php echo url('assets/js/script.js')?>"></script>
        <script type="text/javascript">
            QuranJS.siteUrl = '<?php echo url()?>';
        </script>

        <!-- JPlayer-->
        <link href="<?php echo url('assets/jplayer/dist/skin/blue.monday/css/jplayer.blue.monday.min.css')?>" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo url('assets/jplayer/lib/jquery.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('assets/jplayer/dist/jplayer/jquery.jplayer.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo url('assets/jplayer/dist/add-on/jplayer.playlist.min.js')?>"></script>
    </head>
    <body>
        @section('sidebar')
            This is the master sidebar.
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>