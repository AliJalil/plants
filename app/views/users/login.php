<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="wrapper fadeInDown" style=" font-family: TheSans;">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first yellowDiv">
            <img src="<?php echo URLROOT; ?>/public/images/statics/logo.png" id="icon" alt="User Icon"
                 style="width: 50%"/>
        </div>
        <label style="color: #939393;margin-top: 30px;font-size: 2vh">
            الرجاء ادخال معلومات الدخول
        </label>

        <!-- Login Form -->
        <form enctype="multipart/form-data" name="LoginUserForm" method="post" id="LoginUserForm">
            <input  id="userName" name="userName"
                    required oninput="this.setCustomValidity('')" placeholder="الاسم المستخدم" value=""
                    type="text" id="login" class="fadeIn second">

            <input
                    id="password"
                    required oninput="this.setCustomValidity('')" placeholder=" كلمة المرور" value=""
                    type="password" id="password" class="fadeIn third" name="password">
<!--            <input type="submit" class="fadeIn fourth" value="دخول">-->

            <input id="submit" type="submit" class="fadeIn fourth" value="دخول">

        </form>

    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

<script src=<?php echo URLROOT . "/public/js/main.js" ?>></script>


<script>


    $( document ).ready( function () {


        $( "#userName_err" ).html( "" );
        $( "#password_err" ).html( "" );

        setValidationMSG( "#password", "الرجاء ادخال الاسم المستخدم" );
        setValidationMSG( "#userName", "الرجاء ادخال كلمة المرور" );


        $( "#LoginUserForm" ).submit( function (event) {

                //getting form into Jquery Wrapper Instance to enable JQuery Functions on form
                var form = $( "#LoginUserForm" );

                //Serializing all For Input Values (not files!) in an Array Collection so that we can iterate this collection later.
                var params = form.serializeArray();

                //Declaring new Form Data Instance
                var formData = new FormData();


                //Now Looping the parameters for all form input fields and assigning them as Name Value pairs.
                $( params ).each( function (index, element) {
                    formData.append( element.name, element.value );
                    // alert( element.name + " = " + element.value );
                } );
                // formData.append( "datee", $( "#datee" ).value );
                //disabling Submit Button so that user cannot press Submit Multiple times
                var btn = $( this );
                btn.val( "Uploading..." );
                btn.prop( "disabled", true );
                $.ajax( {
                    url: '<?php echo URLROOT . "/users/login";?>',
                    method: "post",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        //Firing event if File Upload is completed!
                        btn.prop( "disabled", false );
                        btn.val( "حفظ" );

                        var json = $.parseJSON( response );

                        if (json == "1") {

                            window.location = "<?php echo URLROOT . "/info";?>";

                        } else if (json == "10") {
                            $( "#userName_err" ).html( "الرجاء ادخال الاسم مستخدم" );
                        } else if (json == "11") {
                            $( "#password_err" ).html( "الرجاء ادخال كلمة المرور" );
                        } else if (json == "12") {
                            $( "#password_err" ).html( "خطأ في الاسم المستخدم او كلمة المرور" );
                            const Toast = Swal.mixin( {
                                toast: true,
                                position: 'center',
                                showConfirmButton: false,
                                timer: 3000
                            } );

                            Toast.fire( {
                                type: 'error',
                                title: 'خطأ في الاسم المستخدم او كلمة المرور'
                            } )
                        }


                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert( "Status: " + textStatus );
                        alert( "خظأ: " + errorThrown );
                    }
                } );
                return false;
            }
        );
    } );
