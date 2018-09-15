<?php
require 'connection.php';
if ($_POST) {
  $testId = $_POST["id"];
  $sql_select_question = "SELECT * FROM question WHERE test_id = $testId";
  $resultQuestion = $conn->query($sql_select_question);
  if ($resultQuestion->num_rows > 0) {
    while ($question = $resultQuestion->fetch_assoc()) {
      $qid = $question["id"];
      $sql_delete_answer = "DELETE FROM answer WHERE question_id = $qid";
      $conn->query($sql_delete_answer) or Die("die: " . $sql_delete_video);
    }
    $sql_delete_video = "DELETE FROM video WHERE test_id = $testId";
    $sql_delete_question = "DELETE FROM question WHERE test_id = $testId";
    $sql_delete_test = "DELETE FROM test WHERE id = $testId";
    $conn->query($sql_delete_video) or Die("die: " . $sql_delete_video);
    $conn->query($sql_delete_question) or Die("die: " . $sql_delete_question);
    $conn->query($sql_delete_test) or Die("die: " . $sql_delete_test);
    $resp["result"] = true;
    echo json_encode($resp);
  }
}
 ?>
