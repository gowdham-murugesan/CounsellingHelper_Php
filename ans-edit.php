<?php
include "config.php";

$id = $_GET['id'];
$ans = $_GET['ans'];

$con->query("UPDATE users SET ans = '$ans' WHERE id = '$id';");
echo "<script>
    window.location.href='./ans.php';
    alert('Submitted');
    </script>";
?>