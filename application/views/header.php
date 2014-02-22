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
    <script type="text/javascript" src="/js/files/functions.js"></script>


</head>

<body>

<!-- Top line begins. -->
<div id="top">
    <div class="wrapper">
        <a href="/" title="" class="logo"><img src="/images/logo.png" alt="" /></a>

        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <!--<li><a title="" class="search"></a></li>
                <li><a href="#" title="" class="screen"></a></li>
                <li><a href="#" title="" class="settings"></a></li>-->
                <li><a href="/logout/" title="" class="logout"></a></li>
            </ul>
            <a title="" class="iButton"></a>
            <a title="" class="iTop"></a>
            <div class="topSearch">
                <div class="topDropArrow"></div>
                <form action="">
                    <input type="text" placeholder="search..." name="topSearch" />
                    <input type="submit" value="" />
                </form>
            </div>
        </div>

        <!-- Responsive nav -->
        <ul class="altMenu">
            <li><a href="/" title="">Dashboard</a></li>
            <li><a href="/users/" title="">Users</a></li>
        </ul>
    </div>
</div>
<!-- Top line ends -->


<!-- Sidebar begins -->
<div id="sidebar">

    <!-- Main nav -->
    <div class="mainNav">
        <div class="user">
            <a title="" class="leftUserDrop"><img src="/images/<?php echo $username; ?>.png" alt="" /></a><span><?php echo $name; ?></span>
            <ul class="leftUser">
                <!--<li><a href="#" title="" class="sProfile">My profile</a></li>
                <li><a href="#" title="" class="sMessages">Messages</a></li>
                <li><a href="#" title="" class="sSettings">Settings</a></li>-->
                <li><a href="/logout/" title="" class="sLogout">Logout</a></li>
            </ul>
        </div>

        <!-- Responsive nav -->
        <div class="altNav">
            <div class="userSearch">
                <form action="">
                    <input type="text" placeholder="search..." name="userSearch" />
                    <input type="submit" value="" />
                </form>
            </div>

            <!-- User nav -->
            <ul class="userNav">
                <!--<li><a href="#" title="" class="profile"></a></li>
                <li><a href="#" title="" class="messages"></a></li>
                <li><a href="#" title="" class="settings"></a></li>-->
                <li><a href="/logout/" title="" class="logout"></a></li>
            </ul>
        </div>

        <!-- Main nav  -->
        <ul class="nav">
            <li><a href="/" title=""<?php if ($page=='dashboard') echo ' class="active" '; ?>><img src="/images/icons/mainnav/dashboard.png" alt=""/><span>Dashboard</span></a></li>
            <li><a href="/users/" title=""<?php if ($page=='users') echo ' class="active" '; ?>><img src="/images/icons/mainnav/ui.png" alt="" /><span>Users</span></a></li>
            <li><a href="/products/" title=""<?php if ($page=='products') echo ' class="active" '; ?>><img src="/images/icons/mainnav/products.png" alt="" /><span>Products</span></a></li>
            <li><a href="/report/" title=""<?php if ($page=='report') echo ' class="active" '; ?>><img src="/images/icons/mainnav/statistics.png" alt="" /><span>Report</span></a></li>
        </ul>
    </div>

</div>
<!-- Sidebar ends -->


<!-- Content begins -->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-<?php echo $page; ?>"></span><?php echo ucwords($page); ?></span>
        <ul class="quickStats">
            <li>
                <a href="" class="blueImg"><img src="/images/icons/quickstats/plus.png" alt="" /></a>
                <div class="floatR"><strong class="blue"><?php echo $assets; ?></strong><span>assets</span></div>
            </li>
            <li>
                <a href="" class="redImg"><img src="/images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue"><?php echo $users; ?></strong><span>users</span></div>
            </li>
        </ul>
    </div>

    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li <?php if ($page=="dashboard") echo ' class="current"'; ?>><a href="/">Dashboard</a></li>
                <?php if ($page!="dashboard") echo '<li class="current"><a href="#" title="">'.ucwords($page).'</a></li>'; ?>
            </ul>
        </div>
    </div>

    <!-- Main content -->
    <div class="wrapper">
        <ul class="middleFree">
            <li><a href="/assets/add/" title="Add an asset" class="bBlue"><span class="iconb" data-icon="&#xe1fb;"></span><span>Add an asset</span></a></li>
            <!--<li><a href="#" title="Some other action" class="bRed"><span class="iconb" data-icon="&#xe167;"></span><span>View Report</span></a></li>-->
        </ul>