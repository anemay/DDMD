<?php
require 'connection.php';

if (isset($_POST["id"])) {
  $id = $_POST["id"];
  $show = $_POST["show"];
  $link = $_POST["link"];
  $slink = $_POST["slink"];
  $sql = "UPDATE video SET show_first=0";
  $result = $conn->query($sql);
  $sql = "UPDATE video SET link='$link',slink='$slink',show_first=$show WHERE test_id=$id";
  $result = $conn->query($sql);
  $response["result"] = true;
  echo json_encode($response);
}
 ?>
