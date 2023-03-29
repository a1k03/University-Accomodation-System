<html lang='en'>
    <head><title> Application Saved </title><link rel='stylesheet' href='rooms.css'/>
    <link rel='preconnect' href='https://fonts.googleapis.com'><link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap' rel='stylesheet'>
</head>
<body>

    <nav class="navbar">
    <div class="navbar__container">
      <a href="/" id="navbar__logo">University Accomodation</a>
      <div class="navbar__toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
      <ul class="navbar__menu">
        <li class="navbar__item">
          <a href="/" class="navbar__links"> Contact </a>
        </li>
 
      </ul>
      </div>  
  </nav>
  
 
    <div class='main'>
    <div class='main__container'>
        <div class='main__content'>
        <p>

<?php
$host = 'localhost';
$dbname = 'uniaccomodation';
$username = 'root';
$password = '';
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

  
    $SelectedRoomID = $_POST["SelectedRoom"];  
    $firstname = $_POST["firstname"];
    $lastname = $_POST["last_name"];
    $Address = $_POST["address"];
    $Date_of_Birth  = $_POST["date_of_birth"];
    $Email = $_POST["email"];
    $Telephone_Number = $_POST["telephone_number"];
    $Gender = $_POST["gender"];
    $University_ID  = $_POST["university_id"];
    $date_applied = date("Y-m-d");

    // Connecting to the MySQL database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Querying the database by inserting data into the database
    $sql = "INSERT INTO Student (First_Name, Last_Name, Address, Date_of_Birth, Email, Telephone_Number, Gender, University_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt= $pdo->prepare($sql);
    if ($stmt->execute([$firstname, $lastname, $Address, $Date_of_Birth, $Email, $Telephone_Number, $Gender, $University_ID])) { // Prepares and executes the statement

        $student_id = $pdo->lastInsertId();

        echo '<h1>Your student ID is : ' . $student_id . '. Please keep a record of your student ID </h1>';
    } else {
        echo "Problem with inserting student record"; 
    }

    try{ // Error handling
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql2 = "INSERT INTO Application (Date_Applied, Student_ID, Room_ID) VALUES (?, ?, ?)";
  
         $stmt2= $pdo->prepare("INSERT INTO Application (Date_Applied,Student_ID,Room_ID) VALUES (?, ?, ?)");
         if ($stmt2->execute(array($date_applied,$student_id,$SelectedRoomID))) {
            echo "<H2>THANK YOU FOR APPLYING</H2>";
        } else {
            echo "Problem with inserting application record";
        }
    }catch(PDOException $ex){

        echo $ex->getMessage();
      
    }
    
   
    $pdo = null;/* close DB connection */   
}