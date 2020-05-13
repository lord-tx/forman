<html lang="en">
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
            <a href="dashboard.php"><img src="images/FormanLogo.svg"/></a>
        </div>
        <div id="LeftImage"><img src="images/TriangleLogLeft.svg"></div>
        <div id="RightImage"><img src="images/TriangleLogRight.svg"></div>
        <center>
            <h3> Encrypted Emailing Service </h3>
            <br/>
            <img src="images/LockedSym.svg"/>
            <br/> <br/> <br/>
            <form method="post" action="login.php">
                <div id="n_input">
                    <input type="email" name="email" placeholder="email"/> <br>
                    <input type="password" name="password" placeholder="password"/> <br>
                </div>
                <input type="submit" name="submit" value="LOGIN"/> </span> <br>
                <a href="register.php"> Register </a>
            </form>
        </center>
    </div>
</body>
</html>

<?php
session_start();

if($_POST)
{

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = md5($_POST['password']);


    if($_SESSION['email'] && $_SESSION['password'])
    {

    	$con = mysqli_connect("localhost", "root", "", "forman") or die("Could not connect");

    	$query = mysqli_query($con, "SELECT * FROM forman_users WHERE email='".$_SESSION['email']."'");
    	$num_rows = mysqli_num_rows($query);

    	if($num_rows != 0)
        {
    		while($row = mysqli_fetch_assoc($query))
            {
    			$db_email = $row['email'];
    			$db_password = $row['password'];
    			$db_name = $row['firstname'];
    		}
    		if($_SESSION['email']==$db_email)
            {
    			if($_SESSION['password']==$db_password)
                {
                    $_SESSION['name'] = $db_name;
                    header("location:dashboard.php");
    			}
    			else
                {
                    echo "Wrong Password";
                }
            }
        }
    }
}
?>
