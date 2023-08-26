<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['super']) && !isset($_COOKIE['super'])) {
    // header('Location: crud.php');
    echo "<script>
    window.location.href='./crud.php';
    alert('You are not superadmin, You are not authorized to visit this page');
    </script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Users page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .button {
            display: inline-block;
            width: 75px;
            padding: 5px 0px;
            text-align: center;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h2>Query Details</h2>

    <table border="2">
        <tr>
            <td>Name</td>
            <td>email</td>
            <td>Query</td>
            <td>Answer</td>
            <td>Submit</td>
            <!-- <td>Delete</td> -->
        </tr>

        <?php

        include "config.php"; // Using database connection file here

        $name = $_COOKIE['name'];
        
        $records = mysqli_query($con, "SELECT * from users where query!='' and college='".$name."'"); // fetch data from database
        
        while ($data = mysqli_fetch_array($records)) {
            ?>
            <tr id=<?php echo $data['id']; ?>>
                <td>
                    <?php echo $data['name']; ?>
                </td>
                <td>
                    <?php echo $data['email']; ?>
                </td>
                <td>
                    <?php echo $data['college']; ?>
                </td>
                <td>
                    <?php echo $data['query']; ?>
                </td>
                <td><input type="text" class="textbox" id="txt_uname<?php echo $data['id']; ?>" name="txt_uname<?php echo $data['id']; ?>" placeholder="Type your ans here"
                        value="<?php echo $data['ans']; ?>" /></td>
                <td><a href="javascript:void(0);" onclick="return submit(<?php echo $data['id']; ?>);">submit</a></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <script>
        function submit(id) {
            var ans = document.getElementById('txt_uname'+id).value;
            window.location.href='./ans-edit.php?id='+id+'&ans='+ans;
        }
    </script>

</body>

</html>