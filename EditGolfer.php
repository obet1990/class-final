<?php

session_start();
$servername = "";

$username = "";
$password = "";
$dbname = "";




// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



$intGolferID = $_GET['intGolferID'];
$_SESSION['intGolferID'] = $_GET['intGolferID'];

//Selecting the First Name
$SelectFirstName = "Select strFirstName from TGolfers Where intGolferID=$intGolferID";


$stmt = $conn->prepare($SelectFirstName);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectFirstName = $resultSet->fetch_all(MYSQLI_ASSOC);


//Selecting the Last Name
$SelectLastName = "Select strLastName from TGolfers Where intGolferID=$intGolferID";


$stmt = $conn->prepare($SelectLastName);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectLastName = $resultSet->fetch_all(MYSQLI_ASSOC);


//Selecting the Address
$SelectAddress = "Select strAddress from TGolfers Where intGolferID=$intGolferID";


$stmt = $conn->prepare($SelectAddress);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectAddress = $resultSet->fetch_all(MYSQLI_ASSOC);



//Selecting the City
$SelectCity = "Select strCity from TGolfers Where intGolferID=$intGolferID";


$stmt = $conn->prepare($SelectCity);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectCity = $resultSet->fetch_all(MYSQLI_ASSOC);


// Select Statement for States
$SelectedState = "Select TS.intStateID, TS.strState
                FROM TStates as TS
                JOIN TGolfers as TG
                ON TS.intStateID = TG.intStateID
                WHERE TG.intGolferID = $intGolferID";

$stmt = $conn->prepare($SelectedState);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectedState = $resultSet->fetch_all(MYSQLI_ASSOC);

//Select Statement to Load all the States
$States = "Select intStateID, strState FROM TStates";

$stmt = $conn->prepare($States);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$States = $resultSet->fetch_all(MYSQLI_ASSOC);


//Select Statement For ZIP Code
$SelectZIP = "Select strZip from TGolfers Where intGolferID=$intGolferID";


$stmt = $conn->prepare($SelectZIP);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectZIP = $resultSet->fetch_all(MYSQLI_ASSOC);


//Select Statement For E-mail
$SelectEmail = "Select strEmail from TGolfers Where intGolferID=$intGolferID";


$stmt = $conn->prepare($SelectEmail);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectEmail = $resultSet->fetch_all(MYSQLI_ASSOC);


//Select Statement For Phone Number
$SelectPhoneNumber = "Select strPhoneNumber from TGolfers Where intGolferID=$intGolferID";


$stmt = $conn->prepare($SelectPhoneNumber);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectPhoneNumber = $resultSet->fetch_all(MYSQLI_ASSOC);


// Select Statement for ShirtSizes

$ShirtSizes = "SELECT intShirtSizeID, strShirtSize FROM TShirtSizes";

$stmt = $conn->prepare($ShirtSizes);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$ShirtSizes = $resultSet->fetch_all(MYSQLI_ASSOC);

//Displaying the Selected Shirt-Size
$SelectedShirtSize = "SELECT intShirtSizeID FROM TGolfers WHERE intGolferID=$intGolferID";

$stmt = $conn->prepare($SelectedShirtSize);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectedShirtSize = $resultSet->fetch_all(MYSQLI_ASSOC);



// Select Statement for Genders


//Displaying the Selected Gender
$SelectedGender = "SELECT intGenderID FROM TGolfers WHERE intGolferID=$intGolferID";

$stmt = $conn->prepare($SelectedGender);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectedGender = $resultSet->fetch_all(MYSQLI_ASSOC);

//Loading all the Genders
$Genders = "SELECT intGenderID, strGender FROM TGenders";

$stmt = $conn->prepare($Genders);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$Genders = $resultSet->fetch_all(MYSQLI_ASSOC);



$SelectedTeam = "SELECT intTypeofTeamID FROM tgolfers WHERE intGolferID=$intGolferID"; 

			$stmt = $conn->prepare($SelectedTeam);

			$stmt->execute();
			$resultSet = $stmt->get_result();

			//Retrieve the rows using fetchAll.
			$SelectedTeam = $resultSet->fetch_all(MYSQLI_ASSOC);

