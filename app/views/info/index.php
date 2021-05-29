<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/dteditableScript.php'; ?>


<!--Start Header of Table-->
<table id="progsGrid1"
       class="table table-hover table-bordered table-striped table-resource-list table-databases" width="100%"
       cellspacing="10px">
    <thead>
    <tr class="header-back-ground">
        <th class="header-label first-header-lbl">الاسم العربي</th>
        <th class="header-label">الاسم الانكليزي</th>
        <th class="header-label">التفاصيل</th>
        <th class="header-label">النوع</th>
        <th class="header-label"> فعال</th>
        <th class="header-label  last-header-lbl">اتخاذ اجراء</th>
    </tr>
    </thead>
    <!--End of Header-->
    <?php
    foreach ($data['Plants'] as $plant) :
        ?>
        <tr>
            <td><?php echo $plant->name ?> </td>
            <td><?php echo $plant->eName ?> </td>
            <td><?php echo $plant->det ?> </td>
            <td><?php echo $plant->type ?> </td>
            <td><?php echo $plant->isActive ?> </td>
            <td>
                <div style="margin-top: 5px">
                    <button id="delete-volu-<?php echo $plant->pId ?>" title="حذف السجل الحالي"> <span class="glyphicon glyphicon-trash"></span></button>
                </div>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
</table>

<?php require APPROOT . '/views/inc/footer.php'; ?>


