<?php
$connection = mysqli_connect("localhost","root","","playversity");

//Sanitises and stores the playlistid in a variable
$tempPlaylist = 0;
if(isset($_GET['playlistid']))
$tempPlaylist = (int)htmlentities($_GET['playlistid'],ENT_HTML5,'UTF-8',TRUE);

//Checks the orderby value and sanitises the value passed through the URI
$orderby = 'NULL';
if(isset($_GET['orderby']))
$orderby = "'".htmlentities($_GET['orderby'],ENT_HTML5,'UTF-8',TRUE)."'";

//Setting the start page to divide result sets containing multiple lines into multiple pages
$results_per_page = 5;
if (isset($_GET["pageno"]) && is_numeric($_GET["pageno"])) { $page  = $_GET["pageno"]; } else { $page=1; }; 
$start_from = ($page-1) * $results_per_page;

//Find the total nr of records and works out the total nr of pages
$sqlCountAll = "SELECT COUNT(id) AS total FROM song";
$sqlCount = "SELECT COUNT(id) AS total FROM songplaylist WHERE idplaylist = $tempPlaylist";
$resultCount = $connection->query($sqlCountAll);
$rowCount = $resultCount->fetch_assoc();
$total_pages = ceil($rowCount["total"] / $results_per_page);

//Checks if the URI includes "index.php" and whether it contains a playlist id
if ( strpos($_SERVER['REQUEST_URI'], 'index.php') !== false && isset($_GET['playlistid']))
//Calls the usp_returnSongs procedure and returns the artist, song name and song length based on the playlist id and orderby value
$sql = "CALL usp_returnSongs($tempPlaylist,$orderby,$start_from,$results_per_page);";

//Checks if the URI includes "index.php" and allsongs
else if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false && isset($_GET['allsongs']))
$sql = "CALL usp_returnAllSongs($start_from,$results_per_page);";

//Exits song.php if the URI doesn't contain the expected variables
else exit();

//Runs the SQL query
$result = $connection->query($sql);

if($result->num_rows == 0)
{
	echo "Page not found! Please try again!";
	exit();
}
else    {
	echo $sql;
	//Return song details from the DB
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		echo "<td>" . $row["artist"] . "</td>";
		echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["length"] . "</td>";
		echo "</tr>";
		 }
		 echo "</table>";
			}

	//Show the all other pages as a dropdown list
	echo 'Page: <select name="forma" onchange="location = this.value;">';
	for ($i=1; $i<=$total_pages; $i++) {
		$string = $_SERVER["REQUEST_URI"];
		if(isset($_GET["pageno"])) 
		$string = removeParam($string,'pageno');
		echo "<option value='" . $string . "&pageno=".$i."'>".$i."</option> ";  
		}
	echo '</select>';

	function removeParam($url, $param) {
		$url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*$/', '', $url);
		$url = preg_replace('/(&|\?)'.preg_quote($param).'=[^&]*&/', '$1', $url);
		return $url;
	}
?>


