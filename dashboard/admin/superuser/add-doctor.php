<?php
session_start();
include('../../../connect.php');
include('../../../functions.php');

if(!isset($_SESSION['name'])){
    header('location:../../../login.php');
}
if(isset($_POST['submit'])){
    
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $field = $_Post['field'];
    $password = $_POST['password'];
    $s = "select * from doctors where phone = '$phone'";
    $result = mysqli_query($conn, $s);
    $num = mysqli_num_rows($result);

    if($num == 1){
        
       echo '<script> alert("The user details already exists")</script>';
  
    }
    else{
        $reg = "insert into doctors(fullname, address, phone, field, password) values ('$fullname', '$address', '$phone', '$field', '$password')";
        mysqli_query($conn, $reg);
        header('location: add-doctor.php');
    }
}
?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add-doctor.css">
    <title>Dashboard</title>
</head>
<body>
   
    <!-- these are columns -->
    <div class="flex-container">
        
    <!-- this is a shadow that make the first column come out -->
    <div class="shadow"></div>

        <div class="column1">
            <div class="company-name-container">
                    <div class="company-name">
                        Veterinary
                    </div>
            </div>
            <div class="links-container">
                <div class="link">
                     <a href="dashboard.php"><span id='link'> Dashboard </span> </a>
                </div>
                <div class="link">
                    <a href="appointments.php"><span id='link'> Appointments </span></a>
                </div>
                <div class="link">
                    <a href="notifications.php"><span id='link'> Notifications </span> </a>
                </div>
                <div class="link">
                    <a href="settings.php"><span id='link'> Settings </span></a>
                </div>
                <div class="link">
                    <a href="../../logout.php" style="text-decoration: none; color: white">
                        <button class="logout" id="bttn">Logout</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- this is the second column -->
        <div class="column2">
            <!-- the form that will allow the admin to add a doctor -->
            <div class="main-dashboard-container" id="main-dashboard-container">
                <div class="header">
                   <div class="pagetitle">  ADD A DOCTOR.</div>
                   <a href="settings.php">
                        <div class="backarrow"><- Previous Page</div>
                    </a>
                </div>
                <div class="form-container">
                    <div class="form">
                        <form action="" method="post">
                            <input type="text" name="fullname" id="input" placeholder="Doctors Fullname">
                            <input type="text" name="address" id="input" placeholder="Doctors Address">
                            <div class="col">
                                <div class="col1"><input type="text" name="phone" id="input2" placeholder="Doctors Phone number"></div>
                                <div class="col2"> 
                                   <div class="docfield"> Doctors Field:</div>
                                    <div class="fieldbox">
                                        <select name="field" id="field">
                                            <option value="pet">Pet</option>
                                            <option value="livestock">Livestock</option>
                                        </select>
                                   </div>
                            </div>
                            </div>    
                            <input type="password" name="password" id="input" placeholder="Password">
                            <input type="submit" value="Add Doctor" name="submit" id="bttn" class="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script>

        //  greeting the user on top of the dashboad page

        const greeting = document.getElementById('greetings');
        const hour = new Date().getHours();
        const welcomeTypes = ["Good Morning,", "Good Afternoon,", "Good Evening,", "Good Night,"];
        let welcomeText = "";

        if (hour < 12){
            welcomeText = welcomeTypes[0];
        }
        else if (hour < 17){
            welcomeText = welcomeTypes[1];    
        }
        else if (hour < 20){
            welcomeText = welcomeTypes[2];
        }
        else {
            welcomeText = welcomeTypes[3];
        }

        greeting.innerHTML = welcomeText;

        // this is to close the modal
        
    </script>
</body>
</html>