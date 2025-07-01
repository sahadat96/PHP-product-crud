<?php
  require('db_connection.php');

  //Session
  session_start();

   $first_name = $_SESSION['first_name'];
   $last_name  = $_SESSION['last_name'];

   if(!empty($first_name) && !empty ($last_name) ){

    //fetch data from product table
       $sql3 ="SELECT * FROM  product";
       $query3 = $conn->query($sql3);
      
        $data_list = array();

        while($row3 = mysqli_fetch_assoc($query3)){
          	       $product_id2   = $row3['product_id']; 
          	       $product_name2 = $row3['product_name'];
          	       
          	 $data_list[$product_id2] = $product_name2;    
          }
?>
				
<!DOCTYPE html>
<html>
 <head>
 	<title>Report</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
 </head>
 <body>
<div class="container bg-light">
          <div class="container-foulid border-bottom border-info"><!--topbar-->
             <?php include('topbar.php');?>
          </div>
          <div class="container-foulid">
              <div class="row">
                 <div class="col-sm-3 bg-light p-0 m-0"><!--leftbar-->
                     <?php include('leftbar.php'); ?>
                 </div> <!--end of left-->
                  <div class="col-sm-9"><!--rightbar-->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <h3>Store Product</h3>
                    <label>Select Product Name: </label><br>
                      <select name="product_name">
                         <?php    
                             $sql   = "SELECT * FROM product ";
                             $query = $conn->query($sql);
                          
                             while($row = mysqli_fetch_assoc($query)){
                                 $product_id        = $row['product_id'];
                                 $product_name      = $row['product_name'];
                           ?>
                         <option value="<?php echo $product_id   ?> "><?php echo $product_name ?></option>
                         <?php } ?>
                       </select>
                      <input type="submit" value="Generate Report" class="btn btn-info">
                </form>
                
                 <?php
                 //fetch data from store store_product table
                       if(isset($_POST['product_name'])){
                                $product_name = $_POST['product_name'];

                                $sql2= "SELECT * FROM store_product WHERE store_product_name = $product_name "; 
                                  
                                      $query2 = $conn->query($sql2);

                                      while($row2 = mysqli_fetch_array($query2)){
                                          $product_quantity   = $row2['store_product_quantity'];
                                          $product_entry_date = $row2['store_product_entry_date'];
                                          $store_product_name = $row2['store_product_name'];
                                    
                                         echo "<h3>$data_list[$store_product_name]</h3>";
                                         echo "<table class='table table-striped table-hover'><tr><td>Store Date</td><td>Quantity</td></tr>";
                                         echo "<tr><td>$product_entry_date</td><td>$product_quantity</td></tr>";
                                         echo "</table>";
                                      }
                            }
                  ?>
            </div><!--end-rightbar-->
          </div><!--end of row-->
          <div class="container-foulid border-top border-info p-2">
              <?php include('footer.php');?>
          </div>
        </div>
 </body>
</html> 
<?php
//close session
  }else{
     header('location:login.php');
  }
?>