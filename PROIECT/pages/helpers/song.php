<?php

//Checks if the URI includes "index.php" and whether it contains a playlist id
if ( strpos($_SERVER['REQUEST_URI'], 'index.php') !== false && isset($_GET['playlistid']))
{

//Sanitises and stores the playlistid in a variable
$tempPlaylist = (int)htmlentities($_GET['playlistid'],ENT_HTML5,'UTF-8',TRUE);

//Checks the orderby value
$orderby = 'NULL';
if(isset($_GET['orderby']))
//Sanitises the value passed through the URI
$orderby = "'".htmlentities($_GET['orderby'],ENT_HTML5,'UTF-8',TRUE)."'";

//Calls the usp_returnSongs procedure and returns the artist, song name and song length based on the playlist id and orderby value
$sql = "CALL usp_returnSongs($tempPlaylist,$orderby);";
}
//Checks if the URI includes "index.php" and allsongs
else if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false && isset($_GET['allsongs']))
$sql = "CALL usp_returnAllSongs();";

//Runs the SQL query
$result = $connection->query($sql);

//Mesaje de verificare a playlistului

if($result->num_rows == 0)
{
	echo "Invalid playlist id";
	exit();
}
else    {
    echo "Song list:
					<br><br>
					<table class=\"table\">
					<tr>
    				<th>Artist</th>
    				<th>Name</th>
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
				// }
			}
?>