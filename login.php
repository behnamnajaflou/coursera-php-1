<?php
session_start();
require_once "db.php";
$msgError = "";
$msgIncorrect = "";
$badEmail = "";
// p' OR '1' = '1
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ( isset($_POST['email']) && isset($_POST['password'])  ) {
    //echo("<p>Handling POST data...</p>\n");
    if(empty($_POST['email'] && $_POST['password'])){
      $msgError = '<p style="color:red">Both Email and password are required</p>';
    }
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $badEmail = '<p style="color:red">Email must have an at-sign (@)</p>';
    }
    else{
      $e = htmlentities($_POST['email']);
      $p = htmlentities($_POST['password']);
  
      $sql = "SELECT name FROM users
         WHERE email = '$e'
         AND password = '$p'";
  
      //echo "<p>$sql</p>\n";
  
      $stmt = $pdo->query($sql);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
      if ( $row === FALSE ) {
         $msgIncorrect = '<h4 style="color:red">Username or Password is incorrect.</h4>';
         //error_log("Oracle database not available!", 0);
         //error_log("Oh no! We are out of FOOs!", 1, "$row['name']");
         //error_log("You messed up!", 3, "/var/tmp/my-errors.log");
      } else {
         //echo "<p>Login success.</p>\n";
         header('location: autos2.php?name='.urlencode($row['name']));
         $_SESSION['username'] = $row['name'];
      }
    }
}
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Behnam Najafloo</title>
  <link rel="stylesheet" href="newstyle.css">
</head>
<body>
<div class="login-form">
  <form method="post">
    <h1>Login</h1>
    <div class="content">
    <p><?php echo $msgIncorrect ?></p>
    <p><?php echo $msgError ?></p>
      <div class="input-field">
        <input type="email" placeholder="Email" autocomplete="nope" name="email">
        <p><?php echo $badEmail ?></p>
      </div>
      <div class="input-field">
        <input type="password" placeholder="Password" autocomplete="new-password"  name="password">
      </div>
    </div>
    <div class="action">
      <a class="registeration" href="registeration.php">Register</a>
      <input class="button" type="submit" value="Sign In"/>
    </div>
  </form>
</div>
<!-- partial -->
  <script  src="./script.js"></script>
</body>
</html>
