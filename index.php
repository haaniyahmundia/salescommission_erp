<?php 
  $login = false;
  $showError = false;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include 'dbconnect.php';
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employee WHERE EmployeeID='$userid' AND password='$password' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
      $login = true;
      $query = "SELECT `First Name`, `Last Name`, `DepartmentID`, `JobID` FROM `employee` WHERE EmployeeID='$userid' ";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      //$f_name = $row['First Name'];
      //$l_name = $row['Last Name'];
      //echo "You have logged in";
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['userid'] = $userid;
      $_SESSION['fname'] = $row['First Name'];
      $_SESSION['lname'] = $row['Last Name'];
      if($row['DepartmentID'] == 1 && $row['JobID'] == 1){
        header("location: hos.php");
      }
      elseif($row['DepartmentID'] == 2 && $row['JobID'] == 3) {
        header("location: payablemanager.php");
      }
      elseif($row['DepartmentID'] == 3 && $row['JobID'] == 4) {
        header("location: ceo.php");
      }
      else{
        header("location: welcome.php");   
      }         
    }
    else{
      $showError = "Invalid Credentials";
      echo "<br> $showError";
    }
    
  }
  

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title> Login </title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <div class="container">
      <form action='index.php' method="post">
        <div class="form-group">
          <label for="userid">User ID</label>
          <input type="text" class="form-control" id="userid" name="userid" placeholder="Enter User ID">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
      </form>
    </div>
    

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
  </body>
</html>

