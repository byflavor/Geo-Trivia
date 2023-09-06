<!DOCTYPE html>
<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "./connect.php";
if(!isset($_SESSION["username"])) {
    header("Location: ./login.php");
}

$username = $_SESSION['username'];
$propic = "./defaultPropic.jpg";

if(isset($_POST["uploadSubmit"])) {
    $targetDir = "./profilePictures/$username/";

    if(!is_dir($targetDir)) {
        mkdir($targetDir);
    }

    $targetFile = $targetDir . basename($_FILES["propic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["propic"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    if($uploadOk == 1) {
        if (move_uploaded_file($_FILES["propic"]["tmp_name"], $targetFile)) {
            $propicUpdateQuery = "UPDATE users SET propic = '$targetFile' WHERE (username = '$username')";
            mysqli_query($conn, $propicUpdateQuery);
            echo "<div id='banner'>The file " . htmlspecialchars(basename($_FILES["propic"]["name"])) . " has been uploaded.</div>";
        } else {
            echo "<div id='banner'>Sorry, there was an error uploading your file.</div>";
        }
    } else {
        echo "<div id='banner'>Your file could not be uploaded. Please check the file type.</div>";
    }
}

if($propicTemp = mysqli_query($conn, "SELECT propic FROM users WHERE (username = '$username')")) {
    $propic = mysqli_fetch_assoc($propicTemp)["propic"];
}
?>
<html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" href="./studystyle1.css"
    </head>

    <body>
        <?php
        include "./navbar.php";
        ?>

        <div id="popup">
            <!--Buffers the inner div so that the corners aren't obscured by the scroll bar-->
            <div id="scrollbarBuffer">
                <!--close button-->
                <img src="./close.jpg" id="close" onclick="hideUploadWindow();">

                <!--popupContent class to make popup things more manageable.-->
                <div class="popupContent" id="propicUpload">
                    <form method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' enctype="multipart/form-data">
                        <h3>Upload your new profile picture here.</h3>
                        <img id="previewImg">
                        <input type="file" accept="image/*" name="propic" id="propicInput" onchange="previewFile(event);">
                        <br>
                        <button type="submit" name="uploadSubmit" id="uploadSubmit">Upload image</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="profileContent">
            <h1>Profile Picture</h1>

            <img src="<?php echo $propic?>" id="changeImg">
            <br>
            <button onclick="showUploadWindow()">Upload a new Picture</button>
        </div>
        <script src="profile.js">sizeImage();</script>
    </body>
</html>