<?php
    include("connect.php");
    $id = $_GET['id'];
    $q = "delete from grocerytb where id = $id ";
    mysqli_query($con,$q);
?>