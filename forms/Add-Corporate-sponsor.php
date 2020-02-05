<?php
session_start();
$servername = "";

$username = "";
$password = "";
$dbname = "";





// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$intCorporateSponsorshipTypeID = $_GET['intEventCorporateSponsorshipTypeID'];
$_SESSION['intEventCorporateSponsorshipTypeID'] = $_GET['intEventCorporateSponsorshipTypeID'];
/// select statement
$query = "SELECT * FROM `TStates`";
$SelectFirstName = "Select moSponsorshipCost from teventcorporatesponsorshiptypes Where intEventCorporateSponsorshipTypeID=$intCorporateSponsorshipTypeID";
$stmt = $conn->prepare($SelectFirstName);

$stmt->execute();
$resultSet = $stmt->get_result();

//Retrieve the rows using fetchAll.
$SelectFirstName = $resultSet->fetch_all(MYSQLI_ASSOC);

$result1 = mysqli_query($conn, $query);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



// Close connection
mysqli_close($conn);
?>

<html lang="en">

<head>

    <title>Golfathon</title>
    Name: Obet osorio <br>
    Class: IT-117-400 <br>
    Abstract: Golfathon application
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="Styles.css" />
    <script src="https://kit.fontawesome.com/d20cfd4653.js" crossorigin="anonymous"></script>
    <!-- JS code uses Regex to trim user input and insure US phone number is entered correct -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function validatephone(phone) {
            phone = phone.replace(/\D/g, '');
            phone = phone.slice(0, 3) + "-" + phone.slice(3, 6) + "-" + phone.slice(6, 15);
            $("#txtPhoneNumber").val(phone);

            if (phone == '' || !phone.match(/^(\+0?1\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/))

            {
                $("#txtPhoneNumber").css({
                    'background': '#ff5773',
                    'border': 'solid 1px red'
                });
                return false;
            } else {
                $("#txtPhoneNumber").css({
                    'background': 'rgb(198, 255, 107)',
                    'border': 'solid 1px rgb(198, 255, 107)'
                });
                return true;
            }
        }
    </script>
    <!-- page tittle animation -->
    <div class="foo">
        <span class="letter" data-letter="G">G</span>
        <span class="letter" data-letter="o">o</span>
        <span class="letter" data-letter="f">f</span>
        <span class="letter" data-letter="a">a</span>
        <span class="letter" data-letter="t">t</span>
        <span class="letter" data-letter="h">h</span>
        <span class="letter" data-letter="o">o</span>
        <span class="letter" data-letter="n">n</span>
        <span class="letter" data-letter="-">-</span>
        <span class="letter" data-letter="A">A</span>
        <span class="letter" data-letter="d">d</span>
        <span class="letter" data-letter="d">d</span>
        <span class="letter" data-letter="Sponsor">Sponsor</span>


    </div>






        <!-- side bar -->
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="HomePage.php"><i class="fas fa-home"></i></i> Home</a>
        <a href="Corporate-Sponsorship.php"><i class="fas fa-users"></i> Pick another sponsorship</a>
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

        <!-- form  -->
        <form action="process-corpSponsor.php" name="frmProcess" method="POST">


            <table class="TableDonate">

                <tr>
                    <td class="letters"><label for="txtFirstName">First Name</td></label>

                    <td><input type="text" name="txtFirstName" id="txtFirstName" required></td>
                </tr>
                <tr>
                    <td class="letters"> <label for="txtLastName">Last Name</td></label>

                    <td><input type="text" name="txtLastName" id="txtLastName" required></td>
                </tr>
                <tr>
                    <td class="letters"> <label for="txtAddress">Address</td></label>

                    <td><input type="text" name="txtAddress" id="txtAddress" required></td>
                </tr>
                <tr>
                    <td class="letters"><label for="txtCity">City</td></label>

                    <td><input type="text" name="txtCity" id="txtCity" required></td>
                </tr>


                <tr>
                    <td class="letters"><label for="txtState">state</td></label>

                    <td>

                        <select name="txtState" id='txtState' required>
                            <?php while ($row1 = mysqli_fetch_array($result1)) :; ?>

                                <option value="<?php echo $row1[0]; ?>"><?php echo $row1[1]; ?></option>

                            <?php endwhile; ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td class="letters"><Label require>ZIP Code</Label></td>
                    <td> <input type="text" name="txtZip" pattern="[0-9]{5}" title="Five digit zip code" required /></td>
                </tr>

                <tr>
                    <td class="letters"><label for="txtPhoneNumber">Phone Number</td></label>

                    <td><input type="text" name="phone" id="txtPhoneNumber" onkeyup=" return validatephone(this.value);" required /></td>
                </tr>
                <tr>
                    <td class="letters"><label for="txtEmail">Email</td></label>

                    <td><input type="text" name="txtEmail" id="txtEmail" required></td>
                </tr>
                <tr>
                    <td class="letters"><label for="txtCost"><b>Cost of sponsorship: </b></label></td>
                    <?php foreach ($SelectFirstName as $FirstName) : ?>
                        <td><input type="text" name="txtCost" id="txtCost" readonly value="<?= $FirstName['moSponsorshipCost']; ?>"> </td> <?php endforeach; ?>
                </tr>


                <tr>
                    <td>
                        <input type="submit" value="submit">

                    </td>

                    <td>
                        <input type="reset" value="reset">

                    </td>
                </tr>
                <tr>



                    </select>
            </table>

        </form>

    </div>
    <div class="golfball">
        <img src="http://www.pngall.com/wp-content/uploads/2016/03/Golf-Ball-PNG-Image.png" width="150" alt="">
    </div>
</body>

</html>