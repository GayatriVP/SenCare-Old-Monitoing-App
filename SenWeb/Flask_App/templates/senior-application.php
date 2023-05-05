<!DOCTYPE html>
<?php 
session_start();
include 'database.php';
if(!isset($_SESSION['name']))
{
    header('location: login.php');
}

if(empty($fullname) OR empty($age) OR empty($gender) OR empty($weight) OR empty($bp) OR empty($sugarL) OR empty($mob_no) OR empty($home_add) OR empty($weight) OR empty($bp) OR empty($sugarL) OR empty($emg_name) OR empty($emg_no) OR empty($hos_name) OR empty($hos_no) OR empty($hos_add) OR empty($doctor)){
    $error = "All fields are required";
}
elseif(!validate_mobile($mob_no) OR !validate_mobile($emg_no) OR !validate_mobile($hos_no)){
    $error = "Enter valid number";
}
elseif (isset($_POST['submit'])){
    $id= $_SESSION['id'];
    $fullname= mysqli_real_escape_string($conn, $_POST['fullname']);
    $age= mysqli_real_escape_string($conn, $_POST['age']);
    $gender= mysqli_real_escape_string($conn, $_POST['gender']);
    $weight= mysqli_real_escape_string($conn, $_POST['weight']);
    $bp= mysqli_real_escape_string($conn, $_POST['bp']);
    $sugarL= mysqli_real_escape_string($conn, $_POST['sugarL']);
    $mob_no= mysqli_real_escape_string($conn, $_POST['mob_no']);
    $home_add= mysqli_real_escape_string($conn, $_POST['home_add']);
    $emg_name= mysqli_real_escape_string($conn, $_POST['emg_name']);
    $emg_no= mysqli_real_escape_string($conn, $_POST['emg_no']);
    $hos_name= mysqli_real_escape_string($conn, $_POST['hos_name']);
    $hos_no= mysqli_real_escape_string($conn, $_POST['hos_no']);
    $hos_add= mysqli_real_escape_string($conn, $_POST['hos_add']);
    $doctor= mysqli_real_escape_string($conn, $_POST['doctor']);

    $sql = "INSERT INTO sen_data(user_id, fullname, age, gender, weight, bp, sugarL, mob_no, home_add, emg_name, emg_no, hos_name, hos_no, hos_add, doctor) VALUES ('$id','$fullname','$age','$gender','$weight','$bp','$sugarL','$mob_no','$home_add','$emg_name','$emg_no','$hos_name','$hos_no','$hos_add','$doctor')";
    $exe = mysqli_query($conn, $sql);
    if($exe){
        $success = "Submitted Successfully.";
    }
    else{
        $error= "Something went wrong.";
    }
}


elseif(isset($_POST['update'])){
    $mkey = $_POST['mob_no'];
    $fullname= mysqli_real_escape_string($conn, $_POST['fullname']);
    $age= mysqli_real_escape_string($conn, $_POST['age']);
    $gender= mysqli_real_escape_string($conn, $_POST['gender']);
    $weight= mysqli_real_escape_string($conn, $_POST['weight']);
    $bp= mysqli_real_escape_string($conn, $_POST['bp']);
    $sugarL= mysqli_real_escape_string($conn, $_POST['sugarL']);
    $mob_no= mysqli_real_escape_string($conn, $_POST['mob_no']);
    $home_add= mysqli_real_escape_string($conn, $_POST['home_add']);
    $emg_name= mysqli_real_escape_string($conn, $_POST['emg_name']);
    $emg_no= mysqli_real_escape_string($conn, $_POST['emg_no']);
    $hos_name= mysqli_real_escape_string($conn, $_POST['hos_name']);
    $hos_no= mysqli_real_escape_string($conn, $_POST['hos_no']);
    $hos_add= mysqli_real_escape_string($conn, $_POST['hos_add']);
    $doctor= mysqli_real_escape_string($conn, $_POST['doctor']);

    $sql1 = "UPDATE sen_data SET fullname='$fullname',age='$age',gender='$gender',weight='$weight',bp='$bp',sugarL='$sugarL',mob_no='$mob_no',home_add='$home_add',emg_name='$emg_name',emg_no='$emg_no',hos_name='$hos_name',hos_no='$hos_no',hos_add='$hos_add',doctor='$doctor' WHERE mob_no=$mkey ";
    $query = mysqli_query($conn, $sql1);

    if($query){
        $success = "Updated Successfully.";
    }
    else{
        $error= "Something went wrong.";
    }
}

