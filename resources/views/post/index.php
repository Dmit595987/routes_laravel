<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
This is Index page

<div>
    Store
    <div>
        <form action="/post" method="POST">
            <input type="text" placeholder="value" name="title">
            <button type="submit">submit</button>
        </form>
    </div>
</div>

<div>
    <?php
        if($_SESSION['message']){
            echo $_SESSION['message'];
        }
    ?>
</div>
</body>
</html>
