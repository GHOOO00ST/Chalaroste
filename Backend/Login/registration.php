<?php 
    ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>STUDENT PAGE</title>
    </head>
</html>
<body>
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
        $errordateOfCheckIn = "the date of check in is ahead than the date of check out";   
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <!--FIRSTNAME-->
        <label for="FNAME"class="LFNAME">FIRST NAME:</label>
        <input type="text"name="FNAME"id="FNAME"class="IFNAME" placeholder="FIRST NAME"><br>
        <span style="color: red; font-weight: 500"><?= $errorFname?></span>
        <!--MIDDLENAME-->
        <br>
        <label for="MNAME"class="LMNAME">MIDDLE NAME:</label>
        <input type="text"name="MNAME"id="MNAME"class="IMNAME" placeholder="MIDDLE NAME"><br>
        <span style="color: red; font-weight: 500"><?= $errorMname?></span>
        <!--LASTNAME-->
        <br>
        <label for="LNAME"class="LLNAME">LAST NAME:</label>
        <input type="text"name="LNAME"id="LNAME"class="ILNAME" placeholder="LAST NAME"><br>
        <span style="color: red; font-weight: 500"><?= $errorLname?></span>
        <!--HOUSE NUMBER-->
        <br>
        <label for="hnumber">House Number</label>
        <input id="hnumber" name="HNUMBER" type="text" placeholder="House No."><br>
        <!--Street/Subdivision-->
        <br>
        <label for="subd">Street/Subdivision</label>
        <input id="subd" name="SUBDI" type="text" placeholder="Street/Subdivision"><br>
        <!--Barangay-->
        <br>
        <label for="brgy">Barangay</label>
        <input id="brgy" name="BRGY" type="text" placeholder="Barangay"><br>
        <!--City/Municipality-->
        <br>
        <label for="city">City/Municipality</label>
        <input type="text"name="CM"id="cm" placeholder="City/Municipality"><br>
        <!--EMAIL-->
        <br>
        <label for="email"class="LEMAIL">EMAIL:</label>
        <input type="text"name="EMAIL"id="EMAIL"class="IEMAIL" placeholder="EMAIL"><br>
        <span style="color: red; font-weight: 500"><?= $errorEmail?></span>
        <!--CONTACT NUMBER-->
        <br>
        <label for="CONTACT"class="LCONTACT">CONTACT:</label>
        <input type="tel"name="CONTACT"id="CONTACT"class="ICONTACT" placeholder="CONTACT"><br>
        <span style="color: red; font-weight: 500"><?= $errorContact?></span>
        <!--GENDER-->
        <br>
        <label class = "LGEN">GENDER:</label>
        <input id="MALE" name="GENDER" value="MALE" type="radio" class="IGEN"><label for="MALE" class="G">MALE</label>
        <input id="FEMALE" name="GENDER" value="FEMALE" type="radio" class="IGEN"> <label for="FEMALE" class="G">FEMALE</label>
        <br>
        <!--BIRTHDAY-->
        <br>
        <label for="BDAY"class="LBDAY">BIRTHDAY:</label>
        <input id="BDAY" name="BDAY" type="date" min="1900-01-01" max="2023-12-31" class="IBDAY"><br>
        <!--NATIONALITY-->
        <br>
        <label for="NATIONALITY" class="LNATIONALITY">NATIONALITY:</label>
        <input type="text"name="NATIONALITY"id="NATIONALITY"class="INATIONALITY"><br>
        <!--DATE OF CHECK IN-- DOCI==DATE OF CHECK IN-->
        <br>
        <label for="DOCI" class="LDOCI">DATE OF CHECK IN:</label>
        <input type="date" name="DOCI"id="DOCI"min="2023-01-01" max="2023-12-31" class= "IDOCI"><br>
        <span style="color: red; font-weight: 500"><?= $errordateOfCheckIn?></span>
        <!--DATE OF CHECK OUT-- DOCU = DATE OF CHECK OUT-->
        <br>
        <label for="DOCU" class="LDOCU">DATE OF CHECK OUT:</label>
        <input type="date" name="DOCU"id="DOCU"min="2023-01-01" max="2023-12-31" class= "IDOCU"><br>
        
        <br>
        <!--NUMBER OF GUEST-->
        <label for="NumberOfAdult" class = "LNumberOfAdult">Number of Guest Adult:</label>
        <input type = "number" name="NumberOfAdult" id="NumberOfAdult" class=INumberOfAdult><br>

        <label for="NumberOfKids" class = "LNumberOfKids">Number of Guest Kids:</label>
        <input type = "number" name="NumberOfKids" id="NumberOfKids" class=INumberOfKids><br>

        <input type="submit"name="submit"value="submit"class="btnSubmit"><br>
    </form>

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
                    echo 'registration Successful';
                }else{
                    echo 'Error';
                }
                
            }
        }
    ?>
</body>