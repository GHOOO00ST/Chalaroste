<?php 
    ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style/registration.scss" rel='stylesheet'>
        <title>CHALAROSTE | Registration. Book your place now!</title>
    </head>
</html>
<body>
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

            //checks if last name is empty and contains text only
        if (empty($_POST['LNAME'])) {
                $errors['LNAME'] = 'Name is required';
        } else {
            $LNM = trim($_POST['LNAME']);
            if (!preg_match('/^[a-zA-Z ]+$/', $LNM)) {
            $errors['LNAME'] = 'Name must contain only letters and spaces';
            }
        }
        // checks if email is empty
        if (empty($_POST['EMAIL'])) {
            $errors['EMAIL'] = 'Email is required';
        } else {
            $EMAIL = trim($_POST['EMAIL']);
            if (!filter_var($EMAIL, FILTER_VALIDATE_EMAIL)) {
            $errors['EMAIL'] = 'Invalid email format';
            }
        }

        // ADULT NUMBER VALIDATION
        $NumberOfAdult = $_POST['NumberOfAdult'];
        // Validate that the input field only contains positive numbers and is not empty
        if (!ctype_digit($NumberOfAdult) || $NumberOfAdult < 0){
        $errors['NumberOfAdult'] = 'Please enter a valid positive number';
        }
        // KIDS NUMBER VALIDATION
        $NumberOfKids = $_POST['NumberOfKids'];
        // Validate that the input field only contains positive numbers and is not empty
        if (!ctype_digit($NumberOfKids) || $NumberOfKids < 0){
            $errors['NumberOfKids'] = 'Please enter a valid positive number';
        }


        //validation for Privacy
        if (empty($_POST['agree'])) {
            $errors['agree'] = 'You must agree to the privacy policy';
        }

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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="row-nameField">
                <div class="lastName">
                    <!--LASTNAME-->
                    <label for="LNAME"class="LLNAME">LAST NAME</label><br>
                    <input type="text"name="LNAME"id="LNAME"class="ILNAME" placeholder="LAST NAME"><br>
                    <?php if(isset($errors['LNAME']) && !empty($errors)) { echo '<span class="error">' . $errors['LNAME'] . '</span>'; } ?>
                </div>
                <div class="firstName">
                    <!--FIRSTNAME-->
                    <label for="FNAME"class="LFNAME">FIRST NAME</label><br>
                    <input type="text"name="FNAME"id="FNAME"class="IFNAME" placeholder="FIRST NAME"><br>
                    <?php if(isset($errors['FNAME']) && !empty($errors)) { echo '<span class="error">' . $errors['FNAME'] . '</span>'; } ?>
                </div>
                <div class="middleName">
                    <!--MIDDLENAME-->
                    <label for="MNAME"class="LMNAME">MIDDLE NAME</label><br>
                    <input type="text"name="MNAME"id="MNAME"class="IMNAME" placeholder="MIDDLE NAME"><br>
                    <?php if(isset($errors['MNAME']) && !empty($errors)) { echo '<span class="error">' . $errors['MNAME'] . '</span>'; } ?>
                </div>
            </div>

            <div class="row-addField">
                <div class="firstAddField">
                    <div class="housNum">
                        <!--HOUSE NUMBER-->
                        <label for="hnumber" class="input-hnum">House Number</label><br>
                        <input id="hnumber" class="input-hnumb" name="HNUMBER" type="text" placeholder="House No."><br>
                    </div>
                    <div class="streetSubdi">
                        <!--Street/Subdivision-->
                        <label for="subd" class="input-subd">Street/Subdivision</label><br>
                        <input id="subd" class="input-subdi" name="SUBDI" type="text" placeholder="Street/Subdivision"><br>
                    </div>
                </div>
                <div class="secondAddField">
                    <div class="inputBrgy">
                        <!--Barangay-->
                        <label for="brgy" class="input-brgy">Barangay</label><br>
                        <input id="brgy" class="input-brgyfield" name="BRGY" type="text" placeholder="Barangay"><br>                    
                    </div>
                    <div class="inputCityOrMuni">
                        <!--City/Municipality-->
                        <label for="city" class="input-cm">City/Municipality</label><br>
                        <input type="text" class="input-cityormuni" name="CM"id="cm" placeholder="City/Municipality"><br>
                    </div>
                </div>
            </div>

            <div class="row-otherDetails">
                <div class="inputEmail">
                    <!--EMAIL-->
                    <label for="email"class="LEMAIL">Email</label><br>
                    <input type="text"name="EMAIL"id="EMAIL"class="IEMAIL" placeholder="EMAIL"><br>
                    <?php if(isset($errors['EMAIL'])) { echo '<span class="errorEmail">' . $errors['EMAIL'] . '</span>'; } ?>
                </div>
                <div class="contactNum">
                    <!--CONTACT NUMBER-->
                    <label for="CONTACT"class="LCONTACT">Cellphone Number</label><br>
                    <input type="tel"name="CONTACT"id="CONTACT"class="ICONTACT" placeholder="CONTACT"><br>
                    <?php if (isset($errors['CONTACT'])): ?>
                        <div class="error"><?php echo $errors['CONTACT']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="inputGender">
                    <!--GENDER-->
                    <label class = "LGEN">Gender</label><br>
                    <input id="MALE" name="GENDER" value="MALE" type="radio" class="IGEN"><label for="MALE" class="G">MALE</label>
                    <input id="FEMALE" name="GENDER" value="FEMALE" type="radio" class="IGEN"> <label for="FEMALE" class="G">FEMALE</label>
                </div>
                <div class="birthDate">
                    <!--BIRTHDAY-->
                    <label for="BDAY"class="LBDAY">Birthdate</label><br>
                    <input id="BDAY" name="BDAY" type="date" min="1900-01-01" max="2023-12-31" class="IBDAY"><br>
                </div>
                <div class="inputNationality">
                    <!--NATIONALITY-->
                    <label for="NATIONALITY" class="LNATIONALITY">Nationality</label><br>
                    <input type="text"name="NATIONALITY"id="NATIONALITY"class="INATIONALITY"><br>
                </div>
            </div>
            <div class="row-bookingDetails">
                <div class="checkInDate">
                    <!--DATE OF CHECK IN-- DOCI==DATE OF CHECK IN-->
                    <label for="DOCI" class="LDOCI">Date of Check In</label><br>
                    <input type="date" name="DOCI"id="DOCI"min="2023-01-01" max="2023-12-31" class= "IDOCI"><br>
                    <?php if (isset($errors['DOCI'])): ?>
                        <div class="error"><?php echo $errors['DOCI']; ?></div>
                    <?php endif; ?>                    
                </div>
                <div class="checkOutDate">
                    <!--DATE OF CHECK OUT-- DOCU = DATE OF CHECK OUT-->
                    <label for="DOCU" class="LDOCU">Date of Check Out</label><br>
                    <input type="date" name="DOCU"id="DOCU"min="2023-01-01" max="2023-12-31" class= "IDOCU"><br>                    
                </div>
                <!--NUMBER OF GUEST-->
                <div class="numOfAdult">
                    <label for="NumberOfAdult" class = "LNumberOfAdult">Number of Adults:</label><br>
                    <input type = "number" name="NumberOfAdult" id="NumberOfAdult" class=INumberOfAdult><br>
                    <?php if (isset($errors['NumberOfAdult'])): ?>
                        <div class="error"><?php echo $errors['NumberOfAdult']; ?></div>
                    <?php endif; ?>                    
                </div>
                <div class="numOfKids">
                    <label for="NumberOfKids" class = "LNumberOfKids">Number of Kids:</label><br>
                    <input type = "number" name="NumberOfKids" id="NumberOfKids" class=INumberOfKids><br>
                    <?php if (isset($errors['NumberOfKids'])): ?>
                        <div class="error"><?php echo $errors['NumberOfKids']; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="rowPrivacy">
                <!--Privaacy-->
                <input type="checkbox" name="agree" id="agree">
                <label for="agree">I agree to the privacy policy of the Chalaroste Team.</label><br>
                <?php if(isset($errors['agree'])) { echo '<span class="error" style="color: red; font-weight: 500">' . $errors['agree'] . '</span>'; } ?>
                <br>

                <input type="submit"value="submit"class="btn-Submit"><br>
            </div>
        </form>
        
        <h3 class="subtxt">Powered by <span style="color: #222222; font-weight: 600;">Chalaroste Inc.</span></h3>
    </div>
</body>