<?php
require '../connection.php';
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
if ($_POST) {
  $email = $_POST["email"];
  $sql = "SELECT * FROM admin WHERE email = '$email'";
  $result = $conn->query($sql) or die('die');
  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $id = $data["id"];
    $name = $data["name"];
    $lastname = $data["lastname"];
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "gotoknowdrugs@gmail.com";
    $mail->Password = "anemay1016";
    $mail->setFrom('gotoknowdrugs@gmail.com', 'GotoKnowDrugs');
    $mail->addAddress("gotoknowdrugs@gmail.com", $name . " " . $lastname);
    $mail->Subject = 'reset password';
    $mail->msgHTML("
    <html>
      <head>
        <title>gotoknowdrugs</title>
      </head>
      <body>
        <h3>Dear K. $name $lastname</h3>
        <h3><a href='http://www.gotoknowdrugs.shareforproject.com/pages/admin/update_password.php?email=$email&id=$id' target='_blank'>click for reset password</a></h3>
      </body>
    </html>
    ");
    if (!$mail->send()) {
      $resp["verify"] = "ระบบไม่สามารถส่งการยืนยันอีเมล์ได้";
    } else {
      $resp["verify"] = "ระบบส่งการยืนยันอีเมล์สำเร็จ";
    }
    $resp["result"] = true;
    $resp["message"] = "กรุณาตรวจสอบอีเมล์ gotoknowdrugs@gmail.com เพื่อทำการเปลี่ยนรหัสผ่าน";
  } else {
    $resp["result"] = false;
    $resp["message"] = "ไม่พบอีเมล์ในระบบ กรุณาสมัครสมาชิกใหม่อีกครั้ง";
  }
  echo json_encode($resp);
}
 ?>
