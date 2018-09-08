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
  $sql .= " VALUES('$idcard', $prefix, '$name', '$lastname', $age, $sex, '$email', '$password')";

  if ($conn->query($sql) === TRUE) {
    $json["message"] = "สมัครสมาชิกเสร็จสมบูรณ์";
    $json["result"] = true;
    echo json_encode($json);
  } else {
    $json["message"] = "ไม่สามารถสมัครสมาชิกได้ กรุณาลองใหม่อีกครั้ง";
    $json["error"] = $conn->error;
    $json["result"] = false;
    echo json_encode($json);
  }

}
