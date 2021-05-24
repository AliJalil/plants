<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 text-center">
            <div class="rightDiv">
               <span style="color:black">
                   <br>
                   <strong></strong>
                   <br>
                </span>
            </div>
        </div>
    </div>
</div>
<!--<div class="row">-->
<!--    <div class="col-md-12">-->
<!--        --><?php //echo $results; ?>
<!--    </div>-->
<!--</div>-->
<form enctype="multipart/form-data" name="addUserForm" method="post" id="addUserForm">
    <div class="row">

        <div class="col-md-12 mx-auto">
            <div class="card card-body bg-light mt-12">
                <div class="row">


                    <div class="text-center col-md-12">
                        <h3 style="color:red">معلومات النباتات</h3>
                        <p>يرجى تعبئة جميع البيانات المطلوبة مع ملاحظات ان بعض الحقول تتطلب الملء باللغة الانكليزية</p>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="name">الاسم باللغة العربية:<sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="ename">الاسم باللغة الانكليزية:<sup>*</sup></label>
                        <input type="text" name="ename" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="researches">التفاصيل:
                            <sup>*</sup></label>
                        <textarea name="researches" class="form-control form-control-lg"
                                  value="" required></textarea>
                        <span class="invalid-feedback"></span>
                    </div>


                    <div class="form-group col-md-12">
                        <label for="title">النوع<sup>*</sup></label>
                        <select name="title" class="custom-select" id="title" required>
                            <option value="">نوع النبته</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="file">الصورة الرئيسية: <sup>*</sup></label>
                        <a href="<?php echo URLROOT . '/public/docs/cv_template.docx'; ?>">اضغط هنا لتحميل القالب </a>
                        <input type="hidden" value="350000">
                        <input class="form-control" type="file" accept="application/pdf" name="cv" id="cv" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="submit" name="btnSend" value="إرسال" class="btn btn-success btn-block">
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script src=<?php echo URLROOT . "/public/js/main.js" ?>></script>

<script>

    populateSelectFromDs("title", titles);
    populateSelectFromDs("cert", certs);
    populateSelectFromDs("colg", colg);

    $(document).ready(function () {

        $("#addUserForm").submit(function (event) {

                // alert($('#cv'));
                // var x = document.getElementById('cv').files[0];
                // alert(x);
                //
                // alert($("#cv")[0].files);
                //getting form into Jquery Wrapper Instance to enable JQuery Functions on form
                var form = $("#addUserForm");
                //Serializing all For Input Values (not files!) in an Array Collection so that we can iterate this collection later.
                var params = form.serializeArray();
                //Declaring new Form Data Instance
                var formData = new FormData();

                // var bookFile = $("#file")[0].files;
                formData.append("file",document.getElementById('cv').files[0]);
                // alert($("#file")[0].files);
                //Now Looping the parameters for all form input fields and assigning them as Name Value pairs.
                $(params).each(function (index, element) {
                    formData.append(element.name, element.value);
                });

                //disabling Submit Button so that user cannot press Submit Multiple times

                $("#submit").val("جار الحفظ...");
                $("#submit").attr("disabled", true);

                $.ajax({
                        url: '<?php echo URLROOT . "/Plants/add";?>',
                        method: "post",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            //Firing event if File Upload is completed!
                            $("#submit").attr("disabled", false);
                            $("#submit").val("حفظ");
                            $("#file").val("");
                            var json = $.parseJSON(data);
                            var msg = "";
                            var type = 'error';

                            if (json == "50") {
                                msg = 'يرجى رفع ملف السيرة الذاتية';
                            }

                            if (json == "200") {
                                msg = 'تم استلام ردك, شكرا لك';
                                type = 'success';
                                $('#addUserForm').trigger("reset");
                            }
                            showAlert(type, msg)
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            showAlert('error', "خطأ: " + errorThrown);
                            $('#confirm_password_err').html("");
                            $('#submit').attr("disabled", false);
                        },
                    }
                );
                return false;
            }
        );
    });
</script>

