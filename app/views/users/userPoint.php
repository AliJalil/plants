<?php require APPROOT . '/views/inc/header.php';
if (isset($_SESSION['addUserPoint'])
    || isset($_SESSION['editUserPoint'])
    || isset($_SESSION['deleteUserPoint'])):?>
    <?php require APPROOT . '/views/inc/dteditableScript.php'; ?>

    <div class="table-responsive table table-condensed table-hover table-striped">

        <!--Start Header of Table-->
        <table id="progsGrid1"
               class="table table-hover table-bordered table-striped table-resource-list table-databases" width="100%"
               cellspacing="10px">
            <thead>
            <tr class="header-back-ground">
                <th class="header-label first-header-lbl"> الاسم الكامل</th>
                <th class="header-label">الصورة</th>
                <th class="header-label">الاسم المستخدم</th>
                <th class="header-label">رقم الهاتف</th>
                <th class="header-label">الحالة</th>
                <th class="header-label last-header-lbl">اتخاذ اجراء</th>
            </tr>
            </thead>
            <!--End of Header-->


            <tbody id="progsGrid">
            <?php
            $stateValue = ["0" => "غير فعال", "1" => "فعال"];
            foreach ($data['users'] as $user) :
                $userId = $user->userId; ?>
                <tr>

                    <td><a id="name" data-name='name' class='name' data-type='text'
                           data-pk=<?php echo $userId ?>> <?php echo $user->name; ?> </a></td>


                    <td> <?php
                        clearstatcache();
                        $imageSource = URLROOT . "/public/images/statics/noimageicon.png";

                        $upOne = realpath(dirname(__FILE__) . '/../../..');
                        $target = $upOne . "/public/images/users/";
                        if (file_exists($target . $user->img) && $user->uImgDeleted != 1) {
                            $imageSource = URLROOT . "/public/images/users/" . $user->img;
                        }
                        ?>

                        <div>
                            <a target="_blank"
                               href="<?php echo $imageSource ?>">
                                <img id="img<?php echo $userId ?>" class="xy Zimg" src="<?php echo $imageSource ?>">
                            </a>

                        <?php if (isset($_SESSION['editUserPoint'])) : ?>
                            <br>
                            <div class="btnDiv">
                                <!--suppress CssInvalidPropertyValue -->
                                <button  style="float: left" data-toggle="tooltip"
                                        title="تغيير الصورة"
                                        class="btn btn-outline-primary btn-sm btn-success"
                                        onclick='replaceImage(<?php echo $userId ?>,
                                                "<?php echo $user->name ?>",
                                                "<?php echo URLROOT . "/users/replaceImage"; ?>",
                                                "#img<?php echo $userId ?>")'>
                                    <span class="glyphicon  glyphicon-paperclip"></span>
                                </button>

                                <span></span>
                                <?php if (isset($_SESSION['editUserPoint']) && (isset($user->img) && !empty($user->img))) : ?>
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
                        <?php endif; ?>
                    </td>

                    <td><a data-name='userName' class='userName' data-type='text'
                           data-pk=<?php echo $userId ?>> <?php echo $user->userName; ?> </a></td>

                    <td><a id="uPhoneNo" data-name='uPhoneNo' class='uPhoneNo' data-type='text'
                           data-pk=<?php echo $userId ?>> <?php echo $user->uPhoneNo ?> </a></td>

                    <td><a id="uIsActive" data-name='uIsActive' class='uIsActive' data-type='select'
                           data-pk=<?php echo $userId ?>> <?php echo $stateValue[$user->uIsActive] ?> </a></td>
                    <td>
                        <div style="margin-top: 5px">
                            <button id="deleteUser-<?php echo $userId ?>" data-toggle="tooltip" title="حذف السجل الحالي"
                                    class="btn btn-outline-primary btn-sm btn-danger">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>

                            <button class="btn btn-outline-primary btn-sm btn-warning Ubutton"  data-toggle="tooltip" title="تغيير كلمة المرور"
                                    onclick='changeCredintals("<?php echo $userId ?>","<?php echo $user->name ?>","<?php echo $user->userName ?>","<?php echo URLROOT . "/users/changePassword"; ?>")'>
                                <span class="glyphicon glyphicon-eye-close"></span>
                            </button>
                        </div>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>

    <script type="text/javascript">
        $( document ).ready( function () {
            <?php if (isset($_SESSION['editUserPoint'])) :?>
            make_editable_col( "#progsGrid", "a.name", "<?php echo URLROOT . "/Users/edit";?>", "ادخل الاسم الكامل" );
            make_editable_col( "#progsGrid", "a.userName", "<?php echo URLROOT . "/Users/edit";?>", "ادخل الاسم المستخدم" );
            make_editable_col( "#progsGrid", "a.uPhoneNo", "<?php echo URLROOT . "/Users/edit";?>", "ادخل رقم الهاتف" );
            <?php endif; ?>
        } );
    </script>


    <script>
        $( document ).ready( function () {
            <?php if (isset($_SESSION['editUserPoint'])) :?>
            selectFromSourceTB( "#progsGrid", "a.uIsActive", "<?php echo URLROOT . "/Users/edit";?>", activeOrNot, "ما هي حالة المستخدم" );
            <?php endif; ?>

            var emTable = $( '#progsGrid1' ).DataTable( {

                // dom: "<'top'l>rt<'bottom'p><'clear'>",
                dom: '<"html5buttons"B>lTfgitp',

                //---------------------------------------------
                //*********************************************
                //---------------------------------------------
                language: {
                    search: "_INPUT_", //To remove Search Label
                    searchPlaceholder: "ابحث هنا...",
                    "infoFiltered": "(  المجموع الكلي للسجلات المدخلة _MAX_ )",
                    "lengthMenu": "عرض _MENU_ سجل",
                    "decimal": "",
                    "emptyTable": "لا توجد بيانات لعرضها",
                    "info": "عرض من _START_ الى _END_ من مجموع _TOTAL_ سجل",
                    "infoEmpty": "عرض 0 من 0 مدخل",
                    "infoPostFix": "",
                    "thousands": "",
                    "loadingRecords": "جار التحميل ...",
                    "processing": "جار المعالجة...",
                    "zeroRecords": "لا توجد بيانات مطابقة للبحث",
                    "paginate": {
                        "first": "الاولى",
                        "last": "الاخيرة",
                        "next": "التالية",
                        "previous": "السابقة"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                buttons: [
                    {
                        extend: 'copy',
                        text: 'نسخ الى الحافظة',
                        className: 'exportExcel',
                        exportOptions: {modifier: {page: 'current'}}

                    },
                    {
                        extend: 'excel',
                        text: 'تصدير ملف اكسل',
                        className: 'exportExcel',
                        exportOptions:
                            {
                                modifier: {
                                    page: 'current'
                                },
                                columns: [0, 1, 2]
                            },
                        title: 'النقاط'
                    },
                    {
                        extend: 'csv',
                        text: 'تصدير ملف CVS',
                        className: 'exportExcel',
                        exportOptions:
                            {
                                modifier: {
                                    page: 'current'
                                },
                                columns: [0, 1, 2]

                            },
                        title: 'النقاط'
                    },
                    {
                        extend: 'print',
                        text: 'طباعة',
                        className: 'exportExcel',
                        // filename: 'Agenda_Print',
                        exportOptions:
                            {
                                modifier: {
                                    page: 'current'
                                },
                                columns: [0, 1, 2]

                            },
                        title: 'النقاط'

                    },

                ],

                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,
                        "width": "15%",
                        "type": "string"
                    },
                    {
                        "targets": [1],
                        "visible": true,
                        "searchable": true,
                        "width": "15%",
                        "type": "string"
                    },
                    {
                        "targets": [2],
                        "visible": true,
                        "searchable": true,
                        "width": "15%",
                        "type": "string"
                    },
                    {
                        "targets": [3],
                        "visible": true,
                        "searchable": true,
                        "orderable": true,
                        "width": "15%",
                        "type": "string"
                    },
                    {
                        "targets": [4],
                        "visible": true,
                        "searchable": true,
                        "orderable": true,
                        "width": "8%",
                        "type": "string"
                    }, {
                        "targets": [5],
                        "visible": true,
                        "searchable": false,
                        "orderable": false,
                        "width": "8%",
                        "type": "string"
                    },
                ],
                fnInitComplete: function () {
                    addSearchControl();
                }
            } );


            //delete Row
            $( document ).on( 'click', '[id^="deleteUser-"]', function () {
                var $button = $( this );
                var id = this.id.split( '-' ).pop();

                Swal.fire( {
                    title: "حذف مستخدم",
                    text: "هل انت متأكد من حذف المستخدم المحدد؟",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "نعم",
                    cancelButtonText: "لا",
                    confirmButtonColor: "#ec6c62",
                    cancelButtonColor: '#d33',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax( {
                            url: "<?php echo URLROOT . "/Users/edit";?>",
                            type: "POST",
                            data: {
                                'value': '1',
                                'name': 'uIsDeleted',
                                "pk": id
                            },
                            success: function () {
                                emTable.row( $button.parents( 'tr' ) ).remove().draw();
                            },

                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                alert( "Status: " + textStatus );
                                alert( "خظأ: " + errorThrown );
                            }
                        } )
                            .then( response => {
                                try {
                                    response = $.parseJSON( response );
                                    if (response == "err") {
                                        throw new Error( "لم يتم الحذف, حدث خطأ ما" )
                                    }
                                    return response
                                } catch (error) {
                                    swal.close();
                                    showAlert( 'error', ` ${error.message}` );
                                }
                            } )
                    },
                    allowOutsideClick: () => !swal.isLoading()
                } ).then( (result) => {
                    if (result.value) {
                        swal.close();
                        showAlert( 'success', 'تم الحذف بنجاح' );
                    }
                } );
            } );
            //End of delete Row

            //------------------------------------
            function addSearchControl() {
                $( "#progsGrid1 thead" ).append( $( "#progsGrid1 thead tr:first" ).clone() );
                $( "#progsGrid1 thead tr:eq(1) th" ).each( function (index) {
                    if (index == 0 || index == 2|| index == 3) {
                        $( this ).replaceWith( "<th><input type='text' class='form-control' placeholder='ابحث" +
                            "'></input></th>'" );
                        var searchControl = $( "#progsGrid1 thead tr:eq(1) th:eq('" + index + "') input" );
                        searchControl.on( "keyup",
                            function () {
                                emTable.column( index ).search( searchControl.val() ).draw();
                            } );
                    } else if (index == 4) {
                        const y = activeOrNot.map( activeOrNot => activeOrNot.text );
                        const selectDropDown = $( "<select  class='form-control'/>" );
                        selectDropDown.append( $( "<option/>" ).attr( "value", "" ).text( 'اختر' ) );
                        for (let i = 0; i < y.length; i++) {
                            selectDropDown.append( $( "<option/>" ).attr( "value", y[i] ).text( y[i] ) );
                        }
                        $( this ).replaceWith( "<th>" + selectDropDown.prop( "outerHTML" ) + "</th>" );
                        const dropControl = $( "#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select" );
                        dropControl.on( "change",
                            function () {
                                emTable.column( index ).search( dropControl.val() ).draw();
                            } );

                    } else {
                        $( this ).replaceWith( "<th></th>" );
                    }
                } );
            }

        } );
    </script>
<?php endif; ?>
