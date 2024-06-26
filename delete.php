<?php
require("connection.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "DELETE FROM `products` WHERE `id`='$id'";

    if (mysqli_query($con, $query)) {
        header("location: index.php?success=deleted");
    } else {
        header("location: index.php?alert=delete_failed");
    }
} else {
    header("location: index.php?alert=no_id");
}
?>
