<?php
    session_start();
    include 'connect.php';

    if(isset($_POST['login'])){
        
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
       
    

        // authenticating the user input to authorize login
        $s = "select * from users where fullname = '$fullname' && phone = '$phone' && password = '$password'";
        $d = "select * from doctors where fullname = '$fullname' && phone = '$phone' && password = '$password'";
        $result = mysqli_query($conn, $s);
        $result2 = mysqli_query($conn, $d);
        $num = mysqli_num_rows($result);
        $num2 = mysqli_num_rows($result2);
    
        if($num > 0){

            $response = mysqli_fetch_assoc($result);

            // use this to create a reference 
            // to get name for greeting 
            // to be used in the dasbord from the database


            if($response['role'] == "admin"){
                $_SESSION['name'] = $fullname;
                $_SESSION ['phone']= $phone;
                header('location: dashboard/admin/superuser/dashboard.php');
            }
            else{
                $_SESSION['name'] = $fullname;
                $_SESSION['phone'] = $phone;
                header('location: dashboard/index.php');
            }
            
        }elseif ($num2 > 0) {
            $response2 = mysqli_fetch_assoc($result2);
            // to let the doctor login into his dashboard
            $_SESSION['name'] = $fullname;
            $_SESSION['phone'] = $phone;
            header('location: dashboard/admin/dashboard.php');
        }
        else{
            $s = "select * from users where fullname = '$fullname' || phone = '$phone' || password = '$password'";
            $result = mysqli_query($conn, $s);
            $num = mysqli_num_rows($result);

            $response = mysqli_fetch_assoc($result);

            if($fullname != $response['fullname']){
                echo '<script> alert("the name entered is incorrect")</script>';
            }
            if ($phone != $response['phone']) {
                echo '<script> alert("the phone entered is incorrect")</script>';
            }
            if ($password != $response['password']) {
                echo '<script> alert("the password entered is incorrect")</script>';
            }
        }

        // reading employee data from the database
        $sql = "SELECT * FROM appointments";
        $result = $conn->query($sql);
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vet Appointment Booking</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="body">
    <h1>
        <span id="left-h1">Appointment Booking</span>
    </h1>

    <div class="form-container">
        <div class="form">
            <fieldset class="fieldset">
                <legend class="legend">
                    <h2>We are ready to help</h2> 
                </legend>
                <form method="POST" action="login.php" name="form" onsubmit="return validated()">
                    <input type="text" name="fullname" id="email" placeholder="Fullname" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 100;"
                        onclick="document.getElementById('email').style.border = 'none'">
                    <br>
                    <input type="text" name="phone" id="phone" placeholder="Phone" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 100;"
                        onclick="document.getElementById('phone').style.border = 'none'">
                    <br>
                    <input type="password" name="password" id="password" placeholder="Password" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; font-weight: 100;"
                        onclick="document.getElementById('password').style.border = 'none'">
                    <br>
                    <div class="btn" style="margin-top: 10px;">
                    <input type="submit" name="login" value="Log In" id="bttn">
                    </div>
                </form>
                
                <div class="fieldset-container" style="text-align: center;">
                    <fieldset class="fieldset2">
                        <legend class="legend2">
                            <span style="color: white; font-size: large;">or</span>
                        </legend>
                    </fieldset>
                </div>
                <div class="btn">
                    <a href="sign-up.php"><button id="bttn">Sign Up</button></a>
                </div>
            </fieldset>
            
        </div>
    </div>
    </div>
    <script src="valid.js"></script>
</body>

</html>