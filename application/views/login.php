<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Infrastructure Management for Itree</title>

    <link href="/css/styles.css" rel="stylesheet" type="text/css" />
    <!--[if IE]> <link href="/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

    <script type="text/javascript" src="/js/plugins/charts/excanvas.min.js"></script>
    <script type="text/javascript" src="/js/plugins/charts/jquery.flot.js"></script>
    <script type="text/javascript" src="/js/plugins/charts/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="/js/plugins/charts/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="/js/plugins/charts/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="/js/plugins/charts/jquery.sparkline.min.js"></script>

    <script type="text/javascript" src="/js/plugins/tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/js/plugins/tables/jquery.sortable.js"></script>
    <script type="text/javascript" src="/js/plugins/tables/jquery.resizable.js"></script>

    <script type="text/javascript" src="/js/plugins/forms/jquery.autosize.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.uniform.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.inputlimiter.min.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.autotab.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.select2.min.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.dualListBox.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.cleditor.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.ibutton.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.validationEngine-en.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/jquery.validationEngine.js"></script>

    <script type="text/javascript" src="/js/plugins/uploader/plupload.js"></script>
    <script type="text/javascript" src="/js/plugins/uploader/plupload.html4.js"></script>
    <script type="text/javascript" src="/js/plugins/uploader/plupload.html5.js"></script>
    <script type="text/javascript" src="/js/plugins/uploader/jquery.plupload.queue.js"></script>

    <script type="text/javascript" src="/js/plugins/wizards/jquery.form.wizard.js"></script>
    <script type="text/javascript" src="/js/plugins/wizards/jquery.validate.js"></script>
    <script type="text/javascript" src="/js/plugins/wizards/jquery.form.js"></script>

    <script type="text/javascript" src="/js/plugins/ui/jquery.collapsible.min.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.breadcrumbs.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.tipsy.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.progress.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.timeentry.min.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.colorpicker.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.fancybox.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.fileTree.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.sourcerer.js"></script>

    <script type="text/javascript" src="/js/plugins/others/jquery.fullcalendar.js"></script>
    <script type="text/javascript" src="/js/plugins/others/jquery.elfinder.js"></script>

    <script type="text/javascript" src="/js/plugins/forms/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="/js/plugins/ui/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="/js/files/bootstrap.js"></script>
    <script type="text/javascript" src="/js/files/login.js"></script>
    <script type="text/javascript" src="/js/files/functions.js"></script>

</head>

<body>

<!-- Top line begins -->
<div id="top">
    <div class="wrapper">
        <a href="#" title="" class="logo"><img src="/images/logo.png" alt="" /></a>

        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <!--<li><a href="#" title="" class="logout"></a></li>-->
            </ul>
        </div>
    </div>
</div>
<!-- Top line ends -->


<!-- Login wrapper begins -->
<div class="loginWrapper">

    <?php
        if(isset($failure))
            echo '<div style="margin-top: -70px;" class="nNote nFailure"> <p>Login Failed - please try again</p></div>';
    ?>

    <!-- Current user form -->
    <form action="/login/" method="post" id="login">
        <div class="loginPic">
            <a href="#" title=""><img src="/images/userLogin2.png" alt="" /></a>
            <span>Login</span>
            <!--<div class="loginActions">
                <div><a href="#" title="Change user" class="logleft flip"></a></div>
                <div><a href="#" title="Forgot password?" class="logright"></a></div>
            </div>-->
        </div>

        <input type="text" name="username" placeholder="Username" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>

    <!-- New user form
    <form action="index.html" id="recover">
        <div class="loginPic">
            <a href="#" title=""><img src="/images/userLogin2.png" alt="" /></a>
            <div class="loginActions">
                <div><a href="#" title="" class="logback flip"></a></div>
                <div><a href="#" title="Forgot password?" class="logright"></a></div>
            </div>
        </div>

        <input type="text" name="login" placeholder="Your username" class="loginUsername" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />

        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div>
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" />
        </div>
    </form>-->

</div>
<!-- Login wrapper ends -->

</body>
</html>
