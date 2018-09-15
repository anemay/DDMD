<?php session_start(); ?>
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
    <style>
      .center-vertical {
        height: 200px;
        text-align:center;
        line-height:200px;
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
                <div class="col-lg-12">
                    <h1 class="page-header">เพิ่มแบบทดสอบ</h1>
                    <div id="question-content">

                    </div>
                    <div class="col-md-6 center-vertical">
                      <button type="button" id="btn-add-question" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มคำถาม
                      </button>
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
      $('#btn-add-question').on('click', function(){
        var mainContent = $('#question-content');
        var mainDiv = $('<div class="col-md-6"></div>').appendTo(mainContent);
        var mainForm = $('<form class="form-horizontal"></form>').appendTo(mainDiv);

        var divQuestion = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-sm-2 control-label">ข้อที่ 1</label>').appendTo(divQuestion);
        $('<div class="col-sm-9"><input type="text" class="form-control" id="" placeholder="คำถามข้อที่ 1"></div>').appendTo(divQuestion);

        var divAnswerA = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ก.</label>').appendTo(divAnswerA);
        $('<div class="col-sm-6"><input type="text" class="form-control" id="" placeholder="คำถาม ก"></div>').appendTo(divAnswerA);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>ข้อถูก</label></div></div>').appendTo(divAnswerA);

        var divAnswerB = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ข.</label>').appendTo(divAnswerB);
        $('<div class="col-sm-6"><input type="text" class="form-control" id="" placeholder="คำถาม ข"></div>').appendTo(divAnswerB);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">ข้อถูก</label></div></div>').appendTo(divAnswerB);

        var divAnswerC = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ค.</label>').appendTo(divAnswerC);
        $('<div class="col-sm-6"><input type="text" class="form-control" id="" placeholder="คำถาม ค"></div>').appendTo(divAnswerC);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">ข้อถูก</label></div></div>').appendTo(divAnswerC);

        var divAnswerD = $('<div class="form-group"></div>').appendTo(mainForm);
        $('<label for="" class="col-md-3 control-label">ง.</label>').appendTo(divAnswerD);
        $('<div class="col-sm-6"><input type="text" class="form-control" id="" placeholder="คำถาม ง"></div>').appendTo(divAnswerD);
        $('<div class="col-sm-2"><div class="radio"><label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1">ข้อถูก</label></div></div>').appendTo(divAnswerD);
      })
    </script>

</body>

</html>
