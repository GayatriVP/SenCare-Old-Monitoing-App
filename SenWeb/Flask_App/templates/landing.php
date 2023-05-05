<!DOCTYPE html>
<?php 
session_start();
if(!isset($_SESSION['name']))
{
    header('location: login.php');
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SenCare</title>
    <link rel="stylesheet" href="../static/css/landing.css">
    <link rel="stylesheet" href="../static/css/navigation0.css">
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
        <div class="left">
            <!-- left box -->
            <!-- <img src="./media/images/illust/View _Hands Of Senior Man Playing Music On Piano_ by Stocksy Contributor _Raymond Forbes LLC_.png" alt="" srcset=""> -->
        </div>
        <div class="right">
            <div class="one">
                <a href="home.html">Monitors</a>
            </div>
            <div class="two">
                <a href="senior-data-display.php">Seniors</a>
            </div>
            <!-- <div class="three">
                <a href="reminders.html">Reminders</a>
            </div>
            <div class="four">
                <a href="alert.html">Registration</a>
            </div> -->
        </div>
    </div> 
</div>

    <!-- <script>
        function openNav() {
          document.getElementById("mySidebar").style.width = "350px";
          document.getElementById("main").style.marginLeft = "350px";
        }
        
        function closeNav() {
          document.getElementById("mySidebar").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
        }
        </script> -->
    
    <script src="../static/scripts/navigation.js"></script>
</body>
</html>