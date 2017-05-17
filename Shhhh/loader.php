<?php

require './connect.php';

$file = $_FILES['file']['name'];

$data = file_get_contents($file);
$array = json_decode($data, true);


foreach ($array as $row) {

    $name = mysqli_real_escape_string($db, $row["firstName"]);
    $surname = mysqli_real_escape_string($db, $row["surname"]);
    $age = mysqli_real_escape_string($db, $row["age"]);
    $gender = mysqli_real_escape_string($db, $row["gender"]);

    $query = "INSERT INTO users(name,surname,age,gender) VALUES('$name','$surname','$age','$gender')";

    if (!mysqli_query($db, $query)) {
        echo $name . "<br/>";
        echo $surname . "<br/>";
        echo $age . "NULL<br/>";
        echo $gender . "<br/>";
    }
}

foreach ($array as $row) {
    foreach ($row["friends"] as $friend) {

        $f = intval(mysqli_real_escape_string($db, $row['id']));
        $s = intval(mysqli_real_escape_string($db, $friend));
        $query = "INSERT INTO friendship(f,s) VALUES($f,$s)";
        $check = "SELECT * FROM friendship WHERE (f='$f' AND s='$s') OR (f='$s' AND s='$f')";
        if (mysqli_fetch_object(mysqli_query($db,$check))==null) {

            $run = mysqli_query($db, $query);
            
            echo $s . ": " . $f . "<br/>";
           
        }
    }
}

//header("Location: index.php");


    