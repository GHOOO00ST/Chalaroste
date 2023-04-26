<?php 
    ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href='stylesheet' rel='Frontend/style/registration.css'>
        <title>Registration</title>
    </head>
</html>
<body class="reg-body">
    <?php
    error_reporting(0);
    //errorvariables for names
    $errorFname="";
    $errorMname="";
    $errorLname="";
    //error variables for contacts
    $errorContact="";
    //error variables for emails
    $errorEmail="";
    //variables for dates of check in and check out
    $errordateOfCheckIn = "";

    
     //checks if first name is empty and contains text only
     if(empty($_POST['FNAME'])){
        $errorFname="First name is required.";
    } else if(!preg_match("/^[a-z A-Z]*$/", $_POST['FNAME'])){
        $errorFname="Only alphabets and whitespaces are allowed in first name.";
    }

    //checks if the middle name is empty and contains text only
    if(empty($_POST['MNAME'])){
        $errorMname="Middle name is required.";
    } else if(!preg_match("/^[a-z A-Z]*$/", $_POST['MNAME'])){
        $errorMname="Only alphabets and whitespaces are allowed in middle name.";
    }

    //checks if last name is empty and contains text only
    if(empty($_POST['LNAME'])){
        $errorLname="Last name is required.";
    } else if(!preg_match("/^[a-z A-Z]*$/", $_POST['LNAME'])){
        $errorLname="Only alphabets and whitespaces are allowed in last name.";
    }

    //checks if phone number is not empty, accepts numerical values only, and has 11 digits 
    if(empty($_POST['CONTACT'])){
        $errorContact="Phone number is required.";
    } else if(!preg_match("/^[0-9]*$/", $_POST['CONTACT'])){
        $errorContact="Only numerical values is accepted in phone number.";
    } else if(strlen($_POST['CONTACT'])!=11){
        $errorContact="Phone number should be 11 digits.";
    }
    //checks if email is empty
    if(empty($_POST['EMAIL'])){
        $errorEmail="Email is required.";
    }
    //checks if the date of check out is ahead before the check in
    if ($dateOfCheckIn=$_POST['DOCI'] > $dateOfCheckOut=$_POST['DOCU']){
        $errordateOfCheckIn = "The date of check in should be ahead than the date of check out";   
    }
    ?>
    <div class="reg-container">
        <h1 class="title">Registration</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="name-field">
                <!--FIRSTNAME-->
                <label for="FNAME"class="LFNAME">FIRST NAME</label>
                <input type="text"name="FNAME"id="FNAME"class="IFNAME" placeholder="FIRST NAME"><br>
                <span style="color: red; font-weight: 500"><?= $errorFname?></span>
                <!--MIDDLENAME-->
                <br>
                <label for="MNAME"class="LMNAME">MIDDLE NAME</label>
                <input type="text"name="MNAME"id="MNAME"class="IMNAME" placeholder="MIDDLE NAME"><br>
                <span style="color: red; font-weight: 500"><?= $errorMname?></span>
                <!--LASTNAME-->
                <br>
                <label for="LNAME"class="LLNAME">LAST NAME</label>
                <input type="text"name="LNAME"id="LNAME"class="ILNAME" placeholder="LAST NAME"><br>
                <span style="color: red; font-weight: 500"><?= $errorLname?></span>
            </div>
            <!--HOUSE NUMBER-->
            <br>
            <label for="hnumber" class="input-hnum">House Number</label>
            <input id="hnumber" class="input-hnumb" name="HNUMBER" type="text" placeholder="House No."><br>
            <!--Street/Subdivision-->
            <br>
            <label for="subd" class="input-subd">Street/Subdivision</label>
            <input id="subd" class="input-subdi" name="SUBDI" type="text" placeholder="Street/Subdivision"><br>
            <!--Barangay-->
            <br>
            <label for="brgy" class="input-brgy">Barangay</label>
            <input id="brgy" class="input-brgyfield" name="BRGY" type="text" placeholder="Barangay"><br>
            <!--City/Municipality-->
            <br>
            <label for="city" class="input-cm">City/Municipality</label>
            <input type="text" class="input-cityormuni" name="CM"id="cm" placeholder="City/Municipality"><br>
            <!--EMAIL-->
            <br>
            <label for="email"class="LEMAIL">Email</label>
            <input type="text"name="EMAIL"id="EMAIL"class="IEMAIL" placeholder="EMAIL"><br>
            <span style="color: red; font-weight: 500"><?= $errorEmail?></span>
            <!--CONTACT NUMBER-->
            <br>
            <label for="CONTACT"class="LCONTACT">Cellphone Number</label>
            <input type="tel"name="CONTACT"id="CONTACT"class="ICONTACT" placeholder="CONTACT"><br>
            <span style="color: red; font-weight: 500"><?= $errorContact?></span>
            <!--GENDER-->
            <br>
            <label class = "LGEN">Gender</label>
            <input id="MALE" name="GENDER" value="MALE" type="radio" class="IGEN"><label for="MALE" class="G">MALE</label>
            <input id="FEMALE" name="GENDER" value="FEMALE" type="radio" class="IGEN"> <label for="FEMALE" class="G">FEMALE</label>
            <br>
            <!--BIRTHDAY-->
            <br>
            <label for="BDAY"class="LBDAY">Birthdate</label>
            <input id="BDAY" name="BDAY" type="date" min="1900-01-01" max="2023-12-31" class="IBDAY"><br>
            <!--NATIONALITY-->
            <br>
            <label for="NATIONALITY" class="LNATIONALITY">Nationality</label>
            <input type="text"name="NATIONALITY"id="NATIONALITY"class="INATIONALITY"><br>
            <!--DATE OF CHECK IN-- DOCI==DATE OF CHECK IN-->
            <br>
            <label for="DOCI" class="LDOCI">Date of Check In</label>
            <input type="date" name="DOCI"id="DOCI"min="2023-01-01" max="2023-12-31" class= "IDOCI"><br>
            <span style="color: red; font-weight: 500"><?= $errordateOfCheckIn?></span>
            <!--DATE OF CHECK OUT-- DOCU = DATE OF CHECK OUT-->
            <br>
            <label for="DOCU" class="LDOCU">Date of Check Out</label>
            <input type="date" name="DOCU"id="DOCU"min="2023-01-01" max="2023-12-31" class= "IDOCU"><br>
            
            <br>
            <!--NUMBER OF GUEST-->
            <label for="NumberOfAdult" class = "LNumberOfAdult">Number of Adults:</label>
            <input type = "number" name="NumberOfAdult" id="NumberOfAdult" class=INumberOfAdult><br>

            <label for="NumberOfKids" class = "LNumberOfKids">Number of Kids:</label>
            <input type = "number" name="NumberOfKids" id="NumberOfKids" class=INumberOfKids><br>

            <input type="submit"name="submit"value="submit"class="btn-Submit"><br>
        </form>
    </div>

    <?php 
         if(isset($_POST['submit'])){
            if($errorFname==""&&$errorMname==""&&$errorLname==""&&$errorContact==""&&$errordoci==""&&$errordocu==""){
            error_reporting(0);
            $serverName="LAPTOP-CDRKF784\SQLEXPRESS08";
            $connectionOptions=[
            "Database"=>"DLSU",
            "Uid"=>"",
            "PWD"=>""
            ];
            $conn=sqlsrv_connect($serverName, $connectionOptions);
            if($conn==false)
                die(print_r(sqlsrv_errors(),true));

                $FNM = $_POST['FNAME'];
                $MNM = $_POST['MNAME'];
                $LNM = $_POST['LNAME'];
                $HN = $_POST['HNUMBER'];
                $SBS = $_POST['SUBDI'];
                $BRGY = $_POST['BRGY'];
                $CMY = $_POST['CM'];
                $EML = $_POST['EMAIL'];
                $CNM = $_POST['CONTACT'];
                $GND = $_POST['GENDER'];
                $BDY = $_POST['BDAY'];
                $NTN = $_POST['NATIONALITY'];
                $dateOfCin= $_POST['DOCI'];
                $dateOfCout = $_POST['DOCU'];
                $NumberOfAdult = $_POST['NumberOfAdult'];
                $NumberOfKids = $_POST['NumberOfKids'];


                $SQL = "INSERT INTO REGISTRATION(F_NAME,M_NAME,L_NAME,H_NUMBER,SUBDIVISION,BRGY,CITY_MUNICIPALITY,EMAIL,CONTACT,GENDER,BDAY,NATIONALITY,DATE_OF_CHECK_IN,DATE_OF_CHECK_OUT,NUMBER_OF_ADULTS,NUMBER_OF_KIDS)
                VALUES('$FNM','$MNM','$LNM','$HN','$SBS','$BRGY','$CMY','$EML','$CNM','$GND','$BDY','$NTN','$dateOfCin','$dateOfCout','$NumberOfAdult','$NumberOfKids')";
                $RSLTS = sqlsrv_query($conn,$SQL);
                if($RSLTS){
                    header("location: loginpage.php");
                    exit();
                    echo 'Registration Successful';
                }else{
                    echo 'Error';
                }
                
            }
        }
    ?>
</body>