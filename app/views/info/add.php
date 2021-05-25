<?php require APPROOT . '/views/inc/header.php'; ?>


<link rel="stylesheet" href="<?php echo URLROOT . "/public/vendor/dropzone/dropzone.css" ?>">
<script type="text/javascript" src="<?php echo URLROOT . "/public/vendor/dropzone/dropzone.min.js" ?>"></script>

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
                               value="" id="name" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="ename">الاسم باللغة الانكليزية:<sup>*</sup></label>
                        <input type="text" name="ename" class="form-control form-control-lg"
                               value="" id="ename" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="det">التفاصيل:
                            <sup>*</sup></label>
                        <textarea name="det" class="form-control form-control-lg"
                                  value="" id="det" required></textarea>
                        <span class="invalid-feedback"></span>
                    </div>


                    <div class="form-group col-md-12">
                        <label for="type">النوع<sup>*</sup></label>
                        <select name="type" class="custom-select" id="type" required>
                            <option value="">نوع النبته</option>
                        </select>
                        <span class="invalid-feedback"></span>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="dropzone" id="dZUpload">
                                <div class="dz-message" data-dz-message>
                                    <div class="icon">
                                        <i class="flaticon-file"></i>
                                    </div>
                                    <h4 class="message">قم بسحب وافلات الصور هنا</h4>
                                    <div class="note">
                                        يمكنك تحميل المزيد من الصور الخاصة بالنبته
                                    </div>
                                </div>
                                <div class="fallback">
                                    <input name="file" type="file" multiple/>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group col-md-12">
                        <input type="button" id="upload"  name="btnSend" value="إرسال" class="btn btn-success btn-block">
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script src=<?php echo URLROOT . "/public/js/main.js" ?>></script>


<script type="text/javascript">
    populateSelectFromDs("type", titles);
    Dropzone.autoDiscover = false;

    $("#upload").click(function (e) {
        myDZ.processQueue();
    })
    var myDZ = new Dropzone("#dZUpload", {
        url: '<?php echo URLROOT . "/Info/add";?>',
        addRemoveLinks: true,
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 10,
        paramName: 'imgs',
        clickable: true,
        init: function () {
            this.on('sending', function (xhr, fd1, fd2) {
                //append extra data here
                fd2.append("name", $("#name").val());
                fd2.append("ename", $("#ename").val());
                fd2.append("det", $("#det").val());
                fd2.append("type", $("#type").val());
                // alert("testname");
            });

            this.on('success', function (file, responseText) {
                //do after successful upload
                console.log(responseText);
                showAlert("success","تم الاضافة بنجاح")
                // $("#addUserForm").reset();;
                $("#addUserForm").trigger("reset");
                // alert(responseText);
                // alert("success");
            })
        }
    });
</script>
