

<?php


$servername = "";

$username = "";
$password = "";
$dbname = "";




// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);





// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo nl2br ("Connected successfully \n");
	
	//Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
    }



?>

<html>
    <head>
    <script src="https://kit.fontawesome.com/d20cfd4653.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width" />
    <style>
      .bg {
  /* The image used */
  background-image: url("kisspng-golf-club-golf-course-sport-golf-ball-grass-golf-club-5a9abdf87953a7.094574451520090616497.png");
  height: 100%; 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  /* position: static; */
  min-height: 800px;
  width: auto;
        margin: auto;
        text-align: left;
        background-position: left 5px;
}
        body, html {
  background-color: skyblue;
  height: 100%;
  margin: 0;
}
.EventTable{
  border-collapse: collapse;
  width: 40%;

}

.GofersTable{
  border-collapse: collapse;
  width: 40%;


}

th, td {
  text-align: left;
  font-weight: bold;
  padding: 5px;
}

tr:nth-child(even){background-color: #f2f2f2}

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
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      border-radius: 4px;
      
    }
    
    .NavBar a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      
    }
    
    .NavBar a:hover {background-color: rgb(39, 209, 5)}
    
    .Options:hover .NavBar {
      display: block;
    }
    
    .Options:hover .btnMenu {
      background-color: rgb(198, 255, 107);
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
        
        @media screen and (max-height: 450px) {
          .sidebar {padding-top: 15px;}
          .sidebar a {font-size: 18px;}
        }

</style>
   
   <div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="HomePage.php"><i class="fas fa-home"></i>  Home</a>
  <a href="index.php"><i class="fas fa-golf-ball"></i>  Register Golfer</a>
  <a href="Donations.php"><i class="fas fa-donate"></i> Make a Donation</a>
  <a href="showgolfers.php"><i class="fas fa-address-card"></i>  show golfers</a>
  <a href="GolferStatistics.php"><i class="fas fa-ring"></i> Golfer Statistics</a>
  <a class="" href = "logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
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
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "skyblue";
}
</script>

    </head>
<body>
<div class="bg">
<?php
$conn = new mysqli($servername, $username, $password,$dbname);





// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo nl2br ("Connected successfully \n");
	
	//Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
    }
	$sql = "SELECT
	TG.intEventID
	 ,SUM(strSponsorPerHole) AS amount_pledge_for_Golfer 
     
	,TG.dtmEventYear

FROM
	teventgolfersponsors AS TGYE
JOIN teventgolfers as TTYP 
			 ON TGYE.intEventGolferID = TTYP.intEventGolferID
             
JOIN  tevents as TG
on TTYP.intEventID = TG.intEventID 

GROUP BY
	TG.intEventID
	,TG.dtmEventYear
			
";

if($result = mysqli_query($conn, $sql)){
		if(mysqli_num_rows($result) > 0){
     echo" <h2 align='center' class='Event'>Event Totals</h2>";
			echo "<table border=1 align=center class='EventTable'>";
				echo "<tr>";
				echo "<th>Event Year</th>";
				echo "<th>Event Amount</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
			echo "<tr>";
				echo "<td>" . $row['dtmEventYear'] . "</td>";
                echo "<td>" . $row['amount_pledge_for_Golfer'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
		
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: $sql. " . mysqli_error($conn);
}
$sql2="SELECT
TS.intSponsorID
,TT.strTypeofTeam
 ,SUM(strSponsorPerHole) AS amount_pledge_for_Golfer 
 ,TGYE.dtmDateOfSponsor

FROM
teventgolfersponsors AS TGYE
JOIN teventgolfers as TTYP 
         ON TGYE.intEventGolferID = TTYP.intEventGolferID
         
JOIN  tgolfers as TG
on TTYP.intGolferID = TG.intGolferID 

JOIN  tsponsors as TS
on TGYE.intSponsorID = TS.intSponsorID 

JOIN  ttypeofteams as TT
on TT.intTypeofTeamID = TG.intTypeofTeamID 

GROUP BY


TT.strTypeofTeam

order by 
amount_pledge_for_Golfer DESC

";

if($result = mysqli_query($conn, $sql2)){
    if(mysqli_num_rows($result) > 0){
     echo" <h2 align='center' class='golfers'>Teams total raised</h2>";
        echo "<table border=1 align=center class='GofersTable'>";
            echo "<tr>";
            
            echo "<th>Teams</th>";
            echo "<th>Amount Raised</th>";
            echo "<th>Donor List</th>";
        echo "</tr>";
    while($row = mysqli_fetch_array($result)){
        // if ($row['amount_pledge_for_Golfer'] > 1000)
        // {
        echo "<tr>";
        if ($row['amount_pledge_for_Golfer'] >= 2000 )
        {
          $style = 'style="color: red;"'; 
        }elseif ($row['amount_pledge_for_Golfer'] < 2000 ){
          $style = 'style="color:black ;"';
        }
            echo "<td  $style>" . $row['strTypeofTeam'] . "</td>";
            echo "<td  $style>" . $row['amount_pledge_for_Golfer'] . "</td>";
            echo "<td  $style><a href='ViewDonors.php?intSponsorID=" . $row['intSponsorID'] . "'> View Donor</a> </td>";
        echo "</tr>";
        // }
    }
    echo "</table>";
    
    // Free result set
    mysqli_free_result($result);
} else{
    echo "No records matching your query were found.";
}
} else{
echo "ERROR: $sql. " . mysqli_error($conn);
}


mysqli_close($conn);
?>
    
    
    </div> 
</body>

</html>