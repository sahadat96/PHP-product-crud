<?php
  require('db_connection.php');
  session_start();  
?>
				
<!DOCTYPE html>
<html>
 <head>
 	<title>Store MS</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
 </head>
 <body> 
    <div class="container ">
        <div class="bg-info" style="height: 700px; padding-top: 40px;">
            <div  style="margin: auto; width: 50%; border: 3px solid white; padding: 10px;">
                 <h1 class="text-center text-white">Welcome To Store Management System</h1>  
                     <div style="margin: auto; width: 50%; padding: 60px;" >
                            <?php

                               if(isset($_POST['email'])){
                                          $email     = $_POST['email'];
                                          $password  = $_POST['password'];
                               
                                   $sql ="SELECT * FROM user WHERE email ='$email' AND password ='$password'";

                                   $query = $conn->query($sql);  

                                    if(mysqli_num_rows($query) > 0 ){

                                        $row = mysqli_fetch_array($query);
                                               $first_name  = $row['first_name']; 
                                               $last_name   = $row['last_name'];
                                   //login system 
                                        $_SESSION['first_name'] =  $first_name;
                                        $_SESSION['last_name']  =  $last_name;

                                        header('location:index.php');

                                     }else{
                                      echo "User name or password incorrect";  
                                     }
                                }
                            ?>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                          <label class="text-white">User's Email: sahadat@gmail.com</label><br>
                          <input type="email" name="email"><br><br>
                          <label class="text-white">Password: 12345</label><br>
                          <input type="password" name="password"><br><br>
                          <input type="submit" name="" value="Login" class="btn btn-success">
                        </form>
                     </div>
            </div>
            
        </div>
    </div>
 </body>
</html>