<!DOCTYPE html>
<html>
	<meta charset="UTF-8">
		<head>
		</head>
		<body>

			<?php
				include 'db_connector.php';
	
				$connect = db_connect();
	
				echo "Connected Successfully";
	
				db_disconnect($connect);
			?>
		</body>
</html>