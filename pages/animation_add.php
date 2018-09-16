<?php session_start();
require 'connection.php';
$topic="";
$link = "";
$slink = "";
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM test, video where test.id = $id and test.id = video.test_id";
  $result = $conn->query($sql);
    if ($result->num_rows > 0) { //
      $data = $result->fetch_assoc();
      $topic = $data["topic"];
      $link = $data["link"];
      $slink = $data["slink"];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project DDMD</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Project: DDMD</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

            </ul>
            <!-- /.navbar-top-links -->

            <?php require('sidemenu.php'); ?>

        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                      <?php
                        if (isset($_GET["id"])) {
                          echo '<h1 class="page-header">แก้ไขแอนิเมชั่น</h1>';
                        } else {
                          echo '<h1 class="page-header">เพิ่มแอนิเมชั่น</h1>';
                        }
                       ?>
                    </div>
                    <div class="col-md-7">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label for="" class="col-sm-2 control-label">ลิ้งค์(URL)</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="link" value="<?=$link;?>" placeholder="ลิ้งค์(URL)" maxlength="50">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-2 control-label">ตัวอย่าง(URL)</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="slink" placeholder="ลิ้งค์ตัวอย่าง(URL)" value="<?=$slink;?>"  maxlength="50">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">ต้องการแสดงตัวอย่างนี้หรือไม่</label>
                        <div class="col-sm-9">
                          <label class="radio-inline">
                            <input type="radio" name="display" id="inlineRadio1" value="1"> แสดง
                            </label>
                            <label class="radio-inline">
                            <input type="radio" name="display" id="inlineRadio2" value="0"> ไม่แสดง
                            </label>
                        </div>
                        </div>
                      </form>
                      <div class="col-md-12" align="center">
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#btn-update">
                          แก้ไขข้อมูลแอนิเมชั่น
                        </button>
                      </div>
                      <div class="modal fade" id="btn-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="myModalLabel">ยืนยันกันแก้ไขแอนิเมชั่น</h4>
                            </div>
                            <div class="modal-body">
                              คุณแน่ใจหรือไม่
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                              <button type="button" class="btn btn-primary">ยืนยัน</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </body>
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script>
      $('#btn-update').on('click', function() {
          var link = $('#link').val();
          var slink = $('#slink').val();
          var show = $('input[name=display]:checked').val();
          var id = <?= $id; ?>;
          $.ajax({
            url: "edit_animation.php",
            dataType: "JSON",
            type: "POST",
            data: {
              id: id,
              link: link,
              slink: slink,
              show: show
            }, success: function(resp) {
              console.log(resp);
              if (resp.result) {
                alert("แก้ไขข้อมมูลเสร็จสิ้น");
                window.location="show_animation.php";
              }
            }, error: function(error) {
              console.log(error);
            }
          })

      })
    </script>

    </html>
