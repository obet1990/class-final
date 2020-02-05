<?php
header("refresh:5.5;url=Corporate-Sponsorship.php");
session_start();
$servername = "";

$username = "";
$password = "";
$dbname = "";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$query = "SELECT * FROM `TStates`";

$result1 = mysqli_query($conn, $query);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
///echo nl2br ("Connected successfully \n");

//Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//example variables and posts from a form
$txtFirstName = $_POST["txtFirstName"];
$txtLastName = $_POST["txtLastName"];
$txtAddress = $_POST["txtAddress"];
$txtCity = $_POST["txtCity"];
$txtZip = $_POST["txtZip"];
$txtPhoneNumber = $_POST["phone"];
$txtEmail = $_POST["txtEmail"];
$intState = $_POST["txtState"];
$intCorporateSponsorshipTypeID = $_SESSION['intEventCorporateSponsorshipTypeID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Insert information to database
    $insertGolfer = "INSERT INTO tcorporatesponsors (strFirstName, strLastName, strAddress, strCity,intStateID, strZip, strContactPhoneNumber,strContactEmail)
        VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity','$intState', '$txtZip','$txtPhoneNumber','$txtEmail')";

    //Confirm record insertions
    if (mysqli_query($conn, $insertGolfer)) {
        //echo nl2br (" New corporate sponsor record created successfully \n")  ;
    } else {
        echo "Error: " . $insertGolfer . "<br>" . mysqli_error($conn);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Insert information to database


    $last_id = $conn->insert_id;

    $insertNewEvent = "INSERT INTO teventcorporatesponsorshiptypecorporatesponsors(EventCorporateSponsorshipTypeID,intCorporateSponsorID)
        VALUES ($intCorporateSponsorshipTypeID, $last_id)";


    //Confirm record insertions
    if (mysqli_query($conn, $insertNewEvent)) {
        ///echo nl2br ("New corporate event record created successfully \n ");
    } else {
        echo "Error: " . $insertNewEvent . "<br>" . mysqli_error($conn);
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="import.css" />
</head>

<body>
    <div class="bg">
        <span>T</span><span>h</span><span>a</span><span>n</span><span>k</span><span>&nbsp;</span><span>y</span><span>o</span><span>u</span><span>&nbsp;</span>
        <span>F</span><span>o</span><span>r</span><span>&nbsp;</span><span>Y</span><span>o</span><span>u</span><span>r</span><span>&nbsp;</span><span>C</span><span>ontribution</span><span>
            <div class="golfball">
                <img src="http://www.pngall.com/wp-content/uploads/2016/03/Golf-Ball-PNG-Image.png" width="150" alt="">
            </div>
        </span>

    </div>
</body>

</html>