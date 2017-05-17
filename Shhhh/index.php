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
        <form method="post" action="loader.php" enctype="multipart/form-data">
            <input type="file" id="file" name="file"><br/>
            <input type="submit" value="Upload Image" name="submit">

        </form>
        <table>
            <?php
            $query = "SELECT * FROM users";
            $data = mysqli_query($db, $query);
            while ($row = mysqli_fetch_object($data)) {

                echo "<tr>";
                echo "<td>";
                echo "<a href = 'profile.php?id=$row->ID'>";
                echo $row->name . " " . $row->surname . " | " . $row->age . " | " . $row->gender;
                echo "</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </body>
</html>
