<!DOCTYPE html>
<?php
//123003 and 122145 Date: 12/10/21 Purpose: quiz page with questions
//Citatons: Ms. Pandya, Noor, W3Schools
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<html>
    <head>
        <link rel="stylesheet" href="studystyle1.css">

    </head>
    <body>
        <?php
        include "./navbar.php";

        echo "<h1>Geography Quiz</h1>";
        echo "<form action='grade.php' method='post'><div class='quizdiv'";
            require_once "connect.php";
             //Getting the username of the person taking the quiz 
    //and notifying them if they have maxxed their attempts and their best score
            $userQuery = "SELECT * FROM users WHERE (username = '" . $_SESSION["username"] . "')";
            $user = mysqli_fetch_assoc(mysqli_query($conn, $userQuery));
            if($user['timesTaken'] >= 3) {
                echo "<p>You have already taken this quiz the maximum number of times.</p>";
                echo "<p>Best score: " . $user["bestScore"] . "</p>";
            } else {
                 //if they have not maxxed their attempts:
                mysqli_select_db($conn, "csv_db 10");
                $query = "SELECT * FROM questionbank ORDER BY RAND() LIMIT 5;";
                $result = mysqli_query($conn, $query);

                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $i = $row[0];
                    echo
                    "<label>" . ($count + 1) .". $row[1]</label><br>
                    <input type = 'radio' name = '$i' value = '$row[2]' required>
                    <label>$row[2]</label>
                    <input type = 'radio' name = '$i' value = '$row[3]'>
                    <label>$row[3]</label>
                    <input type = 'radio' name = '$i' value = '$row[4]'>
                    <label>$row[4]</label>
                    <input type = 'radio' name = '$i' value = '$row[5]'>
                    <label>$row[5]</label>
                    <br><br>";
                    echo "<input type='hidden' name='answers[$count]' value='$i'>"; //source: Ms. Pandya

                    $count++;
                    $i++;
                }

                echo "<input type='submit' class = 's' name='submit'><br><br>";
                echo "</form></div>";
            }
        ?>
    </body>

      