<?php
$host = 'localhost';
$dbname = 'uniaccomodation';
$username = 'root';
$password = '';
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $showrooms = $_POST["showrooms"];
    $price = $_POST["Price"];
    $location = $_POST["Location"];
   

    if ($showrooms == 1) {
        try {
            // Connecting to the database
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            // Preparing SQL query and using PDO object to prepare and execute the query

            if ($price == "Over500") {
                $sql = "SELECT * FROM Room WHERE price > '500'";
            } else {
                $sql = "SELECT * FROM Room WHERE price < '500'";
            }
            if ($location == "BatterseaCourtWells") {
                $sql = "SELECT * FROM Room WHERE location = 'Battersea Court Wells'";
            } else {
                $sql = "SELECT * FROM Room WHERE location NOT IN ('Battersea Court Wells')";
            }
            if ($location == "ManorPark") {
                $sql = "SELECT * FROM Room WHERE location = 'Manor Park'";
            } else {
                $sql = "SELECT * FROM Room WHERE location NOT IN ('Manor Park')";
            }
            if ($location == "SurreyUniversityCourt") {
                $sql = "SELECT * FROM Room WHERE location = 'Surrey University Court'";
            } else {
                $sql = "SELECT * FROM Room WHERE location NOT IN ('Surrey Universtiy Court')";
            }
            if ($location == "WaitesHouse") {
                $sql = "SELECT * FROM Room WHERE location = 'WaitesHouse'";
            } else {
                $sql = "SELECT * FROM Room WHERE location NOT IN ('WaitesHouse')";
            }
            if ($location == "GuildfordTownCentre") {
                $sql = "SELECT * FROM Room WHERE location = 'GuildfordTownCentre'";
            } else {
                $sql = "SELECT * FROM Room WHERE location NOT IN ('GuildfordTownCentre')";
            }
            
            $q = $pdo->prepare($sql);
            $q->execute(['%son']);
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
          <a href="/" class="navbar__links"> Contact </a>
        </li>
 
      </ul>
      </div>  
  </nav>
  
 
    <div class='main'>
    <div class='main__container'>
        <div class='main__content'>
    <p>Here are the available rooms : </p>


    
<?php       // Looping through results from the database and displaying each result
            while ($row = $q->fetch()) {
                echo "<form action='application.php' method='POST'>";
        
                echo "<input type='hidden' name='RoomID' value='".$row["Room_ID"]."' />";
        
                echo "<div><p style='float: left;'>";
                echo "<img src=images/room".$row["Room_ID"].".jpg width='50' height='50' </p><BR>";
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
