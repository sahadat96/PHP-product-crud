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
 	<title>Add User</title>
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
                       // Insert data in user table
                         if(isset($_POST['first_name'])){
                             $first_name  = $_POST['first_name'];
                             $last_name   = $_POST['last_name'];
                             $email       = $_POST['email'];
                             $password    = $_POST['password'];
                         
                                $sql = "INSERT INTO user (first_name, last_name, email, password)
                                      VALUES ('$first_name', '$last_name', '$email', '$password')";

                                 if ($conn->query($sql) === TRUE) {
                                    echo "New record created successfully";
                                  } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                   }   
                             } 
                       ?>
   
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <label>User's First Name: </label><br>
                            <input type="text"  name="first_name" required><br><br>
                            <label>User's Last Name: </label><br>
                            <input type="text" name="last_name"><br><br>
                            <label>User's Email:</label><br>
                            <input type="email" name="email"><br><br>
                            <label>Password</label><br>
                            <input type="password" name="password"><br><br>
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