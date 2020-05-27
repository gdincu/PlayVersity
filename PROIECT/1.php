<?php
echo "<form action='#' method='post'>
	<select name='orderbyvalue'>
	<option value='name'>Name</option>
	<option value='artist'>Artist</option>
	</select>
	<input type='submit' name='submitorder' value='Select Order' />
	</form>";

if(isset($_POST['submitorder'])){
$selected_val = $_POST['orderbyvalue'];  // Storing Selected Value In Variable
echo "You have selected :" .$selected_val;  // Displaying Selected Value
}
?>