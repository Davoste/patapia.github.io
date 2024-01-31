<?php 
session_start();
include './include/config.php';

$name = $_SESSION['user_name'];
// Check the database dbection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
// Get all user bets from the database
$sql = "SELECT * FROM users WHERE name='$name' ";
$result = mysqli_query($db, $sql);

if (!$result) {
    die("Error fetching data: " . mysqli_error($db));
}
$row = mysqli_fetch_assoc($result)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PataPotea</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="" rel="stylesheet" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <script async
      src="https://pay.google.com/gp/p/js/pay.js"
      onload="onGooglePayLoaded()"></script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"
    ></script>
 
  </head>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="bootstrap" viewBox="0 0 118 94">
          <title>Bootstrap</title>
          <path fill-rule="evenodd" clip-rule="evenodd" src="./assets/img/patapotea.png"></path>
        </symbol>
        <symbol id="home" viewBox="0 0 16 16">
          <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
        </symbol>
        <symbol id="speedometer2" viewBox="0 0 16 16">
          <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
          <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
        </symbol>
        <symbol id="table" viewBox="0 0 16 16">
          <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </symbol>
        <symbol id="grid" viewBox="0 0 16 16">
          <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
        </symbol>
      </svg>
<nav class="navbar nav-sticky navbar-light bg-light">
  <a class="navbar-brand" href="howlow.php">
    <img src="./assets/img/supersteez.png" width="70" height="30" class="d-inline-block align-top" alt="">
    BucksHour
  </a>
  <a href="logout.php" class="nav-item text-dark">
        <span >Logout</span>
  </a>
  <a href="acc.php" class="nav-item text-dark">
    <svg class="d-inline-block align-top" width="24" height="24"><use xlink:href="#people-circle"/></svg>
      $<span id="userBalance"><?php echo htmlspecialchars($row["balance"]); ?></span>
  </a>
</nav>

  <body oncontextmenu="return false" class="snippet-body">
  <style>
  /* Microsoft log in page made by: csozi | Website: english.csozi.hu*/
body{
  font-family: "Quicksand", sans-serif;
	width: 100%;
	height: 100%;
	overflow: auto;
	background-color: #0d2818;
	background-repeat: no-repeat;
	background-size: cover;
	background-blend-mode: luminosity;
}
.form {
/*Scale only to make it look right on the preview*/
  scale: 0.8;
  background-color: #ffffff;
  height: 250px;
  width: 352px;
  box-sizing: content-box;
  padding: 44px;
  margin-left: auto;
  margin-right: auto;
}

.form .title {
  color: #1b1b1b;
  font-size: 1.5rem;
  font-weight: 600;
  padding: 0;
  margin-top: 16px;
  margin-bottom: 12px;
  font-family: "Segoe UI","Helvetica Neue","Lucida Grande","Roboto","Ebrima","Nirmala UI","Gadugi","Segoe Xbox Symbol","Segoe UI Symbol","Meiryo UI","Khmer UI","Tunga","Lao UI","Raavi","Iskoola Pota","Latha","Leelawadee","Microsoft YaHei UI","Microsoft JhengHei UI","Malgun Gothic","Estrangelo Edessa","Microsoft Himalaya","Microsoft New Tai Lue","Microsoft PhagsPa","Microsoft Tai Le","Microsoft Yi Baiti","Mongolian Baiti","MV Boli","Myanmar Text","Cambria Math";
}
.form.p{
  color: black;
	font-family: arial;
	font-size: 26px;
	font-family: "Quicksand", sans-serif;

}
.form .email {
  width: 100%;
  padding: 6px 10px 6px 0px;
  border-style: solid;
  border-width: 0px;
  border-bottom-width: 1px;
  border-color: rgba(0, 0, 0, 0.6);
  height: 36px;
  outline: none;
  background-color: transparent;
  padding-left: 0;
  color: #000000;
  margin-bottom: 16px;
}

.form .email {
  border-color: rgba(0, 0, 0, 0.8);
}

