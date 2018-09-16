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

    <title>PROJECT DDMD</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <script src="http://www.youtube.com/player_api"></script>

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
        <nav class="navbar navbar-default "  role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand ">
                <form class="form-inline">
                <img src="img/Logo.png" alt="" width="35px" height="35px" class="d-inline-block align-top">
                </form>
              </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                  <?php
                    if (!isset($_SESSION["email"])) {
                  ?>
                    <a class="dropdown-toggle" data-toggle="modal" data-target="#modal-login" href="#">
                        เข้าสู่ระบบ <i class="fa fa-user fa-fw"></i>
                    </a>
                  <?php } else { ?>
                    <a class="dropdown-toggle" href="#">
                        <?php echo $_SESSION["email"]; ?> <i class="fa fa-user fa-fw"></i>
                    </a>
                  <?php } ?>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <?php require('sidemenu.php'); ?>

        </nav>

        <div id="page-wrapper">
            <div class="row">
                <?php
                  $sql_select_video = "SELECT * FROM video WHERE show_first = 1";
                  $result = $conn->query($sql_select_video);
                  $slink = "";
                  if ($result) {
                    $video = $result->fetch_assoc();
                    $slink = $video["slink"];
                  }
                 ?>
                <div class="col-lg-12">
                    <h1 class="page-header">Video ตัวอย่าง</h1>
                    <div class="col-md-12" id="player"></div>
              </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

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

    <!-- Modal -->
    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Login</h4>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
              </div>
              <div class="col-md-12">
                <div class="alert alert-danger" style="display:none" role="alert" id="message-alert-login"></div>
              </div>
              <div align="center">
                <p><a href="register.php" target="_self" style="text-decoration: underline">สมัครสมาชิก</a> | <a href="reset_password.php" style="text-decoration: underline">ลืมรหัสผ่าน</a></p>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btn-login" class="btn btn-primary">Login</button>
          </div>
        </div>
      </div>
    </div>

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

    <script>
      $(document).ready(function(){
        var title = getUrlParameter('title');
        var message = getUrlParameter('message');
        if (title !== undefined && message !== undefined) {
          $('#modal-message').modal('show');
          $('#message-title').text(title);
          $('#message-content').text(message);
        }
      })

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

      $('#btn-login').on('click', function() {
        // ajax here
        $('#message-alert-login').hide();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
          url: "service-login.php",
          type: "POST",
          dataType: "JSON",
          data: {
            "email": email,
            "password": password,
          }, success: function(resp) {
            console.log(resp);
            if (resp.result == true) {
                window.location = "index.php";
            } else {
              var alt = $('#message-alert-login');
              alt.show();
              alt.text(resp.message);
            }
          }, error: function(error) {

          }
        })


      })
    </script>

    <script>
        // create youtube player
        var player;
        function onYouTubePlayerAPIReady() {
            player = new YT.Player('player', {
              height: '390',
              width: '640',
              videoId: qs('v'),
              playerVars: {
                  'autoplay': 0,
                  'controls': 1,
                  'rel' : 0,
                  'fs' : 0,
              },
              events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
              }
            });
        }

        function qs(key) {
            key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
            var match = ('<?= $slink;?>').match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
            return match && decodeURIComponent(match[1].replace(/\+/g, " "));
        }

        // autoplay video
        function onPlayerReady(event) {
            event.target.playVideo();
        }

        // when video ends
        function onPlayerStateChange(event) {
            if(event.data === 0) {
              $('#btn-post-test').fadeIn();
            }
        }

    </script>

</body>

</html>
