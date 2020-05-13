<!-- https://www.w3schools.com/php/php_file_upload.asp -->
<?php
$target_dir = "uploads/";
$tmp = explode(".", $_FILES["fileToUpload"]["name"]);
$fileExt = end($tmp);
$target_file = $target_dir . basename($_POST["usernume"] . "." . $fileExt);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br><br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br><br>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br><br>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.<br><br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br><br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename($_POST["usernume"]). " has been uploaded.<br><br>";
    } else {
        echo "Sorry, there was an error uploading your file.<br><br>";
    }
}
?>