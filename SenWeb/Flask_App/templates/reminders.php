<!DOCTYPE html>
<?php 
session_start();
include 'database.php';
if(!isset($_SESSION['name']))
{
    header('location: login.php');
}
if (isset($_POST['submit'])){
    $fullname= $_GET['fullname'];
    $mob_no= $_GET['mob_no'];
    $breakfast= mysqli_real_escape_string($conn, $_POST['breakfast']);
    $lunch = mysqli_real_escape_string($conn, $_POST['lunch']);
    $dinner= mysqli_real_escape_string($conn, $_POST['dinner']);
    $exercise= mysqli_real_escape_string($conn, $_POST['exercise']);
    $morning= mysqli_real_escape_string($conn, $_POST['morning']);
    $afternoon= mysqli_real_escape_string($conn, $_POST['afternoon']);
    $evening= mysqli_real_escape_string($conn, $_POST['evening']);
    $night= mysqli_real_escape_string($conn, $_POST['night']);

    if(empty($fullname) OR empty($mob_no)){
        $error = "All fields are required";
    }
    else{
        $check_phone = "SELECT * FROM `reminder` WHERE mob_no='$mob_no'";
        $data = mysqli_query($conn, $check_phone);
        $result = mysqli_fetch_array($data);
        if($result == 1){
            $query = "INSERT INTO `reminder`(`fullname`, `mob_no`, `breakfast`, `lunch`, `dinner`, `exercise`, `morning`, `afternoon`, `evening`, `night`) VALUES ('$fullname','$mob_no','$breakfast','$lunch','$dinner','$exercise','$morning','$afternoon','$evening','$night')";
            $exe = mysqli_query($conn, $query);
            if($exe){
                $success= "Reminder has been added.";
            }
            else{
                $error = "Something went wrong";
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
    <title>SenCare- Reminders</title>
    <link rel="stylesheet" href="../static/css/reminder.css">
    <link rel="stylesheet" href="../static/css/navigation0.css">
    <link rel="stylesheet" href="../static/css/application.css">
</head>
<style>
        .text{
            padding: 3% 12px 8% 5%;
            margin-bottom:0;
            text-decoration: none;
            font-size: 35px;
            color: #bebebe;
            display: block;
            transition: 0.3s ease-in;
        }
        .text:hover {
            color: #f1f1f1;
            margin-bottom: 7px;
            text-decoration: underline white 2px;
        }
        .error{
            font-size:20px;
            color:red;
            font-weight:bold;
            /* background:rgba(0, 0, 0, 0.265); */
            padding-top: 5% ;
            text-align:center;
            margin:0;
        }
        .success{
            font-size:20px;
            color:green;
            font-weight:bold;
            /* background:rgba(0, 0, 0, 0.265); */
            padding-top: 5%;
            text-align:center;
        }
        label{
            margin-top:15px;
        }
        .box{
            justify-content:space-between;
            /* padding:1% 3%; */
        }
        .one, .two{
            padding:2% 1%;
        }
        input[type=time] {
            border: none;
            color: #2a2c2d;
            font-size: 14px;
            font-family: helvetica;
            width: 120px;
            background:none;
            }

            /* Wrapper around the hour, minute, second, and am/pm fields as well as 
            the up and down buttons and the 'X' button */
            input[type=time]::-webkit-datetime-edit-fields-wrapper {
            display: flex;
            }

            /* The space between the fields - between hour and minute, the minute and 
            second, second and am/pm */
            input[type=time]::-webkit-datetime-edit-text {
            padding: 19px 4px;
            }

            /* The naming convention for the hour, minute, second, and am/pm field is
            `-webkit-datetime-edit-{field}-field` */

            /* Hour */
            input[type=time]::-webkit-datetime-edit-hour-field {
            background-color: #f2f4f5;
            border-radius: 15%;
            padding: 19px 13px;
            }

            /* Minute */
            input[type=time]::-webkit-datetime-edit-minute-field {
            background-color: #f2f4f5;
            border-radius: 15%;
            padding: 19px 13px;
            }

            /* AM/PM */
            input[type=time]::-webkit-datetime-edit-ampm-field {
            background-color: #7155d3;
            border-radius: 15%;
            /* color: #fff; */
            padding: 19px 13px;
            }

            /* 'X' button for resetting/clearing time */
            input[type=time]::-webkit-clear-button {
            display: none;
            }

            /* Up/Down arrows for incrementing/decrementing the value */
            input[type=time]::-webkit-inner-spin-button {
            display: none;
            }

    </style>
</head>
<body>
<div id="mySidebar" class="sidebar">
        <p class="text">Hello, <?php echo $_SESSION['name'];?></p>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="landing.php" class="active">Dashboard</a>
        <a href="senior-application.php">Add Senior</a>
        <!-- <a href="#">Profile</a> -->
        <a href="logout.php">Logout</a>
        <!-- <a href="alert.html">Alerts</a> -->
    </div>

    <div id="main">
        <div class="nav">
            <button class="openbtn" onclick="openNav()">☰</button> 
            <div class="logo" id="logo">
                <!-- Logo -->
                <a href=""></a><img src="../static/media/images/SenCare-removebg.png" alt="SenCare"></a>
            </div>
        </div>

        <div class="block">
                    <p class="success">
                        <?php 
                            if(isset($success)){
                                echo $success;
                            }
                        ?>
                    </p>
            <div class="form">
                <form action="" method="post">
                    <div class="box" id="name">
                        <label>Full Name</label>
                        <?php 
                        $fullname = $_GET['fullname'];
                        echo '<input type="text" class="form-control" name="fullname" placeholder="Full name" value='.$fullname.'>'; ?>
                        <br><br>
                    </div>
                    <div class="box" id="phone">
                        <label>Mobile Number</label>
                        <?php 
                        $mob_no = $_GET['mob_no'];
                        echo '<input type="text" class="form-control" name="mob_no" placeholder="Mobile name" value='.$mob_no.'>'; ?>
                        <br><br>
                    </div>
                    <div class="flex" style="display:flex;flex-direction:row;;">
                        <div class="one" style="flex:50%;">
                            <div class="box" id="breakfast" style="display:flex;flex-direction:row;">
                                <label>Breakfast time</label>
                                <input type="time" class="form-control" name="breakfast" placeholder="Meal Time">
                                <br><br>
                            </div>
                            <div class="box" id="lunch" style="display:flex;flex-direction:row;">
                                <label>Lunch time</label>
                                <input type="time" class="form-control" name="lunch" placeholder="Meal Time">
                                <br><br>
                            </div>
                            <div class="box" id="dinner" style="display:flex;flex-direction:row;">
                                <label>Dinner time</label>
                                <input type="time" class="form-control" name="dinner" placeholder="Meal Time">
                                <br><br>
                            </div>
                            <div class="box" id="exercise" style="display:flex;flex-direction:row;">
                                <label>Exercise Time</label>
                                <input type="time" class="form-control" name="exercise" placeholder="Meal Time">
                                <br><br>
                            </div>
                        </div>
                        <div class="two" style="flex:50%;text-align:left;">
                            <div class="box" id="morning" style="display:flex;flex-direction:row;">
                                <label>Morning Medicine </label>
                                <input type="time" class="form-control" name="morning" placeholder="Medicine Time">
                                <br><br>
                            </div>
                            <div class="box" id="afternoon" style="display:flex;flex-direction:row;">
                                <label>Afternoon Medicine </label>
                                <input type="time" class="form-control" name="afternoon" placeholder="Medicine Time">
                                <br><br>
                            </div>
                            <div class="box" id="evening" style="display:flex;flex-direction:row;">
                                <label>Evening Medicine </label>
                                <input type="time" class="form-control" name="evening" placeholder="Medicine Time">
                                <br><br>
                            </div>
                            <div class="box" id="night" style="display:flex;flex-direction:row;">
                                <label>Night Medicine </label>
                                <input type="time" class="form-control" name="night" placeholder="Medicine Time">
                                <br><br>
                            </div>
                        </div>
                    </div>
                    <button id="Insbtn" name="submit" class="btn btn-primary" style="margin-top:4%;margin-left:33%;width:300px !important;">Submit</button>
                
                    <p class="error">
                        <?php 
                            if(isset($error)){
                                echo $error;
                            }
                        ?>
                    </p>
                </form>
            </div>
        </div>
        <br>
    </div>

    <script src="../static/scripts/navigation.js"></script>

</body>
</html>