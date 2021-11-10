<!-- PARTICIPATION: 11/28/2020
	Ryan Laurents developed the vast majority of this file (delete.controller.php)
		including the HTML and most of the php script
	Matthew Irvine adjusted this file to work with Covid.php, added CSS, and adjusted output to be sent to a file for Displaying (php script).
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
			function deletion()
			{
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
				  $countyName = filter_input(INPUT_POST, 'countyName');
				  $result = "";
				  if($countyName != null)
				  {
					$query = "DELETE FROM counties WHERE County_Name = '$countyName'";
					if($conn->query($query))
					{
					  $result .= "Row deleted successfully.<br>";
					  $proof = "SELECT * FROM counties WHERE County_Name = :countyName";
					  $stmt = $conn->prepare($proof);
					  $stmt->bindParam(':countyName', $newCountyName);
					  $stmt->execute();
					  $rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
					  if($rows == null)
					  {
						$result .= "Select statement returned null - Deletion successful.<br>";
						$myfile = fopen("Results.txt","w");
						fwrite($myfile, $result);
						fclose($myfile);
						//die();
					  }
					  else
					  {
						$result .= "<pre>";
						$result .= "DELETION FAILED.<br>";
						$result .= $rows;
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
			}
			
			deletion();
		?>
		<div><p>Result:</p></div>
		<div class="para"><p><?php include("Results.txt");?></p></div>
	</body>
</html>