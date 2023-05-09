<?php 
    ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="registration.css" rel='stylesheet'>
        <title>Registration</title>
    </head>
</html>
<?php
    $errors = array();
    error_reporting(0);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //checks if the date of check out is ahead before the check in
    $currentDate = Date('Y-m-d 00:00:00.000');
    $checkInDate = $_POST['DOCI'];
    $checkOutDate = $_POST['DOCU'];
    if ($dateOfCheckIn=$_POST['DOCI'] > $dateOfCheckOut=$_POST['DOCU']){
        $errors['DOCI'] = "The date of check in should be ahead than the date of check out";   
    }
    else if($checkInDate < $currentDate || $checkOutDate <  $currentDate ){
        $errors['DOCI'] = "The date of is behind of the current date";
    }
    
    //contact validation
    $phone_number = $_POST['CONTACT'];
    // Define the regular expression for a phone number
    $phone_regex = "/^\+?\d{1,3}[\s.-]?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/";
    // Check if the phone number matches the regular expression
    if (!preg_match($phone_regex, $phone_number)) {
    $errors['CONTACT'] = 'Invalid phone number';
    }else{
        $phone_number = $_POST['CONTACT'];
        if(strlen($_POST['CONTACT'])!=11){
            $errors['CONTACT'] = 'Contact should be 11 numbers only.';
        }
    }
    //checks if first name is empty and contains text only
    if (empty($_POST['FNAME'])) {
            $errors['FNAME'] = 'Firstname is required';
        } else {
            $FNM = trim($_POST['MNAME']);
            if (!preg_match('/^[a-zA-Z ]+$/', $FNM)) {
            $errors['FNAME'] = 'Name must contain only letters and spaces';
            }
        }

    //checks if the middle name is empty and contains text only
    if (empty($_POST['MNAME'])) {
            $errors['MNAME'] = 'Middlename is required';
    } else {
        $MNM = trim($_POST['MNAME']);
        if (!preg_match('/^[a-zA-Z ]+$/', $MNM)) {
        $errors['MNAME'] = 'Name must contain only letters and spaces';
        }
    }

    ?>
    <div class="reg-container">
        <h1 class="title">Registration</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="name-field">
                <!--FIRSTNAME-->
                <label for="FNAME"class="LFNAME">FIRST NAME</label>
                <input type="text"name="FNAME"id="FNAME"class="IFNAME" placeholder="FIRST NAME" required><br>
                <span style="color: red; font-weight: 500"><?= $errorFname?><br> </span>
                <!--MIDDLENAME-->
                <br>
                <label for="MNAME"class="LMNAME">MIDDLE NAME</label>
                <input type="text"name="MNAME"id="MNAME"class="IMNAME" placeholder="MIDDLE NAME" required><br>
                <span style="color: red; font-weight: 500"><?= $errorMname?></span>
                <!--LASTNAME-->
                <br>
                <label for="LNAME"class="LLNAME">LAST NAME</label>
                <input type="text"name="LNAME"id="LNAME"class="ILNAME" placeholder="LAST NAME" required><br>
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
            <input type="text"name="EMAIL"id="EMAIL"class="IEMAIL" placeholder="EMAIL" required><br>
            <span style="color: red; font-weight: 500"><?= $errorEmail?></span>
            <!--CONTACT NUMBER-->
            <br>
            <label for="CONTACT"class="LCONTACT">Cellphone Number</label>
            <input type="tel"name="CONTACT"id="CONTACT"class="ICONTACT" placeholder="CONTACT" required><br>
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
            <input id="BDAY" name="BDAY" type="date" min="1958-01-01" max="2005-12-31" class="IBDAY"><br>
            <!--NATIONALITY-->
            <br>
            <label for="NATIONALITY" class="LNATIONALITY">Nationality</label>
            <input type="text"name="NATIONALITY"id="NATIONALITY"class="INATIONALITY"><br>
            <!--DATE OF CHECK IN-- DOCI==DATE OF CHECK IN-->
            <br>
            <label for="DOCI" class="LDOCI">Date of Check In</label>
            <input type="date" name="DOCI"id="DOCI"min="2023-01-01" max="2023-12-31" class= "IDOCI" required><br>
            <span style="color: red; font-weight: 500"><?= $errordateOfCheckIn?></span>
            <span style="color: red; font-weight: 500"><?= $errordateOfCurrentDate?></span>
            <!--DATE OF CHECK OUT-- DOCU = DATE OF CHECK OUT-->
            <br>
            <label for="DOCU" class="LDOCU">Date of Check Out</label>
            <input type="date" name="DOCU"id="DOCU"min="2023-01-01" max="2023-12-31" class= "IDOCU" required><br>
            <span style="color: red; font-weight: 500"><?= $errordateOfCurrentDate?></span>
            
            <br>
            <!--NUMBER OF GUEST-->
            <label for="NumberOfAdult" class = "LNumberOfAdult">Number of Adults:</label>
            <input type = "number" name="NumberOfAdult" id="NumberOfAdult" class=INumberOfAdult required><br>
            <span style="color: red; font-weight: 500"><?= $errorNumberofGuest?></span>

            <br><label for="NumberOfKids" class = "LNumberOfKids">Number of Kids:</label>
            <input type = "number" name="NumberOfKids" id="NumberOfKids" class=INumberOfKids required><br>
            <br><span style="color: red; font-weight: 500"><?= $errorNumberofGuest?></span>

            <input type="submit"name="submit"value="submit"class="btn-Submit"><br>
        </form>
    </div>

    if (empty($errors)) {
        // Save the data to a database or send an email, etc.
        // ...
        // Redirect to a thank-you page
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
                header("location: http://localhost/Chalaroste/Frontend/Login%20Page/regsuccess.html");//to be replace with an actual link
                exit();
                echo 'Registration LoginSuccessful';
            }else{
                echo 'Error';
            }
            
        }
    }
