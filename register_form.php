<?php
include 'config.php';
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = trim($_POST['pass']);
    $cpass = trim($_POST['cpass']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'user already exits !';
    } else {
        if ($pass != $cpass) {
            $error[] = 'password not matched !';
        } else {
            $insert = "INSERT INTO user_form VALUE(null,'$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>register form</title>

     <!-- custom css file link -->
     <link rel="stylesheet" href="css/style.css">
</head>

<body>
     <div class="form-container">
          <form action="" method="post">
               <h3>Register now</h3>
               <?php
                    if (isset($error)) {
                    foreach ($error as $error) {
                         ?>
                              <span class="error-msg">
                                   <?=$error;?>
                              </span>
                         <?php
                    }
                    }
               ?>
               <input type="text" name="name" id="name" placeholder="enter your name">
               <input type="text" name="email" id="email" placeholder="enter your email">
               <input type="password" name="pass" id="pass" required placeholder="enter your password">
               <input type="password" name="cpass" id="cpass" required placeholder="confirm your password">
               <select name="user_type" id="user_type">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
               </select>
               <input type="submit" name="submit" value="Register now" class="form-btn">
               <p>Already have an account? <a href="login_form.php">Login</a></p>
               <p></p>
          </form>
     </div>
</body>

</html>