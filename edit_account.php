<?php
    session_start();
    if(!isset($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
        $con = mysqli_connect("localhost", "root", "", "forman");
        $query = mysqli_query($con, "SELECT * FROM forman_users WHERE email='" . $_SESSION['email'] . "'");
        $row = mysqli_fetch_assoc($query);
        $id = $row['id'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $email = $row['email'];
        $password = $row['password'];
        $signature = $row['signature'];
    }
?>


<html lang="en">
<head>
    <title> Get Forman </title>
    <meta charset="utf-8">
    <meta name="description" content="Encrypted Mailing Service" />
    <meta name="keywords" content="mail, email, messages, texting, mime, mailing, secure" />
    <meta name="author" content="Mark Jordan" />

    <link rel="stylesheet" type="text/css" href="style.css">

    <script type="text/javascript">
        function generate_signature()
        {
            // Generate a random signature based on the seconds at that time
            let pass = document.getElementById("pass").value;
            let date = Date().split(" ")[4];
            let test = date.split(":");
            let i = Number(test[2]);

            if (i >= 0 && i < 10)
            {
                document.getElementById("signature").value = "a33sDrEw332xMMas1sx" + pass + "p3psQst2e3";
            }
            if (i > 10 && i < 40)
            {
                document.getElementById("signature").value = "Ew223xMMasEwa33sDrEw3322231sx" + pass + "p3psQst2e3";
            }
            if (i > 40 && i < 59)
            {
                document.getElementById("signature").value = "xMMasEwaEw22333ssx" + pass + "p3DrEw3322231psQst2e3";
            }
        }

        function logout()
        {

        }

        function email_alert
        {
            alert("Can't Change Email");
        }
    </script>
    <style>
        body
        {
            text-align: center;
        }

        #Userdetails a
        {
            font-family: Righteous;
            color: grey;
            text-decoration: none;
        }
        #RegPage
        {
            text-align: center;
        }

        #RegPage form
        {
            margin: auto;
        }

    </style>

</head>
<body>
<div id="RegPage">
    <div id="headerlogo">
        <a href="login.php"><img src="images/FormanLogo.svg"/></a>
    </div>
    <div id="Userdetails">
        <a href="logout.php"> <img src="images/lock.svg"> Logout </a>
    </div>
    <div id="LeftImage"><img src="images/TriangleLeft.svg"> Security At it's best, or so. </div>
    <div id="RightImage"><img src="images/TriangleRight.svg"> Edit your account and leave here. </div>
        <h3> Edit Account Information </h3>
        <br/>
        <img src="images/LockedSym.svg"/>
        <br/> <br/> <br/>
    <form method="post" action="edit_account.php">
        <input type="text" name="fullname" value='<?php echo $fname." ".$lname ; ?>' required> <br>
        <input type="email" name="email" value='<?php echo $email; ?>' disabled onmouseenter="email_alert()"> <br>
        <input type="password" name="password" id="pass" placeholder="****************" required> <br>
        <input type="text" name="signature" id="signature" value='<?php echo $signature; ?>' required> <br>
        <input type="button" name="generate" style="width: 2px; height:2px;" value="O" onclick="generate_signature()"> <br>
        <input type="submit" name="submit" value="SAVE"/> <br/>
        <a href="dashboard.php"> Back </a>
    </form>
</div>
</body>
</html>


<?php

if(isset($_POST['submit']))
{
    // Explode the input fullname into first and last name
    $fullname = explode(" ", $_POST['fullname']);
    // Set the firstname variable to the first item in the array $fullname
    $fname = $fullname[0];
    // Check if a second string was entered and set that string to the last name variable.
    $lname = (array_key_exists(1, $fullname) ? $fullname[1] : " ");
    $password = md5($_POST['password']);
    $signature = $_POST['signature'];

    if ($fname && $lname && $email && $password && $signature)
    {
        $con = mysqli_connect("localhost", "root", "", "forman") or die("Couldn't Open a Database connection");

        $query = "UPDATE forman_users SET `firstname` = '$fname', `lastname` = '$lname', `password` = '$password', `signature` = '$signature' WHERE id = $id";
        $result = mysqli_query($con, $query);
        echo "<p> New Changes Saved </p>";
        header("location:edit_account.php");
    }
}

?>
