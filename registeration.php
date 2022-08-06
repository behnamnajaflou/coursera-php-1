<?php
include 'db.php' ;

$nameError = "";
$emailError = "";

if(isset($_POST['submit'])){
  //name validation
  if(empty($_POST['name'])){
    $nameError = "<p>Please fill name box</p>";
  }
  else{
    if(!preg_match("/^[a-zA-Z ]*$/", $_POST['name'])){
      $nameError = "<p>Please fill NNName with only letter</p>";
    }
  }
  //email validation
  if(empty($_POST['email'])){
    $nameError = "<p>Please fill EEEmail box</p>";
  }
  else{
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $emailError = "<p>Email address is not valid</p>";
    }
  }
  if($nameError == "" && $emailError == ""){
    $stmt = $pdo->prepare('INSERT INTO users
    (email, password, name) VALUES ( :em, :ps, :nm)');
    $arrayInfo =  array(
      ':em' => htmlentities($_POST['email']),
      ':ps' => htmlentities($_POST['password']),
      ':nm' => htmlentities($_POST['name'])
    ); 
    $user = htmlentities($_POST['name']);
    if($stmt->execute($arrayInfo))  {
       echo 'Dear <span style="color:red">'. $user .'</span> Thanks for your registeration. Please go <a href="login.php"> back </a> for login';
    };
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
    <h1>Registeration</h1>
    <div class="content">
      <div class="input-field">
        <input type="email" placeholder="Email" autocomplete="nope" name="email">
        <p><?php echo $emailError ?></p>
      </div>
      <div class="input-field">
        <input type="name" placeholder="name" autocomplete="name" name="name">
        <p><?php echo $nameError ?></p>
      </div>
      <div class="input-field">
        <input type="password" placeholder="Password" autocomplete="new-password"  name="password">
      </div>
    </div>
    <div class="action">
      <input class="button" type="submit" value="Register" name="submit"/>
    </div>
  </form>
</div>
<!-- partial -->
  <script  src="./script.js"></script>
</body>
</html>