?>
<div class="reg-container">
<h1 class="title">Registration</h1>
<form action="" method="POST">
    <div class="name-field">
        <!--FIRSTNAME-->
        <label for="FNAME"class="LFNAME">FIRST NAME</label>
        <input type="text"name="FNAME"id="FNAME"class="IFNAME" placeholder="FIRST NAME"><br>
        <?php if(isset($errors['FNAME']) && !empty($errors)) { echo '<span class="error">' . $errors['FNAME'] . '</span>'; } ?>
        
        <!--MIDDLENAME-->
        <br>
        <label for="MNAME"class="LMNAME">MIDDLE NAME</label>
        <input type="text"name="MNAME"id="MNAME"class="IMNAME" placeholder="MIDDLE NAME"><br>
        <?php if(isset($errors['MNAME']) && !empty($errors)) { echo '<span class="error">' . $errors['MNAME'] . '</span>'; } ?>
        
        <!--LASTNAME-->
        <br>
        <label for="LNAME"class="LLNAME">LAST NAME</label>
        <input type="text"name="LNAME"id="LNAME"class="ILNAME" placeholder="LAST NAME"><br>
        <?php if(isset($errors['LNAME']) && !empty($errors)) { echo '<span class="error">' . $errors['LNAME'] . '</span>'; } ?>
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
    <?php if(isset($errors['EMAIL'])) { echo '<span class="errorEmail">' . $errors['EMAIL'] . '</span>'; } ?>
    
    <!--CONTACT NUMBER-->
    <br>
    <label for="CONTACT"class="LCONTACT">Cellphone Number</label>
    <input type="tel"name="CONTACT"id="CONTACT"class="ICONTACT" placeholder="CONTACT"><br>
    <?php if (isset($errors['CONTACT'])): ?>
        <div class="error"><?php echo $errors['CONTACT']; ?></div>
    <?php endif; ?>
    
    <!--GENDER-->
    <br>
    <label class = "LGEN">Gender</label>
    <input id="MALE" name="GENDER" value="MALE" type="radio" class="IGEN"><label for="MALE" class="G">MALE</label>
    <input id="FEMALE" name="GENDER" value="FEMALE" type="radio" class="IGEN"> <label for="FEMALE" class="G">FEMALE</label>
    <br>

    <!--BIRTHDAY-->
    <br>
    <label for="BDAY"class="LBDAY">Birthdate</label>
    <input id="BDAY" name="BDAY" type="date" min="1958-01-01" max="2005-12-31" class="IBDAY"><br>

    <!--NATIONALITY-->
    <br>
    <label for="NATIONALITY" class="LNATIONALITY">Nationality</label>
    <input type="text"name="NATIONALITY"id="NATIONALITY"class="INATIONALITY"><br>

    <!--DATE OF CHECK IN-- DOCI==DATE OF CHECK IN-->
    <br>
    <label for="DOCI" class="LDOCI">Date of Check In</label>
    <input type="date" name="DOCI"id="DOCI"min="2023-01-01" max="2023-12-31" class= "IDOCI"><br>
    <?php if (isset($errors['DOCI'])): ?>
        <div class="error"><?php echo $errors['DOCI']; ?></div>
    <?php endif; ?>

    <!--DATE OF CHECK OUT-- DOCU = DATE OF CHECK OUT-->
    <br>
    <label for="DOCU" class="LDOCU">Date of Check Out</label>
    <input type="date" name="DOCU"id="DOCU"min="2023-01-01" max="2023-12-31" class= "IDOCU"><br>

    <br>
    <!--NUMBER OF GUEST-->
    <label for="NumberOfAdult" class = "LNumberOfAdult">Number of Adults:</label>
    <input type = "number" name="NumberOfAdult" id="NumberOfAdult" class=INumberOfAdult value="<?php echo isset($_POST['NumberOfAdult']) ? htmlspecialchars($_POST['NumberOfAdult']) : ''; ?>"><br>
    <?php if (isset($errors['NumberOfAdult'])): ?>
        <div class="error"><?php echo $errors['NumberOfAdult']; ?></div>
    <?php endif; ?>

    <!--Kids-->
    <br><label for="NumberOfKids" class = "LNumberOfKids">Number of Kids:</label>
    <input type = "number" name="NumberOfKids" id="NumberOfKids" class=INumberOfKids value="<?php echo isset($_POST['NumberOfKids']) ? htmlspecialchars($_POST['NumberOfKids']) : ''; ?>"><br>
    <?php if (isset($errors['NumberOfKids'])): ?>
        <div class="error"><?php echo $errors['NumberOfKids']; ?></div>
    <?php endif; ?>
    
    <!--Privaacy-->
    <input type="checkbox" name="agree" id="agree">
    <label for="agree">I agree to the privacy policy of the Chalaroste Team.</label>
    <?php if(isset($errors['agree'])) { echo '<span class="error" style="color: red; font-weight: 500">' . $errors['agree'] . '</span>'; } ?>
    <br>

    <input type="submit"value="submit"class="btn-Submit"><br>

    <style>
        .errors {
            color: red;
            font-size: 24px;
        }
    </style>
</form>
</div>
