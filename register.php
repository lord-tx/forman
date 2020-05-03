<html>
<head>
    <title> Get Forman </title>
    <meta charset="utf-8">
	<meta name="description" content="Encrypted Mailing Service" />
	<meta name="keywords" content="mail, email, messages, texting, mime, mailing, secure" />
	<meta name="author" content="Mark Jordan" />

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="RegPage">
        <div id="headerlogo">
            <a href="login.php"><img src="images/FormanLogo.svg"/></a>
        </div>
        <div id="LeftImage"><img src="images/TriangleLeft.svg"></div>
        <div id="RightImage"><img src="images/TriangleRight.svg"></div>
        <center>
            <h3> Encrypted Emailing Service </h3>
            <br/>
            <img src="images/LockedSym.svg"/>
            <br/> <br/> <br/>
            <form method="post" action="register.php">
                <div id="n_input">
                    <input type="text" name="fullname" placeholder="fullname"/> <br/>
                    <input type="email" name="email" placeholder="email"/> <br/>
                    <input type="password" name="password" placeholder="password"/> <br/>
                    <input type="text" name="signature" placeholder="signature"/> <br/>
                </div>
                <input type="submit" name="submit" value="REGISTER"/> </span> <br/>
                <a href="login.php"> Login </a>
            </form>
        </center>
    </div>
</body>
</html>


<?php

    if(isset($_POST['submit']))
    {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $cpassword = md5($_POST['cpassword']);
        $signature = $_POST['signature'];

        if ($fname && $lname && $email && $password && $cpassword)
        {
            if (preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
            {
                $con = mysqli_connect("localhost", "root", "", "forman") or die("Couldn't Open a Database connection");

                mysqli_query($con, "INSERT INTO forman-users(firstname, lastname, email, password, signature) VALUES=('$fname', '$lname', '$email', '$password', '$signature')");
            }
            else
            {
                echo "<center>Not a real email</center>";
            }
        }
        else
        {
            echo "<center>Input all fields</center>";
        }
    }

?>
