<?php
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Passing the room id that was selected so that it can be dynamically generated when we insert into the database
    $RoomID = $_POST["RoomID"];
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <script defer src="form.js"></script>
    <link rel="stylesheet" href="form.css">
    <style>
        body {
            padding: 25px;
        }
    </style>
</head>
<body>
    <form id='form' class = "form" action="applicationSaved.php" method="post"> 
        <div class="form__title">Student Application</div>
        <p class="form__description">
            If you are not already an existing user, register your details here : 
        </p>
        <div class="form__item">
            <label for="firstname" class="form__label">First Name</label>
            <input type="text" class="form__input" name="firstname" id="firstname" min="1" max="50" placeholder="Enter your first name (Max. 50)" required>
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <label for="last_name" class="form__label">Last Name</label>
            <input type="text" class="form__input" name="last_name" id="last_name" min="1" max="50" placeholder="Enter your last name (Max. 50)" required>
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <label for="date_of_birth" class="form__label">D.O.B</label>
            <input type="date" class="form__input form__input--smaller" name="date_of_birth" id="date_of_birth" required>
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <label for="address" class="form__label">Address</label>
            <input type="text" class="form__input" name="address" id="address" placeholder="Enter your address here (Postcode + Street)">
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <label for="telephone_number" class="form__label">Telephone Number</label>
            <input type="number" class="form__input" name="telephone_number" id="telephone_number" placeholder="Enter your phone number" required>
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <label for="email" class="form__label">Email</label>
            <input type="email" class="form__input" name="email" id="email" placeholder="Enter your email address here (Include an @)" required>
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <label for="gender" class="form__label">Gender</label>
            <input type="checkbox" name="gender" id="male"/>
            <label for="male">Male</label>
            <span class="form__error">A sample error message</span>
            <input type="checkbox" name="gender" id="female"/>
            <label for="female">Female</label>
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <label for="university_id" class="form__label">University ID</label>
            <input type="number" class="form__input" name="university_id" id="university_id" placeholder="Enter your university ID (Max. 50)">
            <span class="form__error">A sample error message</span>
        </div>
        <div class="form__item">
            <input type="hidden" name="SelectedRoom" value="<?php echo $RoomID; ?>" />
            <button class = "form__btn" type="submit" Value="Apply">Apply</button>
        </div>
    </form>   
</body>
</html>        