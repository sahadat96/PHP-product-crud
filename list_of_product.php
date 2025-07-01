<?php
      require('db_connection.php');


      //Session
      session_start();

       $first_name = $_SESSION['first_name'];
       $last_name  = $_SESSION['last_name'];

       if(!empty($first_name) && !empty ($last_name) ){


    //fetch data from category

       $sql2 ="SELECT * FROM category";
         $query2 = $conn->query($sql2);
      
          $data_list = array();
     
       while($row2 = mysqli_fetch_assoc($query2)){  
          $category_id = $row2['category_id'];
          $category_name   = $row2['category_name'];
          
           
        $data_list[$category_id] = $category_name;
   }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product List</title>
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
                        //fetch data from product table
                          $sql = "SELECT * FROM product ";
                          $query = $conn->query($sql);
                          echo"<table class='table table-striped table-hover'><tr><th>Product name</th><th>Category</th><th>Code</th><th>Action</th></tr>";
                          while($row = mysqli_fetch_assoc($query)){
                                 $product_id        = $row['product_id'];
                                 $product_name      = $row['product_name'];
                                 $product_category  = $row['product_category'];
                                 $product_code      = $row['product_code'];
                                 echo "<tr>
                                         <td>$product_name</td>
                                         <td>$data_list[$product_category]</td>
                                         <td>$product_code </td>
                                         
                                            <td><a href='edit_product.php?id=$product_id' class='btn btn-info' > Edit </a></td>
                                            </tr> ";
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