<!DOCTYPE html>
<html>
<head>
    <title>Zoo Planet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap -->
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.css" ?>" rel="stylesheet"/>

    <!--Google Fonts-->
    <link href="http://fonts.googleapis.com/css?family=Duru+Sans|Actor" rel="stylesheet" type="text/css"/>

    <!--Bootshape-->
    <link href="<?php echo URLROOT . "/public/mh/css/details.css" ?>" rel="stylesheet"/>
    <link href="<?php echo URLROOT . "/public/mh/css/bootshape.css" ?>" rel="stylesheet"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/bootstrap.min.js" ?>"></script>
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/bootshape.js" ?>"></script>
  <script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/jquery.js" ?>"></script>

    <![endif]-->
</head>
<body>
<!-- Navigation bar -->
<div class="navbar navbar-default navbar-fixed-top" style="background: #130F40;" role="navigation">
    <div class="container">
        <a href="#">
            <div class="navbar-header ">

                <a class="navbar-brand" href="index.php" style="color: aliceblue;">
                    حدائق <span class="blue">جامعة الكفيل</span></a>
            </div>
        </a>
        <nav role="navigation" class="collapse navbar-collapse navbar-right">
            <ul class="navbar-nav nav">
                <li>

                    <a style="padding: 0;" href="https://alkafeel.edu.iq/"
                    ><img
                                style="width: 18rem;"
                                src="https://alkafeel.edu.iq/tables/public/images/statics/logo.png"
                                alt="logo "
                        /></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php
$currentPlant = $data;
$imgs = json_decode($currentPlant->imgs); ?>
<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img
                                    src="<?php echo  checkImg($currentPlant->mainImg)  ?>"/></div>

                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <?php
                        $i = 0;
                        foreach ($imgs as $img) :?>
                            <li><a data-target="#pic-<?php echo $i ?>" data-toggle="tab"><img
                                            src=" <?php echo checkImg($img)  ?>"/></a></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="details col-md-6">
                    <h3 class="product-title"><?php echo $currentPlant->name; ?> </h3>
                    <h3 class="product-title"> <?php echo $currentPlant->eName; ?></h3>

                    <p class="product-description text-end">
                        <?php echo $currentPlant->det; ?>
                    </p>
                    <div class="type">
                        <h4><b> : النوع </b></h4>
                        <span class="badge bg-blue"><?php echo $currentPlant->type; ?></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- copyright -->
<div class="footer text-center">
    <p>
        &copy; 2021
        <b
        ><a class="blue" target="_blank" href="https://alkafeel.edu.iq/">
                Alkafeel University
            </a></b
        >
        Planets. All Rights Reserved.
    </p>
</div>
</body>
</html>
