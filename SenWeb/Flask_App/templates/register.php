<!DOCTYPE html>
<?php 

include 'database.php';
if (isset($_POST['signup'])){
    $name= mysqli_real_escape_string($conn, $_POST['name']);
    $phone= mysqli_real_escape_string($conn, $_POST['phone']);
    $password= mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword= mysqli_real_escape_string($conn, $_POST['cpassword']);

    
    function validate_mobile($phone){   
        return preg_match('/^[0-9]{10}+$/', $phone);
    }

    if(empty($name) OR empty($phone) OR empty($password) OR empty($cpassword)){
        $error = "All fields are required";
    }
    elseif(!validate_mobile($phone)){
        $error = "Enter valid number";
    }
    elseif($password != $cpassword){
        $error = "Both password should match";
    }
    elseif(strlen($password)>15 || strlen($password)<6){
        $error = "Password must be between 6-15 characters";
    }
    else{
        $check_phone = "SELECT * FROM `users` WHERE phone='$phone'";
        $data = mysqli_query($conn, $check_phone);
        $result = mysqli_fetch_array($data);
        if($result>0){
            $error= "Phone number alreay exists";
        }
        else{
            $query = "INSERT INTO users(name, phone, password) VALUES ('$name','$phone','$password')";
            $exe = mysqli_query($conn, $query);
            if($exe){
                $success = "Your account has been created successfully";
                header("location: login.php");
		        exit();
            }
        }
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SenCare</title>
    <link rel="stylesheet" href="../static/css/register.css">
    <style>
        
    </style>
</head>
<body>
    <div class="register">
        <div class="form">
            <h2>register here</h2>
            <form action="" method="post">
                <input type="text" name="name" placeholder="Enter Name:" >
                <input type="text" name="phone" placeholder="Enter Phone Number:" >
                <input type="password" name="password" placeholder="Enter password:" >
                <input type="password" name="cpassword" placeholder="Enter re-password:" >
                <div class="flex" style="display:flex;flex-direction:row;">
                    <input type="reset" name="reset" value="Reset">
                    <input type="submit" name="signup" value="Submit">
                </div>
                <p class="text">Already have an account? <a href="login.php">Sign in</a></p>
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