<?php

    include 'db_conn.php';
   
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM `booking` WHERE  id=$id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            //echo "Deleted successfully";
            header('location: user.php');
        } else {
            die(mysqli_error($conn));
        }
    }
