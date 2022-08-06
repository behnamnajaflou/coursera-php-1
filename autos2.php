<?php
session_start();
if(!$_SESSION['username']){
  header('location: login.php');
  die();
}
include 'db.php' ;

// $stmt = $pdo->prepare('INSERT INTO autos
//   (make, year, mileage) VALUES ( :mk, :yr, :mi)');

// $mk = isset($_POST['Make']) ? $_POST['Make'] : '';
// $yr = isset($_POST['Year']) ? $_POST['Year'] : '';
// $mi = isset($_POST['Mileage']) ? $_POST['Mileage'] : '';

// $stmt->execute(array(
//   ':mk' => htmlentities($mk),
//   ':yr' => htmlentities($yr),
//   ':mi' => htmlentities($mi)
// ));
 /////from registeration

 $makeError = "";
 $yearError = "";

 if(isset($_POST['submit_insert'])){
    //name validation
    if(empty($_POST['Make'])){
      $makeError = "<p>Please fill the name of factory</p>";
    }
    else{
      if(!preg_match("/^[a-zA-Z ]*$/", $_POST['Make'])){
        $makeError = "<p>Please fill the Make box with only letter</p>";
      }
    }
    //year validation
    if(empty($_POST['Year'])){
      $yearError = "<p>Please fill the date of production</p>";
    }
    else{
        if(!preg_match("/^[0-9 ]*$/", $_POST['Year'])){
          $yearError = "<p>Please fill the Year box with just the numbers</p>";
        }
      }
    if($makeError == "" && $yearError == ""){
        $mk = isset($_POST['Make']) ? $_POST['Make'] : '';
        $yr = isset($_POST['Year']) ? $_POST['Year'] : '';
        $mi = isset($_POST['Mileage']) ? $_POST['Mileage'] : '';

        $stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
      
        $stmt->execute(array(
        ':mk' => htmlentities($mk),
        ':yr' => htmlentities($yr),
        ':mi' => htmlentities($mi)
      ));
    }
  }    
  
 //end of regis
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Behnam Najafloo</title>
    <link rel="stylesheet" href="newstyle.css">
    <style>
      .session {
        width: auto;
        height: 30px;
        background-color: white;
        margin-bottom: 20px ;
      }
      td{
        width: 160px;
        height: 30px;
      }
      .inser{
        margin-bottom: 20px ;
        background-color: lightblue;
      }
    </style>
</head>
<body>
    <div class="session">
      <table>
        <tr>
          <td>
            <?php echo $_SESSION['username'] ?>
          </td>
          <td>
            <a href="logout.php">Log out</a>
          </td>
        </tr>
      </table>
    </div>
    <div class="logBox">
      <div class="inser">
        <?php echo $makeError ?>
        <br>
        <?php echo $yearError ?>
        <form action="" method="post">
          <table>
            <tr>
              <td>Make:</td>
              <td><input type="text" name="Make"></td>
            </tr>
            <tr>
              <td>Year:</td>
              <td><input type="text" name="Year"></td>
            </tr>
            <tr>
              <td>Maileage:</td>
              <td><input type="text" name="Mileage"></td>
            </tr>
            <tr>
              <td><input type="submit" value="Insert" name="submit_insert"></td>
              <td></td>
            </tr>
          </table>
        </form>
      </div>
      <div class="show">
        <?php
            $sql = 'select * from autos';
            $result = $pdo->query($sql);
            ?>
            <table>
                <tr>
                    <td>Brand</td><td>Model</td><td>Mile-Age</td>
                </tr>
            <?php
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                ?>
                <tr>
                    <td><?php echo $row['make'] ;?></td>
                    <td><?php echo $row['year'] ;?></td>
                    <td><?php echo $row['mileage'] ;?></td>
                </tr>
            <?php 
            }           
        ?>
        </table>
      </div>
    </div>
</body>
</html>
