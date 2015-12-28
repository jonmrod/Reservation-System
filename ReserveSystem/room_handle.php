<?php
if(!isset($_SESSION))
{
  session_start();
}
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require ('/Applications/MAMP/mysqli_connect.php');

  $errors = array();

  if(empty($_POST['room']))
  {
    $errors[] =  "Please select a room.";
    include('select_room.php');
  }


  if (empty($errors)) {

    $_SESSION['room'] = $_POST['room'];

    // Redirect:
    include('review_reserve.php');

  } else {
    // Unsuccessful!



  }

  mysqli_close($dbc); // Close the database connection.
}
?>
