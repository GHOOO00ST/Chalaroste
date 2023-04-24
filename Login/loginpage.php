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
    <link rel="stylesheet" href="Style/style.css">
    <!--Box Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <center>
    <div class="container">
        <div class="admin-user">
            <!-- ADMIN LOGIN -->
            <!--USER LOGIN-->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="user-form">
                <h2 class="title">User Login</h2>
                <div class="input-field">
                    <i class='bx bxs-user'></i>
                    <input type="text" name="username" id="text1" placeholder="USERNAME">
                </div>
                <div class="input-field">
                    <i class='bx bxs-lock-alt'></i>
                    <input type="password" name="userpassword" id="password1" placeholder="PASSWORD">
                </div>
                <input type="submit" value="LOG IN" name="usersubmit" class="btn1">
                <br>
                <button onclick="gotoFunction()" type ="button" class="btns">Log in as Admin</button>
                <script>
                    function gotoFunction(){
                    window.location.href = "admin.php";
                    }
                </script>
            </form>
        </div>
        </center>
</body>
</html>
<!-- USER LOGIN -->
<?php
    if(isset($_POST['usersubmit'])){  
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

        $USER = $_POST['username'];
        $PASSWORD = ($_POST['userpassword']);

        if(empty($USER) || empty($PASSWORD)){
            echo "<p style='position:absolute; bottom: 20px; font-size: 16px; font-weight: 500; color: red;'>USER and password is required.</p>";
        } else {
            $sql = "SELECT * FROM GUEST WHERE USERNAME = '$USER' AND PASSWORD = '$PASSWORD'";
            $results = sqlsrv_query($conn, $sql); 
            $row = sqlsrv_fetch_array($results);
            
            if($row['USERNAME']==$USER && $row['PASSWORD']==$PASSWORD){
                header("location:guestlogin.html");
               exit();
            }else{
                echo "<p style='position:absolute; bottom: 20px; font-size: 16px; font-weight: 500; color: red;'>Incorrect USER or password. Please try again.</p>";
            }   
        }
    } 
?>
<!-- ADMIN LOGIN -->
