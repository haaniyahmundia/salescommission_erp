<?php
  session_start();

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
      header("location: index.php");
      exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Create Plan </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
    </head>

    <body>
    <?php include 'components\_navbarsales.php' ?>;        
    <?php include 'dbconnect.php' ?>;        
        <div class="container pt-3">
            <form action="hos_plan_dashboard.php" method="post">
                <div class="container pt-3 my-3">
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Send For Approval</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input class="form-control form-control-lg" name="plan_name" type="text" placeholder="Plan Name"> 
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cbase" class="col-sm-2 col-form-label">Commission Base</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cbase" id="cbase">
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="quota" class="col-sm-2 col-form-label">Quota</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="quota" id="quota">
                    </div>
                </div>
                                
                <div class="form-group row">
                    <label for="product" class="col-sm-2 col-form-label">Product</label>
                    <div class="col-sm-5">
                    <select class="form-control" id="product" name="product">
                        <option selected>Choose Product</option> 
                <?php
                    $query = "SELECT `Product Name` FROM `product` ";
                    $result = mysqli_query($conn, $query);                                  
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option>".$row['Product Name']."</option>";
                    }
                ?>
                    </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ctime" class="col-sm-2 col-form-label">Commencement Date</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" name="ctime" id="ctime">
                    </div>
                </div>
            </form>
        </div>

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    
</html>