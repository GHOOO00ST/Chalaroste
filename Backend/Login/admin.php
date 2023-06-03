<?php 
    ob_start(); 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!--CSS-->
    <link rel="stylesheet" href="style/adminlogin.scss">
    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href='style/adminlogin.scss' rel='stylesheet'>
</head>
<body>
    <center>
        <div class="container">
            <div class="admin-user">
                <!-- ADMIN LOGIN --> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="admin-form">
                    <h2 class="title">Admin Login</h2>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="adminid" id="adminid" placeholder="ADMINID">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="adminpassword" id="adminpassword" placeholder="Password">
                    </div>
                    <input type="submit" value="LOG IN" name="adminsubmit" class="btn1">
                </form>
                <form>
                    <button class="btn2" onclick="gotoFunction()" type="button">Log in as User</button>
                    <script>
                        function gotoFunction(){
                            window.location.href = "loginpage.php";
                        }
                    </script>
                </form>
            </div>
        </div> 
    </center>
</body>
</html>
<?php
    if(isset($_POST['adminsubmit'])){  
        error_reporting(0);
        $serverName="LAPTOP-CDRKF784\SQLEXPRESS08";
        $connectionOptions=[
            "Database"=>"DLSU",
            "Uid"=>"",
            "PWD"=>""
        ];
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if($conn == false){
            die(print_r(sqlsrv_errors(),true));
        } 

        $idadmin = $_POST['adminid'];
        $passwordid = ($_POST['adminpassword']);

        if(empty($idadmin) || empty($passwordid)){
            echo "<p style='position:absolute; bottom: 20px; font-size: 16px; font-weight: 500; color: white;'>ADMIN USER and password is required.</p>";
        } else {
            $sql = "SELECT * FROM ADMIN WHERE USERNAME = '$idadmin' AND PASSWORD = '$passwordid'";
            $results = sqlsrv_query($conn, $sql); 
            $row = sqlsrv_fetch_array($results);
                    
            if($row['USERNAME']==$idadmin && $row['PASSWORD']==$passwordid){
                header("Location: http://localhost/Chalaroste/Frontend/Login%20Page/adminlogin.html"); //to be replace with an actual link
                exit();
            }else{
                echo "<p style='position:absolute; bottom: 20px; font-size: 16px; font-weight: 500; color: white;'>Incorrect ADMIN USER or password. Please try again.</p>";
            }   
        }
    }   
?>