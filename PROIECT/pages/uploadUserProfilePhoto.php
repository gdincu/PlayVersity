<?php 
/**
 * Store Image File in Database
 */
// Include the database configuration file  
require_once "../db_setup/db_connect.php";
require_once "helpers/session.php";
 
// If file upload form is submitted 
$status = $statusMsg = ''; 

if (!isLoggedIn()) {
    $statusMsg = "Permission error";
} else if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Update image content into database
            $user = getLoggedInUser(); 
            $insert = $connection->query("UPDATE user SET image = '$imgContent' WHERE username='$user'"); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 

if ($status == 'success') {
    header("Location: ../index.php?page=user");
}
?>