</script>
<style>

    html {
        background-color: #d1d1d1;
    }



    @font-face {
        font-family: 'TheSans Bold';
        font-style: normal;
        font-weight: 700;
        src: url(../fonts/TheSans-Bold.eot);
        src: url(../fonts/TheSans-Bold.eot?#iefix) format('embedded-opentype'),
        url(../fonts/TheSans-Bold.woff2) format('woff2'),
        url(../fonts/TheSans-Bold.woff) format('woff'),
        url(../fonts/TheSans-Bold.ttf) format('truetype');
    }

    * {
        font-family: "TheSans Bold";
        font-size: 12px;
    }
    body {
        font-family: "TheSans", sans-serif;
        /*height: 100vh;*/
        background-color: #d1d1d1;
    }

    .yellowDiv {
        background: #3b1880;
        padding: 2% 0;

    }

    /* STRUCTURE */

    .wrapper {
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        width: 100%;
        min-height: 100%;
        padding: 75px;
    }

    #formContent {
        -webkit-border-radius: 10px 10px 10px 10px;
        border-radius: 60px 60px 60px 60px;
        background: #fff;
        width: 90%;
        max-width: 450px;
        position: relative;
        padding: 0px;
        -webkit-box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
        box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
        text-align: center;
        overflow: hidden;
    }

    /* FORM TYPOGRAPHY*/

    input[type=button], input[type=submit], input[type=reset] {
        background-color: #56baed;
        border: none;
        color: white;
        padding: 15px 80px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        text-transform: uppercase;
        font-size: 13px;
        -webkit-box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
        box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
        margin: 5px 20px 40px 20px;
    }

    input[type=text],[type=password] {
        background-color: #f6f6f6;
         color: #0d0d0d;
        padding: 15px 32px;
        text-align: right;
        text-decoration: none;
        display: inline-block;
        font-size: 13px;
        margin: 5px;
        width: 85%;
        border: 1px solid #f6f6f6;
        -webkit-border-radius: 5px 5px 5px 5px;
        border-radius: 5px 5px 5px 5px;
    }

    input[type=text]:focus,[type=password]:focus {
        background-color: #fff;
    }

    /* ANIMATIONS */

    /* Simple CSS3 Fade-in-down Animation */
    .fadeInDown {
        -webkit-animation-name: fadeInDown;
        animation-name: fadeInDown;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    @-webkit-keyframes fadeInDown {
        0% {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0);
        }
        100% {
            opacity: 1;
            -webkit-transform: none;
            transform: none;
        }
    }

    @keyframes fadeInDown {
        0% {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0);
        }
        100% {
            opacity: 1;
            -webkit-transform: none;
            transform: none;
        }
    }

    /* Simple CSS3 Fade-in Animation */
    @-webkit-keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @-moz-keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .fadeIn {
        opacity: 0;
        -webkit-animation: fadeIn ease-in 1;
        -moz-animation: fadeIn ease-in 1;
        animation: fadeIn ease-in 1;

        -webkit-animation-fill-mode: forwards;
        -moz-animation-fill-mode: forwards;
        animation-fill-mode: forwards;

        -webkit-animation-duration: 1s;
        -moz-animation-duration: 1s;
        animation-duration: 1s;
    }

    .fadeIn.first {
        overflow: hidden;
        -webkit-animation-delay: 0.4s;
        -moz-animation-delay: 0.4s;
        animation-delay: 0.4s;

    }

    .fadeIn.second {
        -webkit-animation-delay: 0.6s;
        -moz-animation-delay: 0.6s;
        animation-delay: 0.6s;
        border-radius: 25px;
        background: #ffffff;
        border: solid #d1d1d1;
    }

    .fadeIn.third {
        -webkit-animation-delay: 0.8s;
        -moz-animation-delay: 0.8s;
        animation-delay: 0.8s;
        border-radius: 25px;
        background: #ffffff;
        border: solid #d1d1d1;
    }

    .fadeIn.fourth {
        -webkit-animation-delay: 1s;
        -moz-animation-delay: 1s;
        animation-delay: 1s;
        background: #5c5c5c;
        /*width: 10%;*/
        border-radius: 25px;
    }

     /*Simple CSS3 Fade-in Animation */

    *:focus {
        outline: none;
    }

    #icon {
        width: 60%;
    }
</style>