<?php
   require('db_connection.php');

//Session
  session_start();

   $first_name = $_SESSION['first_name'];
   $last_name  = $_SESSION['last_name'];

   if(!empty($first_name) && !empty ($last_name) ){


 // fetch data from another table 
        function data_list($tablename, $column1, $column2){
          require('db_connection.php');

           $sql = "SELECT * FROM $tablename";
           $query = $conn->query($sql);
        
        while($row = mysqli_fetch_assoc($query)){
             $data_id   = $row[$column1];
             $data_name = $row[$column2];
                   
            echo "<option value='$data_id'>$data_name</option>";
       }
    }   
?>
				
<!DOCTYPE html>
<html>
 <head>
 	<title>Store Product</title>
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
                         <?php
                          // insert data in store product table
                           if(isset($_POST['store_product_name'])){
                               $store_product_name       = $_POST['store_product_name'];
                               $store_product_quantity   = $_POST['store_product_quantity'];
                               $store_product_entry_date = $_POST['store_product_entry_date'];
                               
                                  $sql4 = "INSERT INTO store_product (store_product_quantity, store_product_entry_date, store_product_name)
                                        VALUES ('$store_product_quantity','$store_product_entry_date', '$store_product_name')";

                                        if ($conn->query($sql4) === TRUE) {
                                          echo "New record created successfully";
                                           } else {
                                          echo "Error: " .  "<br>" . $conn->error;
                                             }
                                        } 
                         ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">  
                            <label>Product : </label><br>
                               <select name="store_product_name">
                                  <?php
                                     data_list('product', 'product_id','product_name'); 
                                   ?>
                                </select><br><br>
                            <label>Product Quantity:</label><br>
                                <input type="text"  name="store_product_quantity" ><br><br>
                                <label>Store Entry Date:</label><br>
                                <input type="date" name="store_product_entry_date"><br><br>
                                <input type="submit" name="" value="submit" class='btn btn-info'>
                        </form>
                 </div>
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