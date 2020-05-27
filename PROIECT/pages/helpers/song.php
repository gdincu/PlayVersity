<?php
//Checks if the uri includes "index.php" and whether the last char in the URI is numberic
if ( strpos($_SERVER['REQUEST_URI'], 'index.php') !== false && is_numeric (substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1)))
{
//Stores the last char in the URI    
$tempPlaylist = (int)(substr($_SERVER['REQUEST_URI'], strrpos($_SERVER['REQUEST_URI'], '/') + 1));

	//Added html input dropdown to work with usp_returnSongs
	echo "<form action='#' method='post'>
	<select name='orderbyvalue'>
	<option value='name'>Name</option>
	<option value='artist'>Artist</option>
	</select>
	<input type='submit' name='submitorder' value='Select Order' />
	</form>";

	if(isset($_POST['submitorder'])) 
	$tempOrder = strval($_POST['orderbyvalue']);
	else $tempOrder = NULL; 
	//http://localhost/playversity/PROIECT/index.php?idplaylist=1&order=name
	//Add event listener - to be done by Alex <<<<--------

//Calls the usp_returnSongs procedure
//This returns the position, song name, artist, length based on the playlist id
$sql = "CALL usp_returnSongs($tempPlaylist,NULL);";
$result = $connection->query($sql);
	
//Mesaje pentru client la logare
// if($result->num_rows == 0) {
// 	header("Location: index.php?page=home&error=playlistnotfound");
// 	exit;
//                             }
// else    {
    echo "Song list:
					<br><br>
					<table class=\"table\">
					<tr>
    				<th>Position</th>
    				<th>Name</th>
                    <th>Artist</th>
                    <th>Length</th>
                      </tr>";	

	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row["position"] . "</td>";
    	echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["artist"] . "</td>";
        echo "<td>" . $row["length"] . "</td>";
		echo "</tr>";
		                        		}
		echo "</table>";
				// }
			}
			
			else if ( strpos($_SERVER['REQUEST_URI'], 'index.php') !== false && substr($_SERVER['REQUEST_URI'], -9) == "/allsongs") {
				$sql = "CALL usp_returnAllSongs();";
				$result = $connection->query($sql);
					
				echo "Song list:
									<br><br>
									<table class=\"table\">
									<tr>
									<th>Name</th>
									<th>Artist</th>
									<th>Length</th>
									  </tr>";	
				
					while($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>" . $row["artist"] . "</td>";
						echo "<td>" . $row["name"] . "</td>";
						echo "<td>" . $row["length"] . "</td>";
						echo "</tr>";
														}
						echo "</table>";
			}
?>