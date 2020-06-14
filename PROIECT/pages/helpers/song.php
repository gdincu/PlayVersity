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
//Exits song.php if the URI doesn't contain the expected variables
else exit();

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
					<form method='post' action=''>
					<table class='table'>
					<tr>
    				<th>Artist</th>
    				<th>Name</th>
					<th>Length</th>
					<th>IDSONG</th>
					<th></th>
					  </tr>";

	while($row = $result->fetch_assoc() && isset($_GET['playlistid'])) {
		echo "<tr>";
		echo "<td>" . $row["artist"] . "</td>";
		echo "<td>" . $row["name"] . "</td>";
		echo "<td>" . $row["length"] . "</td>";
		echo '<td><input type="submit" name="deleteItem" value="' . (int)$row['idsong'] . '" /></td>"';
		echo "</tr>";
		}

	while($row = $result->fetch_assoc() && isset($_GET['allsongs'])) {
		echo "<tr>";
		echo "<td>" . $row["artist"] . "</td>";
		echo "<td>" . $row["name"] . "</td>";
		echo "<td>" . $row["length"] . "</td>";
		echo '<td><input type="submit" name="addItem" data-target="#portfolioModal2" data-toggle="modal" value="' . (int)$row['idsong'] . '" /></td>"';
		echo "</tr>";
		}	
		
		echo "</table></form>";
	}


?>

<?php
//Deleting items
	if(isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem']))
	{
$toDel = (int)$_POST['deleteItem'];
$sqlTemp = "CALL usp_delSongFromPlaylist($tempPlaylist,$toDel);";
$con2 = mysqli_connect("localhost","root","","playversity");
mysqli_query($con2,$sqlTemp);
}

//Adding items
if(isset($_POST['addItem']) and is_numeric($_POST['addItem']))
{
$toAdd = (int)$_POST['addItem'];
$currentUser = $_SESSION["user"];



$sqlTemp = "CALL usp_returnPlaylists($currentUser);";

}
?>

