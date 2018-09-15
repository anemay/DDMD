<?php
require 'connection.php';
if ($_POST) {
  $id = $_POST["id"];
  $name = $_POST["name"];
  $lastname = $_POST["lastname"];

  $sql = "UPDATE member SET name = '$name', lastname = '$lastname' WHERE id = $id";
  $conn->query($sql);
  $response["result"] = true;
  echo json_encode($response);
}
 ?>
