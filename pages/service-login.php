<?php
session_start();
require('connection.php');
if ($_POST) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "";
  $pos = strrpos($email, "@ddmd.com");
  if ($pos > 0) {
    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
  } else {
    $sql = "SELECT * FROM member WHERE email='$email' AND password='$password'";
  }

  $result = $conn->query($sql);
  if ($result->num_rows > 0) { //
    $data = $result->fetch_assoc();
    $obj["result"] = true;
    $obj["data"] = $data;
    // create session
    $_SESSION["member_id"] = $data["id"];
    $_SESSION["email"] = $data["email"];

    if ($pos > 0) {
      $_SESSION["admin"] = 1;
    }

    echo json_encode($obj);
  } else {
    $obj["result"] = false;
    $obj["message"] = "ไม่พบข้อมูลผู้ใช้ในระบบ";
    echo json_encode($obj);
  }
}
