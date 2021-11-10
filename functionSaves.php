
<?php
function create_table($tableparam, $mysqli)
			{
				//echo $tableparam[0];
				$str = "CREATE TABLE ";
				$num = count($tableparam);
				//echo $num;
				for ($i = 0; $i<$num; $i++)
				{
					if ($i === 0)
					{
						//This adds the tablename and sets up the column specification
						$str .= $tableparam[$i] . " (";
						continue;
					}
					else if ($i===$num-1)
					{
						//This ends the command properly
						$str .= $tableparam[$i] . ");";
						continue;
					}
					else
					{
						//This inputs each column definiton for the table.
						$str .= $tableparam[$i] . ",";
					}
				}
				if($mysqli->query($str) === TRUE)
				{
					echo "Table " . $tableparam[0] . " successfully created.\n";
				}
				else
					echo "$str failed";
			}
			
			function drop_table($tablename, $mysqli)
			{
				$str = "DROP TABLE " . $tablename;
				if($mysqli->query($str) === TRUE)
				{
					echo "Table " . $tablename . " successfully dropped.\n";
				}
				else
					echo "$str failed";
			}
?>