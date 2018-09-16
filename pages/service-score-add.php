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
  $check = [];
  foreach($json as $qa) {
    $qid = $qa["question"];
    $answerId = $qa["answer"];
    $sql_select_score = "SELECT * FROM question, answer WHERE answer.id = $answerId and answer.question_id = $qid and question.id = answer.question_id";
    $result = $conn->query($sql_select_score);
    if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $item = [];
      $item["question"] = $data["question"];
      if ($data["correct"] == 1) {
        $score++;
      }
      $item["correct"] = $data["correct"];
      array_push($check, $item);
    }
  }
  if (!isset($_SESSION["admin"])) {
    $score_type = $testType == "pre_test" ? 1 : 2;
    $sql_insert_score = "INSERT INTO score(member_id, test_id, score, score_type, time) values($memberId, $testId, $score, $score_type, $testTime)";
    $result = $conn->query($sql_insert_score);
  }
  $response["result"] = true;
  $response["score"] = $score;
  $response["check"] = $check;
  echo json_encode($response);
}

 ?>
