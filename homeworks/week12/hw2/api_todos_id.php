<?php
  require_once("conn.php");
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  

  $sql = "SELECT * FROM rafael_todos";
  $stmt = $conn->prepare($sql); 
  $result = $stmt->execute();

  if (!$result) {
    $json = array(
      "ok" => false,
      "massage" => $conn->error
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

  $result = $stmt->get_result();
  $todos = array();
  while($row=$result->fetch_assoc()) {
    array_push($todos, array(
      "id" => $row['id'],
      "todos" => $row['todos']
    ));
  }

  $json = array(
    "ok" => true,
    "todos" => $todos
  );
  $response = json_encode($json);
  echo $response;


?>


