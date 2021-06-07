<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>Print Card</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <link href="<?php echo URLROOT . "/public/mh/css/bootstrap.css" ?>" rel="stylesheet"/>
    <link href="<?php echo URLROOT . "/public/mh/css/bootshape.css" ?>" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <script src="<?php echo URLROOT . "/public/mh/js/jquery.js" ?>"></script>
    <script src="<?php echo URLROOT . "/public/mh/js/bootstrap.min.js" ?>"></script>

</head>
<body>


<script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/qr/qrcode.js" ?>"></script>
<script type="text/javascript" src="<?php echo URLROOT . "/public/mh/js/qr/html5-qrcode.js" ?>"></script>

<script src="<?php echo URLROOT . "/public/mh/js/print.js" ?>"></script>
<script type="text/javascript">
    function updateQRCode(text, elementId) {
        var element = document.getElementById(elementId);
        var bodyElement = document.body;
        if (element.lastChild)
            element.replaceChild(showQRCode(text), element.lastChild);
        else element.appendChild(showQRCode(text));
    }
</script>

<div class="container" id="print">


        <div class="row align-items-start">
    <?php
    foreach ($data['Plants'] as $plant) :
        ?>
            <div class="col-md-6">
                <div class="carde">
                    <div class="card-avatar">
                        <div class='imag' id="qrcode-<?php echo $plant->pId ?>"></div>
                    </div>
                    <div class="card-details">
                        <div class="skills">
                            <h3 class="card-title"><b> <?php echo $plant->eName ?> </b></h3>
                            <h3 class="card-title"><b> <?php echo $plant->name ?>  </b></h3>
                        </div>
                        <div class="btn btn-primary"><?php echo $plant->type ?></div>
                    </div>
                </div>
            </div>
    <?php
    endforeach;
    ?>
        </div>
        <script>
            updateQRCode("<?php echo URLROOT . "/main/details/" . $plant->pId ?>", "qrcode-<?php echo $plant->pId ?>");
        </script>
</div>
<button type="button" onclick="genpdf()" id="printbtn" class="btn btn-warning">
    Print
</button>
</body>
</html>
