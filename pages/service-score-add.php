<?php
session_start();
require 'connection.php';

if ($_POST) {
  $testId = $_POST["test_id"];
  $testType = $_POST["test_type"];
  $testTime = $_POST["test_time"];
  $json = $_POST["data"];
  $memberId = $_SESSION["member_id"];

  $score = 0;
  foreach($json as $qa) {
    $qid = $qa["question"];
    $answerId = $qa["answer"];
    $sql_select_score = "SELECT id FROM answer WHERE id = $answerId and question_id = $qid and correct = 1";
    $result = $conn->query($sql_select_score);
    if ($result->num_rows > 0) {
      $score++;
    }
  }
  $score_type = $testType == "pre_test" ? 1 : 2;
  $sql_insert_score = "INSERT INTO score(member_id, test_id, score, score_type, time) values($memberId, $testId, $score, $score_type, $testTime)";
  $result = $conn->query($sql_insert_score);
  $response["result"] = true;
  echo json_encode($response);
}

 ?>
