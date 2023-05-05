<!DOCTYPE html>
<?php include 'database.php';
if (isset($_POST['login'])){
    $phone= mysqli_real_escape_string($conn, $_POST['phone']);
    $password= mysqli_real_escape_string($conn, $_POST['password']);

    if(empty($phone) OR empty($password)){
        $error = "All fields are required";
    }
    else{
        $check_phone = "SELECT * FROM `users` WHERE phone='$phone' && password='$password'";
        $query = mysqli_query($conn, $check_phone);
        $row = mysqli_num_rows($query);
        $fetch = mysqli_fetch_array($query);

        if($row==1){
            // echo 'logging in';
            $name = $fetch['name'];
            $id = $fetch['id'];
            session_start();
            $_SESSION['name']= $name;
            $_SESSION['id']= $id;
            $success="Logged in successfully";
            header("location: landing.php");
        }
        else{
            $error="Enter correct details";
        }
        
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login- Sencare</title>
    <link rel="stylesheet" href="../static/css/login.css">
    <style>
        
    </style>
</head>
<body>
    <div class="register">
        <div class="form">
            <h2>Signin here</h2>
            <form action="" method="post">
                <input type="text" name="phone" placeholder="Enter Phone Number:" >
                <input type="password" name="password" placeholder="Enter password:" >
                <div class="flex" style="display:flex;flex-direction:row;">
                    <input type="reset" name="reset" value="Reset">
                    <input type="submit" name="login" value="Submit">
                </div>
                <p class="text">Don't have an account? <a href="register.php">Sign up</a></p>
            </form>
            <p class="error">
                <?php 
                    if(isset($error)){
                        echo $error;
                    }
                ?>
            </p>
            <p class="success">
                <?php 
                    if(isset($success)){
                        echo $success;
                    }
                ?>
            </p>
        </div>
    </div>
</body>
</html>