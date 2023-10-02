<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admain/layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="admain/layout/css/all.min.css">
    <link rel="stylesheet" href="admain/layout/css/admain.css">
    <script src="jq.min.js"></script>
    <title>admain pag test</title>
</head>
<body>

    <div class="container form">
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
            <input class="form-control" style="margin: 20px auto;" type="text" name="username" id="username" placeholder="username">
            <input class="form-control" style="margin: 20px auto;" type="email" name="email" id="email" placeholder="email">
            <input class="form-control" style="margin: 20px auto;" type="password" name="password" id="password" placeholder="password">
            <input class="form-control btn btn-success" style="margin: 20px auto;" type="submit" value="submit" >
        </form>
    </div>
    
    <script src="admain.js"></script>
    <script src="admain/layout/js/bootstrap.bundle.min.js"></script>
    <script src="admain/layout/js/all.min.js"></script>
</body>
</html>