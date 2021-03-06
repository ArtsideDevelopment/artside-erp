<!DOCTYPE html>
<!--

-->
<html lang="ru">
    <head>
        <title>ПИК-99. Система управления контентом</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no"/>
        <link rel="icon" type="image/png" href="/skins/img/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="/skins/img/favicon-32x32.png" sizes="32x32">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="sidebar_main_active">        
        <link rel="stylesheet" href="/skins/css/styles.css">
        <?php include 'skins/tpl/for_all/header.tpl'; ?>
        <!-- main sidebar -->
        <?php include 'skins/tpl/for_all/left_menu.tpl'; ?>
        <!-- main sidebar end -->
        <!-- page content -->
        <div id="page-content">
            <?php echo $content; ?>
        </div>
        <!-- page content end-->
        <script src="https://yastatic.net/jquery/3.1.1/jquery.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>
        <script src="/skins/js/libs/datatables/datatables.min.js"></script>
        <script src="/skins/js/core.js"></script>
        <script src="/skins/js/modal_dialog.js"></script>
        <?php $xajax->printJavascript(); ?>
    </body>
</html>
