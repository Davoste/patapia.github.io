<?php
include './include/config.php';
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>SawBuck</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="canonical" href="./headers.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong|Quicksand">
  
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
  <a class="navbar-brand" href="#">
    <img src="./assets/img/supersteez.png" width="70" height="30" class="d-inline-block align-top" alt="">
    BucksHour
  </a>
  <a href="login.php" class="nav-item text-dark">
    <svg class="d-inline-block align-top" width="24" height="24"><use xlink:href="#people-circle"/></svg>
      $<span ></span>
  </a>
</nav>
<body>
     
  <section>
  <?php 
     //check if id already exists
     $sql= 'SELECT id FROM timer WHERE id=(SELECT MAX(id) From timer) ';
     $result = $db->query($sql);
     $row = $result->fetch_assoc();
     $drawID = $row["id"];
           
            ?>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 padding_right1">
           
            <p id='hint'>PICK YOUR LOWEST UNIQUE NUMBER</p>
          <form   action="login.php" method="post">
            <section class="box" id="box">
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="1" required><span>1</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="2" required><span>2</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="3" required><span>3</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="4" required><span>4</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="5" required><span>5</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="6" required><span>6</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="7" required><span>7</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="8" required><span>8</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="9" required><span>9</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="10" required><span>10</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="11" required><span>11</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="12" required><span>12</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="13" required><span>13</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="14" required><span>14</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="15" required><span>15</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="16" required><span>16</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="17" required><span>17</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="18" required><span>18</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="19" required><span>19</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="20" required><span>20</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="21" required><span>21</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="22" required><span>22</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="23" required><span>23</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="24" required><span>24</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="25" required><span>25</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="26" required><span>26</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="27" required><span>27</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="28" required><span>28</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="29" required><span>29</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="30" required><span>30</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="31" required><span>31</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="32" required><span>32</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="33" required><span>33</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="34" required><span>34</span></label>
                <label class="ball" id="ball1"><input type="radio" id="choice" name="choice" value="35" required><span>35</span></label>
                
            </section>
             <!-- Hidden field to take data from a PHP variable -->
            <?php
            
            echo '<input type="hidden"  name="Draw"  value="' . htmlspecialchars($drawID) . '">';
            ?>
     
            <div>
                <label id="text" for="stake">Stake Amount:</label>
                <input type="number" id="stake" name="stake" min="10" required placeholder="10"><br>
            </div>
            
            <input type="submit" value="Place Bet">
          </form>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 padding_right1">
            <label id="text">Next draw in:</label> <label><div id="timer"></div></label><br>
            <?php
            // Fetch product data from the database
              $sql = 'SELECT *, TIMESTAMPDIFF(SECOND, NOW(), end) AS time_remaining FROM timer WHERE id=(select max(id) from timer)';
              $result = $db->query($sql);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      $timeRemaining = $row['time_remaining'];

                      if ($timeRemaining > 0) {
                          $hoursRemaining = floor($timeRemaining / 3600);
                          $minutesRemaining = floor(($timeRemaining % 3600) / 60);
                          $secondsRemaining = $timeRemaining % 60;

                          echo '<div>';
                        
                          echo '<p>Time Remaining: <span class="countdown" id="countdown" data-remaining="' . $timeRemaining . '">' . $hoursRemaining . 'h ' . $minutesRemaining . 'm ' . $secondsRemaining . 's</span></p>';
                          echo '</div>';
                      } else {
                          echo '<div>';
                          header('draw2.php');
                          echo '<p>Auction Expired</p>';
                          echo '</div>';
                      }
                  }
              } else {
                  echo 'No products found.';
              }

            ?>
          <?php 
            $sql = "SELECT sum(stake) as cumstake FROM low WHERE id='$drawID'";
            $result = mysqli_query($db, $sql);
            $line = mysqli_fetch_assoc($result)

          ?>
            <label id="text"> Possible Win:</label><label id="text"><?php echo htmlspecialchars($line["cumstake"]); ?>$ </label><br>
            <label id="text"> Draw ID: 00<?php echo $drawID; ?></label>
            <!-- Display previous winning numbers-->
            <div id='winners'>
                            <?php
                           
                            // Fetch winners' data from the database
                            $sql = "SELECT * FROM winners";
                            $result = mysqli_query($db, $sql);

                            if (!$result) {
                                die("Error fetching winners data: " . mysqli_error($db));
                            }

                            // Display winners and their winnings
                            echo "<h3>Previous winning numbers include:</h3><ul>";
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<li>" . $row['name'] . ": $" . $row['winnings'] . "</li>";
                            }
                            echo "</ul>";

                            // Close the database dbection
                            mysqli_close($db);
                            ?>
                        </div>
        </div>
    </div>
  </section>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js'></script><script  src="./script.js"></script>
