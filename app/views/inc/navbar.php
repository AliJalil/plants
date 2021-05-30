<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=<?php echo URLROOT ?>>
                <img src="<?php echo URLROOT; ?>/public/images/statics/logo.png"
                     style="padding-bottom: 8px;max-height: 65px;">
            </a>
        </div>
        <div class="collapse navbar-collapse">

            <?php
            clearstatcache();
            $imageSource = URLROOT . "/public/images/statics/placeHolder.png";

            if (isset($_SESSION['uImgD'])) :
                $upOne = dirname(__DIR__, 3);
                $target = $upOne . "/public/images/users/";
                if (file_exists($target . $_SESSION['UImg'])) {
                    $imageSource = URLROOT . "/public/images/users/" . $_SESSION['UImg'];
                }
            endif
            ?>

            <ul class="nav navbar-nav navbar-right">

                <?php if (isset($_SESSION['addPlant'])
                    || isset($_SESSION['editPlant'])
                    || isset($_SESSION['deletePlant'])) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle lost-nav" data-toggle="dropdown"
                           href="<?php echo URLROOT; ?>/Points">الاليات
                            <span class="Plantet"></span></a>

                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['editPlant'])
                                || isset($_SESSION['deletePlant'])) : ?>
                                <li class=""><a href="<?php echo URLROOT; ?>/Plants/index">
                                        <span class="glyphicon glyphicon-list-alt"></span>عرض الاليات الفعالة</a></li>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['editPlant'])
                                || isset($_SESSION['deletePlant'])) : ?>
                                <li class=""><a href="<?php echo URLROOT; ?>/Plants/index/1">
                                        <span class="glyphicon glyphicon-list-alt"></span>عرض المنتهية الصلاحية</a></li>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['editPlant'])
                                || isset($_SESSION['deletePlant'])) : ?>
                                <li class=""><a href="<?php echo URLROOT; ?>/Plants/refusedPlants">
                                        <span class="glyphicon glyphicon-list-alt"></span>عرض المرفوضة</a></li>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['addPlant'])) : ?>
                                <li class=""><a href="<?php echo URLROOT; ?>/Plants/addPlant">
                                        <span class="glyphicon glyphicon-plus"></span> اضافة الية جديدة</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['addReport'])
                    || isset($_SESSION['editReport'])
                    || isset($_SESSION['deleteReport'])) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle income-report-nav" data-toggle="dropdown"
                           href="<?php echo URLROOT; ?>/Points">المواقف الواردة
                            <span class="Plantet"></span></a>

                        <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                            <?php if (isset($_SESSION['editReport'])
                                || isset($_SESSION['deleteReport'])) : ?>
                                <li class=""><a href="<?php echo URLROOT; ?>/Plants/getReports/1/0">
                                        <span class="glyphicon glyphicon-list-alt"></span>عرض المواقف الواردة</a></li>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['editReport'])
                                || isset($_SESSION['deleteReport'])) : ?>
                                <li class="dropdown-submenu">
                                    <a tabindex="-1" href="#">دخول هذا اليوم</a>
                                    <ul class="dropdown-menu">
                                        <li><a tabindex="-1" href="<?php echo URLROOT; ?>/Plants/index/2">الدائمة</a></li>
                                        <li><a href="<?php echo URLROOT; ?>/Plants/getReports/1/1">الواردة</a></li>
                                    </ul>
                                </li>

                            <?php endif; ?>
                        </ul>

                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['addPoint'])
                    || isset($_SESSION['editPoint'])
                    || isset($_SESSION['deletePoint'])) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle point-nav" data-toggle="dropdown"
                           href="<?php echo URLROOT; ?>/points">المراكز والنقاط
                            <span class="Plantet"></span></a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['editPoint'])
                                || isset($_SESSION['deletePoint'])) : ?>
                                <li><a href="<?php echo URLROOT; ?>/points/index"><span
                                                class="glyphicon glyphicon-list-alt"></span>عرض الكل</a></li>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['addPoint'])) : ?>
                                <li><a href="<?php echo URLROOT; ?>/points/add"><span
                                                class="glyphicon glyphicon-plus"></span>اضافة جديدة</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['addUser'])
                    || isset($_SESSION['editUser'])
                    || isset($_SESSION['deleteUser'])
                    || isset($_SESSION['addUserPoint'])
                    || isset($_SESSION['editUserPoint'])
                    || isset($_SESSION['deleteUserPoint'])) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle user-nav" data-toggle="dropdown"
                           href="<?php echo URLROOT; ?>/points">المستخدمين
                            <span class="Plantet"></span></a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['editUser'])
                                || isset($_SESSION['deleteUser'])) : ?>
                                <li><a href="<?php echo URLROOT; ?>/users/index"><span
                                                class="glyphicon glyphicon-list-alt"></span>
                                        عرض المستخدمين المدراء</a></li>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['editUserPoint'])
                                || isset($_SESSION['deleteUserPoint'])) : ?>
                                <li><a href="<?php echo URLROOT; ?>/users/userPoint"><span
                                                class="glyphicon glyphicon-list-alt"></span>
                                        عرض مستخدميّ النقاط</a></li>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['addUser'])) : ?>
                                <li><a href="<?php echo URLROOT; ?>/users/addUser"><span
                                                class="glyphicon glyphicon-plus"></span>اضافة مستخدم مدير</a></li>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['addUserPoint'])) : ?>
                                <li><a href="<?php echo URLROOT; ?>/users/addUserPoint"><span
                                                class="glyphicon glyphicon-plus"></span>اضافة مستخدم نقطة</a></li>
                            <?php endif; ?>
                        </ul>

                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['addPlant'])
                    || isset($_SESSION['editPlant'])
                    || isset($_SESSION['deletePlant'])): ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle event-nav" data-toggle="dropdown"
                           href="<?php echo URLROOT; ?>/points">الاحداث
                            <span class="Plantet"></span></a>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['editPlant'])
                                || isset($_SESSION['deletePlant'])) : ?>
                                <li><a href="<?php echo URLROOT; ?>/events/index"><span
                                                class="glyphicon glyphicon-list-alt"></span>
                                        عرض الاحداث </a></li>
                            <?php endif; ?>

                        </ul>

                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li>
                        <button class="dropdown-toggle btn btn-lg btn-link" data-toggle="dropdown">
                            <img src="<?php echo $imageSource; ?>"
                                 class="img-circle" width="40" height="40" ; style="border-radius: 25% !important;">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-user-info shadowDiv">
                            <li>
                                <img src="<?php echo $imageSource; ?>"
                                     class="img-circle" style="margin:20px;  width:60px; height:60px">
                            </li>

