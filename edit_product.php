<?php
  require('db_connection.php');//Session
  session_start();

   $first_name = $_SESSION['first_name'];
   $last_name  = $_SESSION['last_name'];

   if(!empty($first_name) && !empty ($last_name) ){
?>
        
<!DOCTYPE html>
<html>
 <head>
  <title>Edit Product</title>
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
                      //get by id
                       if(isset($_GET['id'])){
                           $getid = $_GET['id'];
                           $sql3  = "SELECT * FROM product WHERE product_id=$getid";

                           $query3 = $conn->query($sql3); 

                            $row3 = mysqli_fetch_assoc($query3);

                                 $product_id          = $row3['product_id'];
                                 $product_name        = $row3['product_name'];
                                 $product_category    = $row3['product_category'];
                                  $product_code       = $row3['product_code'];
                                  $product_entry_date = $row3['product_entry_date'];
                        }
                       //update data in product table
                           if(isset($_POST['product_name'])) {
                                  $new_product_name       = $_POST['product_name'];
                                  $new_product_category   = $_POST['product_category'];
                                  $new_product_code       = $_POST['product_code'];
                                  $new_product_entry_date = $_POST['product_entry_date'];
                                  $new_product_id         = $_POST['product_id'];
                                  
                                 $sql1 = "UPDATE product SET product_name  = '$new_product_name',
                                                  product_category  = '$new_product_category',
                                                  product_code      = '$new_product_code ',
                                                  product_entry_date= '$new_product_entry_date'
                                                  WHERE product_id  = '$new_product_id'
                                                  ";
                                  if($conn->query($sql1) === TRUE){
                                     echo "Update Success" ;
                                  }else {

                                    echo "error updating record: " . $conn->error ;
                                  }
                           }
                          ?>   
                          <?php
                                   $sql = "SELECT * FROM category";
                                 $query = $conn->query($sql);
                                   
                          ?>
                      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <label>Product:</label> <br>
                        <input type="text"  name="product_name" value="<?php echo $product_name ?>" required><br><br>
                        <label>Product category:</label><br>
                         <select name="product_category">
                           <?php
                               while($row = mysqli_fetch_assoc($query)){
                                      $category_id  = $row['category_id'];
                                     $category_name = $row['category_name']; 
                            ?>           
                                <option value='<?php echo $category_id ?>' <?php if($category_id == $product_category){echo 'selected' ;} ?> >
                                    <?php echo $category_name ?>
                                </option>
                          
                          <?php } ?>
                         </select><br><br>
                        <label>Product code:</label><br>
                          <input type="text"  name="product_code" value="<?php echo $product_code ?>"  required><br><br>
                        <label>Entry Date:</label><br>
                          <input type="date" name="product_entry_date" value="<?php echo $product_entry_date ?>"><br><br>
                          <input type="text"  name="product_id" value="<?php echo $product_id ?> " hidden>
                          <input type="submit" name="" value="submit" class='btn btn-info'>
                      </form>
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