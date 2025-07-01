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
   	<title>Add Category</title>
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
                    // insert data in category table
                         if(isset($_POST['category_name'])){
                             $category_name      = $_POST['category_name'];
                             $category_entrydate = $_POST['category_entrydate'];
                         
                              $sql = "INSERT INTO category (category_name, category_entrydate)
                                      VALUES ('$category_name', '$category_entrydate')";

                                      if ($conn->query($sql) === TRUE) {
                                    echo "New record created successfully";
                                  } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                    }    
                                } 
                     ?>
                      <form action="add_category.php" method="POST">
                          <label>Category:</label> <br>
                          <input type="text"  name="category_name" required><br><br>
                          <label>Entry Date:</label><br>
                          <input type="date" name="category_entrydate"><br><br>
                          <input type="submit" name="" value="submit" class="btn btn-info">
                      </form>
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