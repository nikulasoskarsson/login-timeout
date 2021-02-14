<?php
if($_POST){
    var_dump($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<div class="container">
    <form action="" class="login" method="POST">
        <div class="input-group">
            <label for="username" class="label">Username</label>
            <input name="username" type="text" class="input">
        </div>
        <div class="input-group">
            <label for="password" class="label">password</label>
            <input name="password" type="password" class="input">
        </div>
        <button class="button">Login</button>
    </form>
</div>
    
</body>
</html>