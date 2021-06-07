 var titles = [{value: "زينة", text: 'زينة'},
    {value: "طبي", text: 'طبي'},
];

 var certs = [{value: "دكتوراه", text: 'دكتوراه'},
    {value: "ماجستير", text: 'ماجستير'},
    {value: "دبلوم عالي", text: 'دبلوم عالي'},
    {value: "بكالوريوس", text: 'بكالوريوس'},
    {value: "دبلوم", text: 'دبلوم'}
];

 var colg = [{value: 1, text: 'طب الاسنان'},
    {value: 2, text: 'صيدلة'},
    {value: 3, text: 'تقنيات التحليلات المرضية'},
    {value: 4, text: 'الهندسة التقنية'},
    {value: 5, text: 'قانون'},
    {value: 6, text: 'الاعلام'},
    {value: 7, text: 'الشريعة'},
    {value: 8, text: 'السياحة الدينية'}
];

 var isActive = [{value: 1, text: 'نعم'},
     {value: 2, text: 'لا'},
 ];


 function changeCredintals(id, name,userName, ajaxUrl) {

    Swal.fire({
        title: "<b> تغيير كلمة المرور</b>",
        html: "هل تود تغير كلمة المرور لـ  <b>" + name + "؟ </b>" +
            "<style>.bInput{border: 1px solid #ddd; border-radius: 5px; padding: 5px;margin: 5px}</style>" +
            "<input class='bInput' type='password' id='newPassword' placeholder='يرجى ادخال كلمة المرور الجديد' >" +
            "<input class='bInput' type='password' id='newPasswordConfiorm' placeholder='يرجى ادخال تأكيد كلمة المرور الجديدة' " +
            ">",
        // type: "info",
        showCancelButton: true,
        confirmButtonText: "<u>حفظ</u>",
        cancelButtonText: "الغاء",
        showLoaderOnConfirm: true,
        confirmButtonColor: "#ec6c62",
        cancelButtonColor: '#d33',
        preConfirm: () => {
            return $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: {
                    'userName':userName,
                    'newPassword': document.getElementById('newPassword').value,
                    'newPasswordConfiorm': document.getElementById('newPasswordConfiorm').value,
                    "lId": id
                },
                success: function (response) {
                    //   alert(response);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("خطأ: " + errorThrown);
                }
            })

                .then(response =>
                {
                    try {
                        response = $.parseJSON(response);
                        if (response == "40") {
                            throw new Error("يرجى ملء جميع الحقول")
                        } else if (response == "41") {
                            throw new Error("كلمة المرور وتأكيدها غير متطابقين")
                        }
                        return response
                    } catch (error)
                    {
                        swal.close();
                        showAlert('error',` ${error.message}`);
                    }
                })
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            swal.close();
            showAlert('success','تم التعديل بنجاح');
        }
    });

}

