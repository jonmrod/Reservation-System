<?php session_start();
include('header.php');
?>
<html>
<head>

	<title>Registration</title>
</head>
<body>

	<?
	$fname = $_SESSION['fname'];
	$lname = $_SESSION['lname'];
	$email = $_SESSION['email'];
	$pass = $_SESSION['pass'];
	$sql2 = mysqli_query($dbc, "SELECT * FROM `users` WHERE `email` = '$email'");

	if(mysqli_num_rows($sql2) > 0){

		echo "This email is already in use. <br>
		Please use a different email.<p>";
		echo "<a href='registration.php'>Go back</a>.";
	}
	else {

		$SQL = "INSERT INTO `cps3351`.`users` (`user_id`, `fname`, `lname`, `email`, `pass`, `role`)
		VALUES ('','$fname' , '$lname', '$email', sha1('$pass'), 'User')";


		if(mysqli_query($dbc, $SQL)){
			echo "Account created successfully!<br>";
		} else{
			echo "ERROR: Could not able to execute " . mysqli_error($dbc);

		}
		print "Welcome <b>" . $fname. "</b> <b>"
		.$lname . "!</b><br>";
		echo "Your email is: " . $email."<br>" ;
		echo "<b>You have succesfully registered!</b>";
	}

	?>
	<br>

</FONT>


</body>

<?php include('footer.php'); ?>
</html>
