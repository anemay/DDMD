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
                    echo '<h1 class="page-header">แสดงข้อมูลคะแนน</h1>';
                  } else {
                      echo '<h1 class="page-header">แก้ไขสมาชิก</h1>';
                  } ?>

                  <div class="card bg-primary">
                    <div class="card-body profile-user-box">

                      <div class="row">
                        <div class="col-sm-12">
                                <!-- Profile -->
                          <div class="card bg-primary" style="padding: 10px">
                            <div class="card-body profile-user-box">

                              <div class="row">
                                <div class="col-sm-8">
                                  <div class="media">
                                    <span class="col-xs-6 col-md-3">
                                      <img src="img/avatar-girl.png" style="height: 100px; " alt="" class="center">
                                    </span>

                                  <div class="media-body">
                                      <h4 class="mt-1 mb-1 text-white"><?=$name ."&nbsp;". $lastname; ?></h4>
                                      <p class="font-13 text-white-50"><?= $email ; ?></p>



                                    </div> <!-- end media-body-->


                                  </div> <!-- end col-->


                                </div> <!-- end row -->

                              </div> <!-- end card-body/ profile-user-box-->
                             </div><!--end profile/ card -->
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->


                  </div>


                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <br>
            <br>

            <?php
              $sql_select_test = "SELECT * FROM test";
              $resultTest = $conn->query($sql_select_test);
              if ($resultTest) {
                while ($test = $resultTest->fetch_assoc()) {
                  $testId = $test['id'];
                  $sql_pretest = "SELECT * FROM score WHERE score_type = 1 and member_id = $id and test_id = $testId";
                  $resultPretest = $conn->query($sql_pretest);
                  $pretest = $resultPretest->fetch_assoc();
                  echo '<div class="col-lg-4">
                    <div class="well">
                      <div><h3>'.$test["topic"].'</h3></div>
                      <hr/>
                      <div><h5>คะแนนก่อนเรียน: '.$pretest ["score"].'</5></div>
                    </div>
                    </div>';
                  echo '<div class="col-lg-8 table-responsive">
                      <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                              <th>ลำดับ</th>
                              <th>คะแนนหลังทำแบบทดสอบ</th>
                              <th>เวลาที่ใช้ในการทำแบบทดสอบ</th>
                              <th>วันที่ทำแบบทดสอบ</th>
                              </tr>
                          </thead>
                          <tbody>';

                  $count = 1;
                  $sql_postest = "SELECT * FROM score WHERE score_type = 2 and member_id = $id and test_id = $testId";
                  $resultPostest = $conn->query($sql_postest);
                  if ($resultPostest) {
                    while ($postest = $resultPostest->fetch_assoc()) {
                      echo '<tr>';
                      echo '<td>'.$count++.'</td>';
                      echo '<td>'.$postest["score"].'</td>';
                      echo '<td>'.$postest["time"].'</td>';
                      echo '<td>'.$postest["date"].'</td>';
                      echo '</tr>';
                    }
                  }

                  echo '</tbody>
                          </table>
                      </div>';
                  echo '<div class="col-md-12"></div>';
                }
              }
             ?>

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
          var age = $('input[name=radio-age]:checked').val();
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
