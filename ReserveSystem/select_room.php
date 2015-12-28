
<html>
</style>
<title>Reserve Room</title>


<?php include('header.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
  echo"<h1>You are not logged in!</h1>
  <p>Please login first.</p>";
  echo "<a href=loginreg.php>Login</a>";
}
else {
  ?>
</head>

<body>


  <?
  $q = "SELECT * FROM reservation WHERE checkin_date = '$checkin_date' AND checkin_time = '$checkin_time'";
  $r = mysqli_query ($dbc, $q);

  $numOfRows = mysqli_num_rows($r);

  if ($numOfRows >= 4)
  {
    echo "<center><p><b>
    There are no rooms available for this time.</b><br>
    Go back and pick another time.</div><p>";
    ?>
    <button onclick="history.go(-1);">Go Back </button>
    <?

  }

  else
  {
    ?>

    <center><h2>Please select your desired room/s</h2></center>

    <form id="form" method="post" action="review_reserve.php">

      <?
      $sql = "SELECT * FROM room WHERE room_id NOT IN (SELECT room_id FROM reservation WHERE checkin_date = '$checkin_date' AND (checkin_time = '$checkin_time' OR checkout_time = '$checkout_time'))";
      $r = mysqli_query ($dbc, $sql);

      $numOfRows = mysqli_num_rows($r);

      ?>

      <center>
        <table border="1" width="50%">

          <?
          while ($row = mysqli_fetch_array($r)){

            $roomID = $row['room_id'];

            if ($roomID == 1)
            {
              include ('image_1.php');
              ?>
              <td style="width:50;height:50;">
                <center>
                  <h2>$70</h2><br>
                  <i>(p/hour)</i>
                  <center><input type="radio" name="room" value="1" required></center>
                </td>
              </tr>
              <?
            }

            if ($roomID == 2)
            {
              include ('image_2.php');
              ?>
              <td style="width:50;height:50;">

                <center>
                  <h2>$25</h2><br>
                  <i>(p/hour)</i>
                  <center><input type="radio" name="room" value="2" required></center>
                </td>

              </tr>
              <?

            }
            if ($roomID == 3)
            {
              include ('image_3.php');
              ?>
              <td style="width:50;height:50;">

                <center>
                  <h2>$40</h2><br>
                  <i>(p/hour)</i>
                  <center><input type="radio" name="room" value="3" required></center>
                </td>

              </tr>
              <?

            }
            if ($roomID == 4)
            {
              include('image_4.php');
              ?>
              <td style="width:100;height:50;">

                <center>
                  <h2>$30</h2><br>
                  <i>(p/hour)</i>
                  <center><input type="radio" name="room" value="4" required></center>
                </td>

              </tr>
              <?

            }
          }
          ?>
        </table>

        <p>
          <input name="submit" type="submit" value="Check" style="width:200px;height:300;font-size:30px;">
        </form>
        <script>
        $("#form").Validate();
        </script>
        <p>
        </body>

        <?php
      }
    }
    include('footer.php'); 
    ?>
    </html>