<script>
    $(document).ready(function(){
        //listen for form submition
        $('#myForm').submit(function(event){
            event.preventDefault();//prevent form submition
            //get selecteed option
            const SelectedOption=$("input[name='option']:checked").val();
            //display selected option
            if (SelectedOption){
                $('#selectedOption').text("You selected:"+ selectedOption);
            } else {
                $('#selectedOption').text("Please select an option before submitting");
            }
        });
    });
    //other set
      // Function to fetch user account data from the session
      function fetchUserData() {
            // Fetch user account data from the server using Fetch API
            fetch("get_user_data.php")
                .then((response) => response.json())
                .then((data) => {
                    // Update user name and balance on the page
                    document.getElementById("userName").textContent = data.userName;
                    document.getElementById("userBalance").textContent = data.userBalance.toFixed(2);
                })
                .catch((error) => {
                    console.error("Error fetching user data:", error);
                });
        }
   // Function to fetch user account balance from the database
        function fetchUserBalance() {
            // Fetch user account balance from the server using Fetch API
            fetch("get_user_balance.php")
                .then((response) => response.json())
                .then((data) => {
                    // Update user balance on the page
                    document.getElementById("userBalance").textContent = data.balance.toFixed(2);
                })
                .catch((error) => {
                    console.error("Error fetching user balance:", error);
                });
        }

        // Function to handle form submission
        function handleSubmit(event) {
            // Fetch form data
            const formData = new FormData(event.target);
            const stake = parseFloat(formData.get("stake"));

            // Fetch user balance from the server using Fetch API
            fetch("get_user_balance.php")
                .then((response) => response.json())
                .then((data) => {
                    const userBalance = parseFloat(data.balance);

                    // Validate the stake amount against the user's balance
                    if (stake > userBalance) {
                        alert("Insufficient balance. Please enter a lower stake.");
                        event.preventDefault(); // Prevent form submission if stake is too high
                    }
                })
                .catch((error) => {
                    console.error("Error fetching user balance:", error);
                });
        }
        // Countdown timer function
       
        // Fetch user balance when the page loads
        fetchUserBalance();
         // Fetch user data when the page loads
        fetchUserData();
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to update countdown timers
        function updateCountdown() {
            $('.countdown').each(function() {
                var remaining = parseInt($(this).data('remaining'));
                if (remaining > 0) {
                    var hoursRemaining = Math.floor(remaining / 3600);
                    var minutesRemaining = Math.floor((remaining % 3600) / 60);
                    var secondsRemaining = remaining % 60;
                    $(this).html(hoursRemaining + 'h ' + minutesRemaining + 'm ' + secondsRemaining + 's');
                    $(this).data('remaining', remaining - 1);
                } else {
                    // Redirect to the particular page after the timer ends
                    window.location.href = "draw2.php"; // Replace "redirect_page.php" with your desired page
                }
            });
        }

        // Update countdown timers every second
        setInterval(updateCountdown, 1000);

        // Initial call to update countdown timers
        updateCountdown();
    </script>

</body>
</html>
