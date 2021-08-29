<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");


  $sql = "SELECT * FROM rafael_users AS U ORDER BY U.user_id DESC";
  $stmt = $conn->prepare($sql);
  $result = $stmt->execute();
  


  if(!$result) {
    die("error: ". $conn->error);
  }

  $result = $stmt->get_result();

  
?>
<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <title>留言板</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header class="warning">
    注意!本站為練習用網站，因教學用途刻意忽略資安的實作，註冊時請勿使用任何真實的帳號或密碼。
  </header>
  <div class="comment-area">
    <div class="btn">
      <a class="comment-btn" href="index.php">回主頁</a>
      <a class="comment-btn" href="logout.php">登出</a>  
    </div>
    <h2>帳號管理</h2>
    <div class="admin__rule">帳號管理規則: 管理員(role:2), 一般使用者(role:1), 已停權使用者(role:0)</div>

    <table width="auto" height="20" border="1" class="admin__table">
      <tr> 
      <td> <center><strong> Username </strong></center></td> 
      <td> <center><strong> role </strong></center></td> 
      <td> <center><strong> chanege_role </strong></center></td> 
      </tr> 
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr> <td> <?php echo escape($row['username']); ?></td> 
        <td><center> <?php echo escape($row['role']); ?> </center></td> 
        <td> 
          <a href="handle_update_role.php?role=1&id=<?php echo escape($row['user_id']); ?>"> 一般使用者</a>
          <a href="handle_update_role.php?role=0&id=<?php echo escape($row['user_id']); ?>"> 停權使用者</a>
          <a href="handle_update_role.php?role=2&id=<?php echo escape($row['user_id']); ?>"> 管理員</a>
        </td> 
      </tr><?php } ?>
    </table>

  </div>
</body>
</html>