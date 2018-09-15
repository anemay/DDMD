<?php
require 'connection.php';
if ($_POST) {
  $id = $_POST["id"];
  $password = $_POST["password"];
  $sql = "UPDATE member SET password = '$password' WHERE id = $id";
  $conn->query($sql);
  $resp["message"] = "เปลี่ยนรหัสผ่าน";
  $resp["result"] = true;
  echo json_encode($resp);
}
 ?>
