<?php
require 'connection.php';
if ($_POST) {
  $topic = $_POST["topic"];
  $link = $_POST["link"];
  $slink = $_POST["slink"];
  $detail = $_POST["detail"];
  $json = $_POST["data"];

  //$json = json_decode($data, true);
  $response["result"] = false;
  $sql_insert_topic = "INSERT INTO test(topic, detail) values('$topic', '$detail')";
  if ($conn->query($sql_insert_topic) === TRUE) {
    $topic_last_id = $conn->insert_id;
    $sql_insert_video = "INSERT INTO video(link, slink, test_id) values('$link', '$slink', $topic_last_id)";
    $conn->query($sql_insert_video);
    foreach($json as $qa) { //foreach element in $arr
      $question = $qa["question"];
      $sql_insert_question = "INSERT INTO question(test_id, question) values($topic_last_id, '$question')";
      if ($conn->query($sql_insert_question) === TRUE) {
        $question_last_id = $conn->insert_id;
        $answers = $qa["choices"];
        foreach ($answers as $ch) {
          $correct = isset($ch["correct"]) ? 1 : 0;
          $ans = $ch["answer"];
          $sql_insert_answer = "INSERT INTO answer(question_id, answer, correct) values($question_last_id, '$ans', $correct)";
          $conn->query($sql_insert_answer);
        }
      }
      $response["result"] = true;
    }
  }
  echo json_encode($response);

}

 ?>
