<?php session_start();
require 'connection.php';
$idcard = "";
$name = "";
$lastname = "";
$age= "";
$sex = "";
$status = "";
$email = "";
$password = "";
$type = "";
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM member where id= $id";
  $result = $conn->query($sql);
    if ($result->num_rows > 0) { //
      $data = $result->fetch_assoc();
      $idcard = $data["idcard"];
      $name = $data["name"];
      $lastname = $data["lastname"];
      $age = $data["age"];
      $sex = $data["sex"];
      $email = $data["email"];
      $password = $data["password"];
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

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

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
                <div class="col-lg-12">
                  <?php if(!isset($_GET["id"])) {
                    echo '<h1 class="page-header">สมัครสมาชิก</h1>';
                  } else {
                      echo '<h1 class="page-header">แก้ไขสมาชิก</h1>';
                  } ?>


                    <div class="col-md-5 col-md-offset-2">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">รหัสประชาชน</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="idcard" value="<?= $idcard;?>" placeholder="รหัสประชาชน" maxlength="13">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label">คำนำหน้าชื่อ</label>
                          <div class="col-sm-9">

                            <!-- <select id="prefix" class="form-control" > -->
                            <select class="form-control" name="prefix" id="prefix">
                              <?php
                                $sql = "SELECT * FROM prefix";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0){
                                  while ($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row["id"].'">'.$row["prefix"].'</option>';
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">ชื่อ</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" value="<?=$name;?>"placeholder="ชื่อ" maxlength="50">
                          </div>
                        </div>

                        <!-- Surname -->
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">นามสกุล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="lastname" value="<?=$lastname;?>" placeholder="นามสกุล" maxlength="50">
                          </div>
                        </div>

                        <!-- AGE -->
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">อายุ</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="date" name="age" id="age">
                            <!-- <?php
                              $sql = "SELECT * FROM age";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()) {
                                  echo '<label class="radio-inline">';
                                  echo '<input type="radio" name="radio-age" value="'.$row["id"].'">'.$row["age"].'</input>';
                                  echo '</label>';
                                }
                              }
                            ?> -->

                        </div>
                        </div>

                        <!-- TYPE -->
                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-3 control-label">ประเภทบุคคล</label>
                          <div class="col-sm-9">

                            <select class="form-control" name="type" id="type">
                              <?php
                                $sql = "SELECT * FROM type";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0){
                                  while ($row = $result->fetch_assoc()) {
                                    echo '<option value="'.$row["id"].'">'.$row["type"].'</option>';
                                  }
                                }
                              ?>
                            </select>
                          </div>
                        </div>

                        <!-- SEX -->
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">เพศ</label>
                        <div class="col-sm-9">
                            <?php
                              $sql = "SELECT * FROM sex";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0){
                                while ($row = $result->fetch_assoc()) {
                                  echo '<label class="radio-inline">';
                                  echo '<input type="radio" name="radio-sex" value="'.$row["id"].'">'.$row["sex"].'</input>';
                                  echo '</label>';
                                }
                              }
                            ?>
                        </div>
                        </div>


                        <!-- EMAIL -->
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">อีเมล</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" value="<?=$email;?>" placeholder="อีเมล" maxlength="50">
                          </div>
                        </div>

                        <?php if (!isset($_GET["id"])) { ?>
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">รหัสผ่าน</label>
                          <div class="col-sm-9">

                        <input type="password" class="form-control" id="password" value="<?=$password;?>"placeholder="รหัสผ่าน" >

                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label">ยืนยันรหัสผ่าน</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" id="confirmpassword" placeholder="ยืนยันรหัสผ่าน" >
                          </div>
                        </div>
                      <?php } ;?>
                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label"></label>
                          <div class="col-sm-9">
                            <div class="alert alert-danger" style="display: none" id="alert" role="alert"></div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-12" align="center">
                            <button type="button" class="btn btn-default">ล้างข้อมูล</button>
                            <button type="button" id="btn-register" class="btn btn-primary">ส่งข้อมูล</button>
                          </div>
                        </div>
                      </form>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="loading-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h1><i class="fa fa-circle-o-notch fa-spin" style=""></i> Loading...</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script>
      $('#btn-register').on('click', function() {
          loading(true);
          var message = "";
          displayError(false, "");

          var idcard = $('#idcard').val();
          var prefix = $("#prefix").val();
          var name = $('#name').val();
          var lastname = $('#lastname').val();
          var age = $('#age').val();
          var sex = $('input[name=radio-sex]:checked').val();
          var type = $("#type").val();
          var email = $('#email').val();
          var password = $('#password').val();
          var confirmpassword = $('#confirmpassword').val();

          if (email == "") {
            message += "- กรุณาระบุ email<br>";
          }
          if (password != confirmpassword) {
            message = message.concat("- รหัสผ่านไม่ตรงกัน กรุณากรอกอีกครั้ง<br>");
          } else if (password == "" || confirmpassword == "") {
            message = message.concat("- กรุณาใส่รหัสผ่าน");
          }

          if (message != "") {
            loading(false);
            displayError(true, message);
            return;
          }

          $.ajax({
            url: "service-register.php",
            type: "POST",
            dataType: "JSON",
            data: {
              "idcard": idcard,
              "prefix": prefix,
              "name": name,
              "lastname": lastname,
              "age": age,
              "sex": sex,
              "email": email,
              "password": password,
            }, success: function(resp) {
              loading(false);
              console.log(resp);
              if (resp.result == true) {
                  window.location = "index.php?title=" + resp.message + "&message=กรุณายืนยันอีเมลภายใน 7 วัน";
              }
            }, error: function(error) {
              loading(false);
              console.log(error);
            }
          })

      })

      function displayError(show, message) {
          //show ? $('#alert').show() : $('#alert').hide();
          if (show) {
            $('#alert').show();
          } else {
            $('#alert').hide();
          }
          $('#alert').html(message);
      }

      function loading(show) {
        if (show) {
            $('#loading-dialog').modal('show');
        } else {
            $('#loading-dialog').modal('hide');
        }
      }
    </script>

</body>

</html>
