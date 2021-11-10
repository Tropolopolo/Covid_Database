<!-- 
Authors:
Ryan Laurents - 1000763099
Matthew Irvine - 1001401200

Date: 11/28/2020

These files are for the compeletion of Project 2 Phase 3 for the class Databases and File Systems
at the University of Texas at Arlington, taught by Professor Bhanu Jain.
TAs - Donna Safaddin and Ariella Amanuel 
-->

<!-- PARTICIPATION: 11/28/2020
	Matthew Irvine developed all of this file (noquery.controller.php).
-->

<?php
	function db_connect($str)
	{
		$host = "localhost:3306";
		$user = "root";
		$password = "";
		$db_name = $str;
		
		$touch = new mysqli($host, $user, $password, $db_name) or die("Connection failed: %s\n". $touch -> error);
		
		return $touch;
	}
	
	function db_disconnect($touch)
	{
		$touch -> close();
	}
?>