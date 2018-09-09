<?php
require 'connection.php';
if ($_POST) {
  $id = $_GET["id"];
  $topic = $_POST["topic"];
  $link = $_POST["link"];
  $slink = $_POST["slink"];
  $detail = $_POST["detail"];
  $json = $_POST["data"];

  //$json = json_decode($data, true);
  $response["result"] = true;
  $sql_update_topic = "UPDATE test SET topic = '$topic', detail = '$detail' WHERE id = $id";
  $sql_update_video = "UPDATE video SET link = '$link', slink = '$slink' WHERE test_id = $id";
  $conn->query($sql_update_topic);
  $conn->query($sql_update_video);
  foreach($json as $qa) {
    $question = $qa["question"];
    $questionId = $qa["question_id"];
    $sql_update_question = "UPDATE question SET question = '$question' WHERE id = $questionId";
    $conn->query($sql_update_question);
    $answers = $qa["choices"];
    foreach ($answers as $ch) {
      $correct = isset($ch["correct"]) ? 1 : 0;
      $ans = $ch["answer"];
      $ansid = $ch["id"];
      $sql_update_answer = "UPDATE answer SET answer = '$ans', correct = $correct WHERE id = $ansid";
      $conn->query($sql_update_answer);
    }
  }
  echo json_encode($response);

}

 ?>
