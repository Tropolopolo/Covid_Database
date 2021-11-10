<!-- 
Authors:
Ryan Laurents - 1000763099
Matthew Irvine - 1001401200

Date: 11/28/2020

These files are for the compeletion of Project 2 Phase 3 for the class Databases and File Systems
at the University of Texas at Arlington, taught by Professor Bhanu Jain.
TAs - Donna Safaddin and Ariella Amanuel 
-->
<!--test: Baylor, TX, 2020-03-22 -->
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

		$host = "localhost:3306";

		$dbusername = "root";

		$dbpassword = "";

		$dbname = "project2_covid";

		$result = "";
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
		  $countyName = filter_input(INPUT_POST, 'countyName');
		  $cdate = filter_input(INPUT_POST, 'date');

			//echo "$stateName, $countyName, $cdate<br>";

		  // If we have input for all 3, find the matching rows
		  if($stateName != null AND $countyName != null AND $cdate != null)
		  {
			if($query = "SELECT *
			FROM coviddata 
			WHERE State_Ab = :stateName AND County_Name = :countyName AND CDate = :cdate")
			{
				//echo "query if<br>";
				
				$stmt = $conn->prepare($query);
				//$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt->bindParam(':stateName', $stateName);
				$stmt->bindParam(':countyName', $countyName);
				$stmt->bindParam(':cdate', $cdate);
				$check = $stmt->execute();
				if($check != True)
					echo "False";
				$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
			  if($rows == null)
			  {
				$result .= "No Records Available.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= "<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			}
		  }

		  //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		  // 2 out of 3 search fields non null
		  //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

		  // If we have input for state and county but NOT date, don't consider date
		  if($stateName != null AND $countyName != null AND $cdate == null)
		  {
			if($query = "SELECT *
			FROM coviddata 
			WHERE State_Ab = :stateName AND County_Name = :countyName")
			{
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':stateName', $stateName);
				$stmt->bindParam(':countyName', $countyName);
				$stmt->execute();
				$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
			  if($rows == null)
			  {
				$result .= "No Records Available.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= "<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			}
		  }

		  // If we have entry from State and date but NOT county, ignore county
		  if($stateName != null AND $countyName == null AND $cdate != null)
		  {
			if($query = "SELECT *
			FROM coviddata 
			WHERE State_Ab = :stateName AND CDate = :cdate")
			{
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':stateName', $stateName);
				$stmt->bindParam(':cdate', $cdate);
				$stmt->execute();
				$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
			  if($rows == null)
			  {
				$result .= "No Records Available.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= "<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			}
		  }
		  
		  // If we have input county and date but NOT state, ignore state
		  if($stateName == null AND $countyName != null AND $cdate != null)
		  {
			if($query = "SELECT *
			FROM coviddata 
			WHERE County_Name = :countyName AND CDate = :cdate")
			{
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':countyName', $countyName);
				$stmt->bindParam(':cdate', $cdate);
				$stmt->execute();
				$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
			  if($rows == null)
			  {
				$result .= "No Records Available.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= "<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			}
		  }

		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		// 1 out of 3 search fields non null
		//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

		// ONLY state name entered
		if($stateName != null AND $countyName == null AND $cdate == null)
		  {
			if($query = "SELECT *
			FROM coviddata 
			WHERE State_Ab = :stateName;")
			{
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':stateName', $stateName);
				$stmt->execute();
				$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
				//var_dump($rows);
			  if($rows == null)
			  {
				$result .= "No Records Available.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= "<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			}
		  }

		  // ONLY county name entered
		  if($stateName == null AND $countyName != null AND $cdate == null)
		  {
			if($query = "SELECT *
			FROM coviddata 
			WHERE County_Name = :countyName")
			{
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':countyName', $countyName);
				$stmt->execute();
				$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
			  if($rows == null)
			  {
				$result .= "No Records Available.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= "<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			}
		  }

		  // ONLY date entered
		  if($stateName == null AND $countyName == null AND $cdate != null)
		  {
			if($query = "SELECT *
			FROM coviddata 
			WHERE CDate = :cdate")
			{
				$stmt = $conn->prepare($query);
				$stmt->bindParam(':cdate', $cdate);
				$stmt->execute();
				$rows = $stmt->fetchALL(PDO::FETCH_ASSOC);
			  if($rows == null)
			  {
				$result .= "No Records Available.";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			  else
			  {
				$result .= "<pre>";
				$size = count($rows);
				for( $i = 0; $i<$size; $i++)
				{
					$str = "";
					$tuplesize = count($rows[$i]);
					$str_deep = "";
					foreach($rows[$i] as $value)
					{
						$str_deep .= " " . $value;
					}
					$str .= $str_deep;
					$str .= "<br>";
					$result .= $str;
				}
				$result .= "</pre>";
				$myfile = fopen("Results.txt","w");
				fwrite($myfile, $result);
				fclose($myfile);
			  }
			}
		  }
		}
		?>
		<div><p>Result:</p></div>
		<div class="para"><p><?php include('Results.txt'); ?></p></div>
	</body>
</html>