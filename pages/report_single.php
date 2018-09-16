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

        <div id="">
            <div class="row">
                <div class="col-xs-12">
                  <h3 class="text-center">การพัฒนาสื่อการเรียนรู้เรื่อง</h3>
                  <h4 class="text-center">อันตรายจากลักษณะการใช้ยาในทางที่ผิด</h4>

                    <br> <br>

                      <div class="card-body profile-user-box">

                        <div class="row">
                          <div class="col-sm-12">
                                  <!-- Profile -->


                                <div class="row">
                                  <div class="col-sm-8">
                                    <div class="media">


                                    <div class="col-xs-12 media-body">
                                      <?php


                                       ?>
                                        <h4 class="mt-1 mb-1 text-white"><?= $name ."&nbsp;".$lastname; ?></h4>
                                        <h5 class="mt-1 mb-1 text-white"><?= $email ; ?></h5>



                                      </div> <!-- end media-body-->


                                    </div> <!-- end col-->


                                  </div> <!-- end row -->

                                </div> <!-- end card-body/ profile-user-box-->


                          </div>
                          <!-- end row -->


                    </div>


                  </div>
                  <!-- /.col-lg-12 -->

              </div>
                  </form>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <br>
            <br>
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
                  echo '<div class="col-xs-4">
                    <div class="well">
                      <div><h3>'.$test["topic"].'</h3></div>
                      <hr/>
                      <div><h5>คะแนนก่อนเรียน: '.$pretest ["score"].'</5></div>
                    </div>
                    </div>';
                  echo '<div class="col-xs-8 table-responsive">
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

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

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
