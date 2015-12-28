<?php
if(!isset($_SESSION))
{
  session_start();
}
require_once('/Applications/MAMP/mysqli_connect.php');
?>
<!DOCTYPE html>

<!-- Header-->
<html>
<style>

  .error, .ad 
  {
    font-weight: bold;
    color: #C00
  }

  .hover_img a
  {
    position:relative;

  }
  .hover_img a span
  {
    position:absolute;
    display:none;
    left: -200px;

    z-index:99;
  }
  .hover_img a:hover span
  {
    display:block;
  }
  #header {
    background-color: #A4A4A4;
    padding: 0px 10px;
    height:40px;
  }
  #nav {
    list-style: none;
    padding: 0px;
    display: inline-block;
  }
  #nav li {
    display:inline-block;
    padding: 0px;
    padding-right: 100px;

  }
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  body {
    background-color: #D3D3D3;
    margin: 0;
  }
  #content {
    align: center;
  }
  #left
  {
    float:left;
  }

  #right
  {
    float:right;

  }


  #book
  {
    float:right;
    padding-right:380px;
  }

  .right
  {
    padding-right:100px;
    float: right;
  }

  .left
  {
    padding-left:200px;
    float: left;
  }
  .right2
  {
    padding-right:250px;
    float: right;
  }

  .left2
  {
    padding-left:250px;
    float: left;
  }
  h3{
    color: black;
  }
  h1{
    color: blue;
    border-bottom: 1px solid #000;
  }
  p label{

    display: inline-block;
    width: 150px;

  }
  p input{
    width:150px;
  }
</style>
<div id="header">
  <div id="logo">

  </div>

  <center>
    <ul id="nav">
      <li><a href="reservation.php">Home</a></li>
      <li><a href="history.php">History</a></li>
      <?
      if (isset($_SESSION['user_id'])) {
        $userID = $_SESSION['user_id'];

        //get reservation id to use in payment information
        $q = "SELECT * FROM users WHERE user_id='$userID'";
        $r = @mysqli_query ($dbc, $q);
        $row = mysqli_fetch_array($r);
        $role = $row['role'];
        //if the person is an admin
        if ($role == "Admin")
        {
          echo '<li><a href="view_users.php">Edit/View Users</a></li>';
        }
      }

      ?>
      <li><a href="settings.php">Profile Settings</a></li>
      <li><a href="logout.php">Log Out</a></li>

    </ul>
  </center>
</div>
</html>
