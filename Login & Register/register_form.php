<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($connect_db, $_POST['usermail']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);

    $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

    $result = mysqli_query($connect_db, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exist';
    }else{
        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO user_form(email, password) VALUES('$email', '$pass')";
            mysqli_query($connect_db, $insert);
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
    <title>Document</title>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="form-container">

        <form action="" method="post">
            <h3>register now</h3>
            <?php
            if (isset($error)) {
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
            <input type="email" name="usermail" placeholder="enter your email" class="box" required />
            <input type="password" name="password" placeholder="enter your password" class="box" required />
            <input type="password" name="cpassword" placeholder="confirm your password" class="box" required />
            <input type="submit" value="register now" name="submit" class="form-btn" />
            <p>already have an account? <a href="login_form.php">login now</a></p>
        </form>

    </div>
</body>
</html>