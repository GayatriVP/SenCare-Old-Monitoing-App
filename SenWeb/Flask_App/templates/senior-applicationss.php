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
    </style>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <p class="text">Hello, <?php echo $_SESSION['name'];?></p>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="landing.php" class="active">Dashboard</a>
        <a href="senior-application.php">Add Senior</a>
        <a href="#">Profile</a>
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
                    <div class="row">
                        <div class="col-50">
                            <div class="box" id="name">
                                <label>Full Name</label>
                                <input type="text" class="form-control" id="full-name" placeholder="full name">
                                <br><br>
                            </div>
                            <div class="box" id="phone">
                                <label>Mobile Number</label>
                                <input type="tel" class="form-control" id="mobile-number" placeholder="number">
                                <br><br>
                            </div>
                            <div class="box" id="add">
                                <label>Address</label>
                                <input type="text" class="form-control" id="home-address" placeholder="home-address">
                                <br><br>
                            </div>
                            <div class="box" id="age">
                                <label>Age</label>
                                <input type="number" class="form-control" id="age" placeholder="age">
                                <br><br>
                            </div>
                            <div class="box" id="gender">
                                <label>Gender</label>
                                <input type="text" class="form-control" id="gender" placeholder="Male/Female">
                                <br><br>
                            </div>
                            <div class="box" id="wt">
                                <label>Weight (in kilograms)</label>
                                <input type="float" class="form-control" id="weight" placeholder="Weight">
                                <br><br>
                            </div>
                            <div class="box" id="emg_name">
                                <label>Emergency Contact Name</label>
                                <input type="text" class="form-control" id="emergency-name" placeholder="name">
                                <br><br>
                            </div>
                        </div>
                        <div class="col-50">
                            <div class="box" id="bp">
                                <label>Blood Pressure</label>
                                <input type="float" class="form-control" id="blood-pressure" placeholder="BP">
                                <br><br>
                            </div>
                            <div class="box" id="sugar">
                                <label>Sugar Level</label>
                                <input type="float" class="form-control" id="sugar-level" placeholder="Sugar level">
                                <br><br>
                            </div>
                            <div class="box" id="hos_name">
                                <label>Hospital Name</label>
                                <input type="text" class="form-control" id="hospital-name" placeholder="Hospital name">
                                <br><br>
                            </div>
                            <div class="box" id="doc_name">
                                <label>Doctor Name</label>
                                <input type="text" class="form-control" id="doctor-name" placeholder="Doctor name">
                                <br><br>
                            </div>
                            <div class="box" id="hos_no">
                                <label>Hospital Number</label>
                                <input type="tel" class="form-control" id="hospital-number" placeholder="hospital-number">
                                <br><br>
                            </div>
                            <div class="box" id="hos_Add">
                                <label>Hospital Address</label>
                                <input type="text" class="form-control" id="hospital-address" placeholder="hospital-address">
                                <br><br>
                            </div>
                            <div class="box" id="emg_no">
                                <label>Emergency Contact Number</label>
                                <input type="tel" class="form-control" id="emergency-number" placeholder="emergency-number">
                                <br><br>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-25">
                            <button id="Insbtn" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="col-25">
                            <button id="Selbtn" class="btn btn-primary">Select</button>
                        </div>
                        <div class="col-25">
                            <button id="Updbtn" class="btn btn-primary">Update</button>
                        </div>
                        <div class="col-25">
                            <button id="Delbtn" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                    
                    <br><br>
                </div>
            </div>
            <div class="right">
                
            </div>
        </div> 
    </div>

    <script src="../static/scripts/navigation.js"></script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
        
        // https://firebase.google.com/docs/web/setup#available-libraries
      
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
          apiKey: "AIzaSyAM8DE0QInD_RcGaArxoG3ClgStkJlCKW4",
          authDomain: "sencare-data-90957.firebaseapp.com",
          projectId: "sencare-data-90957",
          storageBucket: "sencare-data-90957.appspot.com",
          messagingSenderId: "254317902444",
          appId: "1:254317902444:web:bcb5b577e12de0e252f649"
        };
      
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        
        import { getDatabase, set, ref,get, push, child, update, remove}
        from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";
        // TODO: Add SDKs for Firebase products that you want to use
    
        // Initialize Realtime Database and get a reference to the service
        const database = getDatabase();
          // write data
        var fullName = document.getElementById('full-name');  
        var age = document.getElementById('age');  
        var gender = document.getElementById('gender');
        var weight = document.getElementById('weight');  
        var blood_pressure = document.getElementById('blood-pressure'); 
        var sugar_level = document.getElementById('sugar-level');  
        var mobile_number = document.getElementById('mobile-number');
        var home_address = document.getElementById('home-address'); 
        var emergency_name = document.getElementById('emergency-name');  
        var emergency_number = document.getElementById('emergency-number');
        var hospital_name = document.getElementById('hospital-name');   
        var doctor_name = document.getElementById('doctor-name');   
        var hospital_number = document.getElementById('hospital-number');
        var hospital_address = document.getElementById('hospital-address');      
        
        var insBtn= document.getElementById("Insbtn");
        var selBtn= document.getElementById("Selbtn");
        var updBtn= document.getElementById("Updbtn");
        var delBtn= document.getElementById("Delbtn");
        
    
    //--------------Insert Data Function-----------------//
        function InsertData(){
            set(ref(database, 'seniors_data/' + fullName.value),{
                FullName: fullName.value,
                Age: age.value,
                Gender: gender.value,
                Weight: weight.value,
                Blood_pressure: blood_pressure.value,
                Sugar_level: sugar_level.value,
                Mobile_number: mobile_number.value,
                Home_address: home_address.value,
                Emergency_name: emergency_name.value,
                Emergency_number: emergency_number.value,
                Hospital_name: hospital_name.value,
                Doctor_name: doctor_name.value,
                Hospital_number: hospital_number.value,
                Hospital_address: hospital_address.value
            })
            .then(()=>{
                alert("Data stored successfully");
            })
            .catch((error)=>{
                alert("unsuccessful, error"+error);
            })
       }
    //--------Select Record-------------//
    function SelectData(){
        const dbRef = ref(database);
    
                    get(child(dbRef,'seniors_data/' + fullName.value)).then((snapshot)=>{
                        if(snapshot.exists()){
                            age.value= snapshot.val().Age;
                            gender.value= snapshot.val().Gender;
                            weight.value= snapshot.val().Weight;
                            blood_pressure.value= snapshot.val().Blood_pressure;
                            sugar_level.value= snapshot.val().Sugar_level;
                            mobile_number.value= snapshot.val().Mobile_number;
                            home_address.value= snapshot.val().Home_address;
                            emergency_name.value= snapshot.val().Emergency_name;
                            emergency_number.value= snapshot.val().Emergency_number;
                            hospital_name.value= snapshot.val().Hospital_name;
                            doctor_name.value= snapshot.val().Doctor_name;
                            hospital_number.value= snapshot.val().Hospital_number;
                            hospital_address.value= snapshot.val().Hospital_address;
                        }
                        else{
                            alert("No data found");
                        }
                    })
                    .catch((error)=>{
                        alert("unsuccessful, error"+error);
                    });
    }
    
    //--------Update Record--------------//
    function UpdateData(){
        update(ref(database, 'seniors_data/' + fullName.value),{
                Age: age.value,
                Gender: gender.value,
                Weight: weight.value,
                Blood_pressure: blood_pressure.value,
                Sugar_level: sugar_level.value,
                Mobile_number: mobile_number.value,
                Home_address: home_address.value,
                Emergency_name: emergency_name.value,
                Emergency_number: emergency_number.value,
                Hospital_name: hospital_name.value,
                Doctor_name: doctor_name.value,
                Hospital_number: hospital_number.value,
                Hospital_address: hospital_address.value
            })
            .then(()=>{
                alert("Data updated successfully");
            })
            .catch((error)=>{
                alert("unsuccessful, error"+error);
            })
    }
    //--------Delete Record-------------//
    function DeleteData(){
        remove(ref(database, 'seniors_data/' + fullName.value))
            .then(()=>{
                alert("Data removed successfully");
            })
            .catch((error)=>{
                alert("unsuccessful, error"+error);
            })
    }
    
    
    //--------------Assign Events To Btns-----------------//
            insBtn.addEventListener('click',InsertData)
            selBtn.addEventListener('click',SelectData)
            updBtn.addEventListener('click',UpdateData)
            delBtn.addEventListener('click',DeleteData)
    
      </script>
</body>
</html>