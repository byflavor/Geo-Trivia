<?php
// File to be included in other main pages of the website, describing a navigation bar at the top of the screen.

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "./connect.php";
echo "<div id='navbar'>
            <a href='index.php'>Home</a>
            <a href='study.php'>Study</a>
            <a href='math.php'>Take the test!</a>
            <div id='profile'>";
if(isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    if($propic = mysqli_query($conn, "SELECT propic FROM users WHERE (username='$username')")) {
        $propic = mysqli_fetch_assoc($propic)["propic"];
    } else {
        $propic = "defaultPropic.jpg";
    }
    $name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT firstName FROM users WHERE (username = '$username')"))["firstName"];
    echo "<button id='profileButton'><img id='profileImg' src='$propic'><span>" . $name .
        "</span><div class='vertAlign'><img id='arrow' src='arrow.png'></div></button>";

    echo "<div id='profileDropdown' class='hidden'>
        <a href='./profile.php'>My Profile</a>
        <a href='./logout.php'>Log Out</a>
        </div>";
    echo "<script src='navbar.js'></script>";
} else {
    echo "<button id='profileButton' onclick='location.href = \"./login.php\"'><img id='profileImg' src='./defaultPropic.jpg'>Login</button>";
}
echo "</div></div>";
?>