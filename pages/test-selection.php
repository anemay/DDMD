<?php session_start();
require 'connection.php';
$allowSkip = false;
if (isset($_GET["id"])) {
  $testId = $_GET["id"];
  $sql_select_test = "SELECT * FROM test, video WHERE test.id = $testId and test.id = video.test_id";
  $result = $conn->query($sql_select_test);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $topic = $row["topic"];
    $detail = $row["detail"];
    $link = $row["link"];
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
                    <h1 class="page-header"><?php $topic; ?></h1>
                    <?php
                      $memberId = $_SESSION["member_id"];
                      $sql_select_score_pre = "SELECT * FROM score WHERE member_id = $memberId and test_id = $testId and score_type = 1";
                      $resultScore = $conn->query($sql_select_score_pre);
                      if ($resultScore->num_rows > 0) {
                        $sql_select_score_post = "SELECT * FROM score WHERE member_id = $memberId and test_id = $testId and score_type = 2";
                        $resultCheck = $conn->query($sql_select_score_post);
                        if ($resultCheck->num_rows > 0) {
                          $allowSkip = true;
                        }
                        echo '<div class="col-md-12" id="player"></div>';
                        if ($allowSkip) {
                          echo '<form action="test-todo.php" method="post">
                            <div class="col-md-12" align="center" style="margin-top: 10px">
                              <input type="hidden" name="test_id" value="'.$testId.'">
                              <input type="hidden" name="test_type" value="post_test">
                              <button type="submit" id="btn-post-test" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> แบบทดสอบหลังเรียน
                              </button>
                            </div>
                          <form>';
                        } else {
                          echo '<form action="test-todo.php" method="post">
                            <div class="col-md-12" align="center" style="margin-top: 10px">
                              <input type="hidden" name="test_id" value="'.$testId.'">
                              <input type="hidden" name="test_type" value="post_test">
                              <button type="submit" id="btn-post-test" style="display:none" class="btn btn-default btn-lg">
                                <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> แบบทดสอบหลังเรียน
                              </button>
                            </div>
                          <form>';
                        }
                      } else {
                        echo '<form action="test-todo.php" method="post">
                          <div class="col-md-12" align="center">
                            <input type="hidden" name="test_id" value="'.$testId.'">
                            <input type="hidden" name="test_type" value="pre_test">
                            <button type="submit" id="btn-post-test" class="btn btn-default btn-lg">
                              <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> แบบทดสอบก่อนเรียน
                            </button>
                          </div>
                        <form>';
                      }
                     ?>
                    <h4 class="page-header">รายละเอียด</h4>
                    <div class="col-md-12">
                      <?php $detail; ?>
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
                  'controls': <?= $allowSkip ? 1 : 0; ?>,
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
            var match = ('<?= $link;?>').match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
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
