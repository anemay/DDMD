<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Administrator</title>

    <style>
    .container, .row {
      height: 100%;
      min-height: 100%;
    }

    html, body {
      height: 100%;
    }
    * {
      box-sizing: border-box;
    }

    .background-image {
      background-image: url('../img/admin-bg.jpg');
      background-size: cover;
      display: block;
      filter: blur(5px);
      -webkit-filter: blur(5px);
      height: 800px;
      left: 0;
      position: fixed;
      right: 0;
      z-index: 1;
    }

    .content {
      background: rgba(255, 255, 255, 0.35);
      border-radius: 3px;
      box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      top: 10px;
      left: 0;
      position: fixed;
      margin-left: 20px;
      margin-right: 20px;
      right: 0;
      z-index: 2;
      padding: 0 10px;
    }
    </style>

  </head>
  <body>
    <div class="container">
      <div class="background-image"></div>
      <div class="row justify-content-center align-items-center content">
        <form style="width: 30%">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">ห้ามเปิดเผยอีเมล์นี้กับผู้อื่น</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password">
          </div>
          <div class="form-group text-right">
            <a href="../index.php">กลับหน้าหลัก</a>
            <a href="form-forgotpassword.php">ลืมรหัสผ่าน</a>
          </div>
          <div class="form-group text-center">
            <button type="button" id="btn-login" class="btn btn-primary">เข้าสู่ระบบ</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>

  <script>
    $('#btn-login').on('click', function() {
      var email = $('#email').val();
      var password = $('#password').val();
      $.ajax({
        url: "../service-login.php",
        type: "POST",
        dataType: "JSON",
        data: {
          "email": email,
          "password": password,
        }, success: function(resp) {
          console.log(resp);
          if (resp.result == true) {
              window.location = "../index.php";
          } else {
            alert('รหัสผ่านไม่ถูกต้อง');
          }
        }, error: function(error) {

        }
      })
    })
  </script>

</html>
