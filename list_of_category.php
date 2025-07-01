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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Category list</title>
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
                        //select data from category table
                         $sql = "SELECT * FROM category ";
                          $query = $conn->query($sql);
                          echo"<table class='table table-striped table-hover'><tr><th>Category</th><th>Date</th><th>Action</th></tr>";
                          while($row = mysqli_fetch_assoc($query)){
                                 $category_id        = $row['category_id'];
                                 $category_name      = $row['category_name'];
                                 $category_entrydate = $row['category_entrydate'];
                                 echo "<tr><td>$category_name</td>
                                            <td>$category_entrydate</td>
                                            <td><a href='edit_category.php?id=$category_id' class='btn btn-info'> Edit </a></td>
                                        </tr>";
                                 }
                           echo "</table>";


                              
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