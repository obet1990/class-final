<?php
header("refresh:5.5;url=Donations.php");

$servername = "";

$username = "";
$password = "";
$dbname = "";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
//echo nl2br ("Connected successfully \n");

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
$txtDonate = $_POST["txtdonate"];
$intGender = $_POST["txtgender"];
$intTeams = $_POST["txtGolferTeams"];
$txtDate = $_POST["txtDates"];
$txtPayment = $_POST["txtPaymentType"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//Insert information to database
	$insertSponsor = "INSERT INTO tsponsors (strFirstName, strLastName, strAddress, strCity,intStateID, strZip, strPhoneNumber,strEmail,intGenderID)
	VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity','$intState', '$txtZip','$txtPhoneNumber','$txtEmail','$intGender')";

	//Confirm record insertions
	if (mysqli_query($conn, $insertSponsor)) {
		//echo nl2br (" New Sponsor record created successfully \n")  ;
	} else {
		echo "Error: " . $insertSponsor . "<br>" . mysqli_error($conn);
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//Insert information to database
	// $insertdonation = 1;

	$last_id = $conn->insert_id;

	$insertdonation = "INSERT INTO teventgolfersponsors(intEventGolferID,intSponsorID,dtmDateOfSponsor,strSponsorPerHole,intTypeofPayment,intPayStatusID)
	VALUES ('$intTeams', '$last_id','$txtDate','$txtDonate','$txtPayment', 1)";


	//Confirm record insertions
	if (mysqli_query($conn, $insertdonation)) {
		//echo nl2br ("New event record created successfully \n ");
	} else {
		echo "Error: " . $insertdonation . "<br>" . mysqli_error($conn);
	}
}




mysqli_close($conn);
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
		<span>F</span><span>o</span><span>r</span><span>&nbsp;</span><span>Y</span><span>o</span><span>u</span><span>r</span><span>&nbsp;</span><span>D</span><span>onation</span><span>
			<div class="golfball">
				<img src="http://www.pngall.com/wp-content/uploads/2016/03/Golf-Ball-PNG-Image.png" width="150" alt="">
			</div>
		</span>
	</div>

</body>

</html>