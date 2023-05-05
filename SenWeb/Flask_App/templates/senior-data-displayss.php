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
        

    <div class="page">
        <div class="top">
            <!-- <img src="./media/images/e1.png" alt="" srcset=""> -->
        </div>
        <div class="form">
            <div style="overflow-x: auto;overflow-y: auto;">
                <input type="text" id="myInput"  placeholder="Search for names..." onkeyup="myFunction();">
                <table id="data" class="display">
                    <thead>
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
                    </thead>
                    <tbody id="tbody1"></tbody>
                    </table>
                    
            </div>
        </div>
    </div>
</div>

<script src="../static/scripts/navigation.js"></script>

<script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("data");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>

    <script type="module">
        var stdNo = 0;
        var tbody = document.getElementById('tbody1');

        function AddItemToTable(full_name,age,gender,weight,blood_pressure,sugar_level,mobile,address,emer_name,emer_contact,hosp_name,doc_name,hosp_no,hosp_address){
            let trow = document.createElement("tr");
            let td1 = document.createElement('td');
            let td2 = document.createElement('td');
            let td3 = document.createElement('td');
            let td4 = document.createElement('td');
            let td5 = document.createElement('td');
            let td6 = document.createElement('td');
            let td7 = document.createElement('td');
            let td8 = document.createElement('td');
            let td9 = document.createElement('td');
            let td10 = document.createElement('td');
            let td11 = document.createElement('td');
            let td12 = document.createElement('td');
            let td13 = document.createElement('td');
            let td14 = document.createElement('td');
            let td15 = document.createElement('td');

            td1.innerHTML= ++stdNo;
            td2.innerHTML= full_name;
            td3.innerHTML= age;
            td4.innerHTML= gender;
            td5.innerHTML= weight;
            td6.innerHTML= blood_pressure;
            td7.innerHTML= sugar_level;
            td8.innerHTML= mobile;
            td9.innerHTML= address;
            td10.innerHTML= emer_name;
            td11.innerHTML= emer_contact;
            td12.innerHTML= hosp_name;
            td13.innerHTML= doc_name;
            td14.innerHTML= hosp_no;
            td15.innerHTML= hosp_address;

            trow.appendChild(td1);
            trow.appendChild(td2);
            trow.appendChild(td3);
            trow.appendChild(td4);
            trow.appendChild(td5);
            trow.appendChild(td6);
            trow.appendChild(td7);
            trow.appendChild(td8);
            trow.appendChild(td9);
            trow.appendChild(td10);
            trow.appendChild(td11);
            trow.appendChild(td12);
            trow.appendChild(td13);
            trow.appendChild(td14);
            trow.appendChild(td15);

            tbody.appendChild(trow);

        }
        
        function AddAllItemsToTable(seniors_data){
            stdNo=0;
            tbody.innerHTML="";
            seniors_data.forEach(element => {
                AddItemToTable(element.FullName,element.Age,element.Gender,element.Weight,element.Blood_pressure,element.Sugar_level,element.Mobile_number,element.Home_address,element.Emergency_name,element.Emergency_number,element.Hospital_name,element.Doctor_name,element.Hospital_number,element.Hospital_address)
            });
        }

        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";

        const firebaseConfig = {
            apiKey: "AIzaSyAM8DE0QInD_RcGaArxoG3ClgStkJlCKW4",
            authDomain: "sencare-data-90957.firebaseapp.com",
            databaseURL: "https://sencare-data-90957-default-rtdb.firebaseio.com",
            projectId: "sencare-data-90957",
            storageBucket: "sencare-data-90957.appspot.com",
            messagingSenderId: "254317902444",
            appId: "1:254317902444:web:bcb5b577e12de0e252f649"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);

        import { getDatabase, ref, push, child, onValue, get}
        from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";
    
        const database = getDatabase();

        function GetAllDataOnce(){
            const dbRef = ref(database);

            get(child(dbRef, "seniors_data"))
            .then((snapshot)=>{
                var seniors = [];

                snapshot.forEach(childSnapshot => {
                    seniors.push(childSnapshot.val());
                }); 

                AddAllItemsToTable(seniors);
            })
        }

        
        function GetAllDataRealtime(){
            const dbRef = ref(database, "seniors_data");

            onValue(dbRef,(snapshot)=>{
                var seniors = [];

                snapshot.forEach(childSnapshot => {
                    seniors.push(childSnapshot.val());
                }); 

                AddAllItemsToTable(seniors);

            })

        
        }

        window.onload = GetAllDataRealtime;

    </script>             
    
</body>
</html>