<?php
include_once'Resource/database.php';

$target_dir = "uploads/"; // directory to upload to
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1; // flag to show success!
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["upload"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Oops, File already exists.";
    $uploadOk = 0;
}

// Check file size

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Oops, File too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Oops, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
  {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    $imageName = $_FILES["fileToUpload"]["name"];
    $theName = $_POST['picname'];
    $sqlInsert = "INSERT INTO upload (image_name,image)
                  VALUES ('$theName','$imageName')";
    if(mysql_query($db,$sqlInsert))
    {
      echo "New record created successfully";
    }
    else {
      echo "Error: ".$sqlInsert."<br >".mysql_error($db);
    }
  }
  else {
        echo "Oops, Error uploading your file.";
    }
}
?>
