<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: index.php");
      exit;
  }
  include 'dbconnect.php';
  
   if (isset($_POST["statusbutton"]))
   {
       $isplanapproved = $_POST["statusbutton"];
       $planid = $_POST["planid"];
       $query = "UPDATE `incentive plan` SET `isPlanApproved`='$isplanapproved' WHERE `IncentivePlanID` = '$planid' ";
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
<!-- NAVBAR STARTS HERE -->
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
<!-- <?php  ?> -->

<div class="container pt-3 my-3">
            <div class="formgroup row">
                  <div class="col-sm-2 ">
                  <select class="form-control" id="status" name="status">
                    <option >View All</option> 
                    <option selected>Pending</option> 
                    <option >Approved</option> 
                    <option >Declined</option> 
                  </select>
                  </div>
                <!-- <div class="col">
                <a href="reviewplan.php" class="btn btn-info" role="button">Create New</a>
                </div> -->
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
            <td> <a id='link' href='reviewplan.php?planid=".$row['IncentivePlanID']."'>".$row['IncentivePlanID']."</a> </td>
            <td> <a id='link' href='reviewplan.php?planid=".$row['IncentivePlanID']."'>".$row['Plan Name']."</td>
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