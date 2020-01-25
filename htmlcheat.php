<?php 
    include('server.php'); //including an external file with  some code to be used s
	//session_start(); 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first"; //incase this page needs user to be first logged in
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy(); //destroy the session when one logs out
		unset($_SESSION['username']);
		header("location: login.php");
	}
?>