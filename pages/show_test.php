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
                <div class="col-lg-12">
                    <h1 class="page-header">แบบทดสอบ</h1>
                    <div class="col-md-10 col-md-offset-1">
                      <form class="form-horizontal" action="show_test.php" method="get">

                        <div class="form-group">
                          <label for="" class="col-sm-2 control-label">ค้นหา</label>
                          <div class="col-sm-5">
                              <input type="text" class="form-control" id="title" name="title" placeholder="ชื่อเรื่อง">
                          </div>

                          <div class="col-sm-5">
                              <button type="submit" id="btn-register" class="btn btn-primary">ค้นหา</button>
                          </div>
                        </div>

                        <div class="col-lg-12 table-bordered table-responsive">
                          <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                  <th>ลำดับ</th>
                                  <th>ชื่อเรื่อง</th>
                                  <th>ลิ้งค์(URL)</th>
                                  <th>อื่นๆ</th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php
                                  $where = "";
                                  if (isset($_GET["title"])) {
                                    $title = $_GET["title"];
                                    $where = " and topic like '%$title%'";
                                  }
                                  $sql = "SELECT *, test.id as tid FROM test , video where test.id = video.test_id " . $where;
                                  $result = $conn->query($sql);
                                  if ($result && $result->num_rows > 0) {
                                    $count = 1;
                                    while ($row = $result->fetch_assoc()) {
                                      echo '<tr>';
                                      echo '<td>'.$count.'</td>';
                                      echo '<td>'.$row["topic"].'</td>';
                                      echo '<td>'.$row["link"].'</td>';
                                      echo '<td>';
                                      ?>
                                        <a class="btn btn-warning" href="test_add.php?id=<?php echo $row['tid']; ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" onclick="deleteTest('<?php echo $row['topic']; ?>', <?php echo $row['tid']; ?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                      <?php
                                      echo '</td>';
                                      echo '</tr>';
                                      $count++;
                                    }
                                  }
                                 ?>

                              </tbody>

                          </table>
                        </div>

                        <div class="form-group">
                          <label for="" class="col-sm-3 control-label"></label>
                          <div class="col-sm-9">
                            <div class="alert alert-danger" style="display: none" id="alert" role="alert"></div>
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
      function deleteTest(test, id) {
        $('#modal-delete').modal();
        var title = $('#message-delete-title');
        title.text(test);
        $('#btn-modal-delete').on('click', function() {
          $.ajax({
            url: "service-test-delete.php",
            type: "POST",
            dataType: 'json',
            data: {
              "id": id
            }, success: function(resp) {
              console.log(resp);
              $('#modal-delete').modal('hide');
              if (resp.result) {
                window.location = "show_test.php";
              }
            }, error: function(error, xhr) {
              console.log(error);
              console.log(xhr);
              $('#modal-delete').modal('hide');
            }
          })
        })
      }

      $(document).ready(function(){
        var title = getUrlParameter('title');
        var message = getUrlParameter('message');
        if (title !== undefined && message !== undefined) {
          $('#modal-message').modal('show');
          $('#message-title').text(title);
          $('#message-content').text(message);
        }
        function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        }
      })
    </script>
    <!-- Modal -->
    <div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="message-title"></h4>
          </div>
          <div class="modal-body" id="message-content">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="message-delete-title"></h4>
          </div>
          <div class="modal-body" id="message-delete-content">
            ยืนยันการลบแบบทดสอบ ถ้าหากลบแบบทดสอบ จะไม่สามารถกู้คืนกลับมาได้ หากต้องการดำเนินการต่อ กรุณายืนยัน
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-danger" id="btn-modal-delete" data-dismiss="modal">ยืนยันการลบ</button>
          </div>
        </div>
      </div>
    </div>


</body>

</html>
