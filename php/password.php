<?php

require_once('../includes/config.inc.php');

$mysqli = @new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_errno()) {
    printf("Unable to connect to database : %s", mysqli_connect_errno);
    exit();
}

$id = $_POST['id'];

//echo $id;
//
//" OR 1=1 ";

$sql = "SELECT * FROM passwords WHERE id = " . $id;

$result = mysqli_query($mysqli, $sql);
if (!$result) {
//    echo "Hello";
    printf("Errormessage: %s\n", mysqli_error($mysqli));
} else {
    // If one row is returned, username and password are valid
    if ($result->num_rows >= 1) {
        $output = "";
        while ($row = mysqli_fetch_array($result)) {
            $output = $output . $row['password'] . " ";
        }
        echo $output;
    } else {
        echo "Password not found";
    }
}
mysqli_close($mysqli);

//// read password line by line
//$handle = fopen("passwordlist.txt", "r");
//if ($handle) {
//    while (($line = fgets($handle)) !== false) {
//        // process the line read.
//        $sql = "INSERT INTO passwords (password) VALUES(' $line ')";
//        if (mysqli_query($mysqli, $sql)) {
//            echo "Save record successfully";
//        } else {
//            echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
//        }
//    }
//
//    fclose($handle);
//} else {
//    // error opening the file.
//}
//
// INSERT PASSWORD


