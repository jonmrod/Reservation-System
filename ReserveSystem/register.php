<?php
session_start();
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors1 = array();
	require ('login_functions.inc.php');
	require ('/Applications/MAMP/mysqli_connect.php');

	if ($_POST['pass'] !== $_POST['pass2'])
	{
		$errors1[] = "Make sure both passwords are correct!";
	}
	if ((empty($_POST['pass']) or empty($_POST["fname"]) or empty($_POST["email"]) or empty($_POST["lname"])))
	{
		$errors1[] = "All fields must be filled!<br>";
	}
	else { // OK!

		$_SESSION['fname'] = $_POST['fname'];
		$_SESSION['lname'] = $_POST['lname'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['pass'] = $_POST['pass'];

		// Redirect:
		redirect_user('registration_handle.php');

	}

	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('registration.php');
?>
