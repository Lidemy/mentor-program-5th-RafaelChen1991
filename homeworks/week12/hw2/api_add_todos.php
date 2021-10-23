<?php
  require_once("conn.php");
  header('Content-type:application/json;charset=utf-8');
  header('Access-Control-Allow-Origin: *');


  if(empty($_POST['todos'])) {
    $json = array(
      "ok" => false,
      "message" => "there is no todos"
    );
    $response = json_encode($json);
    echo $response;
    die();
  } else {
    $todos = $_POST['todos'];
  }


  if (!empty($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE rafael_todos SET todos = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $todos, $id);
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

    $json = array(
      "ok" => true,
      "massage" => "success"
    );
    $response = json_encode($json);
    echo $response;

  } else {
    $sql = "INSERT INTO rafael_todos(todos) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $todos);
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
      $json = array(
        "ok" => true,
        "massage" => "success"
      );
      $response = json_encode($json);
      echo $response;

  }
?>


