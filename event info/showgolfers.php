<?php


$servername = "";

$username = "";
$password = "";
$dbname = "";





?>

<html>

<head>
  <script src="https://kit.fontawesome.com/d20cfd4653.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body,
    html {
      background-color: skyblue;
      height: 100%;
      margin: 0;
    }

    .GofersTable {
      border-collapse: collapse;
      width: 80%;
      /* position:absolute;
  
  bottom: 55%; */
    }

    th,
    td {
      text-align: left;
      font-weight: bold;
      padding: 5px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: rgb(39, 209, 5);
      color: white;
    }

    .btnMenu {
      background-color: rgb(39, 209, 5);
      color: rgb(10, 6, 6);
      padding: 16px 52px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      border-radius: 4px;

    }


    .Options {
      position: fixed;
      padding: 12px 16px;
      display: inline-block;

    }

    .NavBar {
      display: none;
      position: absolute;
      background-color: rgb(198, 255, 107);
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
      border-radius: 4px;

    }

    .NavBar a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;

    }

    .NavBar a:hover {
      background-color: rgb(39, 209, 5)
    }

    .Options:hover .NavBar {
      display: block;
    }

    .Options:hover .btnMenu {
      background-color: rgb(198, 255, 107);
    }


    .bg {
      /* The image used */
      background-image: url("kisspng-golf-club-golf-course-sport-golf-ball-grass-golf-club-5a9abdf87953a7.094574451520090616497.png");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: static;
    }

    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: rgb(39, 209, 5);
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }

    .sidebar a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 25px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }

    .sidebar a:hover {
      color: #f1f1f1;
    }

    .sidebar .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }

    .openbtn {
      font-size: 20px;
      cursor: pointer;
      background-color: rgb(39, 209, 5);
      color: white;
      padding: 10px 15px;
      border: none;
    }

    .openbtn:hover {
      background-color: #444;
    }

    #main {
      transition: margin-left .5s;
      padding: 16px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
      .sidebar {
        padding-top: 15px;
      }

      .sidebar a {
        font-size: 18px;
      }
    }
  </style>

  <div id="mySidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="HomePage.php"><i class="fas fa-user-tie"></i> Home</a>
    <a href="index.php"><i class="fas fa-user-tie"></i> Register Golfer</a>
    <a href="Donations.php"><i class="fas fa-users-cog"></i> Make a Donation</a>
    <a href="GolferStatistics.php"><i class="fas fa-users-cog"></i> Golfer Statistics</a>
    <a href="TeamStatistics.php"><i class="fas fa-users-cog"></i> Team Statistics</a>
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

</head>

<body>
  <div class="bg">
    <?php
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
        echo "<h2 align='center' class='golfers'>Golfers info</h2>";
        echo "<table border=1 align=center class='GofersTable'>";
        echo "<tr>";
        // echo "<th>GolferID</th>";
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
        echo "<th>Choose golfer to edit</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
          echo "<tr>";
          // echo "<td>" . $row['intGolferID'] . "</td>";
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
          echo "<td><a href='EditGolfer.php?intGolferID=" . $row['intGolferID'] . "'> edit Golfer</a> </td>";
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
</body>

</html>