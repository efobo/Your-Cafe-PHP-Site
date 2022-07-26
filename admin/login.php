<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Your ♥ Café</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1>

            <br><br>

            <?php
            
                if (isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

            ?>
            
            <br>

            <!-- Login Form Starts -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter your username"> <br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter your password"> <br><br>

                <input type="submit" name="submit" value="Log in" class="btn-primary">
                <br><br>
            </form>
            <!-- Login Form Ends -->

            <p class="text-center">Created by <a href="https://github.com/efobo">efobo</a></p>
        </div>
    </body>
</html>

<?php

    if (isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn, $sql);

        if ($res)
        {
            $count = mysqli_num_rows($res);

            if ($count == 1)
            {
                $_SESSION['login'] = "<div class='success'>Login Successful</div>";
                header('location:'.SITEURL.'admin/');
            }
            else
            {
                $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
                header('location:'.SITEURL.'admin/login.php');
            }
        }
    }


?>