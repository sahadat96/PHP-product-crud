<?php
//Session
  session_start();

   $first_name = $_SESSION['first_name'];
   $last_name  = $_SESSION['last_name'];

   if(!empty($first_name) && !empty ($last_name) ){
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Store Management System</title>
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
                   <div class="row p-4">
                     <div class="col-sm-3">
                       <a href="add_category.php"><i class="fa-solid fa-folder-plus fa-4x text-info"></i></a>
                       <p>Add Category</p>
                     </div> 
                     <div class="col-sm-3">
                       <a href="list_of_category.php"><i class="fa-solid fa-list fa-4x text-info"></i></a>
                       <p>List of Category</p>
                     </div>
                     <div class="col-sm-3">
                       <a href="add_product.php"><i class="fa-sharp fa-solid fa-box-open fa-4x text-info"></i></a>
                       <p>Add Product</p>
                     </div>
                     <div class="col-sm-3">
                       <a href="list_of_product.php"><i class="fa-regular fa-rectangle-list fa-4x text-info"></i></a>
                       <p>Product List</p>
                     </div>
                   </div>
                   <div class="row p-4">
                    
                     <div class="col-sm-3">
                       <a href="list_of_product.php"><i class="fa-sharp fa-solid fa-shop fa-4x text-info"></i></a>
                       <p>Store Product </p>
                     </div>
                      <div class="col-sm-3">
                       <a href="add_user.php"><i class="fa-solid fa-user-plus fa-4x text-info"></i></a>
                       <p>Add User</p>
                     </div>
                     <div class="col-sm-3">
                       <a href="report.php"><i class="fa-sharp fa-solid fa-file-lines fa-4x text-info"></i></a>
                       <p>Report</p>
                     </div>
                   </div>
                 </div><!--end of right-->
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