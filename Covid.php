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
	Matthew Irvine developed all of the CSS and most of the HTML of this file (Covid.php).
	Ryan Laurents developed the forms Select From Table [coviddata], Update County Name [counties], Insert Into Table [counties], Delete County Name [counties]
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
	
	.form {
		background-color: hsl(210, 100%, 80%);
		color: hsl(240, 100%, 30%);
		border: 2px solid blue;
		border-radius: 4px;
	}
	
	.para {
		background-color: hsl(120, 60%, 50%);
		color: hsl(30, 100%, 20%);
		border: 2px dashed hsl(30, 100%, 20%);
		border-radius: 4px;
		padding: 2px;
	}
	
	.input {
		background-color: hsl(180, 100%, 90%);
		border: 2px solid black;
		border-radius: 4px;
		padding: 2px;
	}
	</style>
	<body class="Body">
		<form method = "post" action="query.controller.php" class="form">
			<fieldset>
				<legend> Database Query (advanced users)</legend>
				<label id="label" for="name"> MySQL Query </label></br>
				<input type="text" name="query" placeholder="Enter mySQL Query" class="input" size="199"></br>
				<input id="button" type="submit" name="submitQ" value="Submit"><br>
			</fieldset>
		</form>	<br>
		
		<form method = "post" action="noquery.controller.php" class="form">
			<fieldset>
				<legend> Database Commands (advanced users)</legend>
				<label id="label" for="name"> MySQL Commands </label></br>
				<input type="text" name="noquery" placeholder="Enter Commmands" class="input" size="199"></br>
				<input id="button" type="submit" name="submitNQ" value="Submit"><br>
			</fieldset>
		</form><br>
		
		<form method="post" action="select.controller.php" class="form">    
		  <fieldset>       
			<legend> Select From Table [coviddata]</legend>

			<label id="label" for="stateName"> State Abbreviation </label> </br>
			<input type="text" name="stateName" placeholder=" Enter state abbreviation" class="input"> </br>    

			<label id="label" for="countyName"> County Name </label> </br>
			<input type="text" name="countyName" placeholder=" Enter county name" class="input"> </br>    

			<label id="label" for="date"> Date </label> </br>
			<input type="text" name="date" placeholder=" Enter date" class="input"> </br>    

			<input id="button" type="submit" name="submit">  
		  </fieldset>
		 </form><br>
		 
		<form method="post" action="update.controller.php" class="form">    
		  <fieldset>       
			<legend> Update County Name [counties]</legend>

			<label id="label" for="newCountyName"> New County Name </label> </br>
			<input type="text" name="newCountyName" placeholder=" Enter a new county name" class="input"> </br> 

			<label id="label" for="oldCountyName"> Old County Name </label> </br>
			<input type="text" name="oldCountyName" placeholder=" County name to replace" class="input"> </br>       

			<label id="label" for="stateName"> State Abbreviation </label> </br>
			<input type="text" name="stateName" placeholder=" Enter state abbreviation" class="input"> </br>    

			<input id="button" type="submit" name="submit">  
		  </fieldset>
		</form><br>
		
		<form method="post" action="insert.controller.php" class="form">    
		  <fieldset>       
			<legend> Insert Into Table [counties]</legend>

			<label id="label" for="countyName"> County Name </label> </br>
			<input type="text" name="countyName" placeholder=" Enter county name" class="input"> </br> 

			<label id="label" for="stateName"> State Abbreviation </label> </br>
			<input type="text" name="stateName" placeholder=" Enter state abbreviation" class="input"> </br>       

			<label id="label" for="pop"> Population </label> </br>
			<input type="text" name="pop" placeholder=" Enter population" class="input"> </br>    

			<input id="button" type="submit" name="submit">  
		  </fieldset>
		</form><br>
		
		<form method="post" action="delete.controller.php" class="form">    
		  <fieldset>       
			<legend>Delete County Name [counties]</legend>

			<label id="label" for="countyName"> County Name </label> </br>
			<input type="text" name="countyName" placeholder=" -DELETE COUNTY-" class="input"> </br>    

			<input id="button" type="submit" name="submit">  
		  </fieldset>
		</form><br>
		
		<div><p class="para"><?php include("README.txt");?></p><div>
	</body>
</html>