<html>

<head>
	<a class="Add" align="center" href="index.php">Add another golfer?</a><br>

	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th,
		td {
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2
		}

		th {
			background-color: rgb(39, 209, 5);
			color: white;
		}

		.Add {
			background-color: rgb(39, 209, 5);
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;

			/* display: inline-block; */
			font-size: 16px;
			margin: 4px 9px;
			cursor: pointer;
			-webkit-transition-duration: 0.4s;
			/* Safari */
			transition-duration: 0.4s;
			border-radius: 4px;
		}

		.Add:hover {
			box-shadow: 0 16px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
		}
	</style>

</head>

</html>

<?php


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
echo nl2br("Connected successfully \n");

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
$intshirt = $_POST["txtshirtsizes"];
$intGender = $_POST["txtgender"];
$intTeams = $_POST["txtTeam"];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//Insert information to database
	$insertGolfer = "INSERT INTO TGolfers (strFirstName, strLastName, strAddress, strCity,intStateID, strZip, strPhoneNumber,strEmail,intShirtSizeID,intGenderID,intTypeofTeamID)
	VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity','$intState', '$txtZip','$txtPhoneNumber','$txtEmail','$intshirt','$intGender','$intTeams')";

	//Confirm record insertions
	if (mysqli_query($conn, $insertGolfer)) {
		echo nl2br(" New golfer record created successfully \n");
	} else {
		echo "Error: " . $insertGolfer . "<br>" . mysqli_error($conn);
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//Insert information to database
	$insertEvent = 1;

	$last_id = $conn->insert_id;

	$insertNewEvent = "INSERT INTO teventgolfers(intEventID,intGolferID)
	VALUES (1, $last_id)";


	//Confirm record insertions
	if (mysqli_query($conn, $insertNewEvent)) {
		echo nl2br("New event record created successfully \n ");
	} else {
		echo "Error: " . $insertNewEvent . "<br>" . mysqli_error($conn);
	}
}

//Display all Golfers
$sql = "SELECT TC.intGolferID, TS.strState,TC.strFirstName,TC.strLastName,TC.strAddress,TC.strCity,TC.strZip,TC.strPhoneNumber,TC.strEmail,TSH.strShirtSize, TG.strGender,TTYP.strTypeofTeam
	FROM TGolfers as TC
		 JOIN TStates as TS 
			 ON TC.intStateID = TS.intStateID
			
			 JOIN TShirtSizes as TSH 
			 ON TC.intShirtSizeID = TSH.intShirtSizeID

			 JOIN TGenders as TG 
			 ON TC.intGenderID = TG.intGenderID

			 JOIN ttypeofteams as TTYP 
			 ON TC.intTypeofTeamID = TTYP.intTypeofTeamID
			
";

if ($result = mysqli_query($conn, $sql)) {
	if (mysqli_num_rows($result) > 0) {
		echo "<table border=1>";
		echo "<tr>";
		echo "<th>GolferID</th>";
		echo "<th>First Name</th>";
		echo "<th>Last Name</th>";
		echo "<th>Address</th>";
		echo "<th>City</th>";
		echo "<th>State</th>";
		echo "<th>Zip Code</th>";
		echo "<th>Phone Number</th>";
		echo "<th>Email	</th>";
		echo "<th>Shirt Size</th>";
		echo "<th>Gender</th>";
		echo "<th>Team</th>";

		echo "</tr>";
		while ($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['intGolferID'] . "</td>";
			echo "<td>" . $row['strFirstName'] . "</td>";
			echo "<td>" . $row['strLastName'] . "</td>";
			echo "<td>" . $row['strAddress'] . "</td>";
			echo "<td>" . $row['strCity'] . "</td>";
			echo "<td>" . $row['strState'] . "</td>";
			echo "<td>" . $row['strZip'] . "</td>";
			echo "<td>" . $row['strPhoneNumber'] . "</td>";
			echo "<td>" . $row['strEmail'] . "</td>";
			echo "<td>" . $row['strShirtSize'] . "</td>";
			echo "<td>" . $row['strGender'] . "</td>";
			echo "<td>" . $row['strTypeofTeam'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";

		// Free result set
		mysqli_free_result($result);
	} else {
		echo "No records matching your query were found.";
	}
} else {
	echo "ERROR: $sql. " . mysqli_error($conn);
}


mysqli_close($conn);
?>

</div>


<html lang="en">

<head>
	<title>Add successful</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="Styles.css" />
	<script src="https://kit.fontawesome.com/d20cfd4653.js" crossorigin="anonymous"></script>

</head>

<body>
	<div id="mySidebar" class="sidebar">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
		<a href="HomePage.php"><i class="fas fa-home"></i></i> Home</a>
		<a href="showgolfers.php"><i class="fas fa-users"></i> show golfers</a>

		<a href="Donations.php"><i class="fas fa-donate"></i> Make a Donation</a>
		<a href="GolferStatistics.php"><i class="fas fa-ring"></i> Golfer Statistics</a>
		<a href="TeamStatistics.php"><i class="fas fa-coins"></i> Team Statistics</a>
		<a class="" href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
	</div>

	<div id="main">
		<button class="openbtn" onclick="openNav()">☰ Options</button>
	</div>


	<script>
		function openNav() {
			document.getElementById("mySidebar").style.width = "250px";
			document.getElementById("main").style.marginLeft = "250px";
			document.body.style.backgroundColor = "rgba(0,0,0,0.4)";


		}

		function closeNav() {
			document.getElementById("mySidebar").style.width = "0";
			document.getElementById("main").style.marginLeft = "0";
			document.body.style.backgroundColor = "skyblue";
		}
	</script>

	<div class="bg"></div>
</body>

</html>