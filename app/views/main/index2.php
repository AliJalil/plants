<?php require APPROOT . '/views/inc/header.php'; ?>
<!--<div class="row">-->
<!--    <div class="col-md-12">-->
<!--        <div class="col-md-12 text-center">-->
<!--            <div class="col-md-12">-->
<!--                <img src="logo.png" alt="" class="logo">-->
<!--                <h1><span style="color:red">استمارة تسجيل الكادر التدريسي في جامعة الكفيل</span></h1>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
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
                        <h3 style="color:red">استمارة السيرة الذاتية للكادر التدريسي في جامعة الكفيل </h3>
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
                        <label for="title">اللقب العلمي<sup>*</sup></label>
                        <select name="title" class="custom-select" id="title" required>
                            <option value="">اختر اللقب العلمي</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="cert">الشهادة الاكادييمة<sup>*</sup></label>
                        <select name="cert" class="custom-select" id="cert" required>
                            <option value="">اختر الشهادة الاكاديمية</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="uniar">خريج جامعة (باللغة العربية) :<sup>*</sup></label>
                        <input type="text" name="uniar" class="form-control form-control-lg"
                               value="" placeholder="اكتب اسم الجامعة التي تخرجت منها باللغة العربية" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="unien"> خريج جامعة (باللغة الانكليزية):<sup>*</sup></label>
                        <input type="text" name="unien" class="form-control form-control-lg"
                               value="" placeholder="اكتب اسم الجامعة التي تخرجت منها باللغة الانكليزية" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="colg">مكان العمل<sup>*</sup></label>
                        <select name="colg" class="custom-select" id="colg" required>
                            <option value="">اختر الكلية</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">البريد الإلكتروني (الجامعي): <sup>*</sup></label>
                        <input type="email" name="email" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email1">بريد الكتروني اخر (اختياري): <sup></sup></label>
                        <input type="email" name="email1" class="form-control form-control-lg"
                               value="">
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phoneNo">رقم الهاتف : <sup>*</sup></label>
                        <input type="text" name="phoneNo" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="phoneNo1">رقم هاتف الغرفة (الارضي) : <sup>*</sup></label>
                        <input type="text" name="phoneNo1" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="orcid">معرف الباحث في ORCID:<sup>*</sup></label>
                        <input type="text" name="orcid" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="scopus">حساب الباحث في Scopus: <sup></sup></label>
                        <input type="text" name="scopus" class="form-control form-control-lg"
                               value="">
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="gScholar"> حساب الباحث العلمي في Google Scholar: <sup>*</sup></label>
                        <input type="text" name="gScholar" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="rGate">حساب الباحث في Research Gate: <sup>*</sup></label>
                        <input type="rGate" name="rGate" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="publons"> حساب الباحث العلمي في Publons: <sup>*</sup></label>
                        <input type="publons" name="publons" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="linkedIn">حساب الباحث في Linked In: <sup>*</sup></label>
                        <input type="linkedIn" name="linkedIn" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="researchInAr">الاهتمامات البحثية باللغة العربية (يرجى الفصل بينها بفارزة):
                            <sup>*</sup></label>
                        <input type="text" name="researchInAr" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="researchInEn">الاهتمامات البحثية باللغة الانلكيزية (يرجى الفصل بينها بفارزة):
                            <sup>*</sup></label>
                        <input type="text" name="researchInEn" class="form-control form-control-lg"
                               value="" required>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="researches">البحوث المنشورة (اسم البحث واسم المجلة او المؤتمر وسنة النشر):
                            <sup>*</sup></label>
                        <textarea name="researches" class="form-control form-control-lg"
                                  value="" required></textarea>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="pExperience">الخبرات السابقة: <sup>*</sup></label>
                        <textarea name="pExperience" class="form-control form-control-lg"
                                  value="" required></textarea>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="file">ملف السيرة الذاتية (يرجى ملء الملف كما في القالب المرفق) : <sup>*</sup></label>
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

