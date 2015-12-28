<?php
if(!isset($_SESSION))
{
  session_start();
}
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  require_once('/Applications/MAMP/mysqli_connect.php');

  $id = $_SESSION['user_id'];


  $errors = array();

  $checkin_date = strtotime($_POST['date']);
  $DayofWeek = $checkin_date;
  $checkin_date = date('Y-m-d', $checkin_date);
  $checkin_time = $_POST['time'];
  $checkin_time = date('H:i',strtotime($checkin_time));
  $hours_reserved = $_POST['hours_reserved'];
  $hours_reserved = date('H:i',strtotime($hours_reserved));

  $check = strtotime($checkin_time)-strtotime("00:00:00");
  $checkout_time = date("H:i:s",strtotime($hours_reserved)+$check);

  $_SESSION['hours_reserved'] = $hours_reserved;
  $_SESSION['checkdate'] = $checkin_date;
  $_SESSION['checktime'] = $checkin_time;
  $_SESSION['checkout_time'] = $checkout_time;
  $_SESSION['hours_reserved'] = $hours_reserved;

  $dayweek = date( "l", $DayofWeek);


  if(strtotime($checkin_date) <= strtotime(date("Y-m-d")))
  {
    $errors[] =  "Date not valid.";
  }
  if ($dayweek == "Saturday" || $dayweek == "Sunday")
  {
    $errors[] = "Weekends are not available.";
  }

  if (empty($errors)) {


    // Redirect:
    include('select_room.php');

  }
  else
  {
    include('reservation.php');
  }

}

?>
