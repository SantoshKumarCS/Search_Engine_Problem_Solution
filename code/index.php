<!DOCTYPE html>
<html>
	
	<head>
		<title>Search Engine</title>
	</head>
	
	<body>
		
		
		<form action="index.php" method="get">
		Search Engine:<input type="text" name="value" placeholder="Search">
		<input type="submit" name="search" value="Search Now">
		<form>
		
		
		
		<hr>
		
		
		
		<?php
		
			$servername = "localhost";
			$username = "root";
			$password = "root";
			$dbname = "search_engine";
             
			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			if(isset($_GET['search'])){
					 $search_val = $_GET['value'];
			// Query to fetch the records based on the keywords entered
			$sql = "select * from searchengine where site_keywords like '%$search_val%' order by `site_strength` desc";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				
				$title = $row['site_title'];
				$link = $row['site_link'];
				$desc = $row['site_desc'];
			
					echo "<h1>$title</h1><a href='$link'>$link</a><p>$desc</p><hr>"; // Display the results one by one ranked based on site strength
				}
			} else {
				echo "No results found for the entered value"; // Gets displayed when there is no keyword present in data base
			}
			}
			
			$conn->close(); // Close Connection
			
		?> 
	</body>
</html>
