<?php
require 'connection.php';

if ($_GET) {
  $email = $_GET["email"];
  $id = $_GET["id"];
  $sql = "UPDATE member SET status = 1 WHERE email = '$email' and id = $id";
  $conn->query($sql);
  header('Location: index.php?title=ยืนยันอีเมล์&message=ยืนยันอีเมล์เสร็จสิ้น ท่านสมารถเข้าสู่ระบบได้ทันที');
}
header('Location: index.php?title=ยืนยันอีเมล์&message=ไม่สามารถยืนยันอีเมล์ได้ กรุณาลองใหม่อีกครั้ง');


 ?>