<script>
    $(document).ready(function () {


        //var faculties = <?php //echo $data['faculties']; ?>//;
        //var subjects = <?php //echo $data['subjects']; ?>//;
        //var cities = <?php //echo $data['cities']; ?>//;
        //

        var emTable = $('#progsGrid1').DataTable({
            dom: '<"html5buttons"B>lTgitpr',
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
                // "loadingRecords": "جار التحميل ...",
                "processing": "جار المعالجة...",



                "zeroRecords": "لا توجد بيانات مطابقة للبحث",
                "paginate":
                    {
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
                    text: 'اضافة جديد',
                    action: function ( e, dt, node, config ) {
                        window.open(window.location.assign('<?php echo URLROOT . "/Info/add";?>'),"_blank");
                    }
                },
                {
                    extend: 'copy',
                    text: 'نسخ الى الحافظة',
                    className: 'exportExcel',
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'excel',
                    text: 'تصدير ملف اكسل',
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'csv',
                    text: 'تصدير ملف CVS',

                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied'
                        },
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ],

            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "الكل"]],
            pageLength: 5,
            fnInitComplete:
                function () {
                    // addSearchControl();
                }
        });


        //delete Row
        $(document).on('click', '[id^="delete-volu-"]', function () {
            var $button = $(this);
            var id = this.id.split('-').pop();

            Swal.fire({
                title: "حذف الصف المحدد",
                text: "هل انت متأكد من حذف الجدول المحدد؟",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "نعم",
                cancelButtonText: "لا",
                confirmButtonColor: "#ec6c62",
                cancelButtonColor: '#d33',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: "<?php echo URLROOT . "/info/edit";?>",
                        type: "POST",
                        data: {
                            'value': '1',
                            'name': 'isDeleted',
                            "pk": id
                        },
                        success: function () {
                        },


                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("خظأ: " + errorThrown);
                        }
                    })

                        .then(response => {
                            try {
                                response = $.parseJSON(response);
                                if (response == "err") {
                                    throw new Error("لم يتم الحذف, حدث خطأ ما")
                                }
                                return response
                            } catch (error) {
                                swal.close();
                                showAlert('error', ` ${error.message}`);
                            }
                        })
                },
                allowOutsideClick: () => !swal.isLoading()
            }).then((result) => {
                if (result.value) {
                    emTable.row($button.parents('tr')).remove().draw();
                    swal.close();
                    showAlert('success', 'تم الحذف بنجاح');
                }
            });

        });
        //End of delete Row

        //------------------------------------
        // function addSearchControl() {
        //     $("#progsGrid1 thead").append($("#progsGrid1 thead tr:first").clone());
        //     $("#progsGrid1 thead tr:eq(1) th").each(function (index) {
        //
        //
        //         if (index == 0) {
        //             var y = faculties.map(faculties => faculties.text);
        //             var selectDropDown = $("<select  class='form-control'/>");
        //             selectDropDown.append($("<option/>").attr("value", "").text('اختر'));
        //             for (let i = 0; i < y.length; i++) {
        //                 selectDropDown.append($("<option/>").attr("value", y[i]).text(y[i]));
        //             }
        //             $(this).replaceWith("<th>" + selectDropDown.prop("outerHTML") + "</th>");
        //             var dropControl = $("#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select");
        //             dropControl.on("change",
        //                 function () {
        //                     emTable.column(index).search(dropControl.val()).draw();
        //                 });
        //
        //         } else if (index == 1) {
        //             var y = sTypes.map(sTypes => sTypes.text);
        //             var selectDropDown = $("<select  class='form-control'/>");
        //             selectDropDown.append($("<option/>").attr("value", "").text('اختر'));
        //             for (let i = 0; i < y.length; i++) {
        //                 selectDropDown.append($("<option/>").attr("value", i + 1).text(y[i]));
        //             }
        //             $(this).replaceWith("<th>" + selectDropDown.prop("outerHTML") + "</th>");
        //             var dropControl = $("#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select");
        //             dropControl.on("change",
        //                 function () {
        //                     emTable.column(index).search(dropControl.val()).draw();
        //                 });
        //
        //         } else if (index == 2) {
        //
        //             var y = levels.map(levels => levels.text);
        //             var selectDropDown = $("<select  class='form-control'/>");
        //             selectDropDown.append($("<option/>").attr("value", "").text('اختر'));
        //             for (let i = 0; i < y.length; i++) {
        //                 selectDropDown.append($("<option/>").attr("value", i + 1).text(y[i]));
        //             }
        //             $(this).replaceWith("<th>" + selectDropDown.prop("outerHTML") + "</th>");
        //             var dropControl = $("#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select");
        //             dropControl.on("change",
        //                 function () {
        //                     emTable.column(index).search(dropControl.val()).draw();
        //                 });
        //         } else if (index == 3) {
        //             var y = subjects.map(subjects => subjects.text);
        //             var selectDropDown = $("<select  class='form-control'/>");
        //             selectDropDown.append($("<option/>").attr("value", "").text('اختر'));
        //             for (let i = 0; i < y.length; i++) {
        //                 selectDropDown.append($("<option/>").attr("value", y[i]).text(y[i]));
        //             }
        //             $(this).replaceWith("<th>" + selectDropDown.prop("outerHTML") + "</th>");
        //             var dropControl = $("#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select");
        //             dropControl.on("change",
        //                 function () {
        //                     emTable.column(index).search(dropControl.val()).draw();
        //                 });
        //         }
        //         // else if (index == 4) {
        //         //     var y = pTypes.map( pTypes => pTypes.text );
        //         //     var selectDropDown = $( "<select  class='form-control'/>" );
        //         //     selectDropDown.append( $( "<option/>" ).attr( "value", "" ).text( 'اختر' ) );
        //         //     for (let i = 0; i < y.length; i++) {
        //         //         selectDropDown.append( $( "<option/>" ).attr( "value",(i+1)).text( y[i] ) );
        //         //     }
        //         //     $( this ).replaceWith( "<th>" + selectDropDown.prop( "outerHTML" ) + "</th>" );
        //         //     var dropControl = $( "#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select" );
        //         //     dropControl.on( "change",
        //         //         function () {
        //         //             emTable.column( index ).search( dropControl.val() ).draw();
        //         //         } );
        //         // }
        //         if (index == 4) {
        //
        //             var y = cities.map(cities => cities.text);
        //             var selectDropDown = $("<select  class='form-control'/>");
        //             selectDropDown.append($("<option/>").attr("value", "").text('اختر'));
        //             for (let i = 0; i < y.length; i++) {
        //                 selectDropDown.append($("<option/>").attr("value", y[i]).text(y[i]));
        //             }
        //             $(this).replaceWith("<th>" + selectDropDown.prop("outerHTML") + "</th>");
        //             var dropControl = $("#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select");
        //             dropControl.on("change",
        //                 function () {
        //                     emTable.column(index).search(dropControl.val()).draw();
        //                 });
        //         } else if (index == 7 || index == 8) {
        //             $(this).replaceWith("<th><input type='text' class='form-control' placeholder='ابحث" +
        //                 "'></input></th>'");
        //             var searchControl = $("#progsGrid1 thead tr:eq(1) th:eq('" + index + "') input");
        //             searchControl.on("keyup",
        //                 function (e) {
        //                     if (e.key === 'Enter' || e.keyCode === 13) {
        //                         // Do something
        //                         emTable.column(index).search(searchControl.val()).draw();
        //                     }
        //                 });
        //         } else if (index == 5) {
        //             var y = days.map(days => days.text);
        //             var selectDropDown = $("<select  class='form-control'/>");
        //             selectDropDown.append($("<option/>").attr("value", "").text('اختر'));
        //             for (let i = 0; i < y.length; i++) {
        //                 selectDropDown.append($("<option/>").attr("value", i + 1).text(y[i]));
        //             }
        //             $(this).replaceWith("<th>" + selectDropDown.prop("outerHTML") + "</th>");
        //             var dropControl = $("#progsGrid1 thead tr:eq(1) th:eq('" + index + "') select");
        //             dropControl.on("change",
        //                 function () {
        //                     emTable.column(index).search(dropControl.val()).draw();
        //                 });
        //         } else {
        //             $(this).replaceWith("<th></th>");
        //         }
        //     });
        // }
    });
</script>

<style>
    a {
        color: #686868;
    }

    /* CSS link color */
</style>
