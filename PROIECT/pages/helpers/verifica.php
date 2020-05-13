<?php

$nume=$prenume=$prenume=$email=$user=$parola=$parola2=$fail="";

if (isset($_POST['nume']))
    $nume = fix_string($_POST['nume']);
if (isset($_POST['prenume']))
    $prenume = fix_string($_POST['prenume']);
if (isset($_POST['email']))
    $email = fix_string($_POST['email']);
if (isset($_POST['usernume']))
    $user = fix_string($_POST['usernume']);
if (isset($_POST['parola']))
    $parola = $_POST['parola'];
if (isset($_POST['parola2']))
    $parola2 = $_POST['parola2'];

    $fail = validate_nume($nume);
    $fail .= validate_prenume($prenume);
    $fail .= validate_email($email);
    $fail .= validate_usernume($user);
    $fail .= validate_parola($parola,$parola2);
    ?>

<?php
function fix_string($string) {
 if (get_magic_quotes_gpc())
 $string = stripslashes($string);
 return htmlentities ($string);
}
?> 

<?php
    function validate_nume($field) {
     if ($field == "")
     return "No surname was entered<br />";
     return "";
    }
?>

<?php
function validate_prenume($field) {
 if ($field == "")
 return "No name was entered<br />";
 return ""; }
?> 

<?php
function validate_usernume($field) {
 if ($field == "")
 return "No Username was entered<br />";
 else if (strlen($field) < 5)
 return "Usernames must be at least 5 characters<br/>";
 else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
 return "Only letters, numbers, - and _ in usernames";

$fieldTemp = "'" . $field . "'";

include "db_connect.php";
$sql = "SELECT * FROM utilizatori WHERE usernume = $fieldTemp";
$result = $connection->query($sql);	
if($result->num_rows > 0) 
return "Username already exists";
 
return "";
}
?> 

<?php
function validate_parola($field1,$field2) {
 if ($field1 == "" || $field2 == "" )
 return "No Password was entered<br />";
 else if (strlen($field1) < 1 || strlen($field2) < 1 )
 return "Passwords must be at least 1 character<br/>";
 else if (strcmp($field1, $field2) != 0) {
 return "Passwords have to match";
}
 return "";
}
?> 

<?php
function validate_email($field) {
 if ($field == "")
 return "No Email was entered<br />";
 else if (!((strpos($field, ".") > 0) &&
(strpos($field, "@") > 0)) ||
preg_match("/[^a-zA-Z0-9.@_-]/", $field))
 return "The Email address is invalid<br />";

 $fieldTemp = "'" . $field . "'";

include "db_connect.php";
$sql = "SELECT * FROM utilizatori WHERE email = $fieldTemp";
$result = $connection->query($sql);	
if($result->num_rows > 0) 
return "Email already exists";

 return "";
}
?> 