function determinePermission(id, name, ajaxUrl) {

    Swal.fire({
        title: "<b> تعديل الصلاحيات </b>",
        html: "هل تود تعديل الصلاحيات لـ  <b>" + name + "؟ </b>" +
            "<style>.bInput{border: 1px solid #ddd; border-radius: 5px; padding: 5px;margin: 5px}</style>" +
            "<div class='panel panel-default'> <div class='panel-heading'> التعامل مع المستخدمين " +
            "</div><div class='panel-body'> " +
            "<label><input type='checkbox' name='addUser' value='0' id='addUser'> اضافة مستخدم</label>" +
            "<label><input  type='checkbox' name='editUser' value='0' id='editUser' > تعديل مستخدم</label>" +
            "<label><input type='checkbox' name='deletetUser' value='0' id='deleteUser' > حذف مستخدم</label>" +
            "</div></div>" +
            "<div class='panel panel-default'> <div class='panel-heading'> التعامل مع المراكز  " +
            "</div><div class='panel-body'> " +
            "<label><input  type='checkbox' name='addCenter' value='0' id='addCenter' > اضافة مركز</label>" +
            "<label><input  type='checkbox' name='editCenter' value='0' id='editCenter' > تعديل مركز</label>" +
            "<label><input  type='checkbox' name='deleteCenter' value='0' id='deleteCenter' > حذف مركز</label>" +
            "</div></div>" +
            "<div class='panel panel-default'> <div class='panel-heading'> التعامل مع التائهين" +
            "</div><div class='panel-body'> " +
            "<label><input  type='checkbox' name='addLost' value='0' id='addLost' > اضافة تائه</label>" +
            "<label><input  type='checkbox' name='editLost' value='0' id='editLost' > تعديل تائه</label>" +
            "<label><input  type='checkbox' name='deleteLost' value='0' id='deleteLost' > حذف تائه</label>" +
            "</div></div>",

        showCancelButton: true,
        confirmButtonText: "<u>حفظ</u>",
        cancelButtonText: "الغاء",
        showLoaderOnConfirm: true,
        confirmButtonColor: "#ec6c62",
        cancelButtonColor: '#d33',
        preConfirm: () => {
            return $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: {
                    'addUser': $('#addUser').is(':checked') ? "1" : "0",
                    'editUser': $('#editUser').is(':checked') ? "1" : "0",
                    'deleteUser': $('#deleteUser').is(':checked') ? "1" : "0",
                    'addCenter': $('#addCenter').is(':checked') ? "1" : "0",
                    'editCenter': $('#editCenter').is(':checked') ? "1" : "0",
                    'deleteCenter': $('#deleteCenter').is(':checked') ? "1" : "0",
                    'addLost': $('#addLost').is(':checked') ? "1" : "0",
                    'editLost': $('#editLost').is(':checked') ? "1" : "0",
                    'deleteLost': $('#deleteLost').is(':checked') ? "1" : "0",
                    'lId': id
                },

                success: function (response) {

                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    swal.close();
                    showAlert('error',"خطأ: " + errorThrown)
                }
            })

                .then(response =>
                {
                    try {
                        var json = $.parseJSON(response);

                        if (json == "40") {
                            alert("40 called");
                            throw new Error("يرجى ملء جميع الحقول");
                        } else if (json == "err") {
                            throw new Error( 'يرجى التاكد من البيانات المدخلة');
                        } else {
                            throw new Error('  تم التعديل بنجاح');
                        }

                        return response
                    } catch (error)
                    {
                        swal.close();
                        showAlert('error',` ${error.message}`);
                    }
                })
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            swal.close();
            showAlert('success','تم التعديل بنجاح');
        }
    });

}

function replaceImage(id, name, ajaxUrl,imgId) {

    Swal.fire({
        title: "<b>تغيير الصورة </b>",
        html: "هل تود رفع صورة جديدة لـ  <b>" + name + "؟ </b>" +
            "<style>.bInput{border: 1px solid #ddd; border-radius: 5px; padding: 5px;margin: 5px}</style>" +
            "<div class='panel panel-default'> <div class='panel-heading'> قم باختيار الصورة " +
            "</div><div class='panel-body'>" +
            " <form enctype='multipart/form-data' name='addProgForm' method='post' id='imageUploadForm'>" +
            " <input  id='img' type='file'  accept='image/*' name='img'  " +
            ">" +
            "</form>" +
            "</div></div>",

        showCancelButton: true,
        confirmButtonText: "<u>رفع</u>",
        cancelButtonText: "الغاء",
        showLoaderOnConfirm: true,
        confirmButtonColor: "#ec6c62",
        cancelButtonColor: '#d33',
        preConfirm: () => {


            //getting form into Jquery Wrapper Instance to enable JQuery Functions on form

            var files = $("#img")[0].files;
            //Declaring new Form Data Instance
            var formData = new FormData();
            //Looping through uploaded files collection in case there is a Multi File Upload. This also works for single i.e simply remove MULTIPLE attribute from file control in HTML.
            for (var i = 0; i < files.length; i++) {
                formData.append("img", files[i]);
            }
            formData.append("id", id);
            var btn = $(this);
            btn.val("جار التحميل...");
            btn.prop("disabled", true);
            $.ajax({
                url: ajaxUrl,
                method: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    //Firing event if File Upload is completed!
                    btn.prop("disabled", false);
                    btn.val("حفظ");
                    $("#img").val("");
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    swal.close();
                    showAlert('error',"خطأ: " + errorThrown)
                }
            })
                .then(response =>
                {
                    try {
                        response = $.parseJSON(response);
                        if (response == "err") {
                            throw new Error("لم يتم الحذف, حصل خطأ ما")
                        }
                        if (response == "50") {
                            throw new Error('يرجى اختيار ملف من نوع صورة');
                        }

                        return response
                    } catch (error)
                    {
                        swal.close();
                        showAlert('error',` ${error.message}`)
                    }
                });

        },

        allowOutsideClick: () => !swal.isLoading()
    })
        .then( (result) => {
            if (result.value) {
                swal.close();
                showAlert('success','تم تغير الصورة بنجاح');
                readURL('#img',imgId)
            }
        });

}

