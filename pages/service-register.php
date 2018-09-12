<?php
require('connection.php');
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

if ($_POST) {
  $idcard = $_POST["idcard"];
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];
  $age = $_POST["age"];
  $sex = $_POST["sex"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $prefix = $_POST["prefix"];

  // คำสั่งเพิ่มข้อมูล
  $sql = "INSERT INTO member(idcard, prefix, name, lastname, age, sex, email, password)";
  $sql .= " VALUES('$idcard', $prefix, '$name', '$lastname', '$age', $sex, '$email', '$password')";
  $last_id = "";
  if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $json["message"] = "สมัครสมาชิกเสร็จสมบูรณ์";
    $json["result"] = true;

  } else {
    $json["message"] = "ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่อีกครั้ง";
    $json["error"] = $conn->error;
    $json["result"] = false;
  }

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
  $mail->addAddress($email, $name . " " . $lastname);
  $mail->Subject = 'verify email gotoknowdrugs';
  $mail->msgHTML("
  <html>
    <head>
      <title>gotoknowdrugs</title>
    </head>
    <body>
      <h3>Dear K. $name $lastname</h3>
      <h3>this email is verify your personal for gotoknowdrugs, <a href='http://www.gotoknowdrugs.shareforproject.com/pages/service-verify.php?email=$email&id=$last_id' target='_blank'>click for verify</a></h3>
    </body>
  </html>
");

  if (!$mail->send()) {
    $json["verify"] = "ระบบไม่สามารถส่งการยืนยันอีเมล์ได้";
  } else {
    $json["verify"] = "ระบบส่งการยืนยันอีเมล์สำเร็จ";
  }

  echo json_encode($json);

}
