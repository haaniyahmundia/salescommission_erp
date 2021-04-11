<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: index.php");
      exit;
  }

  include 'dbconnect.php';
  if (isset($_POST["approve"])){
    $saleid = $_POST["approve"];
    $totalcom = $_POST['comm'];
    $empid = $_POST['eid'];
    $query = "UPDATE `payment` SET `Commission Amount`='$totalcom',`isCommissionApproved`=1 WHERE `SaleID`='$saleid' ";
    $result = mysqli_query($conn, $query);
  }
  
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      #link { color: #000000; }
    </style>

    <title> Welcome </title>
  </head>
  <body>
   <h1>Hello,  <?php echo $_SESSION['fname'] ." ". $_SESSION['lname']; ?>!</h1> 
   <?php include 'components\_navbarsales.php' ?>;

   <div class="container pt-3 my-3">
            <div class="row">
                <div class="col">
                <a href="#" class="btn btn-info" role="button">Create New</a>
                </div>
            </div>
        </div>
        <div class="container">
        <table class="table table-striped" id="plantable">
      <thead class="thead-dark">
        <tr>
          <th scope="col"> </th>
          <th scope="col">SalesPerson ID</th>
          <th scope="col">SalesPerson Name</th>
          <th scope="col">Sales Commission</th>
          <!-- <th scope="col">Status</th> -->
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT `EmployeeID`, `First Name`, `Last Name`, `Total Commission` FROM `employee` WHERE `JobID`=2 ";
        $result = mysqli_query($conn, $query);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>".$sno."</th>
            <td> <a id='link' href='commissiondetails.php?empid=".$row['EmployeeID']."'>".$row['EmployeeID']."</td>
            <td> <a id='link' href='commissiondetails.php?empid=".$row['EmployeeID']."'>".$row['First Name']." ".$row['Last Name']."</td>
            <td>".$row['Total Commission']."</td>
            </tr>";
        }
        ?>
      </tbody>
    </table>
    </div>


       

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
  </body>
</html>