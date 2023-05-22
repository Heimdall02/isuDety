<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:index1.php');
    }else{
        $message[] = 'incorrect password or email!';
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    // Check if the user is an admin
    if ($email === 'admin@email.com' && $password === 'admin123') {
       $_SESSION['user_id'] = 'admin';
       $_SESSION['user_email'] = $email;
       header('location: adminMen.php');
       exit();
    } else {
       // Perform user login validation
       $query = "SELECT * FROM 'admin' WHERE email='$email' AND password='$password'";
       $result = mysqli_query($conn, $query);
 
       if (mysqli_num_rows($result) == 1) {
          $row = mysqli_fetch_assoc($result);
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['user_email'] = $row['email'];
 
          // Redirect to appropriate page based on user role
          if ($row['role'] === 'admin') {
             header('location: adminMen.php');
          } else {
             header('location: adminMen.php');
          }
          exit();
       } else {
          $error = "Invalid email or password";
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
    <title>login</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<?php
if(isset($message)){
    foreach($message as $message){
        echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
    }
}
?>

<div class="form-container">
    <form action="" method="post">
        <h3>Welcome To HappyFeet</h3>
        <h2>Login</h2>
        <input type="email" name="email" required placeholder="enter email" class="box">
        <input type="password" name="password" required placeholder="enter password" class="box">
        <input type="submit" name="submit" class="btn" value="login now">
        <p>don't have an account? <a href="register.php">register now</a></p>
    </form>
</div>

</body>
</html>