$Teams = "SELECT intTypeofTeamID, strTypeofTeam FROM ttypeofteams";

			$stmt = $conn->prepare($Teams);

			$stmt->execute();
			$resultSet = $stmt->get_result();

			//Retrieve the rows using fetchAll.
			$Teams = $resultSet->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>


<html lang="en">

<head>
    <title>Golfathon update Golfer</title>
    Name: Obet osorio <br>
    Class: IT-117-400 <br>
    Abstract: Golfathon application
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="Styles.css" />
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script type="text/javascript">
        function validatephone(phone)
            {
                 phone = phone.replace(/\D/g, '');
                 phone = phone.slice(0,3)+"-"+phone.slice(3,6)+"-"+phone.slice(6,15);
                 $("#txtPhoneNumber").val(phone);

                if(phone == '' || !phone.match(/^(\+0?1\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/))
                
                {
                     $("#txtPhoneNumber").css({'background':'#ff5773','border':'solid 1px red'});
                        return false;
                }
                else
                {
                    $("#txtPhoneNumber").css({'background':'rgb(198, 255, 107)','border':'solid 1px rgb(198, 255, 107)'});
                        return true;  
                }
            }

    </script>
       <div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="HomePage.php"><i class="fas fa-user-tie"></i>  Home</a>
  <a href="index.php"><i class="fas fa-user-tie"></i>  Register Golfer</a>
  <a href="showgolfers.php"><i class="fas fa-user-tie"></i>  show golfers</a>

  <a href="Donations.php"><i class="fas fa-users-cog"></i> Make a Donation</a>
  <a href="GolferStatistics.php"><i class="fas fa-users-cog"></i> Golfer Statistics</a>
  <a href="TeamStatistics.php"><i class="fas fa-users-cog"></i> Team Statistics</a>
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
    <div class="foo">
        <span class="letter" data-letter="U">U</span>
        <span class="letter" data-letter="p">p</span>
        <span class="letter" data-letter="d">d</span>
        <span class="letter" data-letter="a">a</span>
        <span class="letter" data-letter="t">t</span>
        <span class="letter" data-letter="e">e</span>
        <span class="letter" data-letter=""></span>
        <span class="letter" data-letter="P">P</span>
        <span class="letter" data-letter="l">l</span>
        <span class="letter" data-letter="a">a</span>
        <span class="letter" data-letter="y">y</span>
        <span class="letter" data-letter="e">e</span>
        <span class="letter" data-letter="r">r</span>
        <span class="letter" data-letter="-">-</span>
        <span class="letter" data-letter="i">I</span>
        <span class="letter" data-letter="n">n</span>
        <span class="letter" data-letter="f">f</span>
        <span class="letter" data-letter="o">o</span>


    </div>
    <!-- <div class="sky">
        <img src="http://itd1.cincinnatistate.edu/PHP-OsorioO/Images/hiclipart.com-id_fgabb.png" width="200%" height="700" alt="">
    </div> -->

    
    <div class="golfball">
        <img src="http://www.pngall.com/wp-content/uploads/2016/03/Golf-Ball-PNG-Image.png" width="150" alt="">
    </div>


    <form action="process_updateplayer.php" name="frmEditGolfer"  action="id" method="POST">
    <table>
        
                
            <tr>
            
                <td class="letters"><p>Only enter Information you wish to update</p></td>
            </tr>

            <tr>
                <td class="letters"><label for="txtFirstName"><b>First Name: </b></label></td>
                <?php foreach ($SelectFirstName as $FirstName) : ?>
                    <td><input type="text" name="txtFirstName" id="txtFirstName" value="<?= $FirstName['strFirstName']; ?>" required</td> <?php endforeach; ?> 
                </tr> 
                    <tr>
                    <td class="letters"><label for="txtLastName"> <b> Last Name: </b></label> </td>
                    <?php foreach ($SelectLastName as $LastName) : ?>
                        <td><input type="text" name="txtLastName" id="txtLastName" value="<?= $LastName['strLastName']; ?>" required</td> <?php endforeach; ?> 
                    </tr> 
                    <tr>
                        <td class="letters"><label for="txtAddress"> <b> Address: </b></label> </td>
                        <?php foreach ($SelectAddress as $Address) : ?>
                            <td><input type="text" name="txtAddress" id="txtAddress" value="<?= $Address['strAddress']; ?>" required</td> <?php endforeach; ?> 
                        </tr> 
                        <tr>
                            <td class="letters"><label for="txtCity"> <b> City: </b></label> </td>
                            <?php foreach ($SelectCity as $City) : ?>
                                <td><input type="text" name="txtCity" id="txtCity" value="<?= $City['strCity']; ?>" required</td> <?php endforeach; ?> 
                            </tr> 
                            <tr>
                                <td class="letters"><label for="txtState"><b>State: </b></label></td>
                                <td><select name="txtState" id='txtState' required>



                                        <?php foreach ($States as $State) : ?>
                                            <option <?php echo ($State['intStateID'] == $SelectedState[0]['intStateID'] ? 'selected="selected"' : "") ?> value="<?= $State['intStateID']; ?>"><?= $State['strState']; ?></option>

                                        <?php endforeach; ?>



                                    </select>
                                </td>
            </tr>
            <tr>
                <td class="letters"><label for="txtZip"> <b> ZIP Code: </b></label> </td>
                <?php foreach ($SelectZIP as $ZIP) : ?>
                    <td><input type="text" type="text" name="txtZip" pattern="[0-9]{5}" title="Five digit zip code" value="<?= $ZIP['strZip']; ?>" required</td> <?php endforeach; ?> </tr> <tr>
                    <tr>

                        <td class="letters"><label for="txtPhoneNumber"> <b> Phone Number: </b></label> </td>
                        <?php foreach ($SelectPhoneNumber as $PhoneNumber) : ?>
                            <td><input type="text" name="txtPhoneNumber" id="txtPhoneNumber" value="<?= $PhoneNumber['strPhoneNumber']; ?>" onkeyup=" return validatephone(this.value);" required></td> <?php endforeach; ?> </tr> 
                    
                    <td class="letters"><label for="txtEmail"> <b> Email: </b></label> </td>
                    <?php foreach ($SelectEmail as $Email) : ?>
                        <td><input type="text" name="txtEmail" id="txtEmail" value="<?= $Email['strEmail']; ?>"  required </td> <?php endforeach; ?> </tr>  <tr>
                                
                            <td class="letters"><label for="txtshirtsizes"><b>Shirt Size: </b></label></td>
                            <td><select name="txtshirtsizes" id='txtshirtsizes' required>
                                    <?php foreach ($ShirtSizes as $ShirtSize) : ?>
                                        <option <?php echo ($ShirtSize['intShirtSizeID'] == $SelectedShirtSize[0]['intShirtSizeID'] ? 'selected="selected"' : "") ?> value="<?= $ShirtSize['intShirtSizeID']; ?>"><?= $ShirtSize['strShirtSize']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </td>
            </tr>
            <tr>
                <td class="letters"><label for="txtgender"><b> Gender: </b> </label> </td>
                <td><select name="txtgender" id='txtgender' required>
                        <?php foreach ($Genders as $Gender) : ?>
                            <option <?php echo ($Gender['intGenderID'] == $SelectedGender[0]['intGenderID'] ? 'selected="selected"' : "") ?> value="<?= $Gender['intGenderID']; ?>"><?= $Gender['strGender']; ?></option>

                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="letters"><label for="txtTeams"><b>Team: </b></label></td>
                <td><select name="txtTeams" required>
                        <?php foreach ($Teams as $Team) : ?>
                            <option <?php echo ($Team['intTypeofTeamID'] == $SelectedTeam[0]['intTypeofTeamID'] ? 'selected="selected"' : "") ?> value="<?= $Team['intTypeofTeamID']; ?>"><?= $Team['strTypeofTeam']; ?></option>

                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="submit">

                </td>

                <td>
                    <input type="reset" value="reset">

                </td>
            </tr>
            </table>
        </form>
    
    </div>
</body>

</html>