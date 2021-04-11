<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: index.php");
      exit;
  }

  include 'dbconnect.php';
  if (isset($_POST["sendmail"])){
    $saleid = $_POST["sendmail"];
      $query = "UPDATE `payment` SET `isConfirmationEmailSent`=1 WHERE `SaleID`='$saleid' ";
    $result = mysqli_query($conn, $query);
  }
  
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title> Welcome </title>
  </head>
  <body>
   <h1>Hello, Payable Manager!</h1> 

   
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="\images\magic brush.png" width="30" height="30">  
  </a>
  <!-- <a class="btn btn btn-outline-secondary" href="#" role="button">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
    </ul>
  </div>
   </nav>

   <div class="container pt-3">
        <form action="payablemanager.php" method="post">
            <div class="row">
                <table class="table table-striped" id="commissiontable">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col"> Select </th>
                    <th scope="col">Payment ID</th>
                    <th scope="col">Commission Status</th>
                    <th scope="col">Email Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `payment` ";
                    $result = mysqli_query($conn, $query);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        echo "<tr>
                        <th scope='row'> <div class='container pt-3 my-3'>
                            <button type='submit' class='btn btn-primary' name='sendmail' value='".$row['SaleID']."'>Send Email</button>
                        </th>
                        <td>".$row['PaymentID']."</td>
                        <td>";
                        if($row['isCommissionApproved'] == 0){
                          echo "<span class='badge badge-pill badge-primary'> Pending </span>";
                        }
                        elseif($row['isCommissionApproved'] == 1){
                          echo "<span class='badge badge-pill badge-success'> Approved </span>";
                        }
                        echo "</td>
                        <td>";
                        if($row['isConfirmationEmailSent'] == 0){
                          echo "<span class='badge badge-pill badge-primary'> Pending </span>";
                        }
                        elseif($row['isConfirmationEmailSent'] == 1){
                          echo "<span class='badge badge-pill badge-success'> Approved </span>";
                        }
                        echo "</td>                        
                        </tr>";
                        // echo '<input type="hidden" name="comm" value=" ' . $totalcom . '" />';
                        // echo '<input type="hidden" name="eid" value=" ' . $empid . '" />';
                    }
                    ?>
                </tbody>
                </table>
            </form>
        </div>
       

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
  </body>
</html>