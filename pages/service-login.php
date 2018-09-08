<?php
session_start();
require('connection.php');
if ($_POST) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM member WHERE email='$email' AND password='$password'";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) { //
    $data = $result->fetch_assoc();
    $obj["result"] = true;
    $obj["data"] = $data;
    // create session
    $_SESSION["email"] = $data["email"];
    
    echo json_encode($obj);
  } else {
    $obj["result"] = false;
    $obj["message"] = "ไม่พบข้อมูลผู้ใช้ในระบบ";
    echo json_encode($obj);
  }
}
