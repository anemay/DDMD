<?php
require 'connection.php';
if (isset($_POST["id"])) {
  $id = $_POST["id"];
  $sql = "UPDATE member SET status=1 WHERE id=$id";
  $result = $conn->query($sql);
  $response["result"] = true;
  echo json_encode($response);
}
 ?>
