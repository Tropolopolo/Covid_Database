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
	Ryan Laurents developed the vast majority of this file (delete.controller.php)
		including the HTML and most of the php script
	Matthew Irvine adjusted this file to work with Covid.php, added CSS, and adjusted output to be sent to a file for Displaying (php script and HTML).
-->

<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
	<head>
	<title> Covid 19 Project </title>
	</head>
	<style>
	.Body {
		background-color: hsl(120, 100%, 80%);
	}
	
	.para {
		background-color: hsl(210, 100%, 80%);
		color: hsl(240, 100%, 30%);
		border: 2px solid blue;
		border-radius: 4px;
	}
	</style>
	<body class="Body">
		<?php

		$host = "localhost:3306";

		$dbusername = "root";

		$dbpassword = "";

		$dbname = "project2_covid";


		// Create Connection
		$conn = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbusername, $dbpassword);

		// Check Connection
		if(!$conn)
		{
		  die("Connection Failed.");
		}


		else
		{
		  $stateName = filter_input(INPUT_POST, 'stateName');
		  $oldCountyName = filter_input(INPUT_POST, 'oldCountyName');
		  $newCountyName = filter_input(INPUT_POST, 'newCountyName');
		  $result = "";
		  if($stateName != null AND $oldCountyName != null AND $newCountyName != null)
		  {
			$query = "UPDATE counties SET County_Name = '$newCountyName' WHERE County_Name = '$oldCountyName' AND State_Ab = '$stateName'";

			if($conn->query($query))
			{
			  $result .= "Row updated successfully.";

			  $proof = "SELECT * FROM counties WHERE County_Name = :newCountyName AND State_Ab = :stateName";
			  $stmt = $conn->prepare($proof);
			  $stmt->bindParam(':stateName', $stateName);
			  $stmt->bindParam(':newCountyName', $newCountyName);
			  $stmt->execute();
			  $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
			  if($rows == null)
			  {
				$result .= "Unexpected error.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$result .= "$oldCountyName";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						if($value === $newCountyName)
							continue;
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= " County Name is now $newCountyName.<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
						fwrite($myfile, $result);
						fclose($myfile);
			  }
			}
			else
			{
			  $result .= "Error";
			  $myfile = fopen("Results.txt","w");
						fwrite($myfile, $result);
						fclose($myfile);
			}
		  }

		}
		?>
		<div><p>Result:<br></p></div>
		<div class="para"><p><?php include("Results.txt");?></p></div>
	</body>
</html>