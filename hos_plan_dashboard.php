<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: index.php");
      exit;
  }
  include 'dbconnect.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $plan_name = $_POST['plan_name'];
    $cbase = $_POST['cbase'];
    $product = $_POST['product'];
    $quota = $_POST['quota'];
    $ctime = $_POST['ctime'];

    //echo " $product ";

    $query = "SELECT * FROM `product` WHERE `Product Name`= '$product' ";
    $result = mysqli_query($conn, $query);
    //$num = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    
    $productid = $row['ProductID'];
    // echo " $num ";
    // echo " $productid ";


    $query = "INSERT INTO `incentive plan`(`ProductID`, `Plan Name`, `Commencement Time`, `Commission Base`, `Quota`, `isPlanApproved`) 
    VALUES ('$productid','$plan_name','$ctime','$cbase','$quota', 0) ";
    $result = mysqli_query($conn, $query);
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
    <?php include 'components\_navbarsales.php' ?>;
        <div class="container pt-3 my-3">
            <div class="row">
                <div class="col">
                <a href="newplan.php" class="btn btn-info" role="button">Create New</a>
                </div>
            </div>
        </div>
        <div class="container">
        <table class="table table-striped" id="plantable">
      <thead class="thead-dark">
        <tr>
          <th scope="col"> </th>
          <th scope="col">Plan ID</th>
          <th scope="col">Plan Name</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT `IncentivePlanID`, `Plan Name`, `isPlanApproved` FROM `incentive plan`";
        $result = mysqli_query($conn, $query);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>".$sno."</th>
            <td>".$row['IncentivePlanID']."</td>
            <td>".$row['Plan Name']."</td>
            <td>";
            if($row['isPlanApproved'] == 0){
                echo "<span class='badge badge-pill badge-primary'> Pending </span>";
            }
            elseif($row['isPlanApproved'] == 1){
                echo "<span class='badge badge-pill badge-success'> Approved </span>";
            }
            elseif($row['isPlanApproved'] == 2){
                echo "<span class='badge badge-pill badge-danger'> Declined </span>";
            }
            echo "</td>
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