<?php session_start();
require 'connection.php';
$topic="";
$link = "";
$slink = "";
$detail = "";
if (isset($_GET["id"])) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM test, video where test.id = $id and test.id = video.test_id";
  $result = $conn->query($sql);
    if ($result->num_rows > 0) { //
      $data = $result->fetch_assoc();
      $topic = $data["topic"];
      $detail = $data["detail"];
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
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                      <?php
                        if (isset($_GET["id"])) {
                          echo '<h1 class="page-header">แก้ไขแบบทดสอบ</h1>';
                        } else {
                          echo '<h1 class="page-header">เพิ่มแบบทดสอบ</h1>';
                        }
                       ?>
                    </div>
                    <div class="col-md-7">
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label for="" class="col-sm-2 control-label">ชื่อเรื่อง</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="idstory" value="<?=$topic;?>" placeholder="ชื่อเรื่อง">
                          </div>
                        </div>
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
                          <label for="" class="col-sm-2 control-label">รายละเอียด</label>
                          <div class="col-sm-10">
                            <textarea  type="text" class="form-control" id="detail"  value="<?=$detail;?>" placeholder="รายละเอียด" rows="6" style="resize: none;"><?= $detail; ?></textarea>
                          </div>
                        </div>
                      </form>
                    </div>

                    <div class="col-md-12" align="center">
                      <?php if (isset($_GET["id"])) {
                        echo '<button class="btn btn-primary" id="btn-update" type="button" data-toggle="modal" data-target="#modal-confirm">ยืนยันการแก้ไขแบบทดสอบ</button>';
                      } else {
                        echo '<button class="btn btn-primary" id="btn-confirm" type="button" data-toggle="modal" data-target="#modal-confirm">ยืนยันการสร้างแบบทดสอบ</button>';
                      }
                      ?>

                    </div>
                    <div class="col-md-12">
                      <?php if (!isset($_GET["id"])) { ?>
                      <h1 class="page-header">เพิ่มคำถามในแบบทดสอบ</h1>
                      <div class="col-md-12">
                          <div id="question-content">

                          </div>
                          <div class="col-md-6 center-vertical">
                            <button type="button" id="btn-add-question" class="btn btn-success btn-lg">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มคำถาม
                            </button>
                          </div>
                      </div>
                    <?php } else { ?>
                      <h1 class="page-header">แก้ไขคำถามในแบบทดสอบ</h1>
                      <div class="col-md-12">
                          <div id="question-content">
                            <?php
                              $sqlQuestion = "SELECT * FROM question WHERE test_id = $id";
                              $resultQuestion = $conn->query($sqlQuestion);
                              if ($resultQuestion->num_rows > 0) {
                                $topicNumber = 1;
                                while($row = $resultQuestion->fetch_assoc()) {
                                  $question = $row["question"];
                                  $qid = $row["id"];
                                  echo '<div class="col-md-6">';
                                  echo '<form class="form-horizontal">';
                                  echo '<div class="form-group">';
                                  echo '<label for="" class="col-sm-2 control-label">ข้อที่ '. $topicNumber .'</label>';
                                  echo '<div class="col-sm-9"><input type="text" class="form-control question-topic" id="" value="'.$question.'" placeholder="คำถามข้อที่ '. $topicNumber .'"></div>';
                                  echo '<input type="hidden" name="questionId'.$topicNumber.'" value="'.$qid.'">';
                                  echo '</div>';

                                  $sqlAnswer = "SELECT * FROM answer WHERE question_id = $qid";
                                  $resultAnswer = $conn->query($sqlAnswer);
                                  $answerNumber = 1;
                                  while($ans = $resultAnswer->fetch_assoc()) {
                                    $answer = $ans["answer"];
                                    $ansId = $ans["id"];
                                    $textNumber = "";
                                    $textEn = "";
                                    if ($answerNumber == 1) {
                                      $textNumber = "ก";
                                      $textEn = "A";
                                    } else if ($answerNumber == 2) {
                                      $textNumber = "ข";
                                      $textEn = "B";
                                    } else if ($answerNumber == 3) {
                                      $textNumber = "ค";
                                      $textEn = "C";
                                    } else if ($answerNumber == 4) {
                                      $textNumber = "ง";
                                      $textEn = "D";
                                    }

                                    $checked = "";
                                    if ($ans["correct"] == 1) {
                                      $checked = " checked";
                                    }
                                    echo '<div class="form-group">';
                                    echo '<label for="" class="col-md-3 control-label">'.$textNumber.'.</label>';
                                    echo '<div class="col-sm-6"><input type="text" class="form-control answer'.$textEn.'" id="" value="'.$answer.'" placeholder="คำถาม '.$textNumber.'"></div>';
                                    echo '<div class="col-sm-2"><div class="radio"><label><input type="radio" name="correct'.$topicNumber.'" id="optionsRadios1" value="'.($answerNumber - 1).'" '.$checked.'>ข้อถูก</label></div></div>';
                                    echo '<input type="hidden" name="correctId'.$topicNumber.'" value="'.$ansId.'">';
                                    echo '</div>';

                                    $answerNumber++;
                                  }

                                  echo '</form>';
                                  echo '</div>';
                                  $topicNumber++;
                                }
                              }
                             ?>
                          </div>
                          <div class="col-md-6 center-vertical">
                            <button type="button" id="btn-add-question" class="btn btn-success btn-lg">
                              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มคำถาม
                            </button>
                          </div>
                      </div>
                    <?php } ?>
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

      $('#btn-add-question').on('click', function(){
        var topiclength = $('.question-topic').length;
        var topicNumber = topiclength + 1;

        var mainContent = $('#question-content');
        var mainDiv = $('<div class="col-md-6"></div>').appendTo(mainContent);
        var mainForm = $('<form class="form-horizontal"></form>').appendTo(mainDiv);

        var divQuestion = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-sm-2 control-label">ข้อที่ '+topicNumber+'</label>').appendTo(divQuestion);
        $('<div class="col-sm-9"><input type="text" class="form-control question-topic" id="" placeholder="คำถามข้อที่ '+topicNumber+'"></div>').appendTo(divQuestion);

        var divAnswerA = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ก.</label>').appendTo(divAnswerA);
        $('<div class="col-sm-6"><input type="text" class="form-control answerA" id="" placeholder="คำถาม ก"></div>').appendTo(divAnswerA);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="correct'+topicNumber+'" id="optionsRadios1" value="0" checked>ข้อถูก</label></div></div>').appendTo(divAnswerA);

        var divAnswerB = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ข.</label>').appendTo(divAnswerB);
        $('<div class="col-sm-6"><input type="text" class="form-control answerB" id="" placeholder="คำถาม ข"></div>').appendTo(divAnswerB);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="correct'+topicNumber+'" id="optionsRadios1" value="1">ข้อถูก</label></div></div>').appendTo(divAnswerB);

        var divAnswerC = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ค.</label>').appendTo(divAnswerC);
        $('<div class="col-sm-6"><input type="text" class="form-control answerC" id="" placeholder="คำถาม ค"></div>').appendTo(divAnswerC);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="correct'+topicNumber+'" id="optionsRadios1" value="2">ข้อถูก</label></div></div>').appendTo(divAnswerC);

        var divAnswerD = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ง.</label>').appendTo(divAnswerD);
        $('<div class="col-sm-6"><input type="text" class="form-control answerD" id="" placeholder="คำถาม ง"></div>').appendTo(divAnswerD);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="correct'+topicNumber+'" id="optionsRadios1" value="3">ข้อถูก</label></div></div>').appendTo(divAnswerD);
      })

      $('#btn-confirm').on('click', function() {
        var arr = [];
        $('.question-topic').each(function(index){
          var num = index + 1;
          var questionTopic = $(this).val();
          var answerA = $('.answerA')[index].value;
          var answerB = $('.answerB')[index].value;
          var answerC = $('.answerC')[index].value;
          var answerD = $('.answerD')[index].value;
          var correctAns = $('input[name=correct'+num+']:checked').val();

          item = {}
          item["question"] = questionTopic;
          item["choices"] = [];

          a = {}
          a["answer"] = answerA;
          if (correctAns == 0) {
            a["correct"] = 1;
          }
          item["choices"].push(a);

          b = {}
          b["answer"] = answerB;
          if (correctAns == 1) {
            b["correct"] = 1;
          }
          item["choices"].push(b);

          c = {}
          c["answer"] = answerC;
          if (correctAns == 2) {
            c["correct"] = 1;
          }
          item["choices"].push(c);

          d = {}
          d["answer"] = answerD;
          if (correctAns == 3) {
            d["correct"] = 1;
          }
          item["choices"].push(d);
          arr.push(item);
        })

        var modalBody = $('#modal-body-confirm');
        modalBody.html('');

        var topic = $('#idstory').val();
        var link = $('#link').val();
        var slink = $('#slink').val();
        var detail = $('#detail').val();
        var error = 0;

        if (topic.trim() == "") {
          $('<div class="alert alert-danger" role="alert">- กรุณากรอกหัวข้อแบบทดสอบ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').hide();
          error++;
        }

        if (link.trim() == "") {
          $('<div class="alert alert-danger" role="alert">- กรุณาระบุลิงค์วิดิโอ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').hide();
          error++;
        }

        if (arr.length < 5) {
          $('<div class="alert alert-danger" role="alert">- กรุณาเพิ่มคำถามในแบบทดสอบอย่างน้อย 5 ข้อ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').hide();
          error++;
        }

        if (error == 0) {
          $('<div class="alert alert-success" role="alert">ข้อมูลครบถ้วน กรุณากดยืนยันในการสร้างแบบทดสอบ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').show();
        } else {

        }

        $('#btn-modal-confirm').on('click', function() {
          $.ajax({
            url: "service-test-add.php",
            type: "post",
            dataType: "json",
            data: {
              topic: topic,
              link: link,
              slink: slink,
              detail: detail,
              data: arr
            }, success: function(resp) {
              if (resp.result) {
                window.location = "show_test.php?title=บันทึกแบบทดสอบ&message=การบันทึกแบบทดสอบเสร็จสมบูรณ์";
              }
            }, error: function(error) {
              console.log(error);
            }
          })
        })
      })

      $('#btn-update').on('click', function() {
        var arr = [];
        $('.question-topic').each(function(index){
          var num = index + 1;
          var questionTopic = $(this).val();
          var questionId = $('input[name=questionId'+num+']').val();
          //console.log('qid: ' + questionId);
          var answerA = $('.answerA')[index].value;
          var answerB = $('.answerB')[index].value;
          var answerC = $('.answerC')[index].value;
          var answerD = $('.answerD')[index].value;

          var correctAns = $('input[name=correct'+num+']:checked').val();
          var correctId = $('input[name=correctId'+num+']').val();

          item = {}
          item["question"] = questionTopic;
          item["question_id"] = questionId;
          item["choices"] = [];

          a = {}
          a["answer"] = answerA;
          if (correctAns == 0) {
            a["correct"] = 1;
          }

          b = {}
          b["answer"] = answerB;
          if (correctAns == 1) {
            b["correct"] = 1;
          }

          c = {}
          c["answer"] = answerC;
          if (correctAns == 2) {
            c["correct"] = 1;
          }

          d = {}
          d["answer"] = answerD;
          if (correctAns == 3) {
            d["correct"] = 1;
          }


          $('input[name=correctId'+num+']').each(function(index) {
            if (index == 0) {
              a["id"] = $(this).val();
            } else if (index == 1) {
              b["id"] = $(this).val();
            } else if (index == 2) {
              c["id"] = $(this).val();
            } else {
              d["id"] = $(this).val();
            }
          })

          item["choices"].push(a);
          item["choices"].push(b);
          item["choices"].push(c);
          item["choices"].push(d);

          arr.push(item);
        })

        var modalBody = $('#modal-body-confirm');
        modalBody.html('');

        var topic = $('#idstory').val();
        var link = $('#link').val();
        var slink = $('#slink').val();
        var detail = $('#detail').val();
        var error = 0;

        if (topic.trim() == "") {
          $('<div class="alert alert-danger" role="alert">- กรุณากรอกหัวข้อแบบทดสอบ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').hide();
          error++;
        }

        if (link.trim() == "") {
          $('<div class="alert alert-danger" role="alert">- กรุณาระบุลิงค์วิดิโอ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').hide();
          error++;
        }

        if (arr.length < 5) {
          $('<div class="alert alert-danger" role="alert">- กรุณาเพิ่มคำถามในแบบทดสอบอย่างน้อย 5 ข้อ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').hide();
          error++;
        }

        if (error == 0) {
          $('<div class="alert alert-success" role="alert">ข้อมูลครบถ้วน กรุณากดยืนยันในการสร้างแบบทดสอบ</div>').appendTo(modalBody);
          $('#btn-modal-confirm').show();
        } else {

        }

        $('#btn-modal-update').on('click', function() {
          $.ajax({
            <?php
            if (isset($_GET["id"])) {
              $updateId = $_GET["id"];
              echo 'url: "service-test-update.php?id='.$updateId.'",';
            } else {
                echo 'url: "service-test-update.php",';
            } ?>
            type: "post",
            dataType: "json",
            data: {
              topic: topic,
              link: link,
              slink: slink,
              detail: detail,
              data: arr
            }, success: function(resp) {
              if (resp.result) {
                <?php
                if (isset($_GET["id"])) {
                  $updateId = $_GET["id"];
                  echo 'window.location = "test_add.php?title=แก้ไขแบบทดสอบ&message=แก้ไขแบบทดสอบเสร็จสมบูรณ์&id='.$updateId.'"';
                } else {
                  echo 'window.location = "test_add.php?title=แก้ไขแบบทดสอบ&message=แก้ไขแบบทดสอบเสร็จสมบูรณ์"';
                } ?>
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
            <h4 class="modal-title" id="myModalLabel">ยืนยันการสร้างแบบทดสอบ</h4>
          </div>
          <div class="modal-body" id="modal-body-confirm">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <?php if (isset($_GET["id"])) {
              echo '<button type="button" class="btn btn-primary" id="btn-modal-update">ยืนยัน</button>';
            } else {
              echo '<button type="button" class="btn btn-primary" id="btn-modal-confirm">ยืนยัน</button>';
            } ?>
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

</body>

</html>
