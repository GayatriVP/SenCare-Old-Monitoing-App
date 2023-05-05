<!DOCTYPE html>
<?php 
session_start();
include 'database.php';
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
    <title>SenCare- Seniors</title>
    <link rel="stylesheet" href="../static/css/data.css">
    <link rel="stylesheet" href="../static/css/navigation0.css">
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

        <div class="page">
        <div class="top">
            <!-- <img src="./media/images/e1.png" alt="" srcset=""> -->
        </div>
        <div class="form">
            <div style="overflow-x: auto;overflow-y: auto;">
                <?php 
                    $id= $_SESSION['id'];
                    if(isset($_POST['search'])){
                        $skey = $_POST['search'];
                        $sql1 = "SELECT * FROM sen_data where fullname LIKE '%$skey%' AND user_id=$id";
                        $exe = mysqli_query($conn, $sql1);
                        $rowcount= mysqli_num_rows($exe);
                    }
                    else{
                        $sql = "SELECT * FROM sen_data where user_id=$id";
                        $exe = mysqli_query($conn, $sql);
                        $rowcount= mysqli_num_rows($exe);
                    }
                ?>
                
                <form action="" method="post">
                    <input type="text" name="search" id="myInput"  placeholder="Search for name...">
                    <!-- <button> Search</button> -->
                </form>
                <table>
                <tr>
                    <th>Sr. no</th>
                    <th>Full name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th>Blood Pressure</th>
                    <th>Sugar level</th>
                    <th>Mobile number</th>
                    <th>Address</th>
                    <th>Emergency Contact Name</th>
                    <th>Emergency Contact Number</th>
                    <th>Hospital name</th>
                    <th>Doctor name</th>
                    <th>Hospital Number</th>
                    <th>Hospital Address</th>
                    <!-- <th>Actions</th> -->
                </tr>

                <?php 
                 for($i=1; $i<=$rowcount; $i++){
                    $row= mysqli_fetch_array($exe);
                    $fullname= $row['fullname'];
                    $mob_no= $row['mob_no'];
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo'<a href="reminders.php?fullname='.$fullname.'&&mob_no='.$mob_no.'" style="text-decoration:none;color:black;">'.$fullname.'</a>'?></td>
                    <td><?php echo $row['age'];?></td>
                    <td><?php echo $row['gender'];?></td>
                    <td><?php echo $row['weight'];?></td>
                    <td><?php echo $row['bp'];?></td>
                    <td><?php echo $row['sugarL'];?></td>
                    <td><?php echo $row['mob_no'];?></td>
                    <td><?php echo $row['home_add'];?></td>
                    <td><?php echo $row['emg_name'];?></td>
                    <td><?php echo $row['emg_no'];?></td>
                    <td><?php echo $row['hos_name'];?></td>
                    <td><?php echo $row['doctor'];?></td>
                    <td><?php echo $row['hos_no'];?></td>
                    <td><?php echo $row['hos_add'];?></td>
                    <!-- <td>
                        <a href="update.php?id=< ?=$row['user_id']?>" 
			      	     class="btn btn-success">Update</a>

			      	    <a href="php/delete.php?id=< ?=$row['user_id']?>" 
			      	     class="btn btn-danger">Delete</a>
                    </td> -->
                </tr>

                <?php
                 }
                ?>
                </table>
            </div>
        </div>
    </div>

   

    <script src="../static/scripts/navigation.js"></script>

</body>
</html>