<?php
    session_start();
    if(!isset($_SESSION['name']))
    {
        header("location:login.php");
    }
    else
    {
        $con = mysqli_connect("localhost", "root", "", "forman");
        $query_one = mysqli_query($con, "SELECT * FROM forman_email WHERE email='" . $_SESSION['email'] . "'");
        $query_two = mysqli_query($con, "SELECT * FROM forman_email WHERE from_email='". $_SESSION['email'] . "'");

        $num_rows_one = mysqli_num_rows($query_one);
        $num_rows_two = mysqli_num_rows($query_two);
    }
?>


<html lang="en">
<head>
    <title> Dashboard </title>
    <meta charset="utf-8">
	<meta name="description" content="Encrypted Mailing Service" />
	<meta name="keywords" content="mail, email, messages, texting, mime, mailing, secure" />
	<meta name="author" content="Mark Jordan" />

	<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->

    <script>
        function openTab(tabName) {
            var i;
            var x = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(tabName).style.display = "block";
        }
    </script>
    <style type="text/css">
        #Userdetails
        {
            position: absolute;
            right: 30px;
            font-style: normal;
            font-weight: normal;
            font-family: Righteous;
        }
        #Userdetails a
        {
            color: grey;
            text-decoration: none;
        }
        input
        {
            color: white;
            font-family: Righteous;
            width: 10%;
            border-radius: 15px;
            background: #387BCA;
        }
        .tab a
        {
            text-decoration: none;
            color: black;
        }
        .tab a:hover
        {
            text-decoration: none;
            color: gray;
        }
        #inbox-entries
        {
            padding-left: 50px;
            padding-bottom: 5px;
            font-family: Candara;
            border-bottom: solid;
            border-right: solid;
            border-
        }
        li button
        {
            width: 10%;
        }
        li
        {
            list-style-type: none;
            display: inline;
        }
        #access-buttons
        {
            width: 100%;
        }
        em
        {
            font-size: 12px;
        }

    </style>

</head>
<body>
    <div id="headerlogo">
        <a href="login.php"><img src="images/FormanLogo.svg"/></a>
    </div>
    <div id="Userdetails">
        <a href="edit_account.php"> <img src="images/lock.svg"> Hello, <?php echo ($_SESSION['name'])?> </a>
    </div>
    <p><a href="compose.php"><input type="submit" name="submit" value="Compose"></a></p>
    <div id="access-buttons">
        <li> <button class="w3-bar-item w3-button" onclick="openTab('Inbox')">Inbox</button> </li>
        <li> <button class="w3-bar-item w3-button" onclick="openTab('Sent')">Sent</button> </li>
        <li> <button class="w3-bar-item w3-button" onclick="openTab('Outbox')">Outbox</button> </li>
    </div>

    <div id="Inbox" class="tab">
        <h2>Inbox</h2>
            <?php
            echo "<hr>";
            if ($num_rows_one != 0)
            {
                while ($row = mysqli_fetch_assoc($query_one))
                {
                    $id = $row['id'];
                    $email = $row['email'];
                    $from_email = $row['from_email'];
                    $signature = $row['signature'];
                    $subject = $row['subject'];
                    $body = $row['body'];

                    echo "<a href='email.php?id=$id\'>";

                    echo "<div id='inbox-entries'>";
                    echo "<b>$from_email </b> &nbsp;&nbsp;";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$body<br>";
                    echo "<em>$signature</em><br>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            else
            {
                echo "No Mail";
            }
            ?>
        <p>Various Messages tabulated in the inbox</p>
    </div>

    <div id="Sent" class="tab" style="display:none">
        <h2>Sent</h2>
            <?php
            if ($num_rows_two != 0)
            {
                while ($row = mysqli_fetch_assoc($query_two))
                {
                    $id = $row['id'];
                    $email = $row['email'];
                    $subject = $row['subject'];
                    $body = $row['body'];
                    $rec_sig = $row['rec_sig'];

                    echo "<a href='email.php?id=$id\'>";

                    echo "<div id='inbox-entries'>";
                    echo "<b>$email </b> &nbsp;&nbsp;";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $body<br>";
                    echo "<em>$rec_sig</em><br>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            else
            {
                echo "No Mail";
            }
            ?>
        <br>
        <p>Sent Messages tabulated in the mail viewer</p>
    </div>

    <div id="Outbox" class="tab" style="display:none">
        <h2>Outbox</h2>
        <p>Outbox Messages tabulated in the mail viewer</p>
    </div>


</body>
</html>