<?php
require("connection.php");

function image_upload($img) {
    $tmp_loc = $img['tmp_name'];
    $new_name = random_int(11111, 99999) . $img['name'];
    $new_loc = UPLOAD_SRC . $new_name;

    if (!move_uploaded_file($tmp_loc, $new_loc)) {
        header("location: index.php?alert=img_upload");
        exit;
    } else {
        return $new_name;
    }
}

if (isset($_POST['addproduct'])) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = mysqli_real_escape_string($con, $value);
    }

    $imgpath = image_upload($_FILES['image']);

    $query = "INSERT INTO `products`(`name`, `price`, `description`, `image`) VALUES ('$_POST[name]','$_POST[price]','$_POST[desc]','$imgpath')";

    if (mysqli_query($con, $query)) {
        header("location: index.php?success=added");
    } else {
        header("location: index.php?alert=add_failed");
    }
}

if (isset($_POST['editproduct'])) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = mysqli_real_escape_string($con, $value);
    }

    $query = "UPDATE `products` SET `name`='$_POST[name]', `price`='$_POST[price]', `description`='$_POST[desc]'";

    if ($_FILES['image']['name']) {
        $imgpath = image_upload($_FILES['image']);
        $query .= ", `image`='$imgpath'";
    }

    $query .= " WHERE `id`='$_POST[id]'";

    if (mysqli_query($con, $query)) {
        header("location: index.php?success=updated");
    } else {
        header("location: index.php?alert=update_failed");
    }
}

if (isset($_GET['deleteproduct'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "DELETE FROM `products` WHERE `id`='$id'";

    if (mysqli_query($con, $query)) {
        header("location: index.php?success=deleted");
    } else {
        header("location: index.php?alert=delete_failed");
    }
}
?>
