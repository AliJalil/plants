<!DOCTYPE html>

<html>
<head>


    <title> Planet details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap -->
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.css" ?>" rel="stylesheet"/>

    <!--Google Fonts-->
    <link
            href="http://fonts.googleapis.com/css?family=Duru+Sans|Actor"
            rel="stylesheet"
            type="text/css"
    />

    <!--Bootshape-->
    <link href="<?php echo URLROOT . "/public/mh/css/details.css" ?>" rel="stylesheet"/>
    <link href="<?php echo URLROOT . "/public/mh/css/bootshape.css" ?>" rel="stylesheet"/>

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

<!-- End Navigation bar -->
<!------ Include the above in your HEAD tag ---------->


<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img src="./img/252.jpg"/></div>

                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="./img/200.jpg"/></a></li>
                        <li><a data-target="#pic-2" data-toggle="tab"><img src=<?php echo URLROOT . "/public/mh/img/200.jpg"?>""/></a></li>
                        <li><a data-target="#pic-3" data-toggle="tab"><img src="./img/201.jpg"/></a></li>
                        <li><a data-target="#pic-4" data-toggle="tab"><img src="./img/202.jpg"/></a></li>
                        <li><a data-target="#pic-5" data-toggle="tab"><img src="./img/201.jpg"/></a></li>
                    </ul>

                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">وردة الياسمين</h3>
                    <h3 class="product-title">Jasminum polyanthum</h3>

                    <p class="product-description text-end">
                        زهرة الياسمين هي إحدى أنواع
                        الشُجيرات المزهرة التي تنتمي للفصيلة الزيتونية وتنتشر في مُعظم
                        أنحاء العالم بسبب جمال زهرتِها التي تأتي غالباً باللون الأبيض أو
                        الأصفر ورائحتها الفوّاحة، وعادةً ما يتراوح طول نبتة الياسمين بين 3
                        و4.5 متر إذ تُضفي منظراً جميلاً على المكان، في حين يوجد نوعين من
                        الياسمين يُمكن استخدامهما في إنتاج النفط، وتُعتبر زهرة الياسمين
                        الزهرة الوطنية لكل من إندونيسيا والفلبين، كما يُعتقد أن أصل هذه
                        الزهرة يعود إلى غرب الصين.
                    </p>
                    <div class="type">
                        <h4><b> : النوع </b></h4>
                        <span class="badge bg-blue">طبية</span>
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

<!-- End Footer -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- // <script src="https://code.jquery.com/jquery.js"></script> -->
<script src="js/jquery.js"></script>
<script>
    let items = document.getElementById('garden')
    let planet = ''
    for (let index = 0; index < 6; index++) {
        planet += `
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="img/pic22.jpg" alt="" class="img-circle" />
          <div class="caption">
            <h3 class="text-center">وردة الياسمين</h3>
            <p>
              زهرة الياسمين (بالإنجليزية: Jasminum polyanthum) هي إحدى أنواع
              الشُجيرات المزهرة التي تنتمي للفصيلة الزيتونية وتنتشر في مُعظم
              أنحاء العالم بسبب جمال زهرتِها التي تأتي غالباً باللون الأبيض أو
              الأصفر ورائحتها الفوّاحة، وعادةً ما يتراوح طول نبتة الياسمين بين 3
              و4.5 متر إذ تُضفي منظراً جميلاً على المكان، في حين يوجد نوعين من
              الياسمين يُمكن استخدامهما في إنتاج النفط، وتُعتبر زهرة الياسمين
              الزهرة الوطنية لكل من إندونيسيا والفلبين، كما يُعتقد أن أصل هذه
              الزهرة يعود إلى غرب الصين.
            </p>
            <div class="btn-toolbar text-center">
              <a href="details.html" role="button" class="btn btn-info"
                >Details</a
              >
            </div>
          </div>
        </div>
      </div>
    `

    }
    items.innerHTML = planet
</script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootshape.js"></script>
</body>
</html>
