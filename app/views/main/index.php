<!doctype html>
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>حدائق جامعة الكفيل</title>
    
     
    <!-- Bootstrap core CSS -->
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.rtl.min.css" ?>" rel="stylesheet">
    <link href="<?php echo URLROOT . "/public/mh/css/bootshape.css" ?>" rel="stylesheet"/>


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem; 
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>


</head>
<body>

<header class="sticky-top">
 
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a 
               href="<?php echo URLROOT . "/main/index/" ?>" style="padding: 0;" class="navbar-brand d-flex align-items-center">
                <img
                        style="width: 40%"
                        src="https://alkafeel.edu.iq/tables/public/images/statics/logo.png"
                        alt="logo "
                />
            </a>



            <div class="text-center mb-1">

<a href="https://www.facebook.com/alkafeel.edu.iq">
  <img  class="fa" src="<?php echo URLROOT . "/public/images/icon/facebook.svg" ?>" alt="facebook logo"
/></a>




<a href="https://instagram.com/alkafeeleduiq">
  <img
    class="fa"
    src="<?php echo URLROOT . "/public/images/icon/instagram.svg" ?>"
    alt="instagram logo"
  />
</a>


    <a href="https://twitter.com/alkafeeleduiq">
        <img
          class="fa"
          src="<?php echo URLROOT . "/public/images/icon/twitter.svg" ?>"
          alt="twitter logo"
        />
      </a>
    
  
  
  
    <a href="https://www.youtube.com/user/humanitiescollege">
      <img
        class="fa"
        src="<?php echo URLROOT . "/public/images/icon/youtube.svg" ?>"
"
        alt="youtube logo"
      />
    </a>
              </div>
      
        </div>
    </div>
</header>

<main>
<!-- <div style='background: rgba(0, 0, 0, 0.35);' > -->

    
    
    <div class='bg-video'>

    <video autoplay muted loop id="myVideo" >
        <source src="<?php echo URLROOT . "/public/images/vid/garden.mp4" ?>" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>
    
    
    
    
    
    <div class="text">

        <!-- <section class="py-5 text-center container  ">
            <div class=" mx-auto " style='color:#fff'> -->
                <h1 >حدائق جامعة الكفيل</h1>
                <!-- <p class="py-4 lead text"> -->
                    <p>
                    بمناسبة بدء العام الدراسيّ الجديد باشرت مجموعة مشاتل الكفيل التابعة لشركة الكفيل للاستثمارات العامّة
                    بشتل 5000 زهرة بمختلف الأنواع والأشكال والألوان في حدائق جامعة الكفيل لتوفير بيئة دراسية تليق بطلبة
                    جامعتنا وتوفّر لهم أفضل الأجواء الدراسيّة.
                </p>
                
                
            <!-- </div>
        </section> -->
    </div>


    
</div> 
    
    <div class="album py-5 bg-light">
        
        <div class="container">
            



            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($data['Plants'] as $plant) :
                    $pId = $plant->pId; ?>

<div class="col  ">

    
    <div class="card shadow-sm ">

                            <a href="<?php echo URLROOT . "/main/details/" . $pId ?>" >
                            
                            <img id="img<?php echo $pId ?>"  src="<?php echo checkImg($plant->mainImg) ?>" class="zoom bd-placeholder-img card-img-top" width="100%" height="225"
                            role="img" aria-label="Placeholder: صورة مصغرة" focusable="false"></img>
                        </a>
                        
                        
                        <div class="card-body">
                                <h5 class="card-title text-center"  style='color:#01A9E8'><?php echo $plant->name; ?></h5>
                                <hr>
                                <div class='overflowed'>

                                    <p class="card-text  " >
                                        <?php echo $plant->det; ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="<?php echo URLROOT . "/main/details/" . $pId ?>" role="button" class="btn btn-sm btn-outline-primary">عرض
                                            التفاصيل</a>
                                    </div>
                                </div>
                            </div>
</div>
</div>
                     

                <?php endforeach; ?>
            </div>
        </div>
    
    
    </div>
    
</main>
<section class='statisctic '>
<div class='text-center' >
    <img class='far py-4' src="<?php echo URLROOT . "/public/images/statistics/agave.svg" ?>" alt="agaver">
    <h5 class='text-center'> <b> 1200</b></h5> 
<h5 > <b> عدد نباتات الزينة</b></h5> 
</div>
<div class='text-center'>
<img class='far py-4' src="<?php echo URLROOT . "/public/images/statistics/gardening.svg" ?>" alt="gardening">

    <h5 > <b> 1200</b></h5> 
<h5 > <b> عدد النباتات الكلي </b></h5> 
</div>
<div class='text-center'>
<img class='far py-4' src="<?php echo URLROOT . "/public/images/statistics/planet-earth.svg" ?>" alt="planet-earth">

    <h5 > <b> 1200</b></h5> 
<h5 class='text-center'> <b> عدد النباتات الطبية</b></h5> 
</div>
<div class='text-center'>
<img class='far py-4' src="<?php echo URLROOT . "/public/images/statistics/planet-save.svg" ?>" alt="planet-save">

    <h5 > <b> 1200</b></h5> 
<h5 class='text-center'> <b> عدد عمليات التشجير</b></h5> 
</div>

</section>
<footer class="text-muted py-5">
    <div class="container  footer text-center
    ">
    <p>
                    
        <a target='_blank' href="https://alkafeel.edu.iq/research" class="btn btn-primary my-2">البحث العلمي</a>
        <a target='_blank' href="https://alkafeel.edu.iq/library/" class="btn btn-primary my-2">مكتبة الجامعة</a>
        <a target='_blank' href="https://alkafeel.edu.iq/ukfl" class="btn btn-primary my-2">الحياة الجامعية</a>
        <a target='_blank' href="https://alkafeel.edu.iq" class="btn btn-info my-2">موقع الجامعة</a>
                </p>
                 <p>&copy; CopyRight 2021 Alkafeel University </p>
      
    </div>
</footer>


</body>
</html>
