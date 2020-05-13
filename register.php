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
    </script>

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
                    <input type="text" name="fullname" placeholder="fullname" required> <br>
                    <input type="email" name="email" placeholder="email" required/> <br>
                    <input type="password" name="password" id="pass" placeholder="password" required/> <br>
                    <input type="text" name="signature" id="signature" placeholder="click below to generate" /> <br>
                    <input type="button" name="generate" style="width: 2px; height:2px;" value="O" onclick="generate_signature()"/> <br>
                </div>

                <input type="submit" name="submit" value="REGISTER"/> <br/>
                <a href="login.php"> Login </a>
            </form>
        </center>
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
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $signature = $_POST['signature'];

        echo $fname . ' ' . $lname . ' ' . $email . ' ' . $password . ' ' . $signature;

        if ($fname && $lname && $email && $password && $signature)
        {
            if (preg_match("/^[_0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
            {
                $con = mysqli_connect("localhost", "root", "", "forman") or die("Couldn't Open a Database connection");

                $duplicate_email=mysqli_query($con, "SELECT email FROM forman_users WHERE email='$email'");

                $count = mysqli_num_rows($duplicate_email);

                if($count != 0)
                {
                    echo "<script type='text/javascript'> alert('Email already exists, please enter another email!.')</script>";
                }
                else
                {
                    mysqli_query($con ,"INSERT INTO forman_users(firstname,lastname,email,password,signature) VALUES('$fname','$lname','$email','$password','$signature')");
                    echo "You have registered successfully! <a href='login.php'>Login Now!</a>";
                }

            }
            else
            {
                echo ("Wrong Match");
            }
        }
    }

?>
