<?php require APPROOT . '/views/inc/header.php';
if (isset($_SESSION['addUser'])):?>

    <link href=<?php echo URLROOT . "/public/css/addPageStyle.css" ?> rel="stylesheet">

    <div class="panel panel-primary">
        <div class="panel-heading">
            معلومات المستخدم الجديد
        </div>
        <div class="panel-body">

            <form enctype="multipart/form-data" name="addUserForm" method="post" id="addUserForm">
                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label" for="isActive">الحالة </label>
                                    <input class="control-label" type="radio" name="isActive" value="1" required> فعال
                                    <input class="control-label" type="radio" name="isActive" value="0"> غير فعال

                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">الاسم الكامل </label>

                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="name1"
                                           oninput="this.setCustomValidity('')" required
                                           placeholder="الاسم الاول" value=""/>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="name2"
                                           oninput="this.setCustomValidity('')"
                                           placeholder="اسم الاب " value=""/>

                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="name3"
                                           oninput="this.setCustomValidity('')"
                                           placeholder="اسم الجد" value=""/>
                                </div>
                            </div>
                            <br class="break_line">
                            <br class="break_line">


                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="name4"
                                           oninput="this.setCustomValidity('')"
                                           placeholder="اسم والد الجد " value=""/>
                                </div>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="name5"
                                           oninput="this.setCustomValidity('')"
                                           placeholder="اللقب " value=""/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="password">كلمة المرور </label><br>
                            <input type="password" class="form-control password" name="password"
                                   id="password"
                                   autocomplete="password"
                                   required oninput="this.setCustomValidity('')" placeholder=" كلمة المرور" value=""/>
                            <small id="password_err" class="form-text text-muted text-danger"></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="confirm_password"> تأكيد كلمة المرور</label><br>
                            <input type="password" class="form-control confirm_password" name="confirm_password"
                                   id="confirm_password"
                                   autocomplete="password"
                                   required oninput="this.setCustomValidity('')" placeholder="تأكيد كلمة المرور"
                                   value=""/>
                            <small id="confirm_password_err" class="form-text text-muted text-danger"></small>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="userName">الاسم المستخدم </label><br>
                            <input class="form-control userName" name="userName"
                                   id="userName"
                                   required oninput="this.setCustomValidity('')" placeholder="الاسم المستخدم" value=""/>
                            <small id="userName_err" class="form-text text-muted text-danger"></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="uPoint">المركز</label><br>
                            <select name="uPoint" class="form-control" id="uPoint" oninput="this.setCustomValidity('')"
                                    required>
                                <option value="">اختر المركز</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="phoneNo">رقم الهاتف</label><br>
                            <input id="phoneNo" class="form-control phoneNo"
                                   name="phoneNo"
                                   type="text" maxlength="15" minlength="11"
                                   oninput="this.setCustomValidity('')"
                                   placeholder="رقم الهاتف" value=""/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="img">الصورة </label><br>
                            <input type="hidden" value="350000">
                            <input class="form-control" type="file" accept="image/*" name="img" id="img">
                        </div>
                    </div>
                </div>

                <div id="permissionDiv" class="panel panel-warning">
                    <div class="panel-heading">
                        <label>
                            <input type="checkbox" id="checkAll">الصلاحيات الممنوحة للمستخدم
                        </label>
                    </div>

                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>
                                            <input id="addCar" name="addCar" type="checkbox" checked value="1"> اضافة
                                            الية
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="editCar" name="editCar" type="checkbox" checked value="1"> تعديل
                                            الية
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="deleteCar" name="deleteCar" type="checkbox" checked value="1">
                                            حذف
                                            الية
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>
                                            <input id="addReport" name="addReport" type="checkbox" checked value="1">
                                            عرض المواقف
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="editReport" name="editReport" type="checkbox" checked value="1">
                                            تعديل
                                            الموقف
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="deleteReport" name="deleteReport" type="checkbox" checked
                                                   value="1"> حذف
                                            الموقف
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>
                                            <input type="checkbox" name="addUser" value="0" id="addUser">اضافة مستخدم
                                            مدير
                                        </label>
                                    </div>

                                    <div class="col-md-4">
                                        <label>
                                            <input id="editUser" name="editUser" type="checkbox" value="0"> تعديل مستخدم مدير
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="deleteUser" name="deleteUser" type="checkbox" value="0">حذف
                                            مستخدم مدير
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>
                                            <input type="checkbox" name="addUserPoint" value="0" id="addUserPoint">
                                            اضافة مستخدم نقطة
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="editPoint" name="editUserPoint" type="checkbox" value="0"> تعديل مستخدم نقطة
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="deletePoint" name="deleteUserPoint" type="checkbox" value="0"> حذف
                                            مستخدم نقطة
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>
                                            <input id="addPoint" name="addPoint" type="checkbox" value="0"> اضافة نقطة
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="editPoint" name="editPoint" type="checkbox" value="0"> تعديل نقطة
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <label>
                                            <input id="deletePoint" name="deletePoint" type="checkbox" value="0"> حذف
                                            نقطه
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <input id="submit" type="submit" class="btn btn-primary" style="width: 100%;" value="حفظ">

            </form>
        </div>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>

    <script src=<?php echo URLROOT . "/public/js/main.js" ?>></script>

    <script>

        $( "#checkAll" ).click( function () {
            $( 'input:checkbox' ).not( this ).prop( 'checked', this.checked );
        } );

        let points = <?php  echo $data['points']; ?>;

        populateSelectFromDs( "uPoint", points );

        $( document ).ready( function () {

            $( '#password' ).blur( function () {
                if ($( '#password' ).val().length < 8) {
                    $( '#password_err' ).html( "يجب ان لا تقل كلمة المرور عن ٨ احرف" );
                    $( '#submit' ).attr( "disabled", true );
                } else {
                    $( '#submit' ).attr( "disabled", false );
                    $( '#password_err' ).html( "" );
                }
            } );

            $( '#confirm_password' ).blur( function () {
                var _txt1 = $( '#password' ).val();
                var _txt2 = $( '#confirm_password' ).val();

                if (_txt1 == _txt2) {
                    $( '#confirm_password_err' ).html( "" );
                    $( '#submit' ).attr( "disabled", false );

                } else {
                    $( '#submit' ).attr( "disabled", true );
                    $( '#confirm_password_err' ).html( "كلمة المرور وتأكيدها غير متطابقتين" );
                }
            } );

            setValidationMSG( "#phoneNo", "يجب ادخال رقم الهاتف" );

            $( "#addUserForm" ).submit( function (event) {
                    if ($( '#password' ).attr( 'value' ) == $( '#confirm_password' ).attr( 'value' )) {
                        //getting form into Jquery Wrapper Instance to enable JQuery Functions on form
                        var form = $( "#addUserForm" );

                        $( 'input[type="checkbox"]' ).each( function () {
                            this.checked ? this.value = 1 : this.value = 0;
                        } );

                        //Serializing all For Input Values (not files!) in an Array Collection so that we can iterate this collection later.
                        var params = form.serializeArray();

                        //Getting Files Collection
                        var files = $( "#img" )[0].files;

                        //Declaring new Form Data Instance
                        var formData = new FormData();

                        //Looping through uploaded files collection in case there is a Multi File Upload. This also works for single i.e simply remove MULTIPLE attribute from file control in HTML.
                        for (var i = 0; i < files.length; i++) {
                            formData.append( "img", files[i] );
                        }
                        let state = $( 'input[name="isActive"]:checked' ).val();

                        formData.append( "isActive", state );

                        var fullName = (document.getElementById( "name1" ).value).trim() + " " + (document.getElementById( "name2" ).value).trim() + " " +
                            (document.getElementById( "name3" ).value).trim() + " " + (document.getElementById( "name4" ).value).trim()
                            + " " + (document.getElementById( "name5" ).value).trim();

                        formData.append( "name", fullName );

                        //Now Looping the parameters for all form input fields and assigning them as Name Value pairs.
                        $( params ).each( function (index, element) {
                            formData.append( element.name, element.value );
                        } );

                        //disabling Submit Button so that user cannot press Submit Multiple times

                        $( "#submit" ).val( "جار الحفظ..." );
                        $( "#submit" ).attr( "disabled", true );

                        $.ajax( {
                                url: '<?php echo URLROOT . "/users/add";?>',
                                method: "post",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    //Firing event if File Upload is completed!
                                    $( "#submit" ).attr( "disabled", false );
                                    $( "#submit" ).val( "حفظ" );
                                    $( "#img" ).val( "" );
                                    var json = $.parseJSON( data );
                                    var msg = "";
                                    var type = 'error';

                                    if (json == "50") {
                                        msg = 'يرجى اختيار ملف من نوع صورة';
                                    }

                                    if (json == "10") {
                                        $( "#userName_err" ).html( "الرجاء ادخال الاسم مستخدم" );
                                        msg = 'الرجاء ادخال الاسم مستخدم';
                                    }

                                    if (json == "12") {
                                        $( "#userName_err" ).html( "الاسم المستخدم موجود مسبقا" );
                                        msg = 'الاسم المستخدم غير صالح';
                                    }

                                    if (json == "11") {
                                        msg = 'الاسم المستخدم غير صالح';
                                    }

                                    if (json == "31") {
                                        msg = 'يجب ان لا تقل كلمة المرور عن ٨ احرف';
                                    }

                                    if (json == "41") {
                                        msg = 'كلمة المرور وتاكيدها غير متطابقتين';
                                    }

                                    if (json == "200") {
                                        msg = 'تمت الاضافة بنجاح';
                                        type = 'success';
                                        $( '#addUserForm' ).trigger( "reset" );
                                    }

                                    showAlert( type, msg )
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    showAlert( 'error', "خظأ: " + errorThrown );
                                    $( '#confirm_password_err' ).html( "" );
                                    $( '#submit' ).attr( "disabled", false );
                                },
                            }
                        );
                        return false;
                    } else {
                        showAlert( 'error', "كلمة المرور وتأكيدها غير متطابقتين" )
                    }
                }
            );
        } );
    </script>
<?php endif; ?>
