<!DOCTYPE html>
<?php
require './connect.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $ID = mysqli_real_escape_string($db, $_GET['id']);
        $query = "SELECT * FROM users WHERE ID='$ID'";
        $userData = mysqli_fetch_object(mysqli_query($db, $query));
        //echo $ID;
        $query = "SELECT * FROM friendship WHERE f='$ID' or s='$ID'";
        ?>
        <p>Name: <?php echo $userData->name ?></p>
        <p>Surname: <?php echo $userData->surname ?></p>
        <p>age: <?php echo $userData->age ?></p>
        <p>gender: <?php echo $userData->gender ?></p>
        <p>Friends: 
        <ul>
            <?php
            $a = mysqli_query($db, $query);
            while ($friends = mysqli_fetch_object($a)) {
                $s = $friends->s;
                $f = $friends->f;
                if ($s != $ID) {
                    $query2 = "SELECT * FROM users WHERE ID='$s'";
                } else {
                    $query2 = "SELECT * FROM users WHERE ID='$f'";
                }

                $friend = mysqli_fetch_object(mysqli_query($db, $query2));

                echo "<li>";
                echo "<a href='profile.php?id=$friend->ID'>";
                echo $friend->name . " " . $friend->surname;
                echo "</a>";
                echo "</li>";
            }
            ?>
        </ul>


    </p>
</body>
</html>
