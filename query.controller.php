<!DOCTYPE html>
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
			include 'db_connector.php';
			
			/* Functions */
			function sql_command_query($input, $mysqli, $output)
			{
				$varReturn = "";
				$result = $mysqli->query($input);
				if($result == TRUE)
				{
					$all = $result->fetch_all();
					$result->close();
					if($output === TRUE)
					{
						$size = count($all);
						for( $i = 0; $i<$size; $i++)
						{
							$str = "";
							$tuplesize = count($all[$i]);
							$str_deep = "";
							for($j = 0; $j<$tuplesize; $j++)
							{
								$str_deep .= " " . $all[$i][$j];
							}
							$str .= $str_deep;
							$str .= "<br>";
							$varReturn .= $str;
						}
					}
					else
						$varReturn .= "$input was successful";
				}
				else
					$varReturn .= "$input was unsuccessful";
				
				return $varReturn;
			}
			
			/* Webpage Main function */
			if($command = filter_input(INPUT_POST, 'query'))
			{
				if($command == null)
				{
					$result = "$command was unsuccessful";
					$myfile = fopen("Results.txt","w");
					fwrite($myfile, $result);
					fclose($myfile);
				}
				else
				{
					$mysqli = db_connect("project2_covid");
					$result = sql_command_query($command, $mysqli, TRUE);
					//$result = "This was a Query";
					$myfile = fopen("Results.txt","w");
					fwrite($myfile, $result);
					fclose($myfile);
					db_disconnect($mysqli);
				}
			}
			
			//Test Examples
			//SELECT * FROM cities WHERE 1
			//SELECT * FROM coviddata GROUP BY state_ab, County_Name, CDate;

		?>
		<div><p>Result:<br></p></div>
		<div class="para"><p><?php include('Results.txt'); ?></p></div>

	</body>
</html>



