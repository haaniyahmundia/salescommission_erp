<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: index.php");
      exit;
  }

  include 'dbconnect.php';
//   if (isset($_POST["approve"])){
//     $saleid = $_POST["approve"];
//     $totalcom = $_POST['comm'];
//     $empid = $_POST['eid'];
//     $query = "UPDATE `payment` SET `Commission Amount`='$totalcom',`isCommissionApproved`=1 WHERE `SaleID`='$saleid' ";
//     $result = mysqli_query($conn, $query);
//     header("location: commissiondetails.php?empid=".$empid."");

//   }
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

   
   <?php
    $empid = $_GET['empid'];
    $query = "SELECT `First Name`, `Last Name` FROM `employee` WHERE EmployeeID='$empid' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
   ?>

   <div class="container pt-3">
        <form action="hos.php" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="empid" type="text" placeholder= "<?php echo " $empid  "; ?>" readonly>    
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="empname" type="text" placeholder= "<?php echo $row['First Name'] ." ". $row['Last Name']; ?>" readonly>    
                    </div>
                </div>
            </div>
            <div class="row">
                <table class="table table-striped" id="commissiontable">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col"> Select </th>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity Sold</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Total COGS</th>
                    <th scope="col">Quota</th>
                    <th scope="col">Commission Base</th>
                    <th scope="col">Total Commission</th>
                    <!-- <th scope="col">Status</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM `sale` WHERE `EmployeeID`='$empid' ";
                    $result = mysqli_query($conn, $query);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        echo "<tr>
                        <th scope='row'> <div class='container pt-3 my-3'>
                            <button type='submit' class='btn btn-primary' name='approve' value='".$row['SaleID']."'>Approve</button>
                        </th>
                        <td>".$row['ProductID']."</td>";
                        $productid = $row['ProductID'];              
                        $query = "SELECT `Product Name` FROM `product` WHERE `ProductID`='$productid' ";
                        $res = mysqli_query($conn, $query);
                        $r = mysqli_fetch_assoc($res);
                        echo "<td>".$r['Product Name']."</td>
                        <td>".$row['Quantity']."</td>
                        <td>".$row['Unit Price']."</td>";
                        $cogs = $row['Quantity'] * $row['Unit Price'];
                        echo "<td>".$cogs."</td>";
                        $saleid = $row['SaleID'];
                        $query = "SELECT `IncentivePlanID`, `Commission Amount`, `isCommissionApproved` FROM `payment` WHERE `SaleID`= '$saleid' ";
                        $res = mysqli_query($conn, $query);
                        $r = mysqli_fetch_assoc($res);
                        $planid = $r['IncentivePlanID'];
                        $query = "SELECT `Commission Base`, `Quota`, `isPlanApproved` FROM `incentive plan` WHERE `IncentivePlanID`= '$planid' ";
                        $res = mysqli_query($conn, $query);
                        $r = mysqli_fetch_assoc($res);
                        $isplanapproved = $r['isPlanApproved'];
                        echo "<td>".$r['Quota']."</td>
                        <td>".$r['Commission Base']."</td>";
                        if($isplanapproved == 1 && $row['Quantity'] >= $r['Quota']){
                            $totalcom = $cogs * $r['Commission Base'] / 100;
                        }
                        else{
                            $totalcom = 0;
                        }
                        echo "<td>".$totalcom."</td>
                        </tr>";
                        echo '<input type="hidden" name="comm" value=" ' . $totalcom . '" />';
                        echo '<input type="hidden" name="eid" value=" ' . $empid . '" />';
                    }
                    ?>
                </tbody>
                </table>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
  </body>
</html>