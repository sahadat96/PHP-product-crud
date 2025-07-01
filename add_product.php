<?php
  require('db_connection.php');
  //Session
  session_start();

   $first_name = $_SESSION['first_name'];
   $last_name  = $_SESSION['last_name'];

   if(!empty($first_name) && !empty ($last_name) ){
?>
				
<!DOCTYPE html>
<html>
 <head>
   	<title>Add Product</title>
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
                            // insert data in product table
                             if(isset($_POST['product_name'])){
                                 $product_name       = $_POST['product_name'];
                                 $product_category   = $_POST['product_category'];
                                 $product_code       = $_POST['product_code'];
                                 $product_entry_date = $_POST['product_entry_date'];
                             
                                    $sql = "INSERT INTO product (product_name, product_category,product_code, product_entry_date)
                                          VALUES ('$product_name', '$product_category', '$product_code', '$product_entry_date')";

                                          if ($conn->query($sql) === TRUE) {
                                        echo "New record created successfully";
                                      } else {
                                        echo "Error: " . $sql . "<br>" . $conn->error;
                                        }
                                   } 

                            ?>

                           <?php
                                 $sql = "SELECT * FROM category";
                                 $query = $conn->query($sql);
                                 
                            ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                           <label>Product:</label> <br>
                           <input type="text"  name="product_name" required><br><br>
                           <label>Product category:</label><br>
                           <select name="product_category">
                              <?php
                                 while($row = mysqli_fetch_assoc($query)){
                                        $category_id  = $row['category_id'];
                                       $category_name = $row['category_name'];
                                     
                                  echo "<option value='$category_id'>$category_name</option>";
                                 }
                              ?>
                                 
                           </select><br><br>
                           <label>Product code:</label><br>
                             <input type="text"  name="product_code" required><br><br>
                           <label>Entry Date:</label><br>
                             <input type="date" name="product_entry_date"><br><br>
                             <input type="submit" name="" value="submit" class="btn btn-info">
                        </form>
                </div><!--end of row-->
            </div>
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