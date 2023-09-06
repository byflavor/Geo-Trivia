<!DOCTYPE html>
<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION["username"];
?>
<html>
    <head>
        <link rel = "stylesheet" href="studystyle.css">
    </head>
    <body>
        <?php
        include "./navbar.php";
        require_once "./connect.php";

        $score = 0;
//        echo print_r($_POST["answers"]);
        foreach($_POST['answers'] as $ans) {
            $cansQuery = "SELECT * FROM questionbank WHERE (`COL 1` = '$ans')";
            $cans = mysqli_fetch_array(mysqli_query($conn, $cansQuery))[6];

            if($_POST[$ans] == $cans) {
                $score++;
            }
        }

        $score *= 20;
        echo "<h2>Test results</h2>";
        echo "<h4>Score: $score</h4>";

        if($score <= 60) {
            echo "<p>You did not pass the test.</p>";
        } else {
            echo "<p>Congratulations! You passed the test!</p>";
        }

        $currentUserQuery = "SELECT * FROM users WHERE (username = '$username')";
        $currentTimesTaken = mysqli_fetch_assoc(mysqli_query($conn, $currentUserQuery))["timesTaken"];
        $currentBest = mysqli_fetch_assoc(mysqli_query($conn, $currentUserQuery))["bestScore"];
        if($score > $currentBest) {
            $currentBest = $score;
        }

        $updateQuery = "UPDATE users SET timesTaken = '" . ($currentTimesTaken + 1) . "', bestScore = '$currentBest' WHERE (username = '$username')";
        mysqli_query($conn, $updateQuery);


//        if(isset($_POST['submit'])){
//            $score = 0;
//            /*if ($count >= 0){
//                $count++;
//            }*/
//            for ($i = 1; $i <= 5; $i++){
//                $ans = $_POST[$i];
//                echo ($ans);
//                $cans = $_POST['ans'.$i];
//                if ($ans == $cans){
//                    $score++;
//                }
//            }
//        //score results
//            $score *= 20;
//            if ($score <= 60){
//                echo "You did not pass the test.";
//            }
                //update query to change values in the table for that user
           // $sql = "UPDATE users SET score='$score',count='$count' WHERE username='$id'";
           // $result = mysqli_query($conn, $sql);
        //$sql = "SELECT * FROM users WHERE username='$id'";
        //$result = mysqli_query($conn, $sql);
            //selecting data associated with this particular id
        /*while($row = mysqli_fetch_array($result))
        {
            $score = $row['score'];
            $count = $row['count'];
        }*/
        //echo "$score" . "count: $count";
        ?>

    </body>
</html>