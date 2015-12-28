<?php

session_start(); // Access the existing session.

// If no session variable exists, redirect the user:
if (!isset($_SESSION['user_id'])) {

	// Need the functions:
	require ('login_functions.inc.php');
	redirect_user('loginreg.php');

} else { // Cancel the session:

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.

}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';

// Print a customized message:
?>
<head>
	<?php
	echo "<center><h2>Logged Out!</h2>
	<p>You are now logged out!";

	include ('loginreg.php');
	?>

</head>
