<?php
session_start();
include('../../connect.php');
include('../../functions.php');

if(!isset($_SESSION['name'])){
    header('location:../../login.php');
}

?>

<DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="calendar.css">
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
                    <span id='link'> Dashboard
                </div>
                <div class="link">
                    <a href="appointments.php"><span id='link'> Appointments </span></a>
                </div>
                <div class="link">
                    <a href="notifications.php"><span id='link'> Notifications </span> </a>
                </div>
                <div class="link">
                    <a href="../logout.php" style="text-decoration: none; color: white">
                        <button class="logout" id="bttn">Logout</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- this is the second column -->
        <div class="column2">
            <div class="greetings-container">
                <span class="greetings" id="greetings"></span>
                <?php 
                    // this is to call the name of the user with the session variable
                   
                    echo ucwords($_SESSION['name']) . '.';
                ?> 
            </div>

            <!-- 1.Dashboard -->
            <div class="main-dashboard-container" id="main-dashboard-container">
                <div class="dashboard"> 
                    <a href="appointments.php" class="appointments-container" id="link2">
                        <div class="appointments">
                            <div class="count-container">
                                <div class="count-info">
                                    Appointments
                                </div>
                                <div class="count">
                                    <?php
                                        $admin_field = "SELECT field FROM users WHERE phone = '".$_SESSION['phone']."'";
                                        $link_field = mysqli_query($conn, $admin_field);
                                        $field_num = mysqli_num_rows($link_field);
                                        if(empty($field_num)){
                                            echo "The current admin has no field set during registration";
                                            header('location:dashboard.php');
                                        }else{
                                            $fetch_field = mysqli_fetch_assoc($link_field);
                                            $_SESSION['field'] = $fetch_field['field'];
                                            $appointments = "SELECT * from appointments WHERE field = '".$_SESSION['field']."'";
                                            $link_appointments = mysqli_query($conn, $appointments);
                                            $appointments_num = mysqli_num_rows($link_appointments);
                                            echo $appointments_num;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="notifications-container" id="link2">
                        <a href="notifications.php">
                            <div class="notifications">
                                <div class="count-container">
                                    <div class="count-info">
                                        Notifications
                                    </div>
                                <!-- thi is the number badge for the counter -->
                                <div class="count">
                                    <?php
                                        $count1 = "SELECT * FROM notifications Where phone = '" .$_SESSION['phone']."'";
                                        $countlink = mysqli_query($conn, $count1);
                                        $count = mysqli_num_rows($countlink);
                                        echo $count;
                                    ?>
                                </div>
                            </div>
                            </div>
                        </a>
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