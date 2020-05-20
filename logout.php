<?php

    session_start();
    session_destroy();

?>
<head>
    <title>Logout</title>
    <style>
        body
        {
            text-align: center;
        }
        #logout_elements
        {
            font-family: Righteous;
            font-style: normal;
            font-weight: normal;
            margin-left: auto;
            padding: 10px;
            color: white;
            margin-right: auto;
            position: absolute;
            left: 40%;
            top: 40%;
            width: 20%;
            border-radius: 15px;
            background: #387BCA;
        }
        #logout_elements a input
        {
            font-family: Righteous;
            width: 35%;
            font-size: 16px;
            border-radius: 15px;
            background: #387BCA;
            color: white;
        }
    </style>
</head>
<body>
    <hr>
    <div id="logout_elements">
        <h3> Logged Out! </h3>
        <a href="login.php"> <input type="button" value="Login"/> </a>
    </div>
</body>
<?php
    header("Refresh:3; url=login.php");
?>