.form .text {
  color: #1b1b1b;
  font-family: "Segoe UI Webfont",-apple-system,"Helvetica Neue","Lucida Grande","Roboto","Ebrima","Nirmala UI","Gadugi","Segoe Xbox Symbol","Segoe UI Symbol","Meiryo UI","Khmer UI","Tunga","Lao UI","Raavi","Iskoola Pota","Latha","Leelawadee","Microsoft YaHei UI","Microsoft JhengHei UI","Malgun Gothic","Estrangelo Edessa","Microsoft Himalaya","Microsoft New Tai Lue","Microsoft PhagsPa","Microsoft Tai Le","Microsoft Yi Baiti","Mongolian Baiti","MV Boli","Myanmar Text","Cambria Math";
  font-weight: 400;
  line-height: 1.25rem;
  margin-bottom: 16px;
  font-size: .8125rem;
}
.form.text2{
  font-size: 20px;
  color: #1b1b1b;
  font-family: "Segoe UI Webfont",-apple-system,"Helvetica Neue","Lucida Grande","Roboto","Ebrima","Nirmala UI","Gadugi","Segoe Xbox Symbol","Segoe UI Symbol","Meiryo UI","Khmer UI","Tunga","Lao UI","Raavi","Iskoola Pota","Latha","Leelawadee","Microsoft YaHei UI","Microsoft JhengHei UI","Malgun Gothic","Estrangelo Edessa","Microsoft Himalaya","Microsoft New Tai Lue","Microsoft PhagsPa","Microsoft Tai Le","Microsoft Yi Baiti","Mongolian Baiti","MV Boli","Myanmar Text","Cambria Math";
  font-weight: 400;
}

.form .text a {
  color: #0067B8;
}

.form .button_row {
  width: 100%;
  display: flex;
  justify-content: end;
  height: fit-content;
  gap: 4px;
}

.form .button_row .button {
  width: 108px;
  height: 32px;
  box-sizing: content-box;
  padding: 4 12 4 12;
  border: none;
  font-size: 15px;
}

.form .button_row .secondary_button {
  background-color: rgba(0,0,0,0.2);
  text-align: center;
  white-space: nowrap;
  overflow: hidden;
  vertical-align: middle;
  text-overflow: ellipsis;
  touch-action: manipulation;
  color: #000;
  cursor: pointer;
}

.form .button_row .secondary_button:hover {
  background-color: rgba(0,0,0,0.3);
}

.form .button_row .primary_button {
  background-color: #0067b8;
  color: #ffffff;
  cursor: pointer;
}

.form .button_row .primary_button:hover {
  background-color: #005da6;
} 
  </style>
<div class="row">
  <div class="col-xl-6 col-lg-6 col-md-12">
  <form class="form" method="post" action="pay.php">
    <p class="text2"><a>HELLO <?php echo $name?>, Your account Balance is $<span id="userBalance"><?php echo htmlspecialchars($row["balance"]); ?></span>!</a></p>
    
    <svg xmlns="http://www.w3.org/2000/svg" width="46" height="56" fill="currentColor" class="bi bi-paypal" viewBox="0 0 16 16">
      <path d="M14.06 3.713c.12-1.071-.093-1.832-.702-2.526C12.628.356 11.312 0 9.626 0H4.734a.7.7 0 0 0-.691.59L2.005 13.509a.42.42 0 0 0 .415.486h2.756l-.202 1.28a.628.628 0 0 0 .62.726H8.14c.429 0 .793-.31.862-.731l.025-.13.48-3.043.03-.164.001-.007a.351.351 0 0 1 .348-.297h.38c1.266 0 2.425-.256 3.345-.91.379-.27.712-.603.993-1.005a4.942 4.942 0 0 0 .88-2.195c.242-1.246.13-2.356-.57-3.154a2.687 2.687 0 0 0-.76-.59l-.094-.061ZM6.543 8.82a.695.695 0 0 1 .321-.079H8.3c2.82 0 5.027-1.144 5.672-4.456l.003-.016c.217.124.4.27.548.438.546.623.679 1.535.45 2.71-.272 1.397-.866 2.307-1.663 2.874-.802.57-1.842.815-3.043.815h-.38a.873.873 0 0 0-.863.734l-.03.164-.48 3.043-.024.13-.001.004a.352.352 0 0 1-.348.296H5.595a.106.106 0 0 1-.105-.123l.208-1.32.845-5.214Z"/>
    PayPal
    </svg> 
    <p class="title">Deposit</p>
    <input placeholder="Enter amount" type="text" name="amount" class="emails" required>
    <p class="text"><a>Kindly ensure you use the email address you registered with!</a></p>
    
    <div class="button_row">
      
      <button class="button primary_button">Next</button>
    </div>
  </form>
  </div>
  <div class="col-xl-6 col-lg-6 col-md-12">
  <form class="form" method="post" action="withdraw.php">
   
    <p class="title">Withdraw</p>
    <input placeholder="Enter amount" type="text" name="amount" class="emails" required>
    <p class="text"><a>Kindly ensure you use the email address you registered with!</a></p>
    
    <div class="button_row">
      
      <button class="button primary_button">Next</button>
    </div>
  </form>

  </div>
</div>  
    <script
      type="text/javascript"
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
    ></script>
    <script  src="./assets/js/script.js"></script>
    <script type="text/javascript" src=""></script>
    <script type="text/javascript" src=""></script>
    <script type="text/Javascript"></script>
  </body>
</html>
