<?php session_start();
require 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RMUTK</title>

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
          <div class="col-md-12">
              <h1 class="page-header">รายการทดสอบ</h1>
              <?php
                  $sql_select_test = "SELECT * FROM test";
                  $result = $conn->query($sql_select_test);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $id = $row["id"];
                      $detail = mb_strimwidth($row["detail"], 0, 300, "...");
                      echo '<div class="col-md-4">';
                      echo '<div class="col-md-12 well">';
                      echo '<h4>'.$row["topic"].'</h4>';
                      echo '<hr>';
                      echo '<h5>'.$detail.'</h5><br/>';
                      echo '<div align="right">';
                      echo '<a href="test-selection.php?id='.$id.'" type="button" class="btn btn-default">
  <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span> ทำแบบทดสอบ
</a>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                    }
                  }
               ?>
          </div>

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
