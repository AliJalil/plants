<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
        ISCKU
    </title>
    <link href="<?php echo URLROOT . "/public/css/bootstrap.css" ?>" rel="stylesheet"/>
    <link href="<?php echo URLROOT . "/public/css/Style.css" ?>" rel="stylesheet"/>
</head>
<body class="HU-login-container">

<div class="">
    <div style="text-align: center;">
        <div><h1 style="font-family: 'TheSans Bold'; color:#0b730a !important; "> مؤتمر جامعة الكفيل الدولي الثالث, اذار
                2021 </h1></div>
        <div><h1 class="text">International Scientific Conference of Alkafeel University (ISCKU), March 2021</h1></div>
        
        <div class="col-md-7 ts">
            <div class="panel-group">
                
                     <button style="margin-top: 20px;margin-bottom: 20px;width:100%;height:70px;" class="btn-login btn-3"
                        onclick="location.href='<?php echo URLROOT . "/public/assets/docs/iscku_guide.pdf" ?>'">تحميل دوار المؤتمر
                </button>
                
                <div class="panel panel-default">
                    <div class="panel-heading"><h2
                                style="font-size: 29px; font-family: 'TheSans Bold';color:#ffffff !important">مؤتمر
                            العلوم والهندسة</h2></div>
                    <div class="panel-collapse collapse in">
                        <div class="panel-body"><img src="<?php echo URLROOT . "/public/images/002.webp"; ?>" alt="">
                            <button class="btn-login btn-3"
                                    onclick="location.href='<?php echo URLROOT . "/Science" ?>'">دخول / Enter
                            </button>
                            <br/><br/>
                        </div>
                    </div>
                </div>

<!--                <a href="#" type="button" class="btn btn-info">Info</a>-->
           
            </div>
        </div>
        <div class="col-md-7 ds">
            <div class="panel-group">
                <button style="margin-top: 20px;margin-bottom: 20px;width:100%;height:70px;" class="btn-login btn-3"
                        onclick="location.href='<?php echo URLROOT . "/public/assets/docs/ISCKU.pdf" ?>'">روابط ومواعيد الجلسات 
                </button>
                <div class="panel panel-default">
                    <div class="panel-heading"><h2
                                style="font-size: 29px; font-family: 'TheSans Bold';color:#ffffff !important">مؤتمر
                            الاختصاصات الطبية</h2></div>
                    <div class="panel-collapse collapse in">
                        <div class="panel-body"><img src="<?php echo URLROOT . "/public/images/001.webp"; ?>" alt="">
                            <button class="btn-login btn-3"
                                    onclick="location.href='<?php echo URLROOT . "/Pharmacy" ?>'">دخول / Enter
                            </button>
                            <br/><br/>
                        </div>
                    </div>
                </div>

                

            </div>
        </div>
    </div>
</div>


<style>
    @font-face {
        font-family: 'TheSans Bold';
        font-style: normal;
        font-weight: 700;
        src: url(<?php echo URLROOT . "/public/fonts/TheSans-Bold.eot"?>);
        src: url(<?php echo URLROOT . "/public/fonts/TheSans-Bold.eot?#iefix"?>) format('embedded-opentype'),
        url(<?php echo URLROOT . "/public/fonts/TheSans-Bold.woff2"?>) format('woff2'),
        /*url(../fonts/TheSans-Bold.woff) format('woff'),*/
        /*url(../fonts/TheSans-Bold.ttf) format('truetype');*/
    }

    /*@media (min-width: 992px) {*/
    /*    !* width: 58.333333333333336%; *!*/
    /*    [class*="col-"] {*/
    /*        width: 100%;*/
    /*    }*/
    /*}*/

    @media screen and (max-width: 1000px) {
        @media screen and (min-width: 768px) {
            .ts {
                margin-right: 85px !important;
                width: 80%;
            }

            .ds {
                margin-right: 85px !important;
                margin-top: 20px !important;
            }

            [class*="col-"] {
                width: 80%;
            }
        }
    }

    @media screen and (min-width: 1001px) {
        @media screen and (min-width: 768px) {
            .ts {
                margin-right: 240px !important;
            }

            [class*="col-"] {
                width: 35%;
            }
        }

        @media screen and (max-width: 1025px) {
            @media screen and (min-width: 768px) {
                .ts {
                    margin-right: 100px !important;
                }

                .ds {
                    margin-right: 100px !important;
                    margin-top: 20px !important;
                }

                [class*="col-"] {
                    width: 80%;
                }
            }
        }
</style>
</body>
</html>
