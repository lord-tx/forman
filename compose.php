<?php
    session_start();
    if(!isset($_SESSION['name']))
    {
        header("location:login.php");
    };
    $con = mysqli_connect("localhost", "root", "", "forman");
    $query = mysqli_query($con, "SELECT * FROM forman_users WHERE email='".$_SESSION['email']."'");
    $row = mysqli_fetch_assoc($query);
    $signature = $row['signature'];
    $from_email = $_SESSION['email'];
?>

<html>
    <head>
        <title> Compose </title>
        <style type="text/css">
            body
            {
                text-align: center;
            }
            #compose
            {
                margin-left: auto; margin-right: auto;
                text-align: center;
                padding-left: 100px;
                padding-right: 100px;
                padding-top: 10px;
            }
            table
            {
                margin-left: auto; margin-right: auto;
                padding: 1px;
                width: 100%;
            }
            table td
            {
                padding: 10px;
            }
            table tr
            {
                background-color: #999999;
                padding: 10px;
                font-family: Righteous;
            }

            p input
            {
                color: white;
                background-color: #387BCA;
                width: 10%;
                height: 5%;
                border-radius: 20px;
            }

            table input
            {
                width: 100%;
                padding:10px;
                border: none;
            }

            textarea
            {
                width: 100%;
                height: 25%;
            }

            p
            {
                font-size: 42px;
                padding: 10px;
                font-family: Righteous;
            }
            #Userdetails
            {
                position: absolute;
                right: 30px;
                font-style: normal;
                font-weight: normal;
            }
            #Userdetails a
            {
                font-family: Righteous;
                color: grey;
                text-decoration: none;
            }

        </style>
    </head>
    <body>
        <div id="Userdetails">
           <a href="edit_account.php"> <img src="images/lock.svg"> Hello, <?php echo ($_SESSION['name'])?> </a>
        </div>
        <div id="compose">
            <p> Compose </p><hr>
            <form method="post" action="compose.php">
                <table>
                    <tr>
                        <td> <label> To: </label> <input type="email" name="to" maxlength="40" placeholder="johndoe@example.com" required></td>
                        <td> <label> Subject: </label> <input type="text" name="subject" maxlength="40" required> </td>
                    </tr>
                    <tr>
                        <td> <label> Your Signature: </label> <input type="text" name="signature" value='<?php echo $signature; ?>' ></td>
                        <td> <label> Receivers' Signature: </label> <input type="text" name="rec_signature" placeholder="paste the receivers signature here or leave blank if you don't have it"></td>
                    </tr>
                </table>
                <textarea maxlength="10000" name="body" cols="98" rows="20" required spellcheck="true"></textarea><br>
                <p> <input type="submit" name="submit" value="Send">
                <a href="dashboard.php"> <input type=button value="Back"> </a>
                </p>

            </form>
        </div>
    </body>

</html>

<?php
    if(isset($_POST['submit']))
    {
        $email = $_POST['to'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];
        mysqli_escape_string($con, $body);
        $rec_signature = $_POST['rec_signature'];

        if(!($rec_signature) || (strlen($rec_signature) < 20))
        {
            $rec_signature = "0x16";
        }

        if (($_POST['signature']) != $signature)
        {
            echo "<script> alert('Please do not tamper with the signature') </script>";
        }
        else
        {
            $con = mysqli_connect("localhost", "root", "", "forman");
            $query = mysqli_query($con, "INSERT INTO forman_email(email,subject,signature,body,rec_sig,from_email) VALUES('$email','$subject','$signature','$body','$rec_signature','$from_email')");
        }
    }
?>