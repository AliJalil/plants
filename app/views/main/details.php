<!DOCTYPE html>
<html >
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AlKafeel University Plantes">
    <meta name="author" content="Alkafeel University Plantes">
<title>حدائق جامعة الكفيل</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Bootstrap -->
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.rtl.min.css" ?>" rel="stylesheet">


   
    <!--Bootshape-->

    <link href="<?php echo URLROOT . "/public/mh/css/details.css" ?>" rel="stylesheet"/>
    <link href="<?php echo URLROOT . "/public/mh/css/bootshape.css" ?>" rel="stylesheet"/>

    
</head>
<style>
.imgcrop{
width: 180px;
  height: 140px;
  background-position: center center;
  background-repeat: no-repeat;
  border-radius: 4%;

    }
</style>
<body>
<!-- Navigation bar -->
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
/>

</a>




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
<?php
$currentPlant = $data;
$imgs = json_decode($currentPlant->imgs); ?>
<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">

                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img  id="main"
                                style='
    border-radius: 4%;
                                
                                '    src="<?php echo  checkImg($currentPlant->mainImg)  ?>"/></div>

                    </div>

                    <ul class="preview-thumbnail nav nav-tabs">
                        <?php
                        $i = 0;
                        foreach ($imgs as $img) :?>
                            <li><a data-target="#pic-<?php echo $i ?>" data-toggle="tab"><img
                                       width='500px' height='400px'   class='imgcrop' onclick='change(this.src)'  src=" <?php echo checkImg($img)  ?>"/></a></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="details col-md-6">
                    <h3 class="product-title text-center"><?php echo $currentPlant->name; ?> </h3>
                    <h3 class="product-title text-center" style='color:#01A9E8' > <?php echo $currentPlant->eName; ?></h3>
<hr />

                    <p class="product-description " style='text-align: justify ; direction: rtl;' >
                        <?php echo $currentPlant->det; ?>
                    </p> </p>   
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

<footer class="text-muted py-5">
    <div class="container  footer text-center
    ">
    <p>
      
      <a target='_blank' href="https://alkafeel.edu.iq/research" class="btn btn-primary my-2">البحث العلمي</a>
      <a target='_blank' href="https://alkafeel.edu.iq/library/" class="btn btn-primary my-2">مكتبة الجامعة</a>
      <a target='_blank' href="https://alkafeel.edu.iq/ukfl" class="btn btn-primary my-2">الحياة الجامعية</a>
      <a target='_blank' href="https://alkafeel.edu.iq" class="btn btn-info my-2">موقع الجامعة</a>
                </p>
                 <p style='color:#000'>&copy; CopyRight 2021 Alkafeel University </p>
      
    </div>
</footer>
<script type="text/javascript">
  const change = src => {
        document.getElementById('main').src = src;
      }
</script>
</body>
</html>
