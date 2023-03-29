<?php
$host = 'localhost';
$dbname = 'uniaccomodation';
$username = 'root';
$password = '';
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $showrooms = $_POST["showrooms"];
    $price = $_POST["Price"];
   

    if ($showrooms == 1) {  // If user clicks on "Show rooms", it's value is 1 meaning it will be posted to this php file in which all rooms should be shown
        try {
            // Connecting to the database
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);  // PDO represents a connection between PHP and a database server
            // Preparing SQL query and using PDO object to prepare and execute the query

            if ($price == "Over500") { // If the user selects the "Over 500" price filter option, only rooms over the price of 500 will be shown from the database 
                $sql = "SELECT * FROM Room WHERE price > '500'";
            } else {
                $sql = "SELECT * FROM Room WHERE price < '500'";  // Otherwise, all rooms under 500 will be shown, and handles validation of user input 
            }
            
            $q = $pdo->prepare($sql);  // pdo-prepare prepares a statement for execution, in this case my SQL statements above
            $q->execute(['%son']); // The variable %q is now executed
            // Fetches the results of the query
            $q->setFetchMode(PDO::FETCH_ASSOC);
?>
<html lang='en'>
    <head><title> Show Rooms </title><link rel='stylesheet' href='rooms.css'/>
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
          <a href="/" class="navbar__links"> Home </a>
        </li>
 
      </ul>
      </div>    
      <script src="app.js"></script>   <!-- Links to my Javascript file -->
  </nav>
  
 
    <div class='main'>
    <div class='main__container'>
        <div class='main__content'>
    <p>Here are the available rooms</p>


    
<?php       // Looping through results from the database and displaying each result
            while ($row = $q->fetch()) {
                echo "<form action='application.php' method='POST'>";
        
                echo "<input type='hidden' name='RoomID' value='".$row["Room_ID"]."' />";
        
                echo "<div><p style='float: left;'>";
                echo "<img src=images/room".$row["Room_ID"].".jpg width='50' height='50' </p><BR>";  // Assigns selected image for whatever room the user pics, efficient method using concatenation.
                echo $row["Description"];
                echo "<BR>";
                echo $row["Location"];
                echo "<BR><p>";
                echo $row["Price"]." Per Month</td><td> <button class='main__btn' type='submit' value='Submit'>Apply</button></form>";
                echo "</p><BR><BR></div><HR>";
                
            }
            
            // Error handling
        } catch (PDOException $pe) {
            die("Could not connect to the database $dbname :" . $pe->getMessage());
        }


    }
    
    $pdo = null;/* close DB onnection */ 
}


?>
