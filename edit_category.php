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
 	<title>Edit category</title>
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
                   // fetch data from category table
                      if(isset($_GET['id'])){
                           $getid = $_GET['id'];
                           $sql = "SELECT * FROM category WHERE category_id = $getid";

                                         $query = $conn->query($sql);
                                         $row = mysqli_fetch_assoc($query); 

                                  $category_id         = $row['category_id'];
                                  $category_name       = $row['category_name'];
                                  $category_entrydate  = $row['category_entrydate'];
                           }

                              if(isset($_POST['category_name'])){

                                     $new_category_name      = $_POST['category_name'];
                                     $new_category_entrydate = $_POST['category_entrydate'];
                                     $new_category_id        = $_POST['category_id']; 
                                 //update data in category table
                                 $sql1= "UPDATE category SET category_name ='$new_category_name', 
                                  category_entrydate ='$new_category_entrydate' WHERE category_id = 
                                    $new_category_id";

                                   if($conn->query($sql1)=== TRUE){
                                        echo"Update succesfull";
                                       }else{
                                        echo"Data Update not done"; 
                                       }
                                 }
                    ?>
                        <form action="edit_category.php" method="POST">
                          <label>Category:</label> <br>
                          <input type="text"  name="category_name" value="<?php echo $category_name ?>" required><br><br>
                           <label>Entry Date:</label><br>
                           <input type="date" name="category_entrydate" value="<?php echo $category_entrydate ?>"><br><br>
                           <input type="text" name="category_id" value="<?php echo $category_id  ?> " hidden><br><br>
                           <input type="submit" name="" value="Update" class="btn btn-info">
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