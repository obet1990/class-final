<?php
 include('sessionverify.php');
$servername = "";

$username = "";
$password = "";
$dbname = "";




// Create connection


?>
<html>
   
   <head>
      <title>Golfaton Home page </title>
      <meta name="viewport" content="width=device-width" />
      <link rel="stylesheet" type="text/css" href="Homepage.css" />
      <script src="https://kit.fontawesome.com/d20cfd4653.js" crossorigin="anonymous"></script>
      <style>

      .EventTable{
  border-collapse: collapse;
 
  width: 600px;

}

.GofersTable{
  border-collapse: collapse;

  width: 600px;

}

.TeamsTable{
  border-collapse: collapse;

  width:600px;

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



      </style>
   </head>
   
   <body>
   <div class="bg">
   <div class="Welcome">
   <div class="logo-area"> 

<a href="HomePage.php"><img src="http://www.pngall.com/wp-content/uploads/2016/03/Golf-Ball-PNG-Image.png" width="100" alt=""></a> </div>  

 

<div class="foo">
        <span class="letter" data-letter="G">G</span>
        <span class="letter" data-letter="o">o</span>
        <span class="letter" data-letter="f">f</span>
        <span class="letter" data-letter="a">a</span>
        <span class="letter" data-letter="t">t</span>
        <span class="letter" data-letter="h">h</span>
        <span class="letter" data-letter="o">o</span>
        <span class="letter" data-letter="n">n</span>
 

    </div>
   
  <div class="head1">   <h1>Welcome <?php echo $login_session; ?> <i class="far fa-user-circle"></i> </h1> </div>


 
<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="Corporate-Sponsorship.php"><i class="fas fa-user-tie"></i>  Corporate Sponsorship</a>

  <a href="index.php"><i class="fas fa-users-cog"></i> Golfer & Sponsors Management</a>

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
 </div> 
 
<?php
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	
	//Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
    }
    $sql3="SELECT COUNT(*) FROM tgolfers";
if($result = mysqli_query($conn, $sql3)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          echo "<div class='numberofG'>";
            echo "<h2 > Number of golfers paying in this event is " .$row ['COUNT(*)']. "</h2>";
        }
        } else{
            echo "No records matching your query were found.";
        }
        } else{
        echo "ERROR: $sql. " . mysqli_error($conn);
        }
        echo "</div>";
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
      echo "<div class='Event'>";
      echo" <h2 align='center' >Event Totals</h2>";
			echo "<table border=1 align=center class='EventTable'>";
				echo "<tr>";
				echo "<th>Events Years </th>";
				echo "<th>Event Amount</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
			echo "<tr>";
				echo "<td>" . $row['dtmEventYear'] . "</td>";
                echo "<td>" . $row['amount_pledge_for_Golfer'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
		echo "</div>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: $sql. " . mysqli_error($conn);
}

$sql2="SELECT
TG.intGolferID
    ,TG.strLastName
,TG.strFirstName
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

TG.intGolferID
,TG.strLastName
,TG.strFirstName
order by 
amount_pledge_for_Golfer desc



";

if($result = mysqli_query($conn, $sql2)){
    if(mysqli_num_rows($result) > 0){
      echo "<div class='Golfers'>";
    echo  "<h2 align='center' >Golfers VIP zone</h2>";
        echo "<table border=1 align=center class='GofersTable' >";
            echo "<tr>";
            
            echo "<th>Golfer Last Name</th>";
            echo "<th>Golfer first Name</th>";
            echo "<th>Amount Raised</th>";

        echo "</tr>";
    while($row = mysqli_fetch_array($result)){

        echo "<tr>";
            
            echo "<td >" . $row['strLastName'] . "</td>";
            echo "<td >" . $row['strFirstName'] . "</td>";
            
            echo "<td  >" . $row['amount_pledge_for_Golfer'] . "</td>";
            
        echo "</tr>";
        //  }
    }
    echo "</table>";
    echo  "</div>";
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
              echo "<div class='Teams'>";
              echo  "<h2 align='center'  >The teams</h2>";
                echo "<table align=center border=1 class='TeamsTable'> ";
                    echo "<tr>";
                    
                    echo "<th>Teams</th>";
                    echo "<th>Amount Raised</th>";
                    
                echo "</tr>";
            while($row = mysqli_fetch_array($result)){

                echo "<tr>";
                if ($row['amount_pledge_for_Golfer'] >= 2000 )
                {
                  $style = 'style="color: red;"'; 
                }elseif ($row['amount_pledge_for_Golfer'] < 2000 ){
                  $style = 'style="color:black ;"';
                }
                    echo "<td  $style>" . $row['strTypeofTeam'] . "</td>";
                    echo "<td  $style>" . $row['amount_pledge_for_Golfer'] . "</td>";
                    
                echo "</tr>";
                // }
            }
            echo "</table>";
            echo "</div>";
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