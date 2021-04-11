<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: index.php");
      exit;
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

   <?php include 'dbconnect.php'; ?>
   <?php
    $planid = $_GET['planid'];
    $query = "SELECT * FROM `incentive plan` WHERE IncentivePlanID='$planid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $plan_name = $row['Plan Name'];
    $cbase = $row['Commission Base'];
    $productid = $row['ProductID'];
    $quota = $row['Quota'];
    $ctime = $row['Commencement Time'];
    $isplanapproved = $row['isPlanApproved'];
   ?>

<div class="container pt-3">
            <form action="ceo.php" method="post">
                <div class="container pt-3 my-3 ">
                    <div class="row">
                        <?php
                          if($isplanapproved == 0){
                            echo '<div class="col-1">
                                <button type="submit" class="btn btn-primary" value="1" name="statusbutton">Approve</button>  
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-danger" value="2" name="statusbutton">Decline</button>
                            </div>';
                          }
                          else{
                            echo '<div class="col-1">
                                <button type="submit" class="btn btn-primary" disabled>Approve</button>  
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-danger" disabled>Decline</button>
                            </div>';
                          }
                        
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <?php
                            echo '<input type="hidden" name="planid" value=" ' . $planid . '" />'
                            ?>
                            <input class="form-control form-control-lg" name="plan_name" type="text" placeholder= "<?php echo " $plan_name  "; ?>" readonly> 
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cbase" class="col-sm-2 col-form-label">Commission Base</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cbase" id="cbase" placeholder= "<?php echo " $cbase  "; ?>" readonly>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="quota" class="col-sm-2 col-form-label">Quota</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="quota" id="quota" placeholder= "<?php echo " $quota  "; ?>" readonly>
                    </div>
                </div>
                                
                <div class="form-group row">
                    <label for="product" class="col-sm-2 col-form-label">Product</label>
                    <div class="col-sm-5">                     
                <?php
                    $query = "SELECT `Product Name` FROM `product` WHERE ProductID = '$productid' ";
                    $result = mysqli_query($conn, $query);                                  
                    $row = mysqli_fetch_assoc($result);
                    $product = $row['Product Name'];                    
                ?>
                    <input type="text" class="form-control" name="quota" id="quota" placeholder= "<?php echo " $product  "; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ctime" class="col-sm-2 col-form-label">Commencement Date</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="ctime" id="ctime" placeholder= "<?php echo " $ctime  "; ?>" readonly>
                    </div>
                </div>
            </form>
        </div>
       

    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>    
  </body>
</html>