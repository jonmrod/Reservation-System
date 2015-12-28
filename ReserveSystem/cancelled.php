<?
require ('/Applications/MAMP/mysqli_connect.php');
if(!isset($_SESSION))
{
  session_start();
}

$reserve_id = $_SESSION['reserve_id'];
$penalty = $_SESSION['penalty'];
$newTotal = $_SESSION['newTotal'];

$q = "UPDATE reservation SET status='Cancelled' WHERE reservation_id='$reserve_id'";
mysqli_query($dbc, $q);

if ($penalty == 1)
{
  $q = "UPDATE payment SET amount = $newTotal WHERE reservation_id = '$reserve_id'";
  mysqli_query($dbc, $q);
}

include('reservation.php');

echo "<h1><center>Reservation Cancelled!</h1></center>";
?>