<!--                            <li style="margin:10px" role="presentation">--><?php //echo trim($_SESSION['Uname']) ?><!--</li>-->
<!--                            <li role="presentation">-->
<!--                                <div class="user-info-div" style="background: #5c5c5c; ">-->
<!--                                    --><?php //echo $_SESSION['point_name'] ?><!--</div>-->
<!--                            </li>-->
<!--                            <li role="presentation">-->
<!--                                <div class="user-info-div" style="background: #4f4f4f;">-->
<!--                                    --><?php //echo $_SESSION['cPhone'] ?>
<!--                                </div>-->
<!--                            </li>-->

                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="<?php echo URLROOT; ?>/users/logout">
                                    <span class="glyphicon glyphicon-log-out"></span>
                                    تسجيل الخروج</a></li>
                        </ul>
                    </li>

                    <?php if (isset($_SESSION['addUser'])
                        && isset($_SESSION['editUser'])
                        && isset($_SESSION['deleteUser'])) : ?>
                        <li>
                            <a href="<?php echo URLROOT; ?>/manages">
                                <span> &nbsp &nbsp &nbsp</span></a>
                        </li>
                    <?php endif; ?>
                <?php else : ?>
                    <li><a href="<?php echo URLROOT ?>"/users/login"><span
                                class="glyphicon glyphicon-log-in"></span> تسجيل الدخول</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<div class="navbar navbar-default navbar-static-top nav-2nd" style="margin-top: 69px;padding: 16px 0px 16px 0px">

</div>

<style>


    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px;
        border-radius: 0 6px 6px 6px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #ccc;
        margin-top: 5px;
        margin-right: -10px;
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }





    .container-fluid {
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .navbar-inverse {
        background-color: #3b1880 !important;
        border-color: #3b1880 !important;
    }

    .btn-link {
        position: relative;
    }


    .navbar-inverse .navbar-nav > li > a {
        color: #ffffff;
    }

    .navbar-brand {
        padding: 0px 15px;
    }

    .dropdown-menu-user-info {
        width: 250px;
        height: 250px;
        text-align: center;
    }

    .user-info-div {
        border-radius: 10px;
        height: 25px;
        margin: 5px;
        font-size: 10px;
        color: #ffffff;
        line-height: 25px;
    }

    .shadowDiv {
        border: solid #d5d5d5 1px;

        -webkit-box-shadow: 0px 0px 30px 0px rgba(213, 138, 44, 0.2);
        -moz-box-shadow: 0px 0px 30px 0px rgba(213, 138, 44, 0.2);
        box-shadow: 0px 0px 30px 0px rgba(213, 138, 44, 0.2);
    }

    .img-circle {
        border-radius: 50%;
        border: solid #5c5c5c1px;
        /*box-shadow: 0 4px 8px 0 rgba(213, 138, 44, 0.2), 0 6px 20px 0 rgba(213, 138, 44, 0.19);*/


        -webkit-box-shadow: 0px 0px 30px 0px rgba(213, 138, 44, 0.2);
        -moz-box-shadow: 0px 0px 30px 0px rgba(213, 138, 44, 0.2);
        box-shadow: 0px 0px 30px 0px rgba(213, 138, 44, 0.2);
    }

    @media screen and (min-width: 990px) {

        .navbar-nav > li {
            float: none !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }


    }


    @media screen and (max-width: 320px) {

        .nav-2nd {
            width: 119%;
        }
    }

</style>