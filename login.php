<!DOCTYPE html>
<?php session_start();?>
<html>
    <head>
        <title>User Login</title>
        <link rel="stylesheet" href="./studystyle1.css">
    </head>
    <body>
        <h1>Login</h1>
        <form method="post" id="loginForm" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> id="loginForm">
            <label for="username">Username</label>
            <br>
            <input type="text" id="username" name="loginUsername">
            <br><br>
            <label for="loginPassword">Password</label>
            <br>
            <input type="password" id="loginPassword" name="loginPassword">
            <br>
            <button type="submit" name="loginSubmit">Login</button>
        </form>
        <p id="noAccount">Don't have an account? <a href="register.php">Create one</a> today!</p>

        <?php
        require_once "./connect.php";
        if(isset($_POST["loginSubmit"])) {
            $username = $_POST["loginUsername"];
            $password = hash("sha512", $_POST["loginPassword"]);
            $userSelectQuery = "SELECT * FROM Users WHERE (username = '$username' AND password = '$password')";
            mysqli_select_db($conn, "QuizSite");

            if(empty($username) || empty($password)) {
                echo "Please fill out all fields to log in.";
            } else if(!($userSelect = mysqli_query($conn, $userSelectQuery))) {
                echo "User does not exist.";
            } else {
                $_SESSION["username"] = $username;
                header("Location: ./index.php");
            }
        }
        ?>
    </body>
</html>