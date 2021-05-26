<?php require APPROOT . '/views/inc/header.php';
if (isset($_SESSION['addUser'])
    || isset($_SESSION['addUserPoint'])
    || isset($_SESSION['editUser'])
    || isset($_SESSION['deleteUser'])):
    ?>
    <script src="<?php echo URLROOT . "/public/js/bootstrap-editable.js"; ?>"></script>
    <script src="<?php echo URLROOT . "/public/js/main.js" ?>"></script>

    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/bootstrap-editable.css"; ?>"/>
    <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/myStyle.css"; ?>">

    <?php

    $db = new Database;
    $query = "SELECT *,users.uIsActive as 'uIsActive',users.uPhoneNo as 'uPhoneNo' FROM users
                  inner join points on users.uPoint = points.pId
                  where users.uIsDeleted = 0 and users.isAdmin=1";

    $db->query($query);
    $results = $db->resultset();
    $uniqueValues = [];
    foreach ($results as $item) {
        $uniqueValues[$item->pName] = 1;
    }
    $ids = array_keys($uniqueValues);
    $newArray = array();
    foreach ($results as $center) {
        $newArray[$center->pName][] = $center;
    }
    ?>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php $rowC = 1;
        foreach ($ids as $id) :
            $obj = $newArray[$id]; ?>
            <div class="panel panel-primary">
                <div class="panel-heading" role="tab" id="heading<?php echo $id ?>">
                    <h3 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapse<?php echo $rowC; ?>" aria-expanded="true"">
                        <span class="glyphicon-stack">
                    <i class="glyphicon glyphicon-circle glyphicon-stack-2x"></i>
                    <i class="glyphicon glyphicon-plus glyphicon-stack glyphicon-stack-1x"></i>
                     </span>
                        <?php echo $id ?>
                        </a>
                    </h3>
                </div>

                <div id="collapse<?php echo $rowC; ?>" class="panel-collapse collapse" role="tabpanel"
                     aria-labelledby="heading<?php echo $id; ?>">
                    <?php foreach ($obj
                                   as $ob):
                        $userId = $ob->userId;
                        ?>
                        <div id="usersGrid<?php echo $userId ?>" class="panel-body" style="direction: rtl">
                            <div class="row">
                                <div class="col-md-1 rigtSmall">

                                    <?php
                                    clearstatcache();
                                    $imageSource = URLROOT . "/public/images/statics/placeHolder.png";

                                    $upOne = realpath(dirname(__FILE__) . '/../../..');
                                    $target = $upOne . "/public/images/users/";

                                    if (file_exists($target . $ob->img) && $ob->uImgDeleted != 1) {
                                        $imageSource = URLROOT . "/public/images/users/" . $ob->img;
                                    }
                                    ?>

                                    <a target="_blank"
                                       href="<?php echo $imageSource ?>">
                                        <img id="img<?php echo $userId ?>" class="xy Zimg"
                                             src="<?php echo $imageSource ?>"
                                             height="90px" width="70px"
                                             alt="<?php echo $ob->name; ?>">
                                    </a>
                                    <div class="btnDiv">
                                        <?php if (isset($_SESSION['editUser'])) : ?>
                                            <button style="float: left" data-toggle="tooltip"
                                                    title="تغيير الصورة"
                                                    class="btn btn-outline-primary btn-sm btn-success"
                                                    onclick='replaceImage(<?php echo $userId ?>,
                                                            "<?php echo $ob->name; ?>",
                                                            "<?php echo URLROOT . "/users/replaceImage"; ?>",
                                                            "#img<?php echo $userId; ?>")'>
                                                <span class="glyphicon  glyphicon-paperclip"></span>
                                            </button>
                                        <?php endif; ?>

                                        <span></span>
                                        <?php if (isset($_SESSION['deleteUser'])) : ?>
                                            <button style="float: right" data-toggle="tooltip" title="حذف الصورة"
                                                    class="btn btn-outline-primary btn-sm btn-danger"
                                                    onclick='deleteU("<?php echo $userId; ?>",
                                                            "uImgDeleted",
                                                            "<?php echo URLROOT . "/users/edit"; ?>",
                                                            "#img<?php echo $userId ?>" )'>
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        <?php endif; ?>
                                    </div>

                                </div>
                                <div class="col-md-5 rigtSmall">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>الاسم الكامل:</strong>
                                            <a id="name<?php echo $userId ?>" data-name='name' class='name'
                                               data-type='text'
                                               data-pk=<?php echo $userId ?>><?php echo $ob->name; ?></a>
                                        </div>
                                    </div>
                                    <?php if (isset($_SESSION['editUser'])) : ?>
                                        <script>
                                            make_editable( "#name<?php echo $userId ?>", "<?php echo URLROOT . "/users/edit";?>", "ادخل الاسم الكامل" );
                                        </script>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>الاسم المستخدم:</strong>
                                            <a id="userName<?php echo $userId ?>" data-name='userName' class='userName'
                                               data-type='text'
                                               data-pk=<?php echo $userId ?>> <?php echo $ob->userName ?></a>
                                        </div>
                                    </div>
                                    <?php if (isset($_SESSION['editUser'])) : ?>
                                        <script>
                                            make_editable( "#userName<?php echo $userId ?>", "<?php echo URLROOT . "/users/edit";?>", "ادخل اسم المستخدم" );
                                        </script>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>رقم الهاتف :</strong>
                                            <a id="phoneNo<?php echo $userId ?>" data-name='phoneNo' class='phoneNo'
                                               data-type='text'
                                               data-pk=<?php echo $userId ?>> <?php echo $ob->uPhoneNo ?></a>
                                        </div>
                                    </div>
                                    <?php if (isset($_SESSION['editUser'])) : ?>
                                        <script>
                                            make_editable( "#phoneNo<?php echo $userId ?>", "<?php echo URLROOT . "/users/edit";?>", "ادخل رقم الهاتف" );
                                        </script>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4 rigtSmall">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong>المركز :</strong>
                                            <a id="uPoint<?php echo $userId ?>" data-name='uPoint' class='uPoint'
                                               data-type='select'
                                               data-pk=<?php echo $userId ?>>  <?php echo $ob->pName ?></a>
                                        </div>
                                    </div>
                                    <?php if (isset($_SESSION['editUser'])) : ?>
                                        <script>
                                            var points = <?php echo $data['points']; ?>;
                                            selectFromSource( "#uPoint<?php echo $userId ?>", "<?php echo URLROOT . "/users/edit";?>", points, "اختر المركز" );
                                        </script>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <strong> الحالة :</strong>
                                            <a id="uIsActive<?php echo $userId;
                                            $y = ["0" => "غير فعال", "1" => "فعال"] ?>" data-name='uIsActive'
                                               class='uIsActive' data-type='select'
                                               data-pk=<?php echo $userId ?>>  <?php echo $y[$ob->uIsActive] ?></a>
                                        </div>
                                    </div>
                                    <?php if (isset($_SESSION['editUser'])) : ?>
                                        <script>
                                            selectFromSource( "#uIsActive<?php echo $userId ?>", "<?php echo URLROOT . "/users/edit";?>", activeOrNot, "هل المستخدم فعال اولا؟" );
                                        </script>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <?php if (isset($_SESSION['deleteUser'])) : ?>
                                            <div class="col-md-4">
                                                <button id="delete-user-<?php echo $userId ?>" data-toggle="tooltip"
                                                        title="حذف السجل الحالي"
                                                        onclick='deleteU("<?php echo $userId ?>",
                                                                "uIsDeleted",
                                                                "<?php echo URLROOT . "/users/edit"; ?>",
                                                                "#usersGrid<?php echo $userId ?>",
                                                                "",
                                                                "حذف مستخدم",
                                                                "هل انت متأكد من حذف المستخدم المحدد",
                                                                )'
                                                        class="btn btn-outline-primary btn-sm btn-danger Ubutton">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                    حذف
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION['editUser'])) : ?>
                                            <div class="col-md-4">
                                                <button class="btn btn-outline-primary btn-sm btn-warning Ubutton"
                                                        onclick='changeCredintals("<?php echo $userId ?>","<?php echo $ob->name ?>","<?php echo $ob->userName ?>","<?php echo URLROOT . "/users/changePassword"; ?>")'>
                                                    <i class="fas fa-user"></i>
                                                    تغير كلمة المرور
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION['editUser'])) : ?>
                                        <div class="col-md-4">
                                            <button class="btn  btn-sm btn-info Ubutton"
                                                    onclick='determinePermission("<?php echo $userId ?>","<?php echo $ob->name ?>","<?php echo URLROOT . "/users/changePermission"; ?>")'>
                                                <span class="glyphicon   glyphicon-info-sign"></span>
                                                تحديد الصلاحيات
                                            </button>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php $rowC = $rowC + 1;
        endforeach; ?>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>

    <script>
        $( "#accordion" ).on( "hide.bs.collapse show.bs.collapse", e => {
            $( e.target )
                .prev()
                .find( "i:last-child" )
                .toggleClass( "glyphicon-minus glyphicon-plus" );
        } );
    </script>


    <style>
        .glyphicon-stack {
            position: relative;
            display: inline-block;
            width: 2em;
            height: 2em;
            line-height: 2em;
            vertical-align: middle;
        }

        .glyphicon-circle {
            position: relative;
            border-radius: 50%;
            width: 100%;
            height: auto;
            padding-top: 100%;
            background: black;
        }

        .glyphicon-stack-1x {
            line-height: inherit;
        }

        .glyphicon-stack-1x, .glyphicon-stack-2x {
            position: absolute;
            left: 0;
            width: 100%;
            text-align: center;
        }
    </style>

    <style>
        .Ubutton {
            width: 100%;
        }

        .col-md-12 {
            margin: 5px;
            /*width: 100%;*/
        }

        .rigtSmall {
            float: right;
        }

        a {
            text-decoration: none;
        }

        }
        @media screen and (max-width: 990px) {
            .rigtSmall {
                float: none !important;
            }
    </style>
<?php endif; ?>
