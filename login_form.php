<?php
include 'config.php';
session_start();
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = trim($_POST['pass']);
    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_array($result);
          if($row['user_type']=='admin'){
               $_SESSION['type_admin'] = $row['name'];
               header('location:admin.php');
          }
          else if($row['user_type']=='user'){
               $_SESSION['type_user'] = $row['name'];
               header('location:user_page.php');
          }
        
    }
    else{
          $error[] = "incorect password or email !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>login form</title>

     <!-- custom css file link -->
     <link rel="stylesheet" href="css/style.css">
</head>
<body>
     <div class="form-container">
          <form action="" method="post">
               <h3>Login now</h3>

               <?php
                    if(isset($error)){
                         foreach($error as $error){
                              ?>
                                   <span class="error-msg">
                                        <?= $error; ?>
                                   </span>
                              <?php
                         }
                    }
               ?>

               <input type="text" name="email" id="email" placeholder="enter your email">
               <input type="password" name="pass" id="pass" required placeholder="enter your password">
               <input type="submit" name="submit" value="Login now" class="form-btn">
               <p>Already have an account? <a href="register_form.php">Register</a></p>
               <p></p>
          </form>
     </div>
</body>
</html>
