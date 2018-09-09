<?php session_start();
require 'connection.php';
if (isset($_POST["test_id"])) {
  $testId = $_POST["test_id"];
  $testType = $_POST["test_type"];
  $sql_select_test = "SELECT * FROM test WHERE id = $testId";
  $result = $conn->query($sql_select_test);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $topic = $row["topic"];
    $detail = $row["detail"];
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
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

    <style>
    .box {
      position:relative;
    }
    .bet_time {
      position:absolute;
      bottom:0;
      right:0;
    }
    </style>

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
              <input type="hidden" id="test_id" value="<?= $testId; ?>">
              <input type="hidden" id="test_type" value="<?= $testType; ?>">
              <input type="hidden" id="test_time">
                <div class="col-lg-12">
                    <div class="col-md-6">
                      <h1 class=""><?= $topic; ?></h1>
                    </div>
                    <div class="col-md-6" align="right">
                      <h1 id="time-count"></h1>
                    </div>
                    <div class="col-md-12"><hr/></div>
                    <?php
                      $sql_select_random_top_5 = "SELECT * FROM question ORDER BY RAND() LIMIT 5";
                      $result = $conn->query($sql_select_random_top_5);
                      $count = 1;
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $questionId = $row["id"];
                          echo '<div class="col-md-11 col-md-offset-1">
                            <h3 class="question-topic" value="'.$questionId.'">ข้อที่ '.$count++.' '.$row["question"].'</h3>
                          </div>';
                          echo '<div class="col-md-10 col-md-offset-2">';
                          $sql_select_answer = "SELECT * FROM answer WHERE question_id = $questionId";
                          $resultAnswer = $conn->query($sql_select_answer);
                          if ($resultAnswer->num_rows > 0) {
                            $lap = 1;
                            while ($answer = $resultAnswer->fetch_assoc()) {
                              $textAnswer = "";
                              $checked = "";
                              if ($lap == 1) {
                                $textAnswer = "ก";
                                $checked = "checked";
                              } else if ($lap == 2) {
                                $textAnswer = "ข";
                              } else if ($lap == 3) {
                                $textAnswer = "ค";
                              } else {
                                $textAnswer = "ง";
                              }
                              echo '<div class="radio">
                                 <h3><label>
                                   <input type="radio" name="'.$questionId.'" id="optionsRadios1" value="'.$answer["id"].'" '.$checked.'>
                                   '.$textAnswer.'. '.$answer["answer"].'
                                 </label></h3>
                               </div>';
                               $lap += 1;
                            }
                          }
                          echo '</div>';
                        }
                      }
                     ?>
                     <div class="col-md-12" align="center" style="margin-bottom: 20px">
                       <button type="button" data-toggle="modal" data-target="#modal-confirm" class="btn btn-primary">ส่งคำตอบ</button>
                     </div>
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

    <script>
      $(document).ready(function() {
        var startTime = Date.now();
        var interval = setInterval(function() {
            var elapsedTime = Date.now() - startTime;
            var millisec = (elapsedTime / 1000).toFixed(0);
            $('#test_time').val(millisec);
            $('#time-count').html("เวลา: " + millisec + " วินาที");
        }, 100);

        $('#btn-submit').on('click', function() {
          var arr = [];
          $('.question-topic').each(function(index) {
            var qid = $(this).attr('value');
            var answer = $('input[name='+qid+']:checked').val();
            item = {}
            item["question"] = qid;
            item["answer"] = answer;
            arr.push(item);
          })

          var testId = $('#test_id').val();
          var testType = $('#test_type').val();
          var testTime = $('#test_time').val();

          $.ajax({
            url: 'service-score-add.php',
            type: 'post',
            dataType: 'json',
            data: {
              test_id: testId,
              test_type: testType,
              test_time: testTime,
              data: arr
            }, success: function(resp) {
              if (resp.result) {
                window.location = "test-selection.php?id=<?= $testId; ?>";
              }
            }, error: function(error) {
              console.log(error);
            }
          })

        })

      })

    </script>

    <!-- Modal -->
    <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">ส่งคำตอบ "<?= $topic; ?>"</h4>
          </div>
          <div class="modal-body">
             <p>
               หากท่านต้องการส่งคำตอบ กรุณากดยืนยันเพื่อส่งคำตอบของ <u><?php if ($testType == "pre_test") {
                 echo 'แบบทดสอบก่อนเรียน';
               } else {
                 echo 'แบบทดสอบหลังเรียน';
               }
               ?>
              </u>
             </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="button" class="btn btn-primary" id="btn-submit">ยืนยัน</button>
          </div>
        </div>
      </div>
    </div>
</body>

</html>