function readURL(input,imgId) {
    if ($(input).prop('files')[0] && $(input).prop('files')[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(imgId)
                .attr('src', e.target.result);
        };
        reader.readAsDataURL( $(input).prop('files')[0]);
    }
}

function deleteU(id, parameter, ajaxUrl,imgId,divId, msgtitle="حذف الصورة",prompt="هل انت متأكد من حذف الصورة المحددة؟") {

    Swal.fire({
        title:msgtitle,
        text:prompt,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        confirmButtonColor: "#ec6c62",
        cancelButtonColor: '#d33',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: {
                    'value': '1',
                    'name': parameter,
                    "pk": id
                },
                success: function (response) {
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    swal.close();
                    showAlert('error',"خطأ: " + errorThrown)
                }
            }).then(response =>
            {
                try {
                    response = $.parseJSON(response);
                    if (response == "err") {
                        throw new Error("لم يتم الحذف, حصل خطأ ما")
                    }
                    return response
                } catch (error)
                {
                    swal.close();
                    showAlert('error',` ${error.message}`)
                }
            })

        },
        allowOutsideClick: () => !swal.isLoading()
    })
        .then( (result) => {
            if (result.value) {
                $(imgId).attr("src", "../images/statics/noimageicon.png");
                swal.close();
                showAlert('success','  تم الحذف بنجاح  ')

                $(divId).attr('style', 'display:none')  //
            }
        } );
}

function showAlert(type,title) {
    const Toast = Swal.mixin( {
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 3000
    } );
    setTimeout( () => {
        Toast.fire( {
            type: type,
            title:title
        } )
    }, 1500 );
}

function populateSelectFromDs(c_selector, dataSource) {
    let select = document.getElementById(c_selector);
    for (let i = 0; i < dataSource.length; i++) {
        var opt = dataSource[i]['text'];
        let el = document.createElement("option");
        el.textContent = opt;
        el.value = dataSource[i]['value'];
        select.appendChild(el);
    }
}

function setValidationMSG(c_selector, message) {
    // var element = $("#city")[0];
    // element.setCustomValidity('The email address entered is already registerd.');

    $(c_selector)[0].setCustomValidity(message);
    $(c_selector)[0].validity.customError;
}

function selectFromSourceTB(table_selector, column_selector, ajax_url, listSource, title) {

    $(table_selector).editable({
        source: listSource,
        selector: column_selector,
        url: ajax_url,
        ajaxOptions: {
            type: 'post'
        },
        title: title,
        type: "POST",
        dataType: 'json'
    });
    $.fn.editable.defaults.mode = 'inline';
}

function make_editable_col(table_selector, column_selector, ajax_url, title) {
    $(table_selector).editable({
        selector: column_selector,
        placement: 'top',
        url: ajax_url,
        ajaxOptions: {
            type: 'post'
        },
        success: function (response, value) {

            var json = $.parseJSON(response);

            if (json == "err") {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 1500
                });

                Toast.fire({
                    type: 'error',
                    title: 'يرجى التاكد من البيانات المدخلة'
                })
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 1500
                });
                Toast.fire({
                    type: 'success',
                    title: '  تم التعديل بنجاح'
                })
            }

        },
        title: title,
        tpl: "<input type='text' style='width: 150px'>",
        type: "POST",
        dataType: 'json'

    });
    $.fn.editable.defaults.mode = 'popup';
}
//Make Editable
function make_editable(column_selector, ajax_url, title) {

    $(column_selector).editable({

        placement: 'top',
        url: ajax_url,
        ajaxOptions: {
            type: 'post'
        },
        success: function (response, value) {

            var json = $.parseJSON(response);
            if (json == "err") {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 1500
                });

                Toast.fire({
                    type: 'error',
                    title: 'يرجى التاكد من البيانات المدخلة'
                })
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'center',
                    showConfirmButton: false,
                    timer: 1500
                });
                Toast.fire({
                    type: 'success',
                    title: '  تم التعديل بنجاح'
                })
            }

        },
        title: title,
        tpl: "<input type='text' style='width: 150px'>",
        type: "POST",
        dataType: 'json'

    });
    $.fn.editable.defaults.mode = 'inline';
}

function selectFromSource(column_selector, ajax_url, listSource, title) {

    $(column_selector).editable({
        source: listSource,
        url: ajax_url,
        ajaxOptions: {
            type: 'post'
        },
        title: title,
        type: "POST",
        dataType: 'json'
    });
    $.fn.editable.defaults.mode = 'inline';
}
