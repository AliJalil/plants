<!DOCTYPE html>

<html>
<head>
    <title>Zoo Planet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap -->
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.css" ?>" rel="stylesheet"/>
<!-- tab icon -->
<link rel="shortcut icon" type="image/x-icon" href="<?php echo URLROOT . "/public/images/tabicon.svg" ?>" />
    <!--Google Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Duru+Sans|Actor" rel="stylesheet" type="text/css"/>

    <!--Bootshape-->
    <link href="<?php echo URLROOT . "/public/mh/css/bootshape.css" ?>" rel="stylesheet"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>


    <![endif]-->
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/bootstrap.min.js" ?>"></script>
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/bootshape.js" ?>"></script>
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/jquery.js" ?>"></script>
</head>
<head>
    <title>Zoo Planet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap -->
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.css" ?>" rel="stylesheet"/>

    <!--Google Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Duru+Sans|Actor" rel="stylesheet" type="text/css"/>

    <!--Bootshape-->
    <link href="<?php echo URLROOT . "/public/mh/css/bootshape.css" ?>" rel="stylesheet"/>
    
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/jquery.js" ?>"></script>
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/bootstrap.min.js" ?>"></script>
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/bootshape.js" ?>"></script>
  
</head>
<body>
<!-- Navigation bar -->
<div class="navbar navbar-default navbar-fixed-top" style="background: #130F40;" role="navigation">
    <div class="container">
        <a href="#">
            <div class="navbar-header ">

                <a class="navbar-brand" href="#" style="color: aliceblue;">
                    ?????????? <span class="blue">?????????? ????????????</span></a>
            </div>
        </a>
        <nav role="navigation" class="collapse navbar-collapse navbar-right">
            <ul class="navbar-nav nav">
                <li>

                    <a style="padding: 0;" target="_blank" href="https://alkafeel.edu.iq/"><img
                                style="width: 18rem;"
                                src="<?php echo URLROOT; ?>/public/images/statics/logo.png"
                                alt="logo"/></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- End Navigation bar -->

<!-- Slide gallery -->
<div class="jumbotron">
    <div
            id="carousel-example-generic"
            class="carousel slide"
            data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic"
                data-slide-to="0"   
                class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo URLROOT . "/public/images/statics/carousel11.jpg" ?>" alt=""/>
                <div class="carousel-caption"></div>
            </div>
            <div class="item">
                <img src="<?php echo URLROOT . "/public/images/statics/carousel22.jpg" ?>" alt=""/>
                <div class="carousel-caption"></div>
            </div>
            <div class="item">
                <img src="<?php echo URLROOT . "/public/images/statics/carousel33.jpg" ?>" alt=""/>
                <div class="carousel-caption"></div>
            </div>
        </div>
        <!-- Controls -->
        <a class="left carousel-control"
           href="#carousel-example-generic"
           data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control"
           href="#carousel-example-generic"
           data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
<!-- End Slide gallery -->
<!-- Content -->
<div class="container">
    <h3 class="text-center">?????????? ?????????? ????????????</h3>
    <p>
        ?????????????? ?????? ?????????? ???????????????? ???????????? ?????????? ???????????? ?????????? ???????????? ??????????????
        ?????????? ???????????? ?????????????????????? ?????????????? ???????? 5000 ???????? ???????????? ?????????????? ????????????????
        ???????????????? ???? ?????????? ?????????? ???????????? ???????????? ???????? ???????????? ???????? ?????????? ??????????????
        ???????????? ?????? ???????? ?????????????? ??????????????????.
    </p>
</div>
<!-- End Content -->
<div class="container thumbs" id="garden">

    <?php foreach ($data['Plants'] as $plant) :
        $pId = $plant->pId; ?>
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail cardbg">

                <img id="img<?php echo $pId ?>"
                     src="<?php echo checkImg($plant->mainImg) ?>">

                <div class="caption">
                    <h3 class="text-center"><?php echo $plant->name; ?></h3>
                    <p>
                        <?php echo $plant->det; ?>
                    </p>
                    <div class="btn-toolbar text-center">
                        <a href="<?php echo URLROOT . "/main/details/" . $pId ?>" role="button"
                           class="btn text-white btns">Details</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<div class="footer text-center">
    <p>
        &copy;2021
        <b><a class="blue" target="_blank" href="https://alkafeel.edu.iq/">
                Alkafeel University</a></b>Planets. All Rights Reserved.
    </p>
</div>
</body>
</html>
