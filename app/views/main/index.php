<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>حدائق جامعة الكفيل</title>


    <!-- Bootstrap core CSS -->
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.rtl.min.css" ?>" rel="stylesheet">

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
    <div class="collapse bg-dark " id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">حول</h4>
                    <p class="text-muted">أضف بعض المعلومات حول الألبوم، المؤلف، أو أي سياق خلفية آخر. اجعلها بضع جمل
                        حتى يتمكن الزوار من التقاط بعض التلميحات المفيدة. ثم اربطها ببعض مواقع التواصل الاجتماعي أو
                        معلومات الاتصال.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">تواصل معي</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">تابعني على تويتر</a></li>
                        <li><a href="#" class="text-white">شاركني الإعجاب في فيسبوك</a></li>
                        <li><a href="#" class="text-white">راسلني على البريد الإلكتروني</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a target="_blank"
               href="https://alkafeel.edu.iq/" style="padding: 0;" class="navbar-brand d-flex align-items-center">
                <img
                        style="width: 40%"
                        src="https://alkafeel.edu.iq/tables/public/images/statics/logo.png"
                        alt="logo "
                />
            </a>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="تبديل التنقل">
              <span class="navbar-toggler-icon"></span>
            </button> -->
        </div>
    </div>
</header>

<main>

    <section class="py-5 text-center container ">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw">حدائق جامعة الكفيل</h1>
                <p class="lead text">
                    بمناسبة بدء العام الدراسيّ الجديد باشرت مجموعة مشاتل الكفيل التابعة لشركة الكفيل للاستثمارات العامّة
                    بشتل 5000 زهرة بمختلف الأنواع والأشكال والألوان في حدائق جامعة الكفيل لتوفير بيئة دراسية تليق بطلبة
                    جامعتنا وتوفّر لهم أفضل الأجواء الدراسيّة.
                </p>
                <p>
                    <a href="https://alkafeel.edu.iq/" class="btn btn-primary my-2">موقع الجامعة الرئيسي</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($data['Plants'] as $plant) :
                    $pId = $plant->pId; ?>

                    <div class="col">
                        <div class="card shadow-sm ">
                            <img id="img<?php echo $pId ?>"  src="<?php echo checkImg($plant->mainImg) ?>" class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 role="img" aria-label="Placeholder: صورة مصغرة" focusable="false"></img>
                            <div class="card-body">
                                <h5 class="card-title text-center"><?php echo $plant->name; ?></h5>
                                <hr>
                                <p class="card-text">
                                    <?php echo $plant->det; ?>
                                </p>
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

<footer class="text-muted py-5">
    <div class="container footer">
        <!-- <p class="float-end mb-1">
          <a href="#">عد إلى الأعلى</a>
        </p>
       -->
    </div>
</footer>


</body>
</html>
