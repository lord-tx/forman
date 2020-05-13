<?php
    session_start();
    if(!isset($_SESSION['name']))
    {
        header("location:login.php");
    };
?>


<html lang="en">
<head>
    <title> Dashboard </title>
    <meta charset="utf-8">
	<meta name="description" content="Encrypted Mailing Service" />
	<meta name="keywords" content="mail, email, messages, texting, mime, mailing, secure" />
	<meta name="author" content="Mark Jordan" />

	<link rel="stylesheet" type="text/css" href="style.css">

    <script>

    </script>

</head>
<body>
    <div id="RegPage">
        <div id="headerlogo">
            <a href="login.php"><img src="images/FormanLogo.svg"/></a>
        </div>
        <div id="Userdetails"><img src="images/lock.svg"> Hello, <?php echo ($_SESSION['name'])?> </div>
        <center>
            <div id="wrapper">
                <div id="left_elements">
                    <div class="tab">

                    </div>


                <div id="right_elements">

                </div>
            </div>
        </center>
    </div>
</body>
</html>
