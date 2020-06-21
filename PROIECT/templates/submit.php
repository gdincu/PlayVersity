<?php
if ($_POST['dropdownValue']){
//     //call the function or execute the code
    // echo $_POST['dropdownValue'];
    processDrpdown($_POST['dropdownValue']);
}

function processDrpdown($selectedVal) {
    echo $selectedVal;
} 
?>