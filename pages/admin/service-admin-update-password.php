<?php
require '../connection.php';
if ($_POST) {
  $id = $_POST["id"];
  $password = $_POST["password"];
  $sql = "UPDATE admin SET password = '$password' WHERE id = $id";
  $conn->query($sql);
  $resp["message"] = "เปลี่ยนรหัสผ่านสำเร็จ";
  $resp["result"] = true;
  echo json_encode($resp);
}
 ?>