elseif(isset($_POST['delete'])){
    $mkey = $_POST['mob_no'];
    $sql = "DELETE FROM sen_data WHERE mob_no=$mkey";
    $query = mysqli_query($conn, $sql);
    if($query){
        $success = "Removed Successfully.";
    }
    else{
        $error= "Something went wrong.";
    }
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SenCare- Application</title>
    <link rel="stylesheet" href="../static/css/application.css">
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
                <div class="form">
                    <?php 
                        // echo $fetch;
                    ?>
                    <form action="" method="post">
                    <div class="row">
                            <?php
                                if(isset($_POST['select'])){
                                    if(isset($_POST['mob_no'])){
                                        $id= $_SESSION['id'];
                                        $mkey = $_POST['mob_no'];
                                        $sql1 = "SELECT * FROM sen_data where mob_no LIKE '%$mkey%' AND user_id=$id";
                                        $query = mysqli_query($conn, $sql1);
                                        $row = mysqli_num_rows($query);
                                    if($row ==1){
                                    
                                    $fetch = mysqli_fetch_array($query);
                                    $fullname = $fetch['fullname'];
                                    $mob_no= $fetch['mob_no'];
                                    $home_add= $fetch['home_add'];
                                    $age= $fetch['age'];
                                    $gender= $fetch['gender'];
                                    $weight= $fetch['weight'];
                                    $bp= $fetch['bp'];
                                    $sugarL= $fetch['sugarL'];
                                    $emg_name= $fetch['emg_name'];
                                    $emg_no= $fetch['emg_no'];
                                    $hos_name= $fetch['hos_name'];
                                    $hos_no= $fetch['hos_no'];
                                    $hos_add= $fetch['hos_add'];
                                    $doctor= $fetch['doctor'];
                                // ? >
                        echo '<div class="col-50">
                            <div class="box" id="name">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fullname" placeholder="full name" value="'.$fullname.'">
                                <br><br>
                            </div>
                            <div class="box" id="phone">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="mob_no" placeholder="number" value="'.$mob_no.'">
                                <br><br>
                            </div>
                            <div class="box" id="add">
                                <label>Address</label>
                                <input type="text" class="form-control" name="home_add" placeholder="home-address" value="'.$home_add.'">
                                <br><br>
                            </div>
                            <div class="box" id="age">
                                <label>Age</label>
                                <input type="text" class="form-control" name="age" placeholder="age" value="'.$age.'">
                                <br><br>
                            </div>
                            <div class="box" id="gender">
                                <label>Gender</label>
                                <input type="text" class="form-control" name="gender" placeholder="Male/Female" value="'.$gender.'">
                                <br><br>
                            </div>
                            <div class="box" id="wt">
                                <label>Weight (in kilograms)</label>
                                <input type="float" class="form-control" name="weight" placeholder="Weight" value="'.$weight.'">
                                <br><br>
                            </div>
                            <div class="box" id="emg_name">
                                <label>Emergency Contact Name</label>
                                <input type="text" class="form-control" name="emg_name" placeholder="name" value="'.$emg_name.'">
                                <br><br>
                            </div>
                        </div>
                        <div class="col-50">
                            <div class="box" id="bp">
                                <label>Blood Pressure</label>
                                <input type="float" class="form-control" name="bp" placeholder="BP" value="'.$bp.'">
                                <br><br>
                            </div>
                            <div class="box" id="sugar">
                                <label>Sugar Level</label>
                                <input type="float" class="form-control" name="sugarL" placeholder="Sugar level" value="'.$sugarL.'">
                                <br><br>
                            </div>
                            <div class="box" id="hos_name">
                                <label>Hospital Name</label>
                                <input type="text" class="form-control" name="hos_name" placeholder="Hospital name" value="'.$hos_name.'">
                                <br><br>
                            </div>
                            <div class="box" id="doc_name">
                                <label>Doctor Name</label>
                                <input type="text" class="form-control" name="doctor" placeholder="Doctor name" value="'.$doctor.'">
                                <br><br>
                            </div>
                            <div class="box" id="hos_no">
                                <label>Hospital Number</label>
                                <input type="text" class="form-control" name="hos_no" placeholder="hospital-number" value="'.$hos_no.'">
                                <br><br>
                            </div>
                            <div class="box" id="hos_Add">
                                <label>Hospital Address</label>
                                <input type="text" class="form-control" name="hos_add" placeholder="hospital-address" value="'.$hos_add.'">
                                <br><br>
                            </div>
                            <div class="box" id="emg_no">
                                <label>Emergency Contact Number</label>
                                <input type="text" class="form-control" name="emg_no" placeholder="emergency-number" value="'.$emg_no.'">
                                <br><br>
                            </div>
                        </div>';
                        // < ?php 
                            }}}
                                // ? >
                                else {
                                    
                                echo '<div class="col-50">
                            <div class="box" id="name">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fullname" placeholder="Full name">
                                <br><br>
                            </div>
                            <div class="box" id="phone">
                                <label>Mobile Number</label>
                                <input type="text" class="form-control" name="mob_no" placeholder="Mobile number">
                                <br><br>
                            </div>
                            <div class="box" id="add">
                                <label>Address</label>
                                <input type="text" class="form-control" name="home_add" placeholder="Home-address">
                                <br><br>
                            </div>
                            <div class="box" id="age">
                                <label>Age</label>
                                <input type="text" class="form-control" name="age" placeholder="Age">
                                <br><br>
                            </div>
                            <div class="box" id="gender">
                                <label>Gender</label>
                                <input type="text" class="form-control" name="gender" placeholder="Male/Female">
                                <br><br>
                            </div>
                            <div class="box" id="wt">
                                <label>Weight (in kilograms)</label>
                                <input type="float" class="form-control" name="weight" placeholder="Weight">
                                <br><br>
                            </div>
                            <div class="box" id="emg_name">
                                <label>Emergency Contact Name</label>
                                <input type="text" class="form-control" name="emg_name" placeholder="Emg contact name">
                                <br><br>
                            </div>
                        </div>
                        <div class="col-50">
                            <div class="box" id="bp">
                                <label>Blood Pressure</label>
                                <input type="float" class="form-control" name="bp" placeholder="BP">
                                <br><br>
                            </div>
                            <div class="box" id="sugar">
                                <label>Sugar Level</label>
                                <input type="float" class="form-control" name="sugarL" placeholder="Sugar level">
                                <br><br>
                            </div>
                            <div class="box" id="hos_name">
                                <label>Hospital Name</label>
                                <input type="text" class="form-control" name="hos_name" placeholder="Hospital name">
                                <br><br>
                            </div>
                            <div class="box" id="doc_name">
                                <label>Doctor Name</label>
                                <input type="text" class="form-control" name="doctor" placeholder="Doctor name">
                                <br><br>
                            </div>
                            <div class="box" id="hos_no">
                                <label>Hospital Number</label>
                                <input type="text" class="form-control" name="hos_no" placeholder="Hospital-number">
                                <br><br>
                            </div>
                            <div class="box" id="hos_Add">
                                <label>Hospital Address</label>
                                <input type="text" class="form-control" name="hos_add" placeholder="Hospital-address">
                                <br><br>
                            </div>
                            <div class="box" id="emg_no">
                                <label>Emergency Contact Number</label>
                                <input type="text" class="form-control" name="emg_no" placeholder="Emergency-number">
                                <br><br>
                            </div>
                        </div>';
                            }
                         ?> 
                    </div>
                    
                    <div class="row">
                        <div class="col-25">
                            <button id="Insbtn" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col-25">
                            <button id="Selbtn" name="select" class="btn btn-primary">Select</button>
                        </div>
                        <div class="col-25">
                            <button id="Updbtn" name="update" class="btn btn-primary">Update</button>
                        </div>
                        <div class="col-25">
                            <button id="Delbtn" name="delete" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
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
                
                    </form>
                    
                </div>
            </div>
        </div> 
    </div>

    <script src="../static/scripts/navigation.js"></script>

</body>
</html>