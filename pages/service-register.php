<?php
require('connection.php');
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
    echo json_encode($json);
  } else {
    $json["message"] = "ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่อีกครั้ง";
    $json["error"] = $conn->error;
    $json["result"] = false;
    echo json_encode($json);
  }

  $mail_to = $email;
  $subject = "please confirm your email";

  $message = "
  <html>
    <head>
      <title>DDMD</title>
    </head>
    <body>
      <h3>Dear K. $name $lastname</h3>
      <h3>this email for verify your email for gotoknowdrugs, <a href='http://www.gotoknowdrugs.shareforproject.com/pages/service-verify.php?email=$email&id=$last_id' target='_blank'>click for verify</a></h3>
    </body>
  </html>
";
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  // More headers
  $headers .= 'From: <admin@ddmd.com>';

  mail($mail_to,$subject,$message,$headers);

}
