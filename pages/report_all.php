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

    <title>DDMD</title>

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
                <div class="col-sm-12">
                  <h2 class="page-header col-sm-8 col-sm-offset-4">รายงานข้อมูลเรื่องการใช้ยาผิดคุณลักษณะวิธี</h2>



                  <div class="col-sm-12 table-responsive">
                      <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                              <th>ลำดับ</th>
                              <th>ชื่อ</th>
                              <th>นามสกุล</th>
                              <th>คะแนนก่อนทำ</th>
                              <th>คะแนนหลังทำ</th>
                              <th>วัน-เวลาที่ทำแบบทดสอบ</th>
                            </tr>
                          </thead>

                          <tbody>


                          </tbody>
                          </table>
                        <!-- /<div class="col-sm-6 col-md-offset-4">
                          <button ty pe="button" class="btn btn-primary">รายชื่อสมาชิกทั้งหมด</button>
                          <button ty pe="button" class="btn btn-primary">5 อันดับแรก</button>
                      </div>-->


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
