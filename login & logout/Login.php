<?php
include("session.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 

  $myusername = mysqli_real_escape_string($db, $_POST['username']);
  $mypassword = mysqli_real_escape_string($db, $_POST['password']);



  $sql = "SELECT intUsersID FROM TUsers WHERE User = '$myusername' and Password = '$mypassword'";

  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  //$active = $row['active'];

  $count = mysqli_num_rows($result);



  if ($count == 1) {

    $_SESSION['login_user'] = $myusername;

    header("location: HomePage.php");
  } else {
    $error = "Your Login Name or Password is invalid";
    echo "<H1 class='error'> $error </H1>";
  }
}
?>
<html>

<head>

  <title>Golfaton Admin Login</title>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="reset.css" />
  <script src="https://kit.fontawesome.com/d20cfd4653.js" crossorigin="anonymous"></script>
  <style rel="stylesheet" type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Lato);

    * {
      box-sizing: border-box;
    }

    .bg {

      background-image: url("kisspng-golf-club-golf-course-sport-golf-ball-grass-golf-club-5a9abdf87953a7.094574451520090616497.png");



      height: 100%;


      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

    }

    body,
    html {
      background-color: skyblue;
      height: 100%;
      margin: 0;
    }





    form {

      width: 30%;
      margin: 0px auto;
      padding: 1rem;

      border-radius: 5px;
      text-align: center;
      bottom: 50%;
      left: 30%;
    }

    .error {

      color: red;
      width: 30%;
      margin: 0px auto;
      padding: 1rem;

      text-align: center;
      bottom: 42.5%;
      left: 30%;
      animation-name: shake, glow-red;
      animation-duration: 0.7s, 0.35s;
      animation-iteration-count: 1, 2;
    }


    label {
      display: block;
      text-align: center;
    }

    input {
      width: 50%;
      margin-bottom: 1rem;
    }

    input[type="submit"] {

      background-color: rgb(39, 209, 5);
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      -webkit-transition-duration: 0.4s;
      /* Safari */
      transition-duration: 0.4s;
      border-radius: 4px;
      right: 65%;
    }

    input[type="submit"]:hover,
    button:hover {
      box-shadow: 0 16px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }

    .letters {
      text-transform: capitalize;
      font-weight: bolder;
      font-family: 'Times New Roman', Times, serif;
      color: #030302;


      border-radius: 4px;
    }

    input[type="text"],
    input[type="password"] {
      width: 70%;
      padding: 5px 2px;
      border: none;
      border-radius: 4px;
      background-color: rgb(198, 255, 107);
    }

    input[type="text"]:hover,
    input[type="password"]:hover {

      background-color: rgb(39, 209, 5);
    }

    @keyframes shake {

      0%,
      20%,
      40%,
      60%,
      80% {
        transform: translateX(8px);
      }

      10%,
      30%,
      50%,
      70%,
      90% {
        transform: translateX(-8px);
      }
    }

    @keyframes glow-red {
      50% {
        border-color: indianred;
      }
    }

    @import url(https://fonts.googleapis.com/css?family=Lato:900);

    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }

    body {
      font-family: 'Lato', sans-serif;
      ;
    }

    div.foo {
      width: 90%;
      margin: 0 auto;
      text-align: center;
    }

    .letter {
      display: inline-block;
      font-weight: 900;
      font-size: 4em;
      margin: 0.2em;

      color: #00B4F1;
      transform-style: preserve-3d;
      perspective: 400;
      z-index: 1;
    }

    .letter:before,
    .letter:after {
      position: absolute;
      content: attr(data-letter);
      transform-origin: top left;
      top: 0;
      left: 0;
    }

    .letter,
    .letter:before,
    .letter:after {
      transition: all 0.3s ease-in-out;
    }

    .letter:before {
      color: rgb(39, 209, 5);
      text-shadow:
        -1px 0px 1px rgba(255, 255, 255, .8),
        1px 0px 1px rgba(0, 0, 0, .8);
      z-index: 3;
      transform:
        rotateX(0deg) rotateY(-15deg) rotateZ(0deg);
    }

    .letter:after {
      color: rgba(0, 0, 0, .11);
      z-index: 2;
      transform:
        scale(1.08, 1) rotateX(0deg) rotateY(0deg) rotateZ(0deg) skew(0deg, 1deg);
    }

    .letter:hover:before {
      color: rgb(198, 255, 107);
      transform:
        rotateX(50deg) rotateY(-40deg) rotateZ(0deg);
    }

    .letter:hover:after {
      transform:
        scale(1.08, 1) rotateX(0deg) rotateY(40deg) rotateZ(0deg) skew(0deg, 22deg);
    }

    .fas {
      color: rgb(39, 209, 5);

      font-size: 25px;
      position: sticky;

      animation-name: shake, glow-red;
      animation-duration: 0.7s, 0.35s;
      animation-iteration-count: 1, 2;
    }
  </style>

</head>

<body>
  <div class="bg">
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
      <span class="letter" data-letter="L">L</span>
      <span class="letter" data-letter="o">o</span>
      <span class="letter" data-letter="g">g</span>
      <span class="letter" data-letter=""></span>
      <span class="letter" data-letter="i">i</span>
      <span class="letter" data-letter="n">n</span>


    </div>

    <div class="login">

      <form action="" method="post">
        <h2>User name and password is cstate</h2>
        <label class="letters"> UserName :</label>

        <i class="fas fa-user"></i> <input type="text" name="username" placeholder="Enter Username"> </input>

        <label class="letters"> Password :</label>

        <i class="fas fa-lock"></i> <input type="password" name="password" placeholder="**********"> </input>
        <input type="submit" value="Submit" name="submit" />

      </form>



    </div>

  </div>



</body>

</html>