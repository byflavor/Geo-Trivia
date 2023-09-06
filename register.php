<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="./studystyle1.css">
    </head>
    <body>
        <?php
        require "./connect.php";
        ?>

        <h1>Register</h1>
        <h3 id="center">Make a quiz-taking account!</h3>
        <form id="loginForm" method="POST" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>>
            <table id="registerTable">
                <tr>
                    <td><label for="fName">First Name:</label></td>
                    <td><input type="text" id="fName" name="fName"></td>
                </tr>
                <tr>
                    <td><label for="lName">Last Name:</label></td>
                    <td><input type="text" id="lName" name="lName"</td>
                </tr>
                <tr>
                    <td><label for="dob">Date of birth:</label></td>
                    <td><input type="date" max="<?php echo date("Y-m-d");?>" id="dob" name="dob"></td>
                </tr>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td><input type="text" id="username" name="registerUsername"></td>
                </tr>
                <tr>
                    <td><label for="quizPassword">Password:</label></td>
                    <td><input type="password" id="quizPassword" name="quizPassword"></td>
                </tr>
                <tr>
                    <td><label for="confirmPassword">Confirm Password:</label></td>
                    <td><input type="password" id="confirmPassword" name="confirmPassword"><br><p class="error" id="passwordUnverify">Passwords do not match </p></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="registerSubmit">Register!</button></td>
                </tr>
            </table>

            <?php
            if(isset($_POST["registerSubmit"])) {
                $fName = $_POST["fName"];
                $lName = $_POST["lName"];
                $birthDate = $_POST["dob"];
                $username = $_POST["registerUsername"];
                $password = "";
                // Not setting password yet because I don't want to store it in plain text where I can help it.

                // Check for submission errors:
                if(empty($fName) || empty($lName) || empty($birthDate) || empty($username) ||
                empty($_POST["quizPassword"]) || empty($_POST["confirmPassword"])) {
                    echo "<p class='error'>Please fill out all fields.</p>";
                } else if($_POST["quizPassword"] != $_POST["confirmPassword"]) {
                    echo "<p class='error'>Passwords do not match.</p>";
                } else {
                    // Here's where we finally set password. Note that an sha512 hash is a 128-character string.
                    $password = hash("sha512", $_POST["quizPassword"]);
                    mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS QuizSite");

                    $userInsertQuery = "INSERT INTO Users (username, password, firstName, lastName, birthDate, timesTaken, bestScore)
                                        VALUES ('$username', '$password', '$fName', '$lName', '$birthDate', '0', '0')";
                    if(mysqli_query($conn, $userInsertQuery)) {
                        header("Location: ./login.php");
                    } else {
                        echo "<p class='error'>";
                        if(mysqli_num_rows(mysqli_query($conn, "SELECT username FROM users WHERE (username = '$username')")) != 0) {
                            echo "That username is already in use. Please select a different one.</p>";
                        } else {
                            echo "Something went wrong with creating your login. Please contact the system administrator for help.</p>";
                        }
                    }
                }
            }
            ?>
        </form>

        <script src="register.js">makePasswordsWork();</script>
    </body>
</html>