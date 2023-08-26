<?php
include "config.php";
$email = $_COOKIE['uname'];

$sql_query = "SELECT query, ans, college from users where email='" . $email . "'";
$result = mysqli_query($con, $sql_query);
$ans = mysqli_fetch_array($result);

if (isset($_POST['but_submit'])) {

    $query = $_REQUEST['txt_uname'];
    $college = $_REQUEST['txt_clg'];
    if ($query != "") {
        $con->query("UPDATE users SET query = '$query' WHERE email = '$email';");
        $con->query("UPDATE users SET college = '$college' WHERE email = '$email';");
        $success_message = "Query sent successfully, wait for the reply from admin!";
        
        header("refresh:1;url=query.php");
    }
    else
    {
        $error_message = "Type query in the input field";
    }

}
?>
<html>

<head>
    <title>Query Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        #loading {
            position: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0.7;
            background-color: #fff;
            z-index: 99;
        }

        #loading-image {
            z-index: 100;
        }

        input[type=text],
        input[type=password],
        input[type=email],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div.container {
            text-align: center;
        }

        div#div_login {
            text-align: center;
            width: 50%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
            margin: 0 auto;
        }

        #first_p {
            float: left;
        }

        #second_p {
            float: right;
        }

        @media (max-width: 768px) {
            div#div_login {
                margin-top: 20px;
                width: 95%;
                padding-bottom: 10px !important;
            }

            #first_p {
                float: none;
            }

            #second_p {
                float: none;
            }
        }
    </style>

<body>
    <div id="loading">
        <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
    </div>

    <div class="container">
        <form method="post" action="">
            <div id="div_login" style="padding-bottom: 40px;">
                <h1>Query</h1>
                <?php
                if (!empty($success_message)) {
                    ?>
                    <div class="alert alert-success">
                        <?= $success_message ?>
                    </div>

                    <?php
                }
                ?>
                <?php
                if (!empty($error_message)) {
                    ?>
                    <div class="alert alert-danger">
                        <?= $error_message ?>
                    </div>

                    <?php
                }
                ?>
                <label for="txt_clg">College</label>
                <input type="text" class="textbox" id="txt_clg" name="txt_clg" placeholder="Type college name" value="<?php echo $ans['college'];?>"/>
                <br><br>
                <label for="txt_uname">Query</label>
                <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Type your query here" value="<?php echo $ans['query'];?>"/>
                <br><br>
                <label for="txt_pwd">Answer</label>
                <input type="text" class="textbox" id="txt_uname1" name="txt_pwd" placeholder="Not answered yet..." value="<?php echo $ans['ans'];?>"
                    disabled /> <br><br>
                <input type="submit" value="submit" name="but_submit" id="but_submit" />
            </div>
        </form>
    </div>

    <script>
        $(window).on('load', function () {
            $('#loading').fadeOut();
        });
        var query = document.getElementById("txt_uname").value;
        if(query != "")
        {
            document.getElementById("but_submit").style.display = "none";
        }
    </script>

</body>

</html>