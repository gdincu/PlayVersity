<?php
//Checks if the uri includes "index.php" and whether the last char in the URI is numberic
if ( strpos($_SERVER['REQUEST_URI'], 'index.php') !== false && is_numeric (substr($_SERVER['REQUEST_URI'], -1)))
{

//Stores the last char in the URI    
$tempPlaylist = (int)(substr($_SERVER['REQUEST_URI'], -1));
//Calls the usp_returnSongs procedure
//This returns the position, song name, artist, length based on the playlist id
$sql = "CALL usp_returnSongs($tempPlaylist);";
$result = $connection->query($sql);
	
//Mesaje pentru client la logare
if($result->num_rows == 0) {
	header("Location: index.php?page=home&error=playlistnotfound");
	exit;
                            }
else    {
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
				}
            